@extends('admin.layouts.main')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">

         	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
				<!--begin::Subheader-->
				<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
					<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
						<!--begin::Details-->
						<div class="d-flex align-items-center flex-wrap mr-2">
							<!--begin::Title-->
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.edit')}}</h5>
							<!--end::Title-->
							<!--begin::Separator-->
							<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
							<!--end::Separator-->

						</div>
						<!--end::Details-->
						<!--begin::Toolbar-->

						<!--end::Toolbar-->
					</div>
				</div>
				<!--end::Subheader-->

				<!--begin::Entry-->
				<div class="d-flex flex-column-fluid">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Card-->
						<div class="card card-custom card-transparent">
							<div class="card-body p-0">
								<!--begin::Wizard-->
								<div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">

									<!--begin::Card-->
									<div class="card card-custom card-shadowless rounded-top-0">
										<!--begin::Body-->
										<div class="card-body p-0">
											<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-10">
													<!--begin::Wizard Form-->
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.project-name.update',$deal->id)}}" id="kt_form" enctype="multipart/form-data">
														@csrf
														@method('PATCH')
														<div class="row justify-content-center">
														<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="name" type="text" value="{{$deal->name}}" placeholder="{{__('site.name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.image')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			@if($deal->image)
																				<a href="{{env('APP_URL').'/public/uploads/projectData/'.$deal->image}}" target="_blank" download="download">Download</a>
																			@endif
																			<input class="form-control form-control-solid form-control-lg" 	name="image" type="file" >
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!-- end added by fazal -->
																	<!-- added by fazal 29-03-2023  -->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project logo')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			@if($deal->project_logo)
																				<a href="{{env('APP_URL').'/public/uploads/projectData/'.$deal->project_logo}}" target="_blank" download="download">Download</a>
																			@endif
																			<input class="form-control form-control-solid form-control-lg" 	name="project_logo" type="file">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!-- end added by fazal -->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.brochure')}}</label>
																		<div class="col-lg-9 col-xl-9">
																		@if($deal->brochure)
																				<a href="{{env('APP_URL').'/public/uploads/projectData/'.$deal->brochure}}" target="_blank" download="download">Download</a>
																			@endif
																		
																			<input class="form-control form-control-solid form-control-lg" 	name="brochure" type="file">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!-- end added by fazal -->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.video')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="video" type="file">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!-- end added by fazal -->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.payment_plan')}}</label>
																		<div class="col-lg-9 col-xl-9">
																		@if($deal->payment_plan)
																				<a href="{{env('APP_URL').'/public/uploads/projectData/'.$deal->payment_plan}}" target="_blank" download="download">Download</a>
																			@endif
																		
																			<input class="form-control form-control-solid form-control-lg" 	name="payment_plan" type="file">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!-- end added by fazal -->
																	<!-- added by fazal on 06-09-24 -->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.account_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="account_name" type="text" value="{{$deal->account_name}}" placeholder="{{__('site.account_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
                                                                    <!--end-->
																	<!-- added by fazal 02-04-23 -->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bank_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="bank_name" type="text" value="{{$deal->bank_name}}" placeholder="{{__('site.bank_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.iban')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="iban" type="text" value="{{$deal->iban}}" placeholder="{{__('site.iban')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
                                                                    <!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" name="is_active">
																				<option {{$deal->is_active == '1' ? 'selected' : ''}} value="1">Active</option>
																				<option {{$deal->is_active == '0' ? 'selected' : ''}} value="0">In Active</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<div class="col-lg-9 col-xl-9">
																			<input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
																		</div>
																	</div>
																	<!--end::Group-->



																</div>
															</div>
														</div>
						                            </form>
													<!--end::Wizard Form-->
												</div>
											</div>
										</div>
										<!--end::Body-->
									</div>
									<!--end::Card-->
								</div>
								<!--end::Wizard-->
							</div>
						</div>
					<!--end::Card-->
					</div>
				<!--end::Container-->
				</div>
			<!--end::Entry-->
			</div>
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->
</div>
<!--end::Content-->

@endsection
@push('js')
<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endpush
