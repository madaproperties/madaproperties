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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.project-data.update',$projectdata->id)}}" id="kt_form"   enctype="multipart/form-data">
														@csrf
														@method('PATCH')
														<div class="row justify-content-center">
														<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="unit_name" type="text" value="{{$projectdata->unit_name}}" placeholder="{{__('site.unit_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($countries as $country)
																					<option {{$projectdata->country_id == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="city_name" type="text" value="{{$projectdata->city_name}}" placeholder="{{__('site.city_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="district_name" type="text" value="{{$projectdata->district_name}}" placeholder="{{__('site.district_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->



																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="project_id"
																			name="project_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($projects as $project)
																					<option {{$projectdata->project_id == $project->id ? 'selected' : ''}} value="{{$project->id}}" data-select2-id="{{$project->id}}">{{$project->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="developer_id"
																			name="developer_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($developer as $dev)
																					<option {{$projectdata->developer_id == $dev->id ? 'selected' : ''}} value="{{$dev->id}}" data-select2-id="{{$dev->id}}">{{$dev->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.property_type')}}</label>
																		<div class="col-lg-9 col-xl-9">
																		<select class="form-control"  name="property_type">
																			<option value="">{{ __('site.choose') }}</option>
																			@foreach($purposetype as $purpType)
																			<option {{$projectdata->property_type == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
																			@endforeach
																		</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor_plan')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			@if($projectdata->floor_plan)
																				<a href="{{env('APP_URL').'/public/uploads/projectData/'.$projectdata->floor_plan}}" target="_blank" download="download">Download</a>
																			@endif
																			<input class="form-control form-control-solid form-control-lg" 	name="floor_plan" type="file" >
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!-- added by fazal -->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.completion_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="completion_date" type="date" value="{{$projectdata->completion_date}}" placeholder="{{__('site.completion_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!-- end added by fazal -->
																

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area_bua')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="area_bua" type="text" value="{{$projectdata->area_bua}}" placeholder="{{__('site.area_bua')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	

																</div>
															</div>
															<div class="col-xl-6">
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area_plot')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="area_plot" type="text" value="{{$projectdata->area_plot}}" placeholder="{{__('site.area_plot')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor_no')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg"  name="floor_no" type="text" value="{{$projectdata->floor_no}}" placeholder="{{__('site.floor_no')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="bedroom">
																				<option {{$projectdata->bedroom == '1' ? 'selected' : ''}} value="1">1</option>
																				<option {{$projectdata->bedroom == '2' ? 'selected' : ''}} value="2">2</option>
																				<option {{$projectdata->bedroom == '3' ? 'selected' : ''}} value="3">3</option>
																				<option {{$projectdata->bedroom == '4' ? 'selected' : ''}} value="4">4</option>
																				<option {{$projectdata->bedroom == '5' ? 'selected' : ''}} value="5">5</option>
																				<option {{$projectdata->bedroom == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="price" 	name="price" type="text" value="{{$projectdata->price}}" placeholder="{{__('site.price')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
                                                                     <!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.down_payment_percentage')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="down_payment_percentage" 	name="down_payment_percentage" type="text" value="{{$projectdata->down_payment_percentage}}" placeholder="{{__('site.down_payment_percentage')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																
																	<!--end::Group-->
  

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.down_payment')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="down_payment" type="text" value="{{$projectdata->down_payment}}" id="down_payment" placeholder="{{__('site.down_payment')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission_percent')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="commission_percent" name="commission_percent" type="text" value="{{$projectdata->commission_percent}}" placeholder="{{__('site.commission_percent')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="commission" 	name="commission" type="text" value="{{$projectdata->commission}}" placeholder="{{__('site.commission')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.payment_status')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="payment_status">
																				<option {{$projectdata->payment_status == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
																				<option {{$projectdata->payment_status == 'cash-bank' ? 'selected' : ''}} value="cash-bank">{{__('site.cash-bank')}}</option>
																				<option {{$projectdata->payment_status == 'cash-bank-sarkani' ? 'selected' : ''}} value="cash-bank-sarkani">{{__('site.cash-bank-sarkani')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="status">
																				<option value="">{{ __('site.choose') }}</option>
																				<option {{$projectdata->status == 'Sold out' ? 'selected' : ''}} value="Sold out">Sold out</option>
																				<option {{$projectdata->status == 'Available' ? 'selected' : ''}} value="Available">Available</option>
																				<option {{$projectdata->status == 'Reserved' ? 'selected' : ''}} value="Reserved">Reserved</option>
																				<option {{$projectdata->status == 'Resale' ? 'selected' : ''}} value="Resale">Resale</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																</div>
															</div>
														</div>
														<div class="col-xl-12 col-xxl-10">
															<!--begin::Group-->
															<div class="form-group row fv-plugins-icon-container">
																<div class="col-lg-9 col-xl-9">
																	<input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
																</div>
															</div>
															<!--end::Group-->
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
$( "#down_payment_percentage" ).keyup(function() {
	
   var comi = $(this).val();
   var price=  $("#price").val();
   $("#down_payment").val(((price*comi)/100).toFixed(2));
 
});
$( "#commission_percent" ).keyup(function() {
	var comi = $(this).val();
	$("#commission").val('');
	if(comi > 0 && $("#price").val() > 0){
		var price=  $("#price").val();

		var comi_amount = ((price*comi)/100);

		var vat_comi = 15; //vat percent
		var vat_amount=  (comi_amount*vat_comi)/100;

		$("#commission").val(( comi_amount + vat_amount ).toFixed(2));
	}
}); 
</script>
@endpush
