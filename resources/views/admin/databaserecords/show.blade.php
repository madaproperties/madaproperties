@extends('admin.layouts.main')
@section('content')

<hr />
<div class="container">
    
	

					<!--begin::Profile Overview-->
							<div class="d-flex flex-row">
							        
								<!--begin::Aside-->
									@include('admin.databaserecords.components.sidebar')
								<!--begin::Content-->
								<div class="flex-row-fluid ml-lg-8">
    
									<div class="example-preview">
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="notes-tab" data-toggle="tab" href="#notes" aria-controls="notes">
													<span class="nav-icon">
														<i class="fa fa-bell"></i>
													</span>
													<span class="nav-text">{{__('site.notes')}}</span>
												</a>
											</li>
											
									</ul>
		
									<div class="tab-content mt-5" id="myTabContent">
										<div class="tab-pane fade active show" id="notes" role="tabpanel" aria-labelledby="notes-tab">
											@include('admin.databaserecords.components.notes')
										</div>
									</div>
								</div>

								<!--end::Content-->
							</div>
							<!--end::Profile Overview-->
						</div>
<!-- Add Database Note Modal-->
<div class="modal fade" id="add-database-note" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.new note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">
               <!--begin::Form-->
                 <form id="add-note-form" action="{{route('admin.database-note.store')}}" method="POST">
                   @csrf
                   <input type="hidden" value="{{isset($data->id) ? $data->id : '' }}" name="database_id">

                   <div class="form-group">
                     <label class="d-block">{{ __('site.description') }}</label>
                     <textarea  name="description" id="note-description">{{old('description')}}</textarea>
                   </div>

                  <div class="card-footer">
                   <button type="submit" form="add-note-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
                   <button data-dismiss="modal" form="add-note-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
                  </div>
                 </form>
                 <!--end::Form-->
                </div>

            </div>
        </div>
    </div>
</div>
<!--- Eit Database Note Model -->

<!-- Add Database Note Modal-->
<div class="modal fade" id="edit-database" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 900px">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">

					<div class="row justify-content-center">
						<div class="col-xl-12 col-xxl-10">

							<!--begin::Wizard Form-->
							<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.database-records.update',$data->id)}}" id="kt_form">
								@csrf
								@method('PATCH')
								<div class="row justify-content-center">
									<div class="col-xl-6">
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
												<div class="col-lg-9 col-xl-9" data-select2-id="38">
													<select class="form-control " id="user_country_id"
													name="user_country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
														<option value="">{{ __('site.choose') }}</option>
														@foreach($countries as $country)
															<option {{$data->user_country_id == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="name" type="text" value="{{$data->name}}" placeholder="{{__('site.name')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.email')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="email" type="text" value="{{$data->email}}" placeholder="{{__('site.email')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.phone')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="phone" type="text" value="{{$data->phone}}" placeholder="{{__('site.phone')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->

											                @if(auth()->user()->rule =='sales' && auth()->user()->time_zone == 'Asia/Riyadh')
											                <!--  -->
											                <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				
																				@foreach($dbcountries as $country)
																					<option value="{{$country->id}}">{{$country->name}}</option>
																				@endforeach
                                                                         </select>
																		</div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="zone_id"
																			name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				
																				@foreach($zones as $zone)
																					<option {{$data->zone_id == $zone->id ? 'selected' : ''}} value="{{$zone->id}}" data-select2-id="{{$zone->id}}">{{$zone->zone_name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
											                <!--  -->
											                @elseif(auth()->user()->rule =='sales' && auth()->user()->time_zone == 'Asia/Dubai')
											                <!--  -->
											                <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				
																				@foreach($dbcountries as $country)
																					<option value="{{$country->id}}">{{$country->name}}</option>
																				@endforeach
                                                                         </select>
																		</div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" id="community_id" name="community_id">	
                                                                            <!--  -->
                                                                            @foreach($communities as $community)
                                                                            <option {{$data->community_id == $community->id ? 'selected' : ''}} value="{{$community->id}}" data-select2-id="{{$community->id}}">{{$community->name_en}}</option>
                                                                            <!--  -->

                                                                                @endforeach
																			</select>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
											                <!--  -->
											                @else
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($dbcountries as $country)
																					<option {{$data->country_id == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
																				@endforeach
                                                                         </select>
																		</div>
																	</div>
											
																	@if($data->country_id==1)
																	<!--begin::Group-->
																	<div id="zone" >

																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="zone_id"
																			name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				
																				@foreach($zones as $zone)
																					<option {{$data->zone_id == $zone->id ? 'selected' : ''}} value="{{$zone->id}}" data-select2-id="{{$zone->id}}">{{$zone->zone_name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<div id="community" style="display:none;" >
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" id="community_id" name="community_id">
																				<option value="">choose</option>
                                                                                @foreach($communities as $community)
                                                                                <option value="{{$community->id}}">{{$community->name_en}}</option>
                                                                                @endforeach
																			</select>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																    </div>
																	<!--end::Group-->
																	@else
																	<!--  -->
																	<div id="zone" style="display:none;" >

																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="zone_id"
																			name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				
																				@foreach($zones as $zone)
                                                                           <option value="{{$zone->id}}">{{$zone->zone_name}}</option>

                                                                           @endforeach
																			</select>
																		</div>
																	</div>
																</div>
																	<!--  -->
																	<div id="community" >
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" id="community_id" name="community_id">	
                                                                            <!--  -->
                                                                            @foreach($communities as $community)
                                                                            <option {{$data->community_id == $community->id ? 'selected' : ''}} value="{{$community->id}}" data-select2-id="{{$community->id}}">{{$community->name_en}}</option>
                                                                            <!--  -->

                                                                                @endforeach
																			</select>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																    </div>
																	@endif
                                                                    @endif
											

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="area" type="text" value="{{$data->area}}" placeholder="{{__('site.area')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project_name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" id="project_id" 	name="project_id" type="text" value="{{$data->project_id}}" placeholder="{{__('site.project_name')}}" autocomplete="off">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.building_name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="building_name" type="text" value="{{$data->building_name}}" placeholder="{{__('site.building_name')}}">
													<div class="fv-plugins-message-container"></div>
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

											

										</div>
									</div>

									<div class="col-xl-6">
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
										
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedroom')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="bedroom" type="text" value="{{$data->bedroom}}" placeholder="{{__('site.bedroom')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.phone or ref')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" id="local_phone_no_or_reference" name="local_phone_no_or_reference" type="text" value="{{$data->local_phone_no_or_reference}}" placeholder="{{__('site.local_phone_no_or_reference')}}" autocomplete="off">
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
														<option {{$data->options == 'buy' ? 'selected' : ''}} value="buy">{{__('site.buy')}}</option>
														<option {{$data->options == 'sell' ? 'selected' : ''}} value="sell">{{__('site.sell')}}</option>
														<option {{$data->options == 'rent' ? 'selected' : ''}} value="rent">{{__('site.rent')}}</option>
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
														<option {{$data->response == 'intrested' ? 'selected' : ''}} value="intrested">{{__('site.intrested')}}</option>
														<option {{$data->response == 'not intrested' ? 'selected' : ''}} value="not intrested">{{__('site.not intrested')}}</option>
														<option {{$data->response == 'follow up' ? 'selected' : ''}} value="follow up">{{__('site.follow up')}}</option>
														<option {{$data->response == 'unsubscribe' ? 'selected' : ''}} value="unsubscribe">{{__('site.unsubscribe')}}</option>
													</select>
												</div>
											</div>
											<!--end::Group-->
											<!-- begin -->
																	<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="city" id="city" type="text" value="{{$data->city}}" placeholder="{{__('site.city')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!-- end -->
											
											<!--begin::Group-->
											@if($data->country_id==1)
											<div id="district">
											   <div class="form-group row fv-plugins-icon-container">
												 <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}}</label>
												 <div class="col-lg-9 col-xl-9">
												   <select class="form-control" id="district_id" name="district_id">
													@foreach($districts as $district)
													  <option {{$data->district_id == $district->id ? 'selected' : ''}} value="{{$district->id}}" data-select2-id="{{$district->id}}">{{$district->name}}</option>
                                                    @endforeach
												   </select>
											       <div class="fv-plugins-message-container"></div>
												</div>
											   </div>
										    </div>
											<!--end::Group-->
											<div id="subcommunity" style="display:none;" >
											  <div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_community')}}</label>
												 <div class="col-lg-9 col-xl-9">
													<select class="form-control" id="subcommunity_id" name="subcommunity_id">
													</select>
													<div class="fv-plugins-message-container"></div>
												  </div>
											  </div>
											</div>
											<!--end::Group-->
												<!--begin::Group-->
											@else
											<div id="district" style="display: none;">
											   <div class="form-group row fv-plugins-icon-container">
												 <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}}</label>
												 <div class="col-lg-9 col-xl-9">
												  <select class="form-control" id="district_id" name="district_id"></select>
											      <div class="fv-plugins-message-container"></div>
												 </div>
											   </div>
											</div>
											<div id="subcommunity" >
											   <div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_community')}}</label>
												  <div class="col-lg-9 col-xl-9">
												   	<select class="form-control" id="subcommunity_id" name="subcommunity_id">
												   		@foreach($subcommunities as $subcommunity)
                                                          <option {{$data->subcommunity_id == $subcommunity->id ? 'selected' : ''}} value="{{$subcommunity->id}}" data-select2-id="{{$subcommunity->id}}">{{$subcommunity->name_en}}</option>
												   		@endforeach
													</select>
													<div class="fv-plugins-message-container"></div>
												  </div>
											   </div>
											</div>
													<!--end::Group-->
											@endif
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="developer" type="text" value="{{$data->developer}}" placeholder="{{__('site.developer')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
												<div class="col-lg-9 col-xl-9">
													<select class="form-control" name="status" id="status">
													@foreach($status as $sta)
															<option {{$data->status == $sta->id ? 'selected' : ''}} value="{{$sta->id}}" data-select2-id="{{$sta->id}}">{{$sta->name_en}}</option>
														@endforeach	
													</select>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="unit_name" type="text" value="{{$data->unit_name}}" placeholder="{{__('site.unit_name')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											
											<!--end::Group-->

										</div>
									</div>
									<div class="col-xl-12">
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.comment')}}</label>
												<div class="col-lg-9 col-xl-9">
													<textarea class="form-control form-control-solid form-control-lg" name="comment" placeholder="{{__('site.comment')}}">{{$data->comment}}</textarea>
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
												<button data-dismiss="modal" form="add-note-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>											</div>
										</div>
										<!--end::Wizard Actions-->
									</div>
								</div>
							</form>
							<!--end::Wizard Form-->
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!--- Eit Database Note Model -->


@endsection
@push('js')
<script>
var KTCkeditor = function () {
    // Private functions
    var demos = function () {
    ClassicEditor
      .create( document.querySelector( '#note-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );
	}
    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();
// Initialization
KTCkeditor.init();
// 
$('#country_id').on('change', function () {
            var id = this.value;
            if(id==1)
            {
             $("#zone").show();
             $("#district").show();	
             $("#community").hide();
             $("#subcommunity").hide();
            }
            else
            {
            $("#zone").hide();
            $("#district").hide();
             $("#community").show();
             $("#subcommunity").show();	
            }
            $.ajax({
                    url: "{{url('fetch-city')}}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (city) {
                       $("#city").val(city)
                       

                    }
                });
                
            });
// 
$('#zone_id').on('change', function () {
            var id = this.value;
            $.ajax({
                    url: "{{url('databasefetch-district')}}",
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
$('#community_id').on('change', function () {
            var id = this.value;
            $.ajax({
                    url: "{{url('databasefetch-subcommunity')}}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#subcommunity_id').html('<option value="">Select</option>');

                        $.each(result.subCommunity, function (key, value) {
                            $("#subcommunity_id").append('<option value="' + value
                                .id + '">' + value.name_en + '</option>');
                        });
                    }
                });
                
            });


</script>
@endpush