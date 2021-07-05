<div class="dash-categories">

  @php
  $main_categories = [
    'slots' => [
      'title' => 'Slots',
      'href' => 'all',
      'image' => 'cats/cat_slots.png',
      'count' => 0
    ],
    'card' => [
      'title' => 'Cards',
      'href' => 'card',
      'image' => 'cats/cat_cards.png',
      'count' => 0
    ],
    'roulette' => [
      'title' => 'Roulette',
      'href' => 'roulette',
      'image' => 'cats/cat_roulette.png',
      'count' => 0
    ],
    'bingo' => [
      'title' => 'Bingo',
      'href' => 'bingo',
      'image' => 'cats/cat_bingo.png',
      'count' => 0
    ],
    'fish' => [
      'title' => 'Fish',
      'href' => 'fish',
      'image' => 'cats/cat_fish.png',
      'count' => 0
    ],
    'keno' => [
      'title' => 'Keno',
      'href' => 'keno',
      'image' => 'cats/cat_keno.png',
      'count' => 0
    ]
  ];

  foreach ($categories as $key => $value) {
    if(array_key_exists($value['href'], $main_categories)){

    }
  }
  @endphp

  @foreach ($main_categories as $cat)
  <a href="/categories/{{$cat['href']}}">

    <h3>{{$cat['title']}}</h3>
    @if (false)
    <span>{{$cat['count']}} games</span>
    @endif

    <div style="background-image:url('{{asset('frontend/Tropicana/img/'.$cat['image'])}}')"></div>

  </a>
  @endforeach


</div>
