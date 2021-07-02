@extends('frontend.Ggslot.layouts.app')
@section('page-title', $title)

@section('content')

		
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
  </div>
  <div class="phone-rotate">
    <div class="section"><img src="/frontend/Ggslot/images/rotate.gif" width="403"></div>
  </div>


   <!--script>// Find the right method, call on correct element
function launchFullScreen(element) {
  if(element.requestFullScreen) {
    element.requestFullScreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullScreen) {
    element.webkitRequestFullScreen();
  }
}

// Launch fullscreen for browsers that support it!
launchFullScreen(document.documentElement); // the whole page
launchFullScreen(document.getElementById("videoElement")); // any individual element
   </script>
   <script>
   addEventListener("click", function() {
    var
          el = document.documentElement
        , rfs =
               el.requestFullScreen
            || el.webkitRequestFullScreen
            || el.mozRequestFullScreen
    ;
    rfs.call(el);
});
</script-->


<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #000;
                color: #636b6f;
               
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
                background-color: #000;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>

</html>

<!DOCTYPE html>
<html>
<body>


<iframe id="" src="../frontend/Ggslot/allgames.php" style="position:absolute; width:100%; color: #000;height:100%;border:0;z-index:1;"></iframe>


<script>
function myFunction() {
  var x = document.getElementById("myframe").src;
  document.getElementById("demo").innerHTML = x;
}
</script>

</body>
</html>





            <div data-ix="roll-down-jp-1" id="jp1" class="jp-text-01 text-jp-number"><span style="color:#fff;font-weight: bold;" class="jackpot__value jackpot4">
								            @if( count($jpgs) > 1 )
									            {{ number_format ($jpgs[1]->balance, 2,".","") }}
								            @endif											
											</span></div>
            <div data-ix="roll-down-jp-2" id="jp2" class="jp-text-02 text-jp-number"><span style="color:#eee;font-weight: bold;" class="jackpot__value jackpot4">
								            @if( count($jpgs) > 2 )
									            {{ number_format ( $jpgs[2]->balance, 2,".","") }}
								            @endif											
											</span></div>
            <div data-ix="roll-down-jp-3" id="jp3" class="jp-text-03 text-jp-number"><span style="color:#ffeb3b;font-weight: bold" class="jackpot__value jackpot4">
								            @if( count($jpgs) > 3 )
									            {{ number_format ( $jpgs[3]->balance, 2,".","") }}
								            @endif											
											</span></div>
			 <div data-ix="roll-down-jp-4" id="jp4" class="jp-text-04 text-jp-number"><span style="color:#ff6838;font-weight: bold" class="jackpot__value jackpot4">
								            @if( count($jpgs) > 4 )
									            {{ number_format ( $jpgs[4]->balance, 2,".","") }}
								            @endif											
											</span></div>
          </div>

        <div class="div-logo-page"><img src="" width="1" class="image-2"></div>
        <h3 class="footr-down select-game"></h3>
        <div class="footer-slider">
          <div class="div-btn-exit-user">
		  <div>
<html>



<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  
  document.getElementById('txt').innerHTML =
  h + ":" + m ;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
<body onload="()" ></div>
            <div id="gredit" class="text-gredit"></div>
			<footer class="footer">
		<div class="container">
			<div class="footer__block">
				<div class="footer__left">
					@if ( $return && auth()->user()->present()->count_return > 0 && auth()->user()->present()->balance <= $return->min_balance )
					<a href="#" data-name="modal-bonus" class="gift" id="returns">
					</a>
					@endif
					
					<span style="right: 7vw;
    position: fixed;
    top: 5.6vw;
    text-align: center;
    font-size: 1.1vw;
    font-family: revert;
    font-weight: 800;
    color: #FFEB3B;">Bonus: <span>{{ number_format(Auth::user()->count_return, 2,".","") }} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</em></span>
				</div>
				<div class="">
					<div class="">
						<span class="text-gredit" id="balanceValue">{{ number_format(Auth::user()->balance, 2,".","") }} <em>@if( auth()->user()->present()->shop )  @endif</em></span>
					</div>
			

          </div>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">



<style>
.button{
    position: fixed;
    left: 11%;
    top: 7%;
    width: 11%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
	.button:hover {
    opacity:0.5;
    z-index: 99999;
	}

	.button1{
    position: fixed;
    left: 22%;
    top: 7%;
    width: 11%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
.button1:hover {
    opacity:0.5;
    z-index: 99999;
	}
	.button2{
    position: fixed;
    left: 33%;
    top: 7%;
    width: 11%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
.button2:hover {
    opacity:0.5;
    z-index: 99999;
	}
	.button3{
    position: fixed;
    left: 44%;
    top: 7%;
    width: 12%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
.button3:hover {
    opacity:0.5;
    z-index: 99999;
	}
	.button4{
    position: fixed;
    left: 55%;
    top: 7%;
    width: 11%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
.button4:hover {
    opacity:0.5;
    z-index: 99999;
	}
	.button5{
    position: fixed;
    left: 66%;
    top: 7%;
    width: 11%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}

	.button6{
    position: fixed;
    left: 77%;
    top: 7%;
    width: 11%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
.button6:hover {
    opacity:0.5;
    z-index: 99999;
	}
	.button7{
    position: fixed;
    left: 88%;
    top: 7%;
    width: 10%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
.button7:hover {
    opacity:0.5;
    z-index: 99999;
	}
</style>

    <!--a href="/frontend/Ggslot/allgames.php"><img src="/frontend/Ggslot/images/allgames0.png" class="button"></a></div>
	<a href="/frontend/Ggslot/amatic.php"><img src="/frontend/Ggslot/images/amatic0.png" class="button1"></a></div>
	<a href="/frontend/Ggslot/table.php"><img src="/frontend/Ggslot/images/table0.png" class="button2"></a></div>
	<a href="/frontend/Ggslot/novomatic.php"><img src="/frontend/Ggslot/images/novomatic0.png" class="button4"></a></div>
	<a href="#"><img src="/frontend/Ggslot/images/egt1.png" class="button5"></a></div>
	<a href="/frontend/Ggslot/wazdan.php"><img src="/frontend/Ggslot/images/wazdan0.png" class="button6"></a></div-->

          </div>
		  		          </div>
			            <a href="/logout"><img src="../frontend/Ggslot/img/exit.png" style="position: fixed;
    right: 0.5%;
    top: 7.5%;
    width: 6%;
    height: 9%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout0.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;"></a></div>
				          <a href=""><img src="../frontend/Ggslot/images/jackpot_bar.png" style="position: fixed;
    right: 0%;
    top: 0%;
    width: 100%;
    height: 9%;
    border: 1px none #fff;
    background-size: 7vw auto;
    z-index: 9999;"></a></div>


		
            </div>


</div>
		
			<html>


</body>
          <div class="div-main-button-cat-footer">
            <!--div class="div-batton-category"><a href="#" class="link-block w-inline-block"><img src="images/ALL-GAME-3.png" class="btn-all-game img-btn-cat"></a></div>
            <div class="btn-cat-02 div-batton-category"><a href="lobby-page/Ggslot.php" class="w-inline-block"><img src="images/Ggslot-3.png" class="img-btn-cat"></a></div>
            <div class="btn-cat-03 div-batton-category"><a href="lobby-page/novomatic.php" class="w-inline-block"><img src="images/NOVOMATIC-5.png" class="img-btn-cat"></a></div>
            <div class="btn-cat-04 div-batton-category"><a href="lobby-page/netent.php" class="w-inline-block"><img src="images/NETENT-3.png" class="img-btn-cat"></a></div>
            <div class="btn-cat--5 div-batton-category"><a href="lobby-page/gaminator.php" class="w-inline-block"><img src="images/gaminator.png" class="img-btn-cat"></a></div>
            <div class="btn-cat---6 div-batton-category"><a href="lobby-page/slots.php" class="w-inline-block"><img src="images/SLOTS-2.png" class="img-btn-cat"></a></div>
            <div class="btn-cat---7 div-batton-category"><a href="lobby-page/casino.php" class="w-inline-block"><img src="images/CASINO-2.png" class="img-btn-cat"></a></div-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
  <script src="/frontend/Ggslot/js/kzr-dd-tronic.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  <!-- ///////////////--Footer Code---//////////////////////-- -->


	<span style="left: 2vw;
    position: fixed;
    bottom: 2.6vw;
    text-align: center;
    font-size: 1.1vw;
    font-family: revert;
    font-weight: 800;
    color: #fff;
	z-index:99999">ID : <em> {{ Auth::user()->username }}</em></span>
				</div>	
		
						
						<!-- GAMES - BEGIN -->
				@if ($games && count($games))
					@foreach ($games as $key=>$game)
 
  
  






						
					@endforeach
				@endif
						<!-- GAMES - BEGIN -->
			
			<!-- SLIDER - END -->
		</div>
	</main>

				

	<!-- /.MAIN -->


@stop

