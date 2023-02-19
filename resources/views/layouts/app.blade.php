<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>

  <base href="../../../../">
		<meta charset="utf-8" />
		<title>MADA - Login</title>
		<!--<meta name="viewport" content="width=device-width, height=device-height,  initial-scale=1.0, user-scalable=no;user-scalable=0;"/>-->
		<meta name='viewport' content='user-scalable=0'>
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
		

    <style>
        .bgi-position-top{
          background-image: url("{{asset('public/assets/media/bg/bg-3.jpg')}}")
        }
        .form-control:focus {
    outline: 0;
    -webkit-appearance: none;
    -webkit-transition: none;
    box-shadow: none;
}
    </style>
		@include('admin.layouts.msgs')
		@stack('css')
	</head>
  <body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled subheader-enabled page-loading">

	<!--end::Head-->
	<!--begin::Body-->
	 @yield('content')
	<!--end::Body-->
  <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
  <!--begin::Global Config(global config for global JS scripts)-->
  <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
  <!--end::Global Config-->
  <!--begin::Global Theme Bundle(used by all pages)-->
  <script src="{{ asset('public/assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
  <script src="{{ asset('public/assets/js/scripts.bundle.js') }}"></script>
  <!--end::Global Theme Bundle-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('public/assets/js/pages/custom/login/login-general.js') }}"></script>
  <!--end::Page Scripts-->
  @stack('js')
</body>
</html>
