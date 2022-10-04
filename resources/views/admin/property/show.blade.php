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
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.edit_property')}}</h5>
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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.property.update',$property->id)}}" id="kt_form" enctype="multipart/form-data">
														@csrf
														@method('PATCH')
														<div class="tab-content mt-5" id="myTabContent">
															<div class="tab-pane fade active show" id="basic" role="tabpanel" aria-labelledby="basic-tab">
																
																<!--begin::Group-->
																<div class="form-group row fv-plugins-icon-container">
																	<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
																	<div class="col-lg-9 col-xl-9">
																		<select name="status" id="status" class="form-control">
																			{!! selectOptions(__('config.status'),$property->status) !!}
																		</select>
																	</div>
																</div>
																<!--end::Group-->
																
																<div class="row col-xl-12">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-1 col-lg-1 col-form-label">{{__('site.title')}}</label>
																				<div class="col-lg-11 col-xl-11">
																					<input class="form-control form-control-solid form-control-lg" 	name="title" type="text" value="{{$property->title}}" placeholder="{{__('site.title')}}">
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
																					<input class="form-control form-control-solid form-control-lg" 	name="unitno" type="text" value="{{$property->unitno}}" placeholder="{{__('site.unit')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.permit')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="str_no" type="text" value="{{$property->str_no}}" placeholder="{{__('site.permit_no')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.type')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="sale_rent" required>
																						{!! selectOptions(__('config.sale_rent'),$property->sale_rent) !!}
																					</select>																					
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.street')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="street" type="text" value="{{$property->street}}" placeholder="{{__('site.street')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_meas')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="measure_unit" id="measure_unit" class="form-control">
																						{!! selectOptions(__('config.measure_unit'),$property->measure_unit) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bua')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="buildup_area" type="text" value="{{$property->buildup_area}}" placeholder="{{__('site.bua')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.plot')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="plot_size" type="text" value="{{$property->plot_size}}" placeholder="{{__('site.plot')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.parking_type')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="parking_type" id="parking_type" class="form-control" required>
																						{!! selectOptions(__('config.parking_type'),$property->parking_type) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.parking')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="parking_areas" id="parking_areas" class="form-control" required>
																						{!! selectOptions(__('config.parking_areas'),$property->parking_areas) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="floor" type="text" value="{{$property->floor}}" placeholder="{{__('site.floor')}}">
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
																						<option {{$property->city_id == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name_en}}</option>
																						@endforeach 
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.location')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="area_name" type="text" value="{{$property->area_name}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_location')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="project_name" type="text" value="{{$property->project_name}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.building')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="building_name" type="text" value="{{$property->building_name}}" placeholder="">
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
																						<option {{$property->source_id == $source->id ? 'selected' : ''}} value="{{$source->id}}">{{$source->name}}</option>
																						@endforeach      
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.campaign')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control" name="campaign_id" required>
																						<option value="">{{__('site.choose')}}</option>
																						@foreach($campaigns as $campaign)
																						<option {{ $property->campaign_id == $campaign->id ? 'selected' : ''}} value="{{$campaign->id}}">{{$campaign->name}}</option>
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
																						<option value="">{{ __('site.choose') }}</option>
																						@foreach($categories as $category)
																						<option {{ $property->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
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
																						{!! selectOptions(__('config.price_type'),$property->price_type) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price_on_application')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="price_on_application" id="price_on_application" class="form-control">
																						{!! selectOptions(__('config.yes_no'),$property->price_on_application) !!}
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
																					<input class="form-control form-control-solid form-control-lg" 	name="price" type="text" value="{{$property->price}}" placeholder="{{__('site.price')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			

																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Price_Area')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="price_unit" type="text" value="{{$property->price_unit}}" placeholder="{{__('site.price_unit')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedrooms')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="bedrooms" id="bedrooms" class="form-control">
																						{!! selectOptions(__('config.bedrooms'),$property->bedrooms) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Baths')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="bathrooms" id="bathrooms" class="form-control">
																						{!! selectOptions(__('config.bathrooms'),$property->bathrooms) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Cheques')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="cheques" id="cheques" class="form-control">
																						{!! selectOptions(__('config.cheques'),$property->cheques) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Deposit')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="deposit" type="text" value="{{$property->deposit}}" placeholder="{{__('site.Deposit')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Furnished')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="furnished" id="furnished" class="form-control" required>
																						{!! selectOptions(__('config.furnished'),$property->furnished) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			

																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.managed')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="is_managed" id="is_managed" class="form-control">
																						{!! selectOptions(__('config.yes_no'),$property->is_managed) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.offplan')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="checkbox" name="is_exclusive" class="checkbox" {{ $property->is_exclusive ? 'checked' : ''}}>
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
																					<textarea class="form-control form-control-solid form-control-lg" id="description" rows="10" name="description" type="text" placeholder="{{__('site.description')}}">{!!$property->description!!}</textarea>
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
																						<option {{ $property->user_id == $seller->id ? 'selected':  '' }} value="{{$seller->id}}">{{$seller->name}}</option>
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
																						{!! selectOptions(__('config.stage'),$property->stage) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_features')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="unit_features" type="text" value="{{$property->unit_features}}" placeholder="{{__('site.unit_features')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.dev_feature')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="dev_feature" type="text" value="{{$property->dev_feature}}" placeholder="{{__('site.dev_feature')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.lifestyle')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="lifestyle" type="text" value="{{$property->lifestyle}}" placeholder="{{__('site.lifestyle')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.photos')}} (can attach more than one)</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#image_uploader">
                    																	Images {{isset($property->images) ? count($property->images) : 0 }} <i class="fa fa-image"></i>
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.features')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#features_modal">
                    																	Features {{isset($property->features) ? count($property->features) : 0 }} <i class="fa fa-menu"></i>
                  																	</button>
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
																						{!! selectOptions(__('config.featured'),$property->is_featured) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.fitted')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="fitted" id="fitted" class="form-control">
																						{!! selectOptions(__('config.fitted'),$property->fitted) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->
																		

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.tenanted')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="tenanted" id="tenanted" class="form-control">
																						{!! selectOptions(__('config.yes_no'),$property->tenanted) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.rent_price')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="rent_price" type="text" value="{{$property->rent_price}}" placeholder="{{__('site.rent_price')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project_status')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="project_status" id="project_status" class="form-control">
																						{!! selectOptions(__('config.project_status'),$property->project_status) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="developer" type="text" value="{{$property->developer}}" placeholder="{{__('site.developer')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.documents')}} (can attach more than one)</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#document_uploader">
                    																	Documents {{isset($property->documents) ? count($property->documents) : 0 }}  <i class="fa fa-folder"></i>
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.portals')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#portals_modal">
																					{{__('site.portals')}} {{isset($property->portals) ? count($property->portals) : 0 }} <i class="fa fa-menu"></i>
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
																					<input class="form-control form-control-solid form-control-lg" 	name="rented_till" type="date" value="{{$property->rented_till}}" placeholder="{{__('site.rented_till')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.avail')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="next_available" type="date" value="{{$property->next_available}}" placeholder="{{__('site.next_available')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.maint_fee')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="maint_fee" type="text" value="{{$property->maint_fee}}" placeholder="{{__('site.maint_fee')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.dewa')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="dewa" type="text" value="{{$property->dewa}}" placeholder="{{__('site.dewa')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.postal_code')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="postal_code" type="text" value="{{$property->postal_code}}" placeholder="{{__('site.postal_code')}}">
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
																						{!! selectOptions(__('config.yes_no'),$property->reminder) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.virtual_360')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="virtual_360" type="text" value="{{$property->virtual_360}}" placeholder="{{__('site.virtual_360')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor_plan')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="floorplan" type="text" value="{{$property->floorplan}}" placeholder="{{__('site.floorplan')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.video')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="video" type="text" value="{{$property->video}}" placeholder="{{__('site.video')}}">
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
																					<input class="form-control form-control-solid form-control-lg" 	name="contact_no" type="text" value="{{$property->contact_no}}" placeholder="{{__('site.contact_no')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.mobile')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="mobile" type="text" value="{{$property->mobile}}" placeholder="{{__('site.mobile')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.owner_name')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="owner_name" type="text" value="{{$property->owner_name}}" placeholder="{{__('site.owner_name')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.email')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="email" type="text" value="{{$property->email}}" placeholder="{{__('site.email')}}">
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
																						{!! selectOptions(__('config.yes_no'),$property->verified) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unver_reas')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select name="unverified_reason" id="unverified_reason" class="form-control">
																						{!! selectOptions(__('config.unverified_reason'),$property->unverified_reason) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.date')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="verified_date" type="date" value="{{$property->verified_date}}" placeholder="{{__('site.date')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.pass_p_eid')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="passport_emirates_id" type="text" value="{{$property->passport_emirates_id}}" placeholder="{{__('site.pass_p_eid')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.title_deed')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="title_deed" type="text" value="{{$property->title_deed}}" placeholder="{{__('site.title_deed')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.from_a_noc_sl_form')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="forma_noc_slform" type="text" value="{{$property->forma_noc_slform}}" placeholder="{{__('site.from_a_noc_sl_form')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->


																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.published_date')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg"  type="text" value="{{$property->publishing_date}}" disabled>
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
@include('admin.property.features')
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