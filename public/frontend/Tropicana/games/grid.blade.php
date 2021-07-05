<div class="grid-game">
  @php
  $games_list = [];
  @endphp
  @foreach ($games as $key=>$game)
    @if ($game['view'] == 1)
      <div>
        <h4>{{$game['title']}}</h4>
        <a href="/game/{{$game['name']}}" style="background-image:url('{{ $game->name ? '/frontend/Tropicana/ico/' . $game->name . '.jpg' : '' }}')">
        </a>
      </div>
      @endif
  @endforeach
</div>
