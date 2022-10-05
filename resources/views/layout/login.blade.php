@extends('app')
@section('content')
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="{{ route('login') }}" method="post">
			@csrf
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
			</div>
			<span>or use your email for registration</span>
			<input type="text" placeholder="Name" />
			<input type="email" placeholder="Email" />
			<input type="password" placeholder="Password" />
			<button type="submit" name="">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('login') }}" method="post">
			@csrf
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" placeholder="Email" />
			<input type="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
@endsection
@push('after-styles')
	 <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
@endpush
@section('script')
<script type="text/javascript">

$('#signUp').click(() => {
		$("#container").addClass('right-panel-active')
  });

  $('#signIn').click(() => {
		$("#container").removeClass('right-panel-active')
  });
</script>
@endsection