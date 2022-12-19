<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>

  <base href="../../../../">
		<meta charset="utf-8" />
		<title>MADA - Login</title>
		<meta name="description" content="Login page example" />
		<link rel="shortcut icon" href="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{ asset('public/assets/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="{{asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('public/dist/css/adminlte.min.css')}}">

    <style>
        .bgi-position-top{
          background-image: url("{{asset('public/assets/media/bg/bg-3.jpg')}}")
        }
    </style>
		@include('admin.layouts.msgs')
		@stack('css')
	</head>
  <body class="hold-transition login-page">

	<!--end::Head-->
	<!--begin::Body-->
	 @yield('content')
  <!--end::Global Theme Bundle-->
		<!-- jQuery -->
	<script src="{{ asset('public/plugins/jquery/jquery.min.js')}}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('public/dist/js/adminlte.min.js')}}"></script>
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('public/assets/js/pages/custom/login/login-general.js') }}"></script>
  <!--end::Page Scripts-->
  @stack('js')
</body>
</html>
