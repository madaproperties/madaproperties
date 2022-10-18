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
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.New database record')}}</h5>
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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.database-records.store')}}" id="kt_form">
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
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="name" type="text" value="{{old('name')}}" placeholder="{{__('site.name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.email')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="email" type="text" value="{{old('email')}}" placeholder="{{__('site.email')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.phone')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="phone" type="text" value="{{old('phone')}}" placeholder="{{__('site.phone')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="city" type="text" value="{{old('city')}}" placeholder="{{__('site.city')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="area" type="text" value="{{old('area')}}" placeholder="{{__('site.area')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="project_id" 	name="project_id" type="text" value="{{old('project_id')}}" placeholder="{{__('site.project_name')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.building_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="building_name" type="text" value="{{old('building_name')}}" placeholder="{{__('site.building_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="unit_name" type="text" value="{{old('unit_name')}}" placeholder="{{__('site.unit_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="price" type="text" value="{{old('price')}}" placeholder="{{__('site.price')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	
																</div>
															</div>

															<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="bedroom" type="text" value="{{old('bedroom')}}" placeholder="{{__('site.bedroom')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.local_phone_no_or_reference')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="local_phone_no_or_reference" name="local_phone_no_or_reference" type="text" value="{{old('local_phone_no_or_reference')}}" placeholder="{{__('site.local_phone_no_or_reference')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.options')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" name="options" id="options">
																				<option value="">{{ __('site.choose') }}</option>
																				<option {{old('options') == 'buy' ? 'selected' : ''}} value="buy">{{__('site.buy')}}</option>
																				<option {{old('options') == 'sell' ? 'selected' : ''}} value="sell">{{__('site.sell')}}</option>
																				<option {{old('options') == 'rent' ? 'selected' : ''}} value="rent">{{__('site.rent')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.response')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" name="response" id="response">
																				<option value="">{{ __('site.choose') }}</option>
																				<option {{old('response') == 'intrested' ? 'selected' : ''}} value="intrested">{{__('site.intrested')}}</option>
																				<option {{old('response') == 'not intrested' ? 'selected' : ''}} value="not intrested">{{__('site.not intrested')}}</option>
																				<option {{old('response') == 'follow up' ? 'selected' : ''}} value="follow up">{{__('site.follow up')}}</option>
																				<option {{old('response') == 'unsubscribe' ? 'selected' : ''}} value="unsubscribe">{{__('site.unsubscribe')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="community" type="text" value="{{old('community')}}" placeholder="{{__('site.community')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_community')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="sub_community" type="text" value="{{old('sub_community')}}" placeholder="{{__('site.sub_community')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="developer" type="text" value="{{old('developer')}}" placeholder="{{__('site.developer')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" name="status" id="status">
																				<option value="">{{ __('site.choose') }}</option>
																				<option {{old('status') == 'Ready' ? 'selected' : ''}} value="Ready">{{__('site.Ready')}}</option>
																				<option {{old('status') == 'Not Ready' ? 'selected' : ''}} value="Not Ready">{{__('site.Not Ready')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	@if(count($sellers))
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.assigned to')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="assign_to">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($sellers as $seller)
																				<option {{old('assign_to') == $seller->id ? 'selected' : ''}}
																				value="{{$seller->id}}">{{$seller->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	@endif
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.comment')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<textarea class="form-control form-control-solid form-control-lg" name="comment" placeholder="{{__('site.comment')}}">{{old('comment')}}</textarea>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->


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
