<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/amilabmanagerlogo.png') }}" />

	<!-- Font Style -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	
	<!-- CSS Global Style -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/node-waves/waves.css') }}"  />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/animate-css/animate.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/waitme/waitMe.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/jquery-spinner/css/bootstrap-spinner.css') }}" />
	
	<!-- CSS Local Style -->
	@stack('css')

	<!-- CSS Default Overiding Style -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}" />
	<link rel="stylesheet" type="text/css" media="print" href="{{ URL::asset('css/printstyle.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/themes/theme-green.min.css') }}"  />
	
	@stack('title')
</head>
<body class="theme-green">
	@include('backend.partials.loader')

	<div class="overlay"></div>

	@include('backend.partials.search')
	@include('backend.partials.header')
	
	
	<section class="print-content">
		@include('backend.partials.sidebar')
		@yield('content')
	</section>

	<!-- JS Global -->
	<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ URL::asset('plugins/waitme/waitMe.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/jquery-spinner/js/jquery.spinner.js') }}"></script>
	<script src="{{ URL::asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/node-waves/waves.js') }}"></script>
	{{-- <script src="{{ URL::asset('js/admin.js') }}"></script> --}}
	<script src="{{ URL::asset('js/print.js') }}"></script>
	
	<!-- JS Local -->
	@stack('script')

</body>
</html>