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
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.New Lead')}}</h5>
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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.commercial-leads.store')}}" id="kt_form" enctype="multipart/form-data">
														@csrf
														<div class="row justify-content-center">
														<div class="col-xl-12">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	<!--begin::Group-->
																	<h2 style="color:#9fc538"> {{__('site.Basic Details')}}</h2>
																	<hr>
																	<div class="form-group row fv-plugins-icon-container">
																		<!-- <label class="col-xl-2 col-lg-2 col-form-label">{{__('site.country')}}</label>
																		<div class="col-lg-4 col-xl-4">
																			<input class="form-control form-control-solid form-control-lg" 	name="country" type="text" value="{{old('country')}}" placeholder="{{__('site.country')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div> -->
																	
																		<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.brand_name')}}</label>
																		<div class="col-lg-4 col-xl-4">
																			<input class="form-control form-control-solid form-control-lg" 	name="brand_name" type="text" value="{{old('brand_name')}}" placeholder="{{__('site.brand_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>

																		<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.activity')}}</label>
																		<div class="col-lg-4 col-xl-4">
																			<input class="form-control form-control-solid form-control-lg" 	name="activity_name" type="text" value="{{old('activity_name')}}" placeholder="{{__('site.activity')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.activity_type')}}</label>
																		<div class="col-lg-4 col-xl-4">
																			<select class="form-control"  name="activity_type">
																			<option {{old('activity_type') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
																			{!! selectOptions(__('config.activity_type'),old('activity_type')) !!}
																			</select>
																		</div>
																		<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.location')}}</label>
																		<div class="col-lg-4 col-xl-4">
																			<input class="form-control form-control-solid form-control-lg" 	name="location" type="text" value="{{old('location')}}" placeholder="{{__('site.location')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																</div>
															</div>
															<div class="col-xl-12">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	<!--begin::Group-->
																	<h2 style="color:#9fc538"> {{__('site.Contact Persons')}}</h2>
																	<hr>
																	<div id="contact_html">
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.name')}}</label>
																			<div class="col-lg-4 col-xl-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="contact_persons[0][name]" type="text" value="{{old('name')}}" placeholder="{{__('site.name')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.email')}}</label>
																			<div class="col-lg-4 col-xl-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="contact_persons[0][email]" type="email" value="{{old('email')}}" placeholder="{{__('site.email')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.phone')}}</label>
																			<div class="col-lg-4 col-xl-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="contact_persons[0][phone]" type="text" value="{{old('phone')}}" placeholder="{{__('site.phone')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		

																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.designation')}}</label>
																			<div class="col-lg-4 col-xl-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="contact_persons[0][designation]" type="text" value="{{old('designation')}}" placeholder="{{__('site.designation')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<!--end::Group-->
																		<hr>
																	</div>

																	<div class="form-group row fv-plugins-icon-container">
																		<a class="btn btn-primary col-xl-3 col-lg-3" href="javascript:void(0)" id="contact_add_more">{{__('site.add_more')}} Contact Person</a>
																	</div>
																</div>
															</div>

															<div class="col-xl-12">
																
																
																<!--begin::Wizard Actions-->
																<div class="d-flex justify-content-between border-top pt-10 mt-15">
																	<div>
																		<input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
																	</div>
																</div>
																<!--end::Wizard Actions-->
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
<script>
$(document).ready(function(){
	var total_contacts = 0;
	$("#contact_add_more").click(function(){
		total_contacts += 1;
		$("#contact_html").append('<div class="form-group row fv-plugins-icon-container"><label class="col-xl-2 col-lg-2 col-form-label">{{__("site.name")}}</label><div class="col-lg-4 col-xl-4"><input class="form-control form-control-solid form-control-lg" 	name="contact_persons['+total_contacts+'][name]" type="text" value="" placeholder="{{__("site.name")}}"><div class="fv-plugins-message-container"></div></div><label class="col-xl-2 col-lg-2 col-form-label">{{__("site.email")}}</label><div class="col-lg-4 col-xl-4"><input class="form-control form-control-solid form-control-lg" 	name="contact_persons['+total_contacts+'][email]" type="email" value="" placeholder="{{__("site.email")}}"><div class="fv-plugins-message-container"></div></div></div><div class="form-group row fv-plugins-icon-container"><label class="col-xl-2 col-lg-2 col-form-label">{{__("site.phone")}}</label><div class="col-lg-4 col-xl-4"><input class="form-control form-control-solid form-control-lg" 	name="contact_persons['+total_contacts+'][phone]" type="text" value="" placeholder="{{__("site.phone")}}"><div class="fv-plugins-message-container"></div></div><label class="col-xl-2 col-lg-2 col-form-label">{{__("site.designation")}}</label><div class="col-lg-4 col-xl-4"><input class="form-control form-control-solid form-control-lg" 	name="contact_persons['+total_contacts+'][designation]" type="text" value="" placeholder="{{__("site.designation")}}"><div class="fv-plugins-message-container"></div></div></div><!--end::Group--><hr>');
	});
});
</script>
@endpush

