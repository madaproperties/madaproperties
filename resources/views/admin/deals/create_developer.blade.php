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
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.new').' '.__('site.developer')}}</h5>
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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.deal-developer.store')}}" id="kt_form">
														@csrf
														<div class="row justify-content-center">
														<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($countries as $country)
																					<option {{old('country_id') == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer').' '.__('site.name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="name_en" type="text" value="{{old('name_en')}}" placeholder="{{__('site.developer').' '.__('site.name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.company_address')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<textarea class="form-control form-control-solid form-control-lg" 	name="company_address" type="text" placeholder="{{__('site.company_address')}}">{{old('company_address')}}</textarea>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.trn')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="trn" type="text" value="{{old('trn')}}" placeholder="{{__('site.trn')}}">
																			<div class="fv-plugins-message-container"></div>
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
