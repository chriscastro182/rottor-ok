<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title', __('labels.title'))</title>
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
	<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

	<link href="{{ asset('admin/style.css') }}" rel="stylesheet">
	@stack('header_styles')

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="https://kit.fontawesome.com/f8f810a40d.js" crossorigin="anonymous"></script>
	@stack('header_scripts')
</head>

<body class="admin" id="page-top">
	<div id="wrapper">
		@guest
		<div class="container">
			@yield('content')
		</div>
		@endguest
		@auth
		@include('layouts.admin.sidebar')
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<header id="header">
					@include('layouts.admin.menu')
				</header>
				<main class="container-fluid">
					@yield('content')
				</main>
				<footer>
				</footer>
			</div>
		</div>
		@endauth
	</div>
	<!-- Bootstrap core JavaScript-->
	<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

	<!-- Core plugin JavaScript-->
	<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

	<!-- Custom scripts for all pages-->
	<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

	<!-- Page level plugins -->
	<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

	@stack('footer_scripts')
</body>
</html>
