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
								<img src="https://lms.madaproperties.com/public/imgs/mada-logo-blackbg.svg" class="w-100 max-h-75px" alt="" />
							</a>
						</div>
						<!--end::Login Header-->
						<!--begin::Login Sign in form-->
						<div class="login-signin">
							<div class="mb-20">
								<h3>{{ __('site.Reset Password') }}</h3>
							</div>
              @if(session()->has('danger'))
                  <div class="alert alert-danger">{{session()->get('danger')}}</div>
              @endif
							<form class="form" action="{{route('password.update')}}" method="post" id="">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8"
                  type="email" placeholder="{{__('site.email')}}" readonly
                  name="email" value="{{ $email ?? old('email') }}" required />
								</div>
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" type="password" required
                  placeholder="{{__('site.password')}}" name="password" />
								</div>
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" type="password" required
                  placeholder="{{ __('site.Confirm Password') }}" name="password_confirmation" />
								</div>

								<button id="kt_login_signin_submit" class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-4">{{ __('site.Reset Password') }}</button>
							</form>

						</div>
						<!--end::Login Sign in form-->


					</div>
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->



@endsection
