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
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.New Contacts')}}</h5>
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
															<form class="form fv-plugins-bootstrap fv-plugins-framework"
                              method="post"
                              action="{{route('admin.contact.store')}}" id="kt_form">
                                @csrf
																<div class="row justify-content-center">
																	<div class="col-xl-9">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
                                      <div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.email')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<div class="input-group input-group-solid input-group-lg">
																						<div class="input-group-prepend">
																							<span class="input-group-text">
																								<i class="la la-at"></i>
																							</span>
																						</div>
																						<input type="email"    class="form-control form-control-solid form-control-lg" name="email" value="{{old('email')}}">
																					</div>
																			</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.first Name')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" required
                                          name="first_name" type="text" value="{{old('first_name')}}" placeholder="{{__('site.first Name')}}">
																				<div class="fv-plugins-message-container"></div></div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.last name')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg"
                                          name="last_name" type="text" value="{{old('last_name')}}" placeholder="{{__('site.last name')}}">
																				<div class="fv-plugins-message-container"></div></div>
																			</div>
																			<!--end::Group-->

												@if(count($sellers))
													<!--begin::Group-->
                        <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                					<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.contact owner')}} </label>
    												<div class="col-lg-9 col-xl-9">
               								<select class="form-control"  name="user_id">
																<option value="">{{ __('site.contact owner') }}</option>
       													@foreach($sellers as $seller)
															    <option {{old('user_id') == $seller->id ? 'selected' : ''}} value="{{$seller->id}}">{{$seller->name}}</option>
       													 @endforeach
															</select>
														</div>
  		               		</div>
  		               		@endif
										<!--end::Group-->
										<!--begin::Group-->
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
                												<div class="col-lg-9 col-xl-9" data-select2-id="38">
                													<select class="form-control " id="countries" required
                                           name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
																					 <option value="">{{ __('site.choose') }}</option>
                                           @foreach($countries as $country)
                														<option
                						data-code="{{$country->code}}"
                                            {{old('country_id') == $country->id ? 'selected' : ''}}
                                            value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                													</select>
                												</div>
  											               </div>
																			<!--end::Group-->
                                      <!--begin::Group-->
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
                                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                                          <select id="cities" class="form-control "
                                           name="city_id"  tabindex="-1" aria-hidden="true">
																					 <option value="">{{__('site.select country')}}</option>
                                          </select>
                                        </div>
                                       </div>
                                      <!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.contact phone')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<div class="row">

												<div class="col-2" style="padding:0;text-align:center">
												        <div class="input-group input-group-solid input-group-lg">

																						<input type="number" disabled
																						style="padding:0"
																			id="show-coutry-code"			class="form-control text-center form-control-solid form-control-lg" >
																					</div>
												</div>
												<div class="col-10">
												    <div class="input-group input-group-solid input-group-lg">
																						<div class="input-group-prepend">
																							<span class="input-group-text">
																								<i class="la la-phone"></i>
																							</span>
																						</div>
																						<input type="number"
																						value="{{old('phone')}}"
																						class="form-control form-control-solid form-control-lg" required name="phone" placeholder="{{__('site.contact phone')}}">
																					</div>
												</div>
																					</div>
																			</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.scound Phone')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<div class="input-group input-group-solid input-group-lg">
																						<div class="input-group-prepend">
																							<span class="input-group-text">
																								<i class="la la-phone"></i>
																							</span>
																						</div>
																						<input type="number"
																						value="{{old('scound_phone')}}"
																						class="form-control form-control-solid form-control-lg"  name="scound_phone"
																						placeholder="{{__('site.please include country code')}}">
																					</div>
																			</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.budget')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<div class="input-group input-group-solid input-group-lg">
																						<div class="input-group-prepend">
																							<span class="input-group-text">
																								<i class="la la-money-bill"></i>
																							</span>
																						</div>


																						<select class="form-control"  name="budget">
																						<option value="">{{ __('site.budget') }}</option>
																						@foreach(budgets() as $budget)
								 														<option
																						{{old('budget') == $budget ? 'selected' : ''}}
																						 value="{{$budget}}">{{$budget}}</option>
																						@endforeach
								 													</select>
																					</div>
																			</div>
																			</div>
																			<!--end::Group-->
                                      <!--begin::Group-->
																			 <div class="form-group row">
								 												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.currencies')}}</label>
								 												<div class="col-lg-9 col-xl-9">
								 													<select class="form-control"  name="currency">
																						<option value="">{{ __('site.choose') }}</option>
																						@foreach($currencies as $currencie)
								 														<option
																						{{old('currency') == $currencie->id ? 'selected' : ''}}
																						 value="{{$currencie->id}}">{{$currencie->currencyname}}</option>
																						@endforeach
								 													</select>
								 												</div>
								 											</div>
                                      <!--end::Group-->
                                       <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		 		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit country')}} </label>
																		 			<div class="col-lg-9 col-xl-9" data-select2-id="38">
																		 				<select class="form-control " id="unit_country" name="unit_country" data-select2-id="" tabindex="-1" aria-hidden="true">
																		 					<option value="">{{ __('site.choose') }}</option>
																		           @foreach($countries as $country)
																		 			      <option {{old('unit_country') == $country->id ? 'selected' : ''}}
																		     value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
																		            @endforeach
																		 				</select>
																		 			</div>
																		 	 </div>
 																			<!--end::Group-->
																			<!--begin::Group-->

																			 <div class="form-group row prject-area">
																			 	<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project')}}</label>
																			 	<div class="col-lg-9 col-xl-9">
																			 		<select class="form-control other-select"  name="project_id">
                                          </select>
																			 	</div>
																			 </div>
																			<!--end::Group-->
	                                  <!-- added by fazal 16-05-23 -->
                                   <!--begin::Group-->
                                    <div id="id_city" style="display: none;">
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
                                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                                          <select id="city_id" class="form-control "
                                           name="city"  tabindex="-1" aria-hidden="true">
																					 <option value="">{{__('site.select country')}}</option>
                                          </select>
                                        </div>
                                       </div>
                                     </div>
                                      <!--end::Group-->
 																		<!--begin::Group-->          
         														<div id="id_community" style="display: none;">
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
                                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                                          <select id="community_id" class="form-control "
                                           name="community_id"  tabindex="-1" aria-hidden="true">
																					 <option value="">{{__('site.select community')}}</option>
                                          </select>
                                        </div>
                                       </div>
                                     </div>
                                      <!--end::Group-->
                                      <!--begin::Group-->                                    
                                      <div id="id_subcommunity" style="display: none;">
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_community')}}</label>
                                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                                          <select id="subcommunities_id" class="form-control "
                                           name="subcommunities_id"  tabindex="-1" aria-hidden="true">
																					 <option value="">{{__('site.select sub_community')}}</option>
                                          </select>
                                        </div>
                                       </div>
                                     </div>
                                      <!--end::Group-->
                                      <!--begin::Group-->          
         														<div id="id_zone" style="display: none;">
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}}</label>
                                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                                          <select id="zone_id" class="form-control "
                                           name="zone_id"  tabindex="-1" aria-hidden="true">
																					 <option value="">{{__('site.select zone')}}</option>
                                          </select>
                                        </div>
                                       </div>
                                     </div>
                                      <!--end::Group-->
                                      <!--begin::Group-->                                    
                                      <div id="id_district" style="display: none;">
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}}</label>
                                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                                          <select id="district_id" class="form-control "
                                           name="district_id"  tabindex="-1" aria-hidden="true">
																					 <option value="">{{__('site.select district')}}</option>
                                          </select>
                                        </div>
                                       </div>
                                     </div>
                                     <!--end::Group-->
                                      <!-- end -->

 <div class="related-to-project" style="display:none">
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit city')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
<select id="unit_city" class="form-control "
name="unit_city"  tabindex="-1" aria-hidden="true">
<option value="">{{__('site.select country')}}</option>
</select>
</div>
</div>
<!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit zone')}}</label>
<div class="col-lg-9 col-xl-9">
<input class="form-control form-control-solid form-control-lg"
name="unit_zone" type="text" value="{{old('unit_zone')}}" placeholder="{{__('site.unit Zone')}}">
</div>
</div>
<!--end::Group-->
</div>
<!--end::Group-->
                                      <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.last mile conversion')}}</label>
																				<div class="col-lg-9 col-xl-9">
                                          <select class="form-control" required name="last_mile_conversion" tabindex="-1" aria-hidden="true">
																					<option value="">{{ __('site.choose') }}</option>
                                           @foreach($miles as $mile)
                                            <option
                                            {{old('mile_id') == $mile->id ? 'selected' : ''}}
                                            value="{{$mile->id}}">{{$mile->name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
																			</div>
																			<!--end::Group-->
																			@php
																				$lead_types = ['Hot','Cold','Warm'];
																			@endphp
                                      <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.lead type')}}</label>
																				<div class="col-lg-9 col-xl-9">
                                          <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
																					<option value="">{{ __('site.choose') }}</option>
                                           @foreach($lead_types as $lead_type)
                                            <option
                                            {{old('lead_type') == $lead_type ? 'selected' : ''}}
                                            value="{{$lead_type}}">{{$lead_type}}</option>
                                            @endforeach
                                          </select>
                                        </div>
																			</div>
																			<!--end::Group-->

									                                      <!--begin::Group-->
																		  <div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.campaign')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control"  name="campaign" tabindex="-1" aria-hidden="true">
																																<option value="">{{ __('site.choose') }}</option>
																					@foreach($campaigns as $campaign)
																						<option
																						{{old('campaign') == $campaign->name ? 'selected' : ''}}
																						value="{{$campaign->name}}">{{$campaign->name}}</option>
																						@endforeach
																					</select>

																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.campaign_country')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control"  name="campaign_country" tabindex="-1" aria-hidden="true">
																						<option value="">{{ __('site.choose') }}</option>
																						@foreach($countries as $country)
																							<option data-code="{{$country->code}}" {{old('campaign_country') == $country->id ? 'selected' : ''}}
																							value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
																						@endforeach
																					</select>

																				</div>
																			</div>
																			<!--end::Group-->
                                      <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.source')}}</label>
																				<div class="col-lg-9 col-xl-9">

												<select class="form-control"  name="source" tabindex="-1" aria-hidden="true">
                                        	<option value="">{{ __('site.choose') }}</option>
                                           @foreach($sources as $source)
                                            <option
                                            {{old('source') == $source->name ? 'selected' : ''}}
                                            value="{{$source->name}}">{{$source->name}}</option>
                                            @endforeach
                                          </select>

                                        </div>
																			</div>
																			<!--end::Group-->
                                      <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.medium')}}</label>
																				<div class="col-lg-9 col-xl-9">

                                          <select class="form-control"  name="medium" tabindex="-1" aria-hidden="true">
                                        	<option value="">{{ __('site.choose') }}</option>
                                           @foreach($mediums as $medium)
                                            <option
                                            {{old('medium') == $medium->name ? 'selected' : ''}}
                                            value="{{$medium->name}}">{{$medium->name}}</option>
                                            @endforeach
                                          </select>

                                        </div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.content')}}</label>
																				<div class="col-lg-9 col-xl-9">

                                          <select class="form-control"  name="content" tabindex="-1" aria-hidden="true">
                                        	<option value="">{{ __('site.choose') }}</option>
                                           @foreach($contents as $content)
                                            <option
                                            {{old('content') == $content->name ? 'selected' : ''}}
                                            value="{{$content->name}}">{{$content->name}}</option>
                                            @endforeach
                                          </select>

                                        </div>
																			</div>
																			<!--end::Group-->
												 							<!--begin::Group-->
                                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.language')}}</label>
                                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                                          <select class="form-control"  name="lang">
																						<option value="">{{ __('site.choose') }}</option>
                                            <option {{old('lang') == 'arabic' ? 'selected' : ''}} value="arabic">عربي</option>
                                            <option {{old('lang') == 'english' ? 'english' : ''}} value="english">english</option>
                                            <option {{old('lang') == 'russian' ? 'russian' : ''}} value="russian">russian</option>
                                            <option {{old('lang') == 'French' ? 'russian' : ''}} value="French">French</option>
                                          </select>
                                        </div>
                                       </div>
                                      <!--end::Group-->
																		</div>
																		<!--end::Wizard Step 1-->
																		@if(count($purpose) == 1)
																			<input type="hidden" value="{{$purpose[0]}}" name="purpose" />
																		@elseif(count($purpose)>1)
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																			<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Purpose')}}</label>
																			<div class="col-lg-9 col-xl-9" data-select2-id="38">
																				<select class="form-control"  name="purpose">
																					<option value="">{{ __('site.choose') }}</option>
																					@foreach($purpose as $purp)
																					<option {{old('purpose') == $purp ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
																					@endforeach
																				</select>
																			</div>
																		 </div>
																		<!--end::Group-->
																		@endif
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Agent')}} {{__('site.Purpose')}}</label>
																			<div class="col-lg-9 col-xl-9">
																				<select class="form-control"  name="agent_purpose">
																					<option value="">{{ __('site.choose') }}</option>
																					@foreach($purpose as $purp)
																					<option {{old('agent_purpose') == $purp ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
																					@endforeach
																				</select>
																			</div>
																		 </div>
																		<!--end::Group-->

																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																			<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.purpose type')}}</label>
																			<div class="col-lg-9 col-xl-9" data-select2-id="38">
																				<select class="form-control"  name="purpose_type">
																					<option value="">{{ __('site.choose') }}</option>
																					@foreach($purposetype as $purpType)
																					<option {{old('purpose_type') == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
																					@endforeach
																				</select>
																			</div>
																		 </div>
																		<!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="">
		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.lead_category')}} </label>
		<div class="col-lg-9 col-xl-9" data-select2-id="">
			<select class="form-control"  name="lead_category" id="lead_category">
				<option {{old('lead_category') == 'Primary' ? 'selected' : ''}} value="Primary">{{__('site.Primary')}}</option>
				<option {{old('lead_category') == 'Secondary' ? 'selected' : ''}} value="Secondary">{{__('site.Secondary')}}</option>
			</select>
		</div>
	</div>
	<!--end::Group-->	

                                 
																																	
																		<!--begin::Wizard Actions-->
																		<div class="d-flex justify-content-between border-top pt-10 mt-15">
																			<div>
																			    <input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
																			</div>
																		</div>
																		<!--end::Wizard Actions-->
																	</div>
																</div>
															<div>
                              </div>
                              <div>
                              </div>
                              <div>
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
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->

@endsection
@push('js')
<!-- <script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

	function getCountryCities(country,city,changeCode = false)
	{
		let token = $('meta[name=csrf-token]').attr('content');
		let route = '{{route("admin.get.cities")}}';
		let cityEl = city;

		$.ajax({
			type:'POST',
			url: route,
			data:{_token:token,country:country},
			responseType:'json',
			success: (res) => {
				if(res.status == 'success'){

						cityEl.html('');

	if(changeCode){
		$('#show-coutry-code').val(res.countryCode);
	}


						cityEl.append(`<option value=''>select</option>`);
						res.rows.forEach(row => {
							cityEl.append(`<option	value="${row.id}" data-select2-id="${row.id}">
							${row.name}
							</option>`);
						});
				}else{
					console.log(`خطأ غير معروف ${res}`);
				}
			},
			error: function(res){
				console.log(`خطأ غير معروف ${res}`);
			}
		});
	}

	if($('#countries').val()){
	    getCountryCities($('#countries').val(),$("#cities"),true);
	}


	$('#countries').on('change', function (){
		getCountryCities($('#countries').val(),$("#cities"),true);
	});

	$('#unit_country').on('change', function (){
   $('#id_city').show(); // added by fazal 17/05/23
		getCountryCities($('#unit_country').val(),$("#city_id"));
		getProjects($('#unit_country').val());
		$('.prject-area').css('height','auto');
		$('.prject-area').css('opacity','1');
		
   });

	$( document ).ready(function (){
	   $('.prject-area').css('height','0');
	   $('.prject-area').css('opacity','0');
	   //added by fazal
	   // fetch community
	$('#city_id').on('change', function () {
    var city_id = this.value;
      $.ajax({
        url: "{{url('contactsfetch-community')}}",
        type: "POST",
        data: {
            city_id: city_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#community_id').html('<option value="">Select</option>');
          $.each(result.communities, function (key, value) {
            $("#community_id").append('<option value="' + value
                    .id + '">' + value.name_en + '</option>');
          });
        }
      });
  });
	 //fetch subcommunity
   $('#community_id').on('change', function () {
    var community_id = this.value;
      $.ajax({
        url: "{{url('contactsfetch-subcommunity')}}",
        type: "POST",
        data: {
            community_id: community_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#subcommunities_id').html('<option value="">Select</option>');
          $.each(result.subcommunities, function (key, value) {
            $("#subcommunities_id").append('<option value="' + value
                    .id + '">' + value.name_en + '</option>');
          });
        }
      });
    });
    // fetch zone
	$('#city_id').on('change', function () {
		var country=$('#unit_country').val();
		if(country == 1)
    {
    $('#id_zone').show();
    $('#id_district').show();
     $('#id_community').hide();
    $('#id_subcommunity').hide();
    }
    if(country == 2)
    {
    $('#id_community').show();
    $('#id_subcommunity').show();
    $('#id_zone').hide();
    $('#id_district').hide();
    }

    var city_id = this.value;
    $.ajax({
        url: "{{url('contactsfetch-zone')}}",
        type: "POST",
        data: {
          city_id: city_id,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#zone_id').html('<option value="">Select</option>');
          $.each(result.zones, function (key, value) {
            $("#zone_id").append('<option value="' + value
                    .id + '">' + value.zone_name + '</option>');
          });
        }
    });
  });
	//fetch district
   $('#zone_id').on('change', function () {
    var zone_id = this.value;
    $.ajax({
        url: "{{url('contactsfetch-district')}}",
        type: "POST",
        data: {
            zone_id: zone_id,
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
   // end added by fazal
});


	function getProjects(country)
	{
	    $('.related-to-project').css('display','none');
	    let token = $('meta[name=csrf-token]').attr('content');
		let route = '{{route("admin.get.projects")}}';
		let projectEl = $('.other-select');


        projectEl.attr('disabled',true);


		$.ajax({
			type:'POST',
			url: route,
			data:{_token:token,country:country},
			responseType:'json',
			success: (res) => {
				if(res.status == 'success'){

	         projectEl.html('');

	       	projectEl.append( `<option
                    data-text=""
                    value=""
                    data-select2-id="">
                        select
                    </option>`);

			res.rows.forEach(row => {
				projectEl.append(`<option
                    id="project-value-${row.id}"
                    data-text="${row.name}"
                    value="${row.id}"
                    data-select2-id="${row.name}">
                        ${row.name}
                    </option>`);

		    });

		    projectEl.attr('disabled',false);

				}else{
					console.log(`خطأ غير معروف ${res}`);
				}
			},
			error: function(res){
				console.log(`خطأ غير معروف ${res}`);
			}
		});
	};



	$('.other-select').on('change',function (){
		let val = $('#project-value-'+$(this).val()).data('text');
		if(val == 'others' || val == 'أخري')
		{
			$('.related-to-project').css('display','block');
		}else{
			$('.related-to-project').css('display','none');
		}
	});
</script>
@endpush
