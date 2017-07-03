<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" type="image/png" href="{{ URL::asset('favicon.png') }}">

	<!-- Font Style -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" >
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	
	<!-- CSS Global Style -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/node-waves/waves.css') }}"  />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/animate-css/animate.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/themes/theme-blue.min.css') }}"  />

	<!-- CSS Local Style -->
	@stack('css')
	
	<title>Peer Health - MDRTB Laboratory</title>
</head>
<body class="login-page">
	@include('backend.partials.loader')

	<div class="login-box">
		<div class="logo">
			<div class="logo text-center ">
				<img src="{{ URL::asset('img/usaid-small.png') }}" alt="logo usaid" class="animate" data-animate="zoomIn">
				<img src="{{ URL::asset('img/hardvard-small.png') }}" alt="logo hardvard" class="animate" data-animate="zoomIn">
				<img src="{{ URL::asset('img/unand-small.png') }}" alt="logo unand" class="animate" data-animate="zoomIn">
				<img src="{{ URL::asset('img/kemenkes-small.png') }}" alt="logo kemenkes" class="animate" data-animate="zoomIn">
			</div>
			<h1 class="m-t-50 m-b-30">Peer - Health MDRTB Laboratory Manager</h1>
			<h2><small>Understanding the Acquisition and Transmission of Drug-resistant Tuberculosis</small></h2>
			<h3><small>Research conducted by Dr dr Andani Eka Putra MSC</small></h3>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="card light m-t-50">
					<div class="body" style="padding: 35px;">
						<form id="sign_in" action="{{ route('login') }}" method="post" accept-charset="utf-8">
							<input type="hidden" name="_token" value="{{ Session::token() }}">
							
							<div class="msg">Silahkan login untuk lanjut ke Applikasi</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">portrait</i>
								</span>
								<div class="form-line">
									<input type="text" name="username" class="form-control" value="{{ Request::old('username') ? Request::old('username') : '' }}" placeholder="Username" required autofocus>
								</div>
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
								<div class="form-line">
									<input type="password" name="password" class="form-control" value="{{ Request::old('password') ? Request::old('password') : '' }}" placeholder="Password" required>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12  m-t-15 m-b--20">
									<button class="btn btn-block btn-lg bg-green waves-effect" type="submit">Log In</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<p class="text-center m-t-15 m-b--20"><small><?php echo date('Y').'&#32; &#64; &#32;Peer Health - MDRTB Laboratory' ?></small></p>
		
	</div>

	<!-- JS Global -->
	<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ URL::asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
	<script src="{{ URL::asset('plugins/node-waves/waves.js') }}"></script>
	<script src="{{ URL::asset('plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script src="{{ URL::asset('js/admin.js') }}"></script>
	
	<!-- JS Local -->
	<script>
	$(function() {
		setTimeout(function () { $('.page-loader-wrapper').fadeOut();}, 90);
		setTimeout(function () { $.AdminBSB.animate.activate();}, 160);
	});
	</script>

</body>
</html>