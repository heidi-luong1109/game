<nav class="leftmenu">
  <div class="user-logout">
    <a href="/logout">
      Logout
    </a>
  </div>
  <header>
    <h3>Categories</h3>
    <div class="tggle-menu" data-action="hide">
      <i data-feather="x"></i>
    </div>
  </header>
  <div>

    @php
     $mainCategories = [
      'hot' => [
        'icon' => 'https://assets10.lottiefiles.com/packages/lf20_vT2Gkd.json',
        'icon_type' => 'lottie'
      ],
      'new' => [
        'icon' => 'https://assets8.lottiefiles.com/temp/lf20_gNBoNM.json',
        'icon_type' => 'lottie'
      ],
      'card' => [
        'icon' => 'frontend/Tropicana/img/icons/poker-cards.png',
        'icon_type' => 'image'
      ],
      'keno' => [
        'icon' => 'frontend/Tropicana//img/icons/keno.png',
        'icon_type' => 'image'
      ],
      'roulette' => [
        'icon' => 'frontend/Tropicana//img/icons/roulette.png',
        'icon_type' => 'image'
      ],
      'bingo' => [
        'icon' => 'frontend/Tropicana//img/icons/bingo.png',
        'icon_type' => 'image'
      ],
      'fish' => [
        'icon' => 'https://assets7.lottiefiles.com/private_files/lf30_tcE86H.json',
        'icon_type' => 'lottie'
      ]
    ];

    foreach ($categories as $key => $value) {
      if(array_key_exists($value['href'], $mainCategories)){
        $mainCategories[$value['href']] = array_merge($mainCategories[$value['href']], ['type' => 'category'], json_decode(json_encode($value), true));
      } else {
        $mainCategories[$value['href']] = array_merge(['type' => 'company'], json_decode(json_encode($value), true));
      }
    }
    unset($mainCategories['vision']);


    @endphp

    <ul>
      @foreach ($mainCategories as $cat)
        @if ($cat['type'] == "category")
        <li class="{{$cat['type']}}-{{$cat['icon_type']}}">
          <a class="@if (request()->category1 == $cat['href'])
                        selected
                    @endif" href="/categories/{{$cat['href']}}">

              @if ($cat['icon_type'] == "lottie")
                <div class="lottie-player">
                  <lottie-player class="{{$cat['href']}}" src="{{$cat['icon']}}"  background="transparent"  speed="0.9"  style=""  autoplay loop></lottie-player>
                </div>
              @endif

              @if ($cat['icon_type'] == "image")
              <div class="lottie-player">
                <img src="{{asset($cat['icon'])}}" alt="">
              </div>
              @endif
              <span>{{$cat['title']}}</span>
          </a>
        </li>
        @endif
      @endforeach
    </ul>
    <ul class="company">
      @foreach ($mainCategories as $cat)
        @if ($cat['type'] == "company")
        <li class="{{$cat['type']}}">
          <a class="@if (request()->category1 == $cat['href'])
                        selected
                    @endif" href="/categories/{{$cat['href']}}">
              <img src="{{asset('frontend/Tropicana/img/companies/'.$cat['href'].'.png')}}" alt="">
          </a>
        </li>
        @endif
      @endforeach
    </ul>
  </div>
</nav>
