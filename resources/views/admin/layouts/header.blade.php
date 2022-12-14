<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MADA -
		@php
		    $url = str_replace(request()->getHost(),'', request()->fullUrl());
		    $url = str_replace('https:///','',$url);
		@endphp

		{{ ucfirst($url) }}
		</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/plugins/fullcalendar/main.css')}}">
  <link href="{{ asset('public/css/developer.css?t='.time())}}" rel="stylesheet" type="text/css" />
  @include('admin.layouts.msgs')
		@stack('css')
		<link rel="shortcut icon" href="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" />
		<style>
		@if(Request::root() == 'https://lmsstaging.madaproperties.com')
		    body {
		     background:#e8afaf;
		    }
		@else
		    body {
		        background:#F2F3F7;
		    }
		@endif

</head>
@php
  $user = App\User::where('id',auth()->id())->first();
@endphp
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img height="300" width="300" src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="animation__shake" alt="Mada Properties"/>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">  
      <li class="nav-item">
        <a href="{{app()->getLocale() == 'en' ? route('lang','ar') : route('lang','en') }}" class="nav-link">
          <i class="fas fa-globe"></i>
          <span class="badge badge-warning navbar-badge">{{ app()->getLocale() == 'en' ? 'ع' : 'en'}}</span>
        </a>
      </li>
      @if(userRole() != 'other')
      <li class="nav-item">
        @php
          $notoficationCount = App\Notofication::where('user_id',auth()->id())->where('completed','0')->count();
        @endphp
        <a class="nav-link" href="{{route('admin.notofications.index')}}">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$notoficationCount}}</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" 
        href="{{ route('logout') }}" title="Sign Out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button">
          <i class="fas fa-door-open"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

@include('admin.layouts.menu')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                @if(userRole() == 'other')
                  <a href="{{route('admin.deal.index')}}" class="d-block">
                @else
                  <a href="{{route('admin.')}}" class="d-block">
                @endif
                  Home
                </a>
              </li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
