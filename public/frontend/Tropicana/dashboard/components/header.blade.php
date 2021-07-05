
@php
  $return = \VanguardLTE\Returns::where('shop_id', Auth::user()->shop_id)->first();
                $pincodes = \VanguardLTE\Pincode::where(['shop_id' => Auth::user()->shop_id, 'status' => 1, 'activated_at' => null])->count();
  $happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'time' => date('G'), 'status' => 1])->first();
  if(!$happyhour){
    $happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'status' => 1])->where('time', '>',date('G'))->first();
  }
  if(!$happyhour){
    $happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'status' => 1])->first();
  }
@endphp

@if ( $return && auth()->user()->present()->count_return > 0 && auth()->user()->present()->balance <= $return->min_balance )
<div class="cashback-pop">
  <div class="cashback-infos">
    <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_pGUlZz.json"  background="transparent"  speed="0.9"  style=""  autoplay loop></lottie-player>
    <span>Continue to play ! Your <b>{{number_format(Auth::user()->count_return, 2,","," ")}} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</b> cashback is now available !</span>
    <button type="button" id="returns" name="button">I take it !</button>
  </div>
</div>
@endif

<header class="dheader">
    <div>
      <div class="humberger-menu tggle-menu" data-action="show">
        <i data-feather="menu"></i>
      </div>
      <ul class="topm">
        <li>
          <a href="/categories/all">HOME</a>
        </li>
        <li>
          <a class="search_showing">
            <div class="search_pc">
              <span>Search ...</span>
              <i data-feather="search"></i>
            </div>
          </a>
        </li>
      </ul>
      <div class="menu-mobile">
        @include('frontend.Tropicana.dashboard.components.leftmenu')
      </div>

    </div>
    <div>
      <div class="logo">
        <img src="{{ asset('frontend/Tropicana/img/logo_dragon.png') }}"/>
      </div>
    </div>
    <div>
      @include('frontend.Tropicana.dashboard.components.userinfos')
    </div>
</header>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" charset="utf-8"></script>
<script type="text/javascript">
  $('#returns').on('click', function(e) {


    $('.cashback-infos').html(`

          <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_bRNzlt.json"  background="transparent"  speed="0.9"  style=""  autoplay loop></lottie-player>
      `);

      e.preventDefault();
      $.get('{{ route('frontend.profile.returns')  }}', function(data) {
        if (data.success) {

          $('.cashback-infos').html(`

                <lottie-player src="https://assets4.lottiefiles.com/temp/lf20_zBfmHv.json"  background="transparent"  speed="0.9"  style=""  autoplay loop></lottie-player>
            `);

            setTimeout(function(){
              $('.cashback-infos').html(`
                <span>` + '@lang('app.your_cash_back_bonus') <b>' + data.value + ' '+ data.currency +'</b> @lang('app.has_been_added_to_the_balance').' + `</span>
                <button type="button" id="ct" name="button">Continue</button>
                `);

                $('#ct').on('click', function(){
                  location.reload();
                });

            }, 2800);

          // $('.cashBankText').html('@lang('app.your_cash_back_bonus') <b>' + data.value + ' '+ data.currency +'</b> @lang('app.has_been_added_to_the_balance'). <br />@lang('app.have_a_good_game_in') <b>{{ config('app.name') }}</b>.');
          // $("div.modal-bonus").addClass("active");
          // $(".overlay").fadeIn();
          // $('.balanceValue').text(data.balance + ' ' + data.currency);
          // $('#balanceValue').html(data.balance + '&ensp;<em>'+ data.currency +'</em>');
          //
          // $('#returns').remove();
        }
        if (data.fail) {
          alert("The CashBack Bonus was fully extended , Please contact your Agent/Admin with code error limit50021");
          $('.cashback-pop').remove();
        }
      }, 'json');




  });
</script>
