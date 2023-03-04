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
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.new').' '.__('site.project')}}</h5>
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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.secondary.store')}}" id="kt_form"   enctype="multipart/form-data">
														@csrf
														<div class="row justify-content-center">
														<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="unit_name" type="text" value="{{old('unit_name')}}" placeholder="{{__('site.unit_name').' '.__('site.name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true" readonly>
																				<option value="{{$countries['id']}}">{{$countries['name_en']}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city_name')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="city"
																			name="city" data-select2-id="" tabindex="-1" aria-hidden="true" >
																				
																					<option value="riyadh">Riyadh</option>
																				
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="zone_id"
																			name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true" >
																			<option value="">Choose</option>
																				@foreach($zones as $zone)
																					<option value="{{$zone->id}}" >{{$zone->zone_name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="district_id"
																			name="district_id" data-select2-id="" tabindex="-1" aria-hidden="true" >
																			
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="project_name" type="text" value="{{old('project')}}" placeholder="{{__('site.project')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																			
																		</div>
																	
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="developer_name" type="text" value="{{old('developer')}}" placeholder="{{__('site.developer')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.property_type')}}</label>
																		<div class="col-lg-9 col-xl-9">
																		<select class="form-control"  name="type">
																			<option value="">{{ __('site.choose') }}
                                                                            </option>
                                                                            @foreach($purposetypes as $purpose)
                                                                             <option value="{{$purpose->type}}">{{$purpose->type}}</option>
                                                                            @endforeach
																			
																		</select>
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
																	<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.photos')}} ({{__('site.can attach more than one')}})</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" id="files" name="photos[]" multiple="multiple">
                    																
																					
																					<!-- <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="photos[]" multiple>
																					<div class="fv-plugins-message-container"></div> -->
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Assign to')}} </label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="assign_to">
																						<option>choose</option>
																						@foreach($sellers as $user)
																						<option value="{{$user->id}}">{{$user->name}}</option>
																						@endforeach
																					</select>
                    																
																				</div>
																			</div>
																			<!--end::Group-->
																	
																</div>
															</div>
															<div class="col-xl-6">
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area_bua')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="area_bua" type="text" value="{{old('area_bua')}}" placeholder="{{__('site.area_bua')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area_plot')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="area_plot" type="text" value="{{old('area_plot')}}" placeholder="{{__('site.area_plot')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="bedroom">
																				<option value="">Choose</option>
																				<option {{old('bedroom') == '1' ? 'selected' : ''}} value="1">1</option>
																				<option {{old('bedroom') == '2' ? 'selected' : ''}} value="2">2</option>
																				<option {{old('bedroom') == '3' ? 'selected' : ''}} value="3">3</option>
																				<option {{old('bedroom') == '4' ? 'selected' : ''}} value="4">4</option>
																				<option {{old('bedroom') == '5' ? 'selected' : ''}} value="5">5</option>
																				<option {{old('bedroom') == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bathroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="bathroom">
																				<option value="">Choose</option>
																				<option {{old('bedroom') == '1' ? 'selected' : ''}} value="1">1</option>
																				<option {{old('bedroom') == '2' ? 'selected' : ''}} value="2">2</option>
																				<option {{old('bedroom') == '3' ? 'selected' : ''}} value="3">3</option>
																				<option {{old('bedroom') == '4' ? 'selected' : ''}} value="4">4</option>
																				<option {{old('bedroom') == '5' ? 'selected' : ''}} value="5">5</option>
																				<option {{old('bedroom') == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.livingroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="living_room">
																				<option value="">Choose</option>
																				<option  value="1">1</option>
																				<option  value="2">2</option>
																				<option value="3">3</option>
																				<option  value="4">4</option>
																				<option  value="5">5</option>
																				<option value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.guestroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="guest_room">
																				<option value="">Choose</option>
																				<option {{old('bedroom') == '1' ? 'selected' : ''}} value="1">1</option>
																				<option {{old('bedroom') == '2' ? 'selected' : ''}} value="2">2</option>
																				<option {{old('bedroom') == '3' ? 'selected' : ''}} value="3">3</option>
																				<option {{old('bedroom') == '4' ? 'selected' : ''}} value="4">4</option>
																				<option {{old('bedroom') == '5' ? 'selected' : ''}} value="5">5</option>
																				<option {{old('bedroom') == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor no')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="floor_no" type="text" value="{{old('floor_no')}}" placeholder="{{__('site.floor_no')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.no of floor')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="no_of_floor" type="text" value="{{old('no_of_floor')}}" placeholder="{{__('site.no_of_floor')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.completion_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="completion_date" type="text" value="{{old('completion_date')}}" placeholder="{{__('site.completion_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor_plan')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input type="file" id="files" name="floorplan[]" multiple="multiple">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
                                                              </div>
                                                              

															</div>
														</div>
														<h4 style="text-decoration: underline;">Additional information</h4>
														<div class="row justify-content-center">
														<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.parking')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="parking">
																				<option value="">Choose</option>
																				<option  value="1">1</option>
																				<option  value="2">2</option>
																				<option  value="3">3</option>
																				
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.furniture')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="furniture">
																				<option value="">Choose</option>
																				<option  value="furnished">Furnished</option>
																				<option  value="unfurnished">Un Furnished</option>
																				
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																</div>
															</div>
															<div class="col-xl-6">
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.facing')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="facing" type="text" value="{{old('facing')}}" placeholder="{{__('site.facing')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.street width')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="street_width" type="text" value="{{old('street width')}}" placeholder="{{__('site.street width')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!-- end ::Group -->
																</div>
															</div>
															<div class="col-xl-12">
																<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.description')}}</label>
																				<div class="col-lg-10 col-xl-10">
																					<textarea class="form-control form-control-solid form-control-lg" id="description" rows="5" name="description" type="text" placeholder="{{__('site.description')}}">{!!old('description')!!}</textarea>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
															</div>
														</div>
														<h4 style="text-decoration: underline;">Border Details</h4>
														<div class="row justify-content-center">
														<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.length')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="border_length" type="text" value="{{old('width')}}" placeholder="{{__('site.width')}}">
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
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.depth')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="border_depth" type="text" value="{{old('depth')}}" placeholder="{{__('site.depth')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
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
@include('admin.secondary.imageuploader')
@endsection
@push('js')

@endpush
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
            $('#zone_id').on('change', function () {
            var id = this.value;
            $.ajax({
                    url: "{{url('fetch-district')}}",
                    type: "POST",
                    data: {
                        zone_id: id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#district_id').html('<option value="">Select</option>');

                        $.each(result.districts, function (key, value) {
                            $("#district_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
                
            }); 
        });
</script>