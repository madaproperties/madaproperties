@extends('layouts.app')
@section('content')


    <!-- <li   style="background:#fff" class="text-center d-block w-100">
				@if(app()->getLocale() == 'en')
        <a class="nav-link active" href="{{route('lang','ar')}}"><i class="fa fa-globe"></i> عربي</a>
				@else
				<a class="nav-link active" href="{{route('lang','en')}}"><i class="fa fa-globe"></i> En</a>
				@endif
    </li> -->

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
				<a href="{{route('login')}}">
					<img src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="w-100 max-h-75px" alt="" />
				</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">{{__('site.Sign In To Admin')}}</p>
			@if(session()->has('danger'))
					<div class="alert alert-danger">{{session()->get('danger')}}</div>
			@endif
			<form class="form" action="{{route('login')}}" method="post" id="kt_login_signin_form">
				@csrf
        <div class="input-group mb-3">
				<input class="form-control" required
                  type="email" placeholder="{{__('site.email')}}" name="email" value="{{old('email')}}" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
					<input class="form-control" type="password" required
                  placeholder="{{__('site.password')}}" name="password" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
							{{__('site.Remember me')}}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{__('site.Sign In')}}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="{{route('forget-password')}}">{{__('site.Forget Password')}} ?</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

@endsection
