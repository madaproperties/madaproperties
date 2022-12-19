@extends('admin.layouts.main')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="">
		<div class="container">

         	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
				<!--begin::Subheader-->
				<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
					<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
						<!--begin::Details-->
						<div class="d-flex align-items-center flex-wrap mr-2">
							<!--begin::Title-->
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.New property')}}</h5>
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
				<div class="">
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
											<div class="row py-8 px-8 py-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-12">
													<ul class="nav nav-tabs" id="myTab" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic">
																<span class="nav-icon">
																	<i class="fa fa-building"></i>
																</span>
																<span class="nav-text">{{__('site.basic')}}</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="files-tab" data-toggle="tab" href="#files" aria-controls="notes">
																<span class="nav-icon">
																	<i class="fa fa-image"></i>
																</span>
																<span class="nav-text">{{__('site.files and other')}}</span>
															</a>
														</li>
														
														<li class="nav-item">
															<a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" aria-controls="additional">
																<span class="nav-icon">
																	<i class="fa fa-edit"></i>
																</span>
																<span class="nav-text">{{__('site.additional')}}</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="owner-tab" data-toggle="tab" href="#owner" aria-controls="owner">
																<span class="nav-icon">
																	<i class="fa fa-user"></i>
																</span>
																<span class="nav-text">{{__('site.owner_details')}}</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="verification-tab" data-toggle="tab" href="#verification" aria-controls="verification">
																<span class="nav-icon">
																	<i class="fa fa-barcode"></i>
																</span>
																<span class="nav-text">{{__('site.verification')}}</span>
															</a>
														</li>
													</ul>
					
													<!--begin::Wizard Form-->
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.property.store')}}" id="kt_form" enctype="multipart/form-data">
														@csrf
														<div class="tab-content mt-5" id="myTabContent">
															<div class="tab-pane fade active show" id="basic" role="tabpanel" aria-labelledby="basic-tab">
																<div class="row col-xl-12">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-1 col-lg-1 col-form-label">{{__('site.title')}}</label>
																				<div class="col-lg-11 col-xl-11">
																					<input class="form-control form-control-solid form-control-lg" 	name="title" type="text" value="{{old('title')}}" placeholder="{{__('site.title')}}" required>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																		</div>
																	</div>
																</div>

																<div class="row col-xl-12">
																	<div class="col-xl-4">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="unitno" type="text" value="{{old('unitno')}}" placeholder="{{__('site.unit')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.permit')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="str_no" type="text" value="{{old('str_no')}}" placeholder="{{__('site.permit_no')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.type')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="sale_rent" required>
																						{!! selectOptions(__('config.sale_rent'),old('sale_rent')) !!}
																					</select>																					
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.street')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="street" type="text" value="{{old('street')}}" placeholder="{{__('site.street')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_meas')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="measure_unit" id="measure_unit" class="form-control">
																						{!! selectOptions(__('config.measure_unit'),old('measure_unit')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bua')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="buildup_area" type="text" value="{{old('buildup_area')}}" placeholder="{{__('site.bua')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.plot')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="plot_size" type="text" value="{{old('plot_size')}}" placeholder="{{__('site.plot')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.parking_type')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="parking_type" id="parking_type" class="form-control">
																						{!! selectOptions(__('config.parking_type'),old('parking_type')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.parking')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="parking_areas" id="parking_areas" class="form-control">
																						{!! selectOptions(__('config.parking_areas'),old('parking_areas')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="floor" type="text" value="{{old('floor')}}" placeholder="{{__('site.floor')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																		</div>
																	</div>
																	<div class="col-xl-4">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="city_id" id="city_id" class="form-control">
																						<option value="">{{ __('site.choose') }}</option>
																						@foreach($cities as $city)
																						<option {{old('city_id') == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name_en}}</option>
																						@endforeach 
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.location')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="area_name" type="text" value="{{old('area_name')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_location')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="project_name" type="text" value="{{old('project_name')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.building')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="building_name" type="text" value="{{old('building_name')}}" placeholder="">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.source')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="source_id">
																						<option value="">{{ __('site.source') }}</option>
																						@foreach($sources as $source)
																						<option {{old('source_id') == $source->id ? 'selected' : ''}} value="{{$source->id}}">{{$source->name}}</option>
																						@endforeach      
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.campaign')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="campaign_id">
																						<option value="">{{__('site.choose')}}</option>
																						@foreach($campaigns as $campaign)
																						<option {{ old('campaign_id') == $campaign->id ? 'selected' : ''}} value="{{$campaign->id}}">{{$campaign->name}}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.category')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control"  name="category_id" required>
																						<option value="" >{{ __('site.choose') }}</option>
																						@foreach($categories as $category)
																						<option {{ old('category_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Price Type')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="price_type" id="price_type" class="form-control ">
																						{!! selectOptions(__('config.price_type'),old('price_type')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->																			
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price_on_application')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="price_on_application" id="price_on_application" class="form-control">
																						{!! selectOptions(__('config.yes_no'),old('price_on_application')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																		</div>
																	</div>
																	<div class="col-xl-4">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="price" type="text" value="{{old('price')}}" placeholder="{{__('site.price')}}" required>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Price_Area')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="price_unit" type="text" value="{{old('price_unit')}}" placeholder="{{__('site.price_unit')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedrooms')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="bedrooms" id="bedrooms" class="form-control">
																						{!! selectOptions(__('config.bedrooms'),old('bedrooms')) !!}	
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Baths')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="bathrooms" id="bathrooms" class="form-control">
																						{!! selectOptions(__('config.bathrooms'),old('bathrooms')) !!}	
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Cheques')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="cheques" id="cheques" class="form-control">
																						{!! selectOptions(__('config.cheques'),old('cheques')) !!}		
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Deposit')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="deposit" type="text" value="{{old('deposit')}}" placeholder="{{__('site.Deposit')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Furnished')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="furnished" id="furnished" class="form-control">
																						{!! selectOptions(__('config.furnished'),old('furnished')) !!}																					
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			

																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.managed')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="is_managed" id="is_managed" class="form-control">
																						{!! selectOptions(__('config.yes_no'),old('is_managed')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.offplan')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="checkbox" name="is_exclusive" value="1" id="is_exclusive" class="checkbox">
																				</div>
																			</div>
																			<!--end::Group-->

																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
																<div class="row col-xl-12">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.description')}}</label>
																				<div class="col-lg-10 col-xl-10">
																					<textarea class="form-control form-control-solid form-control-lg" id="description" rows="10" name="description" type="text" placeholder="{{__('site.description')}}">{!!old('description')!!}</textarea>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																		</div>
																	</div>
																</div>	

																
																<div class="row col-xl-12">
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																		
																		@if(userRole() == 'admin' || userRole() == 'sales admin uae')
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="user_id">
																						<option value="">{{__('site.choose')}}</option>
																						@foreach($sellers as $seller)
																						<option {{ old('user_id') == $seller->id ? 'selected':  '' }} value="{{$seller->id}}">{{$seller->name}}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																		@endif


																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.stage')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="stage" id="stage" class="form-control">
																					{!! selectOptions(__('config.stage'),old('stage')) !!}	
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_features')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#features_modal_unit">
																					{{__('site.unit_features')}} <i class="fa fa-menu"></i>
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.dev_feature')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#features_modal_dev">
																					{{__('site.dev_feature')}} <i class="fa fa-menu"></i>
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.lifestyle')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#features_modal_life_style">
																					{{__('site.lifestyle')}} <i class="fa fa-menu"></i>
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.portals')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#portals_modal">
                    																	Add portals <i class="fa fa-menu"></i>
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.photos')}} ({{__('site.can attach more than one')}})</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#image_uploader">
                    																	Add Images <i class="fa fa-image"></i>
                  																	</button>
																					
																					<!-- <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="photos[]" multiple>
																					<div class="fv-plugins-message-container"></div> -->
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
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.featured')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="is_featured" id="is_featured" class="form-control">
																						{!! selectOptions(__('config.featured'),old('featured')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.fitted')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="fitted" id="fitted" class="form-control">
																						{!! selectOptions(__('config.fitted'),old('fitted')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																		

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.tenanted')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="tenanted" id="tenanted" class="form-control">
																						{!! selectOptions(__('config.yes_no'),old('tenanted')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.rent_price')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="rent_price" type="text" value="{{old('rent_price')}}" placeholder="{{__('site.rent_price')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.offplan')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="project_status" id="project_status" class="form-control">
																						{!! selectOptions(__('config.project_status'),old('project_status')) !!}
																					</select>
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
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.documents')}} ({{__('site.can attach more than one')}})</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#document_uploader">
                    																	Add Documents <i class="fa fa-folder"></i>
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
																<div class="row col-xl-12">
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.rented_till')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="rented_till" type="date" value="{{old('rented_till')}}" placeholder="{{__('site.rented_till')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.avail')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="next_available" type="date" value="{{old('next_available')}}" placeholder="{{__('site.next_available')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.maint_fee')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="maint_fee" type="text" value="{{old('maint_fee')}}" placeholder="{{__('site.maint_fee')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.dewa')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="dewa" type="text" value="{{old('dewa')}}" placeholder="{{__('site.dewa')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.postal_code')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="postal_code" type="text" value="{{old('postal_code')}}" placeholder="{{__('site.postal_code')}}">
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
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.remind')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="reminder" id="reminder" class="form-control">
																						{!! selectOptions(__('config.yes_no'),old('reminder')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.virtual_360')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="virtual_360" type="text" value="{{old('virtual_360')}}" placeholder="{{__('site.virtual_360')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor_plan')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="floorplan" type="text" value="{{old('floorplan')}}" placeholder="{{__('site.floorplan')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.video')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="video" type="text" value="{{old('video')}}" placeholder="{{__('site.video')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane fade" id="owner" role="tabpanel" aria-labelledby="owner-tab">
																<div class="row">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.contact_no')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="contact_no" type="text" value="{{old('contact_no')}}" placeholder="{{__('site.contact_no')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.mobile')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="mobile" type="text" value="{{old('mobile')}}" placeholder="{{__('site.mobile')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.owner_name')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="owner_name" type="text" value="{{old('owner_name')}}" placeholder="{{__('site.owner_name')}}">
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

																			
																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane fade" id="verification" role="tabpanel" aria-labelledby="verification-tab">
																<div class="row">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.verified')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="verified" id="verified" class="form-control">
																						{!! selectOptions(__('config.yes_no'),old('verified')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unver_reas')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="unverified_reason" id="unverified_reason" class="form-control">
																						{!! selectOptions(__('config.unverified_reason'),old('unverified_reason')) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.date')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="verified_date" type="date" value="{{old('verified_date')}}" placeholder="{{__('site.date')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.pass_p_eid')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="passport_emirates_id" type="text" value="{{old('passport_emirates_id')}}" placeholder="{{__('site.pass_p_eid')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.title_deed')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="title_deed" type="text" value="{{old('title_deed')}}" placeholder="{{__('site.title_deed')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.from_a_noc_sl_form')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="forma_noc_slform" type="text" value="{{old('forma_noc_slform')}}" placeholder="{{__('site.from_a_noc_sl_form')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->


																		</div>
																	</div>

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
@include('admin.property.image_uploader')
@include('admin.property.document_uploader')
@include('admin.property.dev_features')
@include('admin.property.unit_features')
@include('admin.property.life_style_features')
@include('admin.property.portals')
@endsection

@push('js')
<script>
var KTCkeditor = function () {    
	var demos = function () {
		ClassicEditor
			.create( document.querySelector( '#description' ) )
			.then( editor => {
			})
			.catch( error => {
				console.error( error );
			});
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
</script>
@endpush

