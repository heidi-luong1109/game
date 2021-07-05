
<div class="user-logout">
  <a href="/logout">
    <i data-feather="x"></i>
  </a>
</div>
<div class="blc">
  <div>
    <span>Balance</span>
    <span><i id="balance-amnt" data-value="{{Auth::user()->balance}}">{{ number_format(Auth::user()->balance, 2,","," ") }} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</i></span>
  </div>
  <i data-feather="chevron-down"></i>
  <ul>
    <li>
      <p>Account balance</p>
      <span class="amount balanceValue">{{ number_format(Auth::user()->balance, 2,","," ") }} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</span>
    </li>
    <li>
      <p>Bonus balance</p>
      <span class="amount">{{ number_format(Auth::user()->bonus, 2,","," ") }} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</span>
    </li>
    <li>
      <p>Wager</p>
      <span class="amount">{{ number_format(Auth::user()->wager, 2,","," ") }} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</span>
    </li>
    <li>
      <p>CashBack</p>
      <span class="amount">{{ number_format(Auth::user()->count_return, 2,","," ") }} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</span>
    </li>
  </ul>
</div>

<a class="user">
  <div class="user-inf">
    <span>Welcome,</span>
    <span>{{ Auth::user()->username }}</span>
  </div>
  <div class="user-pc">
    <span>{{substr( Auth::user()->username, 0, 1) }}</span>
  </div>
</a>
