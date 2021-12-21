@push('css')
    <style>
        .bgi-position-top
        {
            height:100vh;
        }
    </style>
@endpush
@extends('layouts.app')

@section('content')

            <div class="card">
		
				<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat">
					<div class="login-form text-center p-7 position-relative overflow-hidden">
						<!--begin::Login Header-->
						<div class="d-flex flex-center mb-15">
							<a href="#">
								<img src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="w-100 max-h-75px" 
								    s
								alt="" />
							</a>
						</div>
						<!--end::Login Header-->
						<!--begin::Login Sign in form-->
						<div class="login-signin">
							<div class="mb-20">
								<h3>Change Password</h3>
								<div class="text-muted font-weight-bold">Change your Password to login to your account:</div>
							</div>
              @if(session()->has('danger'))
                  <div class="alert alert-danger">{{session()->get('danger')}}</div>
              @endif
							<form class="form" action="{{route('changepassword')}}" method="post">
                @csrf
                <input type="hidden" name="hash" value="{{$user->hash}}" />

								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" required
                  type="email" readonly value="{{$user->email}}"  />
								</div>

								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" required
                  type="password" placeholder="Password" name="password"  autocomplete="off" />
								</div>
								
								
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" required
                  type="password" placeholder="confirm password " name="password_confirmation"  autocomplete="off" />
								</div>

								<div class="form-group d-flex flex-wrap justify-content-between align-items-center">
									<div class="checkbox-inline">
										<label class="checkbox m-0 text-muted">
										<input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}/>
										<span></span>Remember me</label>
									</div>
								</div>
								<button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
							</form>

						</div>
						<!--end::Login Sign in form-->
					
					
					</div>
				</div>
            </div>

@endsection