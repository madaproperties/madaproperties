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
																			<select class="form-control " id="user_country_id"
																			name="user_country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
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
																	@if(auth()->user()->rule !='admin' && auth()->user()->time_zone == 'Asia/Riyadh')
                                                                    <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				
																				@foreach($dbcountries as $country)
																					<option  value="{{$country->id}}" >{{$country->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="zone_id"
																			name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($zones as $zone)
																					<option value="{{$zone->id}}">{{$zone->zone_name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div id="community" style="display:none;">
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

																	@elseif(auth()->user()->rule !='admin' && auth()->user()->time_zone == 'Asia/Dubai')
                                                                   <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				
																				@foreach($dbcountries as $country)
																					<option  value="{{$country->id}}"> {{$country->name_en}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
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

																	@else
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="country_id"
																			name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($dbcountries as $country)
																					<option {{old('country_id') == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div id="zone" style="display: none;">

																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="zone_id"
																			name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($zones as $zone)
																					<option value="{{$zone->id}}">{{$zone->zone_name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div id="community" style="display:none;">
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
																	
																	@endif

																	<!--begin::Group-->
																	<!-- <div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site. client city')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="city" type="text"  value="{{old('city')}}" placeholder="{{__('site.city')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div> -->
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
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.lead options')}}</label>
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
																			<!-- added by fazal -->
                                                                 @if(auth()->user()->rule !='admin' && auth()->user()->time_zone == 'Asia/Riyadh')
                                                                 <div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="city" value="Riyadh" id="city">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" id="district_id" name="district_id">
																				<option value=""></option>
																			</select>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>


                                                                 @elseif(auth()->user()->rule != 'admin' && auth()->user()->time_zone == 'Asia/Dubai')
                                                                 <div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="city" value="Dubai" id="city">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_community')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" id="subcommunity_id" name="subcommunity_id">
																				
																			</select>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	

                                                                 @else

																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="city"  placeholder="city" id="city">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--  -->
																	<!--begin::Group-->
																	<div id="district" style="display:none;">
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" id="district_id" name="district_id"></select>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																    </div>
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	<div id="subcommunity" style="display:none;">
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_community')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" id="subcommunity_id" name="subcommunity_id">
																				
																			</select>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	</div>
																	@endif
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="developer" type="text" value="{{old('developer')}}" placeholder="{{__('site.developer')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
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
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.source')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="source" type="text" value="{{old('source')}}" placeholder="{{__('site.source')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->																	
																	<!--end::Group-->
                                                                     <!-- added by fazal  -->
																	<!--begin::Group-->
																	<!-- <div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" name="status" id="status">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($status as $sta)
																				<option value="{{$sta->id}}">{{$sta->name_en}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div> -->
																	<!--  end added by fazal  -->
																	<!--end::Group-->
																	
																	<!--begin::Group-->
																	<!-- <div class="form-group row fv-plugins-icon-container">
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
																	</div> -->
																	
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
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






        });
</script>
