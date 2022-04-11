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
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.edit_deal')}}</h5>
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
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.deal.update',$deal->id)}}" id="kt_form">
														@csrf
														@method('PATCH')
														<div class="row justify-content-center">
														<div class="col-xl-6">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit country')}} </label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control " id="unit_country"
																			name="unit_country" data-select2-id="" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($countries as $country)
																					<option {{$deal->unit_country == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
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
																				<option {{$deal->purpose == $purp ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
																				@endforeach
																			</select>
																		</div>
																		</div>
																	<!--end::Group-->
																	@endif

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.purpose type')}}</label>
																		<div class="col-lg-9 col-xl-9" data-select2-id="38">
																			<select class="form-control"  name="purpose_type">
																				<option value="">{{ __('site.choose') }}</option>
																				@foreach($purposetype as $purpType)
																				<option {{$deal->purpose_type == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="unit_name" type="text" value="{{$deal->unit_name}}" placeholder="{{__('site.unit_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="developer_id">
																			<option value="">{{ __('site.choose') }}</option>
																			@foreach($developer as $dev)
																				<option {{$deal->developer_id == $dev->id ? 'selected' : ''}} value="{{$dev->id}}">{{$dev->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.deal_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="deal_date" type="date" value="{{$deal->deal_date}}" placeholder="{{__('site.deal_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.invoice_number')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="invoice_number" type="text" value="{{$deal->invoice_number}}" placeholder="{{__('site.invoice_number')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.source')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control" name="source_id" tabindex="-1" aria-hidden="true">
																				<option value="">{{ __('site.choose') }}</option>
																					@foreach($sources as $source)
																					<option {{$deal->source_id == $source->id ? 'selected' : ''}} value="{{$source->id}}">{{$source->name}}</option>
																					@endforeach
																			</select>														
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.client_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="client_name" type="text" value="{{$deal->client_name}}" placeholder="{{__('site.client_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.client_mobile_no')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="client_mobile_no" type="text" value="{{$deal->client_mobile_no}}" placeholder="{{__('site.client_mobile_no')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.client_email')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<div class="input-group input-group-solid input-group-lg">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
																				<input type="email" class="form-control form-control-solid form-control-lg" name="client_email" value="{{$deal->client_email}}">
																			</div>
																		</div>
																	</div>
																	<!--end::Group-->





																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="price" 	name="price" type="text" value="{{$deal->price}}" placeholder="{{__('site.price')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission_type')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="commission_type">
																			<option {{$deal->commission_type == 'Commission Type' ? 'selected' : ''}} value="full">{{__('Commission Type')}}</option>
																			<option {{$deal->commission_type == 'full' ? 'selected' : ''}} value="full">{{__('site.full')}}</option>
																			<option {{$deal->commission_type == 'installment 1' ? 'selected' : ''}} value="installment 1">{{__('site.installment1')}}</option>
																			<option {{$deal->commission_type == 'installment 2' ? 'selected' : ''}} value="installment 2">{{__('site.installment2')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="commission" 	name="commission" type="text" value="{{$deal->commission}}" placeholder="{{__('site.commission')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="commission_amount" 	name="commission_amount" type="text" value="{{$deal->commission_amount}}" placeholder="{{__('site.commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.vat')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="vat"  name="vat" type="text" value="{{$deal->vat}}" placeholder="{{__('site.vat')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.vat_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg"  id="vat_amount" name="vat_amount" type="text" value="{{$deal->vat_amount}}" placeholder="{{__('site.vat_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.vat_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="vat_received" type="radio" value="no" {{ $deal->vat_received == 'no' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="vat_received" type="radio" value="yes" {{ $deal->vat_received == 'yes' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.total_invoice')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg"  id="total_invoice" name="total_invoice" type="text" value="{{$deal->total_invoice}}" placeholder="{{__('site.total_invoice')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.token')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="text" name="token" value="{{$deal->token}}" placeholder="{{__('site.token')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.down_payment')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="down_payment">
																				<option {{$deal->down_payment == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
																				<option {{$deal->down_payment == 'yes' ? 'selected' : ''}} value="yes">{{__('site.yes')}}</option>
																				<option {{$deal->down_payment == 'no' ? 'selected' : ''}} value="no">{{__('site.no')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.spa')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="spa">
																			<option {{$deal->spa == 'yes' ? 'selected' : ''}} value="yes">{{__('site.yes')}}</option>
																			<option {{$deal->spa == 'no' ? 'selected' : ''}} value="no">{{__('site.no')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.expected_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="date" name="expected_date" value="{{$deal->expected_date}}" placeholder="{{__('site.expected_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.invoice_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="date"  name="invoice_date" value="{{$deal->invoice_date}}" placeholder="{{__('site.invoice_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission_received_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="date"  name="commission_received_date" value="{{$deal->commission_received_date}}" placeholder="{{__('site.commission_received_date')}}">
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
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.mada_commission')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="mada_commission" 	name="mada_commission" type="text" value="{{$deal->mada_commission}}" placeholder="{{__('site.mada_commission')}}" readonly> 
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.mada_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="mada_commission_received" type="radio" value="no" {{ $deal->mada_commission_received == 'no' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="mada_commission_received" type="radio" value="yes" {{ $deal->mada_commission_received == 'yes' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->



																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.third_party')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control third_party" id="third_party" name="third_party" type="checkbox" {{ !empty($deal->third_party) ? 'checked' : ''}}>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container third_party_div">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.third_party_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="third_party_amount" name="third_party_amount" type="text" value="{{$deal->third_party_amount}}" placeholder="{{__('site.third_party_amount')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container third_party_div">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.third_party_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" name="third_party_name" type="text" id="third_party_name" value="{{$deal->third_party_name}}" placeholder="{{__('site.third_party_name')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->



																	@if(count($sellers))
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Agent')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="agent_id">
																			<option value="">{{ __('site.select agent') }}</option>
																			@foreach($sellers as $seller)
																				<option {{$deal->agent_id == $seller->id ? 'selected' : ''}} value="{{$seller->id}}">{{$seller->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	@endif


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_commission_percent')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent_commission_percent" id="agent_commission_percent" type="text" value="{{$deal->agent_commission_percent}}" placeholder="{{__('site.agent_commission_percent')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent_commission_amount" type="text" value="{{$deal->agent_commission_amount}}" id="agent_commission_amount" placeholder="{{__('site.agent_commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.agent_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_commission_received" type="radio" value="no" {{ $deal->agent_commission_received == 'no' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_commission_received" type="radio" value="yes" {{ $deal->agent_commission_received == 'yes' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->


																	@if(count($leaders))
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Leader')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="leader_id">
																			<option value="">{{ __('site.select leader') }}</option>
																			@foreach($leaders as $leader)
																				<option {{$deal->leader_id == $leader->id ? 'selected' : ''}} value="{{$leader->id}}">{{$leader->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	@endif

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_leader_commission_percent')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="agent_leader_commission_percent" 	name="agent_leader_commission_percent" type="text" value="{{$deal->agent_leader_commission_percent}}" placeholder="{{__('site.agent_leader_commission_percent')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_leader_commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent_leader_commission_amount" type="text" value="{{$deal->agent_leader_commission_amount}}" id="agent_leader_commission_amount" placeholder="{{__('site.agent_leader_commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.agent_leader_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_leader_commission_received" type="radio" value="no" {{ $deal->agent_leader_commission_received == 'no' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_leader_commission_received" type="radio" value="yes" {{ $deal->agent_leader_commission_received == 'yes' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->

																	@if(count($sellers))
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Agent2')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="agent2_id">
																			<option value="">{{ __('site.select agent2') }}</option>
																			@foreach($sellers as $seller)
																				<option {{$deal->agent2_id == $seller->id ? 'selected' : ''}} value="{{$seller->id}}">{{$seller->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	@endif


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent2_commission_percent')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent2_commission_percent" id="agent2_commission_percent" type="text" value="{{$deal->agent2_commission_percent}}" placeholder="{{__('site.agent2_commission_percent')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent2_commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent2_commission_amount" type="text" value="{{$deal->agent2_commission_amount}}" id="agent2_commission_amount" placeholder="{{__('site.agent2_commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.agent2_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent2_commission_received" type="radio" value="no" {{ $deal->agent2_commission_received == 'no' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent2_commission_received" type="radio" value="yes" {{ $deal->agent2_commission_received == 'yes' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->

																	@if(count($leaders))
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Leader2')}} </label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="leader2_id">
																			<option value="">{{ __('site.select leader') }}</option>
																			@foreach($leaders as $leader)
																				<option {{$deal->leader2_id == $leader->id ? 'selected' : ''}} value="{{$leader->id}}">{{$leader->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	@endif

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent2_leader_commission_percent')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="agent2_leader_commission_percent" 	name="agent2_leader_commission_percent" type="text" value="{{$deal->agent2_leader_commission_percent}}" placeholder="{{__('site.agent2_leader_commission_percent')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent2_leader_commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent2_leader_commission_amount" type="text" value="{{$deal->agent2_leader_commission_amount}}" id="agent2_leader_commission_amount" placeholder="{{__('site.agent2_leader_commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.agent2_leader_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent2_leader_commission_received" type="radio" value="no" {{ $deal->agent2_leader_commission_received == 'no' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent2_leader_commission_received" type="radio" value="yes" {{ $deal->agent2_leader_commission_received == 'yes' ? 'checked' : '' }}>
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.notes')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<textarea class="form-control form-control-solid form-control-lg" rows="10" name="notes" type="text" id="notes" placeholder="{{__('site.notes')}}">{{$deal->notes}}</textarea>
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
@push('js')
<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
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
		getCountryCities($('#unit_country').val(),$("#unit_city"));
		getProjects($('#unit_country').val());
	});

	$( document ).ready(function (){

		$('.datepic').datetimepicker({
			format: 'L'
			//minDate:new Date()
		});

		@if($deal->third_party)
			$(".third_party_div").show();
		@else
			$(".third_party_div").hide();
		@endif
		$(".third_party").click(function(){
			if ($('.third_party').is(':checked')) {
				$(".third_party_div").show();
			}else{
				$("#third_party_amount").val(0);
				$("#third_party_name").val('');
				$(".third_party_div").hide();
			}
		});


		$("#price").on('input keyup keypress blur change',function(){
			var comi = $("#commission").val();
			var price = $("#price").val();	
			$("#commission_amount").val(((price*comi)/100).toFixed(2));
			$("#vat").change();
		});

		$("#commission").on('input keyup keypress blur change',function(){
			if($(this).val() > 100 || $(this).val() < 0){
				alert('Commission value should be greater than 0 and less than 100');
				$(this).val(0);
			}
			if($("#price").val() < 0){
				alert('Price amount should not be 0');
				$("#price").focus();
				$(this).val(0);
			}

			var comi = $(this).val();
			var price = $("#price").val();	
			$("#commission_amount").val(((price*comi)/100).toFixed(2));

			var comi = $("#vat").val();
			var commission_amount = $("#commission_amount").val();	
			$("#vat_amount").val(((commission_amount*comi)/100).toFixed(2));
			$("#total_invoice").val((((commission_amount*comi)/100) + parseFloat(commission_amount)).toFixed(2));
			updateMadaCommission();
		});

		$("#agent_commission_percent").on('input keyup keypress blur change',function(){
			if($(this).val() > 100 || $(this).val() < 0){
				alert('Agent commission value should be greater than 0 and less than 100');
				$("#agent_commission_percent").focus();
				$(this).val(0);
			}
			if($("#commission_amount").val() < 0){
				alert('Commission amount should not be 0');
				$("#commission_amount").focus();
				$(this).val(0);
			}

			var comi = $(this).val();
			var price = $("#commission_amount").val();	
			if ($('.third_party').is(':checked')) {
				var third_party_amount = parseFloat($("#third_party_amount").val());
				if(third_party_amount > 0){
					price -= third_party_amount;
				}
			}

			$("#agent_commission_amount").val(((price*comi)/100).toFixed(2));
			updateMadaCommission();
		});


		$("#agent2_commission_percent").on('input keyup keypress blur change',function(){
			if($(this).val() > 100 || $(this).val() < 0){
				alert('Agent 2 commission value should be greater than 0 and less than 100');
				$("#agent2_commission_percent").focus();
				$(this).val(0);
			}
			if($("#commission_amount").val() < 0){
				alert('Commission amount should not be 0');
				$("#commission_amount").focus();
				$(this).val(0);
			}

			var comi = $(this).val();
			var price = $("#commission_amount").val();	
			if ($('.third_party').is(':checked')) {
				var third_party_amount = parseFloat($("#third_party_amount").val());
				if(third_party_amount > 0){
					price -= third_party_amount;
				}
			}
			$("#agent2_commission_amount").val(((price*comi)/100).toFixed(2));
			updateMadaCommission();
		});

		$("#agent_leader_commission_percent").on('input keyup keypress blur change',function(){
			if($(this).val() > 100 || $(this).val() < 0){
				alert('Agent leader commission value should be greater than 0 and less than 100');
				$("#agent_leader_commission_percent").focus();
				$(this).val(0);
			}
			if($("#commission_amount").val() < 0){
				alert('Commission amount should not be 0');
				$("#commission_amount").focus();
				$(this).val(0);
			}

		var comi = $(this).val();
			var agent_commission_amount = $("#agent_commission_amount").val();	
			$("#agent_leader_commission_amount").val(((agent_commission_amount*comi)/100).toFixed(2));
			updateMadaCommission();
		});

		$("#agent2_leader_commission_percent").on('input keyup keypress blur change',function(){
			if($(this).val() > 100 || $(this).val() < 0){
				alert('Agent 2 leader commission value should be greater than 0 and less than 100');
				$("#agent2_leader_commission_percent").focus();
				$(this).val(0);
			}
			if($("#commission_amount").val() < 0){
				alert('Commission amount should not be 0');
				$("#commission_amount").focus();
				$(this).val(0);
			}

		var comi = $(this).val();
			var agent_commission_amount = $("#agent2_commission_amount").val();	
			$("#agent2_leader_commission_amount").val(((agent_commission_amount*comi)/100).toFixed(2));
			updateMadaCommission();
		});


		$("#vat").on('input keyup keypress blur change',function(){
			if($(this).val() > 100 || $(this).val() < 0){
				alert('Vat value should be greater than 0 and less than 100');
				$("#vat").focus();
				$(this).val(0);
			}
			if($("#price").val() < 0){
				alert('Price amount should not be 0');
				$("#price").focus();
				$(this).val(0);
			}

			if($("#commission_amount").val() < 0){
				alert('Commission amount should not be 0');
				$("#commission_amount").focus();
				$(this).val(0);
			}

			var comi = $(this).val();
			var price = $("#price").val();	
			var commission_amount = $("#commission_amount").val();	
			$("#vat_amount").val(((commission_amount*comi)/100).toFixed(2));
			$("#total_invoice").val((((commission_amount*comi)/100) + parseFloat(commission_amount)).toFixed(2));
		});

		$("#third_party_amount").on('input keyup keypress blur change',function(){
			updateMadaCommission();
		});


	});
	function updateMadaCommission(){
		var commission_amount = parseFloat($("#commission_amount").val());
		var agent_commission_amount = parseFloat($("#agent_commission_amount").val());
		var agent2_commission_amount = parseFloat($("#agent2_commission_amount").val());
		var agent_leader_commission_amount = parseFloat($("#agent_leader_commission_amount").val());
		var agent2_leader_commission_amount = parseFloat($("#agent2_leader_commission_amount").val());
		var temp_com = 0;
		if(agent_commission_amount > 0){
			temp_com += agent_commission_amount;
		}
		if(agent2_commission_amount > 0){
			temp_com += agent2_commission_amount;
		}
		if(agent_leader_commission_amount > 0){
			temp_com += agent_leader_commission_amount;
		}
		if(agent2_leader_commission_amount > 0){
			temp_com += agent2_leader_commission_amount;
		}
		if ($('.third_party').is(':checked')) {
			var third_party_amount = parseFloat($("#third_party_amount").val());
			if(third_party_amount > 0){
				temp_com += third_party_amount;
			}
		}
		$("#mada_commission").val((commission_amount - temp_com).toFixed(2));		
	}

	function getProjects(country)
	{
	    $('.related-to-project').css('display','none');
	    let token = $('meta[name=csrf-token]').attr('content');
		let route = '{{route("admin.get.dealprojects")}}';
		let projectEl = $('.other-select');


        projectEl.attr('disabled',true);

		var projectId = '{{$deal->project_id}}';
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
				var selected = '';
				if(projectId == row.id){
					selected = 'selected';
				}
				

				projectEl.append(`<option
                    id="project-value-${row.id}"
                    data-text="${row.name}"
                    value="${row.id}"
                    data-select2-id="${row.name}"  `+selected+`>
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

	getProjects('{{$deal->unit_country}}');
	$('.prject-area').css('height','auto');
	$('.prject-area').css('opacity','1');
</script>
@endpush
