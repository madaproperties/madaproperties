@push('css')
  <style>
      .bgi-position-top,.nav-link {
        background: #000
      }

      .nav-link.active ,.login-signin h3
      {
        color:#fff
      }

      .btn.btn-success
      {
        background: #000 !important
      }
      .btn.btn-success
      {
        border-color:#fff
      }
      .btn.btn-success:hover {
        border-color:#fff !important
      }
  </style>
@endpush
@extends('layouts.app')
@section('content')


    <li   style="background:#fff" class="text-center d-block w-100">
				@if(app()->getLocale() == 'en')
        <a class="nav-link active" href="{{route('lang','ar')}}"><i class="fa fa-globe"></i> عربي</a>
				@else
				<a class="nav-link active" href="{{route('lang','en')}}"><i class="fa fa-globe"></i> En</a>
				@endif
    </li>

		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
				<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat">
					<div class="login-form text-center p-7 position-relative overflow-hidden">
						<!--begin::Login Header-->
						<div class="d-flex flex-center mb-15">
							<a href="{{route('login')}}">
								<img src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="w-100 max-h-75px" alt="" />
							</a>
						</div>
						<!--end::Login Header-->
						<!--begin::Login Sign in form-->
						<div class="login-signin">
							<div class="mb-20">
								<h3>{{__('site.Sign In To Admin')}}</h3>
								<div class="text-muted font-weight-bold">{{__('site.Enter your details to login to your account')}}:</div>
							</div>
              @if(session()->has('danger'))
                  <div class="alert alert-danger">{{session()->get('danger')}}</div>
              @endif
							<form class="form" action="{{route('login')}}" method="post" id="kt_login_signin_form">
                @csrf
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" required
                  type="email" placeholder="{{__('site.email')}}" name="email" value="{{old('email')}}" />
								</div>
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" type="password" required
                  placeholder="{{__('site.password')}}" name="password" />
								</div>
								<div class="form-group d-flex flex-wrap justify-content-between align-items-center">
									<div class="checkbox-inline">
										<label class="checkbox m-0 text-muted">
									<input class="form-check-input" type="checkbox" 
                                    name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
										<span></span>{{__('site.Remember me')}}</label>
									</div>
										<a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-success">{{__('site.Forget Password')}} ?</a>
								</div>
								<button id="kt_login_signin_submit" class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-4">{{__('site.Sign In')}}</button>
							</form>

						</div>
						<!--end::Login Sign in form-->

						<!--begin::Login forgot password form-->
						<div class="login-forgot">
							<div class="mb-20">
								<h3>{{__('site.Forgotten Password')}} ?</h3>
								<div class="text-muted font-weight-bold">{{__('site.Enter your email to reset your password')}}</div>
							</div>
							<form class="form" method="post" id="kt_login_forgot_form" action="{{route('password.email')}}">
								@csrf
								<div class="form-group mb-10">
									<input class="form-control form-control-solid h-auto py-4 px-8" type="email"
									value="{{old('email')}}"
									placeholder="{{__('site.email')}}" name="email" />
								</div>
								<div class="form-group d-flex flex-wrap flex-center mt-10">
									<button id="kt_login_forgot_submit" class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-2">{{__('site.Request')}}</button>
								</div>
							</form>
						</div>
						<!--end::Login forgot password form-->
					</div>
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->

@endsection
