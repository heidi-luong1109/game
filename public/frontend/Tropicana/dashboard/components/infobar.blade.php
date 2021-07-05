<section class="infosbar">
    <div class="jk">
      <div class="mjk">
        @php
        $totalValueJackpots = 0;
        foreach ($jpgs as $key => $value){
          $totalValueJackpots += $value->balance;
        }
        @endphp
        <img src="{{asset('frontend/Tropicana/img/global/megajackpot.png')}}" />
        <span id="jackpots-mega" data-value="{{$totalValueJackpots}}">{{number_format($totalValueJackpots, 2)}}</span>
      </div>
      <ul class="jackpots-listing">

        @foreach ($jpgs as $jack)

          <li class="jacpot jacpots-{{$jack->id}}">

            <span>{{$jack->name}}</span>
            <span id="jacpots-{{$jack->id}}-value" data-value="{{$jack->balance}}">{{number_format($jack->balance, 2)}}</span>

          </li>

        @endforeach
      </ul>
    </div>
    <div class="cru">

    </div>
</section>
