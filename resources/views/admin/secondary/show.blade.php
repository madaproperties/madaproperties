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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.secondary.update',$data->id)}}" id="kt_form"   enctype="multipart/form-data">
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
																			<input class="form-control form-control-solid form-control-lg" 	name="unit_name" type="text" value="{{$data->unit_name}}" placeholder="{{__('site.unit_name').' '.__('site.name')}}">
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
																			   @foreach($zones as $zone)
																				 <option {{$data->zone_id == $zone->id ? 'selected' : ''}} value="{{$zone->id}}" data-select2-id="{{$zone->id}}">{{$zone->zone_name}}</option>
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
																			@foreach($districts as $district)
                                                                            


																			<option {{$data->district_id == $district->id ? 'selected' : ''}} value="{{$district->id}}" data-select2-id="{{$district->id}}">{{$district->name}}</option>

																			@endforeach
																			
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="project_name" type="text" value="{{$data->project_name}}" placeholder="{{__('site.project')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																			
																		</div>
																	
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="developer_name" type="text" value="{{$data->developer_name}}" placeholder="{{__('site.developer')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.property_type')}}</label>
																		<div class="col-lg-9 col-xl-9">
																		<select class="form-control"  name="type">
																			
                                                                            @foreach($purposetypes as $purpose)
                                                                            <!--  -->
                            												<option {{$data->type == $purpose->id ? 'selected' : ''}} value="{{$purpose->type}}" data-select2-id="{{$purpose->type}}">{{$purpose->type}}</option>
                            												@endforeach
																			
																		</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="price" type="text" value="{{$data->price}}" placeholder="{{__('site.price')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.photos')}} ({{__('site.can attach more than one')}})</label>
																				
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" id="files" name="photos[]" multiple="multiple">
																					@if(count($data_images)>0)
																				<button type="button" class="btn btn-primary" style="margin-top:7px;" data-toggle="modal" data-target="#exampleModal">Show images</button>
																			    @endif
                    															
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Assign to')}} </label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="assign_to">
																					@foreach($sellers as $user)
																						 <option {{$data->assign_to == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
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
																			<input class="form-control form-control-solid form-control-lg" 	name="area_bua" type="text" value="{{$data->area_bua}}" placeholder="{{__('site.area_bua')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area_plot')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="area_plot" type="text" value="{{$data->area_plot}}" placeholder="{{__('site.area_plot')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="bedroom">
																			<option {{$data->bedroom == '1' ? 'selected' : ''}} value="1">1</option>
																			
																			<option {{$data->bedroom == '2' ? 'selected' : ''}} value="2">2</option>
																			<option {{$data->bedroom == '3' ? 'selected' : ''}} value="3">3</option>
																			<option {{$data->bedroom == '4' ? 'selected' : ''}} value="4">4</option>
																			<option {{$data->bedroom == '5' ? 'selected' : ''}} value="5">5</option>
																			<option {{$data->bedroom == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bathroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="bathroom">
																				<option {{$data->bathroom == '1' ? 'selected' : ''}} value="1">1</option>
																			
																			<option {{$data->bathroom == '2' ? 'selected' : ''}} value="2">2</option>
																			<option {{$data->bathroom == '3' ? 'selected' : ''}} value="3">3</option>
																			<option {{$data->bathroom == '4' ? 'selected' : ''}} value="4">4</option>
																			<option {{$data->bathroom == '5' ? 'selected' : ''}} value="5">5</option>
																			<option {{$data->bathroom == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.livingroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="living_room">
																				<option {{$data->living_room == '1' ? 'selected' : ''}} value="1">1</option>
																			
																			<option {{$data->living_room == '2' ? 'selected' : ''}} value="2">2</option>
																			<option {{$data->living_room == '3' ? 'selected' : ''}} value="3">3</option>
																			<option {{$data->living_room == '4' ? 'selected' : ''}} value="4">4</option>
																			<option {{$data->living_room == '5' ? 'selected' : ''}} value="5">5</option>
																			<option {{$data->living_room == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.guestroom')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="guest_room">
																				<option {{$data->guest_room == '1' ? 'selected' : ''}} value="1">1</option>
																			
																			<option {{$data->guest_room == '2' ? 'selected' : ''}} value="2">2</option>
																			<option {{$data->guest_room == '3' ? 'selected' : ''}} value="3">3</option>
																			<option {{$data->guest_room == '4' ? 'selected' : ''}} value="4">4</option>
																			<option {{$data->guest_room == '5' ? 'selected' : ''}} value="5">5</option>
																			<option {{$data->guest_room == '6' ? 'selected' : ''}} value="6">6</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor no')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="floor_no" type="text" value="{{$data->floor_no}}" placeholder="{{__('site.floor_no')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.no of floor')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="no_of_floor" type="text" value="{{$data->no_of_floor}}" placeholder="{{__('site.no_of_floor')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.completion_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="completion_date" type="date" value="{{$data->completion_date}}" placeholder="{{__('site.completion_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor_plan')}}</label>
                                                                         <div class="col-lg-9 col-xl-9">
																			 
																			<input type="file" id="files" name="floorplan[]" multiple="multiple">
																			@if(count($data_floorplan)>0)
																				<button type="button" class="btn btn-primary" data-toggle="modal" style="margin-top:7px;" data-target="#exampleModal1">Show images</button>
																			    @endif
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
																				<option {{$data->parking == '1' ? 'selected' : ''}} value="1">1</option>
																				<option {{$data->parking == '2' ? 'selected' : ''}} value="2">2</option>
																				<option {{$data->parking == '3' ? 'selected' : ''}} value="3">3</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.furniture')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="furniture">
																				<option {{$data->furniture == 'furnished' ? 'selected' : ''}} value="furnished">Furnished</option>
																				<option {{$data->furniture == 'unfurnished' ? 'selected' : ''}} value="unfurnished">Un Furnished</option>
																				
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
																			<input class="form-control form-control-solid form-control-lg" 	name="facing" type="text" value="{{$data->facing}}" placeholder="{{__('site.facing')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.street width')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="street_width" type="text" value="{{$data->street_width}}" placeholder="{{__('site.street width')}}">
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
																					<textarea class="form-control form-control-solid form-control-lg" id="description" rows="5" name="description" type="text" placeholder="{{__('site.description')}}">{{$data->description}}</textarea>
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
																			<input class="form-control form-control-solid form-control-lg" 	name="border_length" type="text" value="{{$data->border_length}}" placeholder="{{__('site.width')}}">
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
																			<input class="form-control form-control-solid form-control-lg" 	name="border_depth" type="text" value="{{$data->border_depth}}" placeholder="{{__('site.depth')}}">
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
<!-- modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	@foreach($data_images as $images) 
       <div class="col-xl-4" style="float:left" id=''>
        <!--begin::Wizard Step 1-->

          <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current"> 
            <img src="{{ asset('public/uploads/secondary/'.$images->image_link) }}"  style="width:215px;height:147px">
          </div>
          <a onclick="deleteimage({{$images->id}});" class="checkbox deleteImage" data-value="">Delete</a>
          <a href="{{asset('public/uploads/secondary/'.$images->image_link) }}" target="_blank">View</a>
       </div>
       @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	@foreach($data_floorplan as $floor) 
       <div class="col-xl-4" style="float:left" id=''>
         <!--begin::Wizard Step 1-->
            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">  
            	<img src="{{ asset('public/uploads/secondary/'.$floor->image) }}"  style="width:215px;height:147px">
            </div>
            <a  onclick="deletefloorplan({{$floor->id}})" class="checkbox deleteImage" data-value="">Delete</a>
            <a href="{{asset('public/uploads/secondary/'.$floor->image) }}" target="_blank">View</a>
            </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- modal -->

@endsection
@push('js')
<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
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
	function deleteimage($id)
	{
	   var id=$id
       $.ajax({
                url: "{{url('delete-images')}}",
                type: "POST",
                data: {
                     id: id,
                     _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                    location.reload();
                    }
            });
	}
	function deletefloorplan($id)
	{
	   var id=$id
        $.ajax({
                url: "{{url('delete-floorplan')}}",
                type: "POST",
                data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                    location.reload();
                    }
            });
	}
</script>