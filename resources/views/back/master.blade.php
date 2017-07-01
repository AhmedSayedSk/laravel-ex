<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.sub-header')
    <title>@yield('title')</title>

	<link rel="stylesheet" type="text/css" href="./packages/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/icomoon/E-commerce1/style.css"> <!-- for icon set in left-navbar -->
	<link rel="stylesheet" type="text/css" href="./assets/css/custom/bootstrap.css">
	@yield('head-css')
	<link rel="stylesheet" type="text/css" href="./assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="./back/assets/css/main.css">

	@if(App::getLocale('locale') == 'ar')
		<link rel="stylesheet" href="./packages/bootstrap-rtl/dist/css/bootstrap-rtl.min.css">
		<link rel="stylesheet" type="text/css" href="./assets/css/langs/ar/main.css">
		<link rel="stylesheet" type="text/css" href="./back/assets/css/langs/ar/main.css">
	@endif

	<script type="text/javascript" src="./assets/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./packages/bootstrap/js/bootstrap.min.js"></script>
	@yield('head-js')
	<script type="text/javascript" src="./back/assets/js/main.js"></script>
	<script type="text/javascript" src="./assets/js/main.js"></script>

	@if(App::getLocale('locale') == 'ar')
		<script type="text/javascript" src="./back/assets/js/langs/ar/main.js"></script>
	@endif
</head>
<body>
	@include('back.add-ons.navbar-1')

	<div class="container-fluid">
		<div class="row">
			<div class="
				@if(Session::has('leftnav_resize_status'))
					@if(Session::get('leftnav_resize_status') == "true")
						col-md-1 @else col-md-3
					@endif
				@else
					col-md-3
				@endif
			" id="left-nav">
				@include('back.add-ons.left-nav')
			</div>
			<div class="
				@if(Session::has('leftnav_resize_status'))
					@if(Session::get('leftnav_resize_status') == "true")
						col-md-11 @else col-md-9
					@endif
				@else
					col-md-9
				@endif
			" id="content">
				@yield('content')
			</div>
		</div>
	</div>		

	<footer id="footer">
		<div class="container footer-bottom">
			<span>© 2016 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></span> ·
			<span>Sensorization demo project</span>
		</div>
	</footer>

	@yield('footer-js')
	<script type="text/javascript" src="./assets/js/token.js"></script>
</body>
</html>




