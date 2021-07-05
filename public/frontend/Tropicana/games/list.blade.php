@extends('frontend.Tropicana.layouts.app')
@section('page-title', $title)

@section('content')

<div class="gscrolsm">

	@if (request()->category1 == "all")
	<div class="home-toph">
		<div>
			@include('frontend.Tropicana.dashboard.components.slidershow')
			@include('frontend.Tropicana.games.categories')
		</div>
	</div>
	@endif

	@include('frontend.Tropicana.games.grid', ['games_category' => 'Hot'])

</div>

@stop
