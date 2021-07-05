@extends('frontend.Flaming777v1.layouts.auth')

@section('page-title', trans('app.login'))

@section('content')
	
	<main class="main login-page">

		<div class="wrapper">
			<!-- LOGIN BEGIN -->
			<div class="login">
				<a href="#" class="login__logo logo">
					<img src="/frontend/Flaming777v1/img/_src/logo.png" alt="">
				</a>
				@include('backend.partials.messages')
				<form role="form" action="<?= route('frontend.auth.login.post') ?>" method="POST" id="login-form" class="form login__form">
					<div class="form__group">
					    <input type="hidden" value="<?= csrf_token() ?>" name="_token">
						<input type="text" name="username" placeholder="@lang('app.email_or_username')">
						<input type="password" name="password" placeholder="@lang('app.password')">
						<button class="btn form-btn">@lang('app.log_in')</button>
					</div>
				</form>
			</div>
			<!-- LOGIN END -->
			<div class="banner">
					<a href="#" class="banner__item">
						<img src="/frontend/Flaming777v1/img/_src/slide1.png" alt="">
					</a>
					<a href="#" class="banner__item">
						<img src="/frontend/Flaming777v1/img/_src/slide2.png" alt="">
					</a>
					<a href="#" class="banner__item">
						<img src="/frontend/Flaming777v1/img/_src/slide3.png" alt="">
					</a>
			</div>
		</div>

	</main>

@stop

@section('scripts')
  {!! JsValidator::formRequest('VanguardLTE\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@stop
