@extends('admin.layouts.main')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:10px">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Mobile Toggle-->
									<button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
										<span></span>
									</button>
									<!--end::Mobile Toggle-->
								</div>
									<!--end::Mobile Toggle-->
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">{{__('site.Account')}}</h5>
										<!--end::Page Title-->

									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->

							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Change Password-->
								<div class="row">
									<!--begin::Aside-->
									@include('admin.layouts.aside')
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="col-sm-8">
										<!--begin::Card-->
										<div class="card card-custom">
											<!--begin::Header-->
											<div class="card-header py-3">
												<div class="card-title align-items-start flex-column">
													<h3 class="card-label font-weight-bolder text-dark">{{__('site.Update Account')}}</h3>
												</div>
												<div class="card-toolbar">
													<button form="update-account" type="submit" class="btn btn-success mr-2">{{__('site.save')}}</button>
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Form-->
											<form class="form" method="POST" id="update-account" action="{{route('admin.account.update',auth()->id())}}">
                        @csrf
                        @method('PUT')
												<div class="card-body">

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('site.email')}}</label>
														<div class="col-lg-9 col-xl-6">
															<input type="text" class="form-control form-control-lg form-control-solid mb-2" required
				{{ userRole() != 'admin' ? 'disabled' : '' }}
                                name="name" placeholder="Your Name" value="{{auth()->user()->name}}">
														</div>
													</div>
													
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('site.language')}}</label>
														<div class="col-lg-9 col-xl-6">
                              <select name="lang" class="form-control form-control-lg form-control-solid mb-2" required>
  															<option
                                {{auth()->user()->lang == 'en' ? 'selected' : ''}}
                                value="en">english</option>
  															<option
                              {{auth()->user()->lang == 'ar' ? 'selected' : ''}}
                                value="ar">عربي</option>
  														</select>
														</div>
													</div>
													
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label text-alert">
								TimeZone
														    </label>
														<div class="col-lg-9 col-xl-6">
                              <select name="time_zone" class="form-control form-control-lg form-control-solid mb-2" required>
                                  
  					<option value="en">{{__('site.choose')}}</option>
  					@foreach(timeZones() as $zone)
  					<option 
  					{{ auth()->user()->time_zone == $zone ? 'selected' : '' }}
  					value="{{ $zone }}">{{$zone }}</option>
  					@endforeach
  														</select>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('site.New Password')}}</label>
														<div class="col-lg-9 col-xl-6">
															<input type="password" class="form-control form-control-lg form-control-solid"
                               placeholder="New password" name="password">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('site.Verify Password')}}</label>
														<div class="col-lg-9 col-xl-6">
															<input type="password" class="form-control form-control-lg form-control-solid"
                              placeholder="Verify password" name="password_confirmation">
														</div>
													</div>
												</div>
											</form>
											<!--end::Form-->
										</div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Change Password-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>

@endsection
@push('js')
	<script src="{{ asset('public/assets/js/pages/custom/profile/profile.js') }}"></script>
@endpush
