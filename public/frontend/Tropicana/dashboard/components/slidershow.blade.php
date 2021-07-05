<div class="slidershow">

  <div class="scrollbar">
    <div class="handle">
      <div class="mousearea"></div>
    </div>
  </div>

  <div class="frame" id="basic">
    <ul class="clearfix">
      @for ($i = 1; $i <= 11; $i++)
      <li>
        <a href="/play/" style="background-image:url('{{asset('frontend/Tropicana/img/slider/'.$i.'.jpg')}}')">

        </a>
      </li>
      @endfor
    </ul>
  </div>

</div>
