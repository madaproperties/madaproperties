@push('css')
  <style>
      #headingOne
      {
        padding: 0;
      }
      #headingOne button
      {
        color:#000;
        text-decoration: none
      }
  </style>
@endpush
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Advanced Search <i class="fas fa-compress"></i>
          
          @if(request('ADVANCED'))
            <a href="?">
                Remove Filter
            </a>
          @endif
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">

                          <form method="GET" action="" class="search-from" >
                            <h3 class="text-center">advanced Search</h2> <hr />
                            <input type="hidden" name="ADVANCED" value="search">
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
																					<option {{old('unit_country') == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
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
																			<option value="">{{ __('site.choose') }}</option>
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
																				<option {{old('purpose') == $purp ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
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
																				<option {{old('purpose_type') == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
																				@endforeach
																			</select>
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
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="developer_id">
																			<option value="">{{ __('site.choose') }}</option>
																			@foreach($developer as $dev)
																				<option {{old('developer_id') == $dev->id ? 'selected' : ''}} value="{{$dev->id}}">{{$dev->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.deal_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="deal_date" type="date" value="{{old('deal_date')}}" placeholder="{{__('site.deal_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.client_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="client_name" type="text" value="{{old('client_name')}}" placeholder="{{__('site.client_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.client_mobile_no')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="client_mobile_no" type="text" value="{{old('client_mobile_no')}}" placeholder="{{__('site.client_mobile_no')}}">
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
																				<input type="email" class="form-control form-control-solid form-control-lg" name="client_email" value="{{old('client_email')}}">
																			</div>
																		</div>
																	</div>
																	<!--end::Group-->





																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="price" 	name="price" type="text" value="{{old('price')}}" placeholder="{{__('site.price')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission_type')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="commission_type">
																			<option {{old('commission_type') == 'Commission Type' ? 'selected' : ''}} value="Commission Type">{{__('Commission Type')}}</option>
																			<option {{old('commission_type') == 'full' ? 'selected' : ''}} value="full">{{__('site.full')}}</option>
																			<option {{old('commission_type') == 'installment 1' ? 'selected' : ''}} value="installment 1">{{__('site.installment1')}}</option>
																			<option {{old('commission_type') == 'installment 2' ? 'selected' : ''}} value="installment 2">{{__('site.installment2')}}</option>
																			</select>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="commission" 	name="commission" type="text" value="{{old('commission')}}" placeholder="{{__('site.commission')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="commission_amount" 	name="commission_amount" type="text" value="{{old('commission_amount')}}" placeholder="{{__('site.commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.vat')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="vat"  name="vat" type="text" value="{{old('vat')}}" placeholder="{{__('site.vat')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.vat_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg"  id="vat_amount" name="vat_amount" type="text" value="{{old('vat_amount')}}" placeholder="{{__('site.vat_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.vat_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="vat_received" type="radio" value="no" checked>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="vat_received" type="radio" value="yes">
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.total_invoice')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg"  id="total_invoice" name="total_invoice" type="text" value="{{old('total_invoice')}}" placeholder="{{__('site.total_invoice')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.token')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="text" name="token" value="{{old('token')}}" placeholder="{{__('site.token')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.down_payment')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="text" name="down_payment" value="{{old('down_payment')}}" placeholder="{{__('site.down_payment')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.spa')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<select class="form-control"  name="spa">
																			<option {{old('spa') == 'yes' ? 'selected' : ''}} value="yes">{{__('site.yes')}}</option>
																			<option {{old('spa') == 'no' ? 'selected' : ''}} value="no">{{__('site.no')}}</option>
																			</select>
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
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.expected_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="date" name="expected_date" value="{{old('expected_date')}}" placeholder="{{__('site.expected_date')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.invoice_date')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" type="date" name="invoice_date" value="{{old('invoice_date')}}" placeholder="{{__('site.invoice_date')}}">
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
																				<option {{old('agent_id') == $seller->id ? 'selected' : ''}} value="{{$seller->id}}">{{$seller->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	@endif


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_commission_percent')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent_commission_percent" id="agent_commission_percent" type="text" value="{{old('agent_commission_percent')}}" placeholder="{{__('site.agent_commission_percent')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent_commission_amount" type="text" value="{{old('agent_commission_amount')}}" id="agent_commission_amount" placeholder="{{__('site.agent_commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.agent_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_commission_received" type="radio" value="no" checked>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_commission_received" type="radio" value="yes">
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
																				<option {{old('leader_id') == $leader->id ? 'selected' : ''}} value="{{$leader->id}}">{{$leader->name}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>
																	@endif

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_leader_commission_percent')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="agent_leader_commission_percent" 	name="agent_leader_commission_percent" type="text" value="{{old('agent_leader_commission_percent')}}" placeholder="{{__('site.agent_leader_commission_percent')}}" autocomplete="off">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->


																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.agent_leader_commission_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" 	name="agent_leader_commission_amount" type="text" value="{{old('agent_leader_commission_amount')}}" id="agent_leader_commission_amount" placeholder="{{__('site.agent_leader_commission_amount')}}" readonly>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.agent_leader_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_leader_commission_received" type="radio" value="no" checked>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="agent_leader_commission_received" type="radio" value="yes">
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.third_party')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control third_party" id="third_party" name="third_party" type="checkbox" value="{{old('third_party')}}">
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container third_party_div">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.third_party_amount')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="third_party_amount" name="third_party_amount" type="text" value="{{old('third_party_amount')}}" placeholder="{{__('site.third_party_amount')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container third_party_div">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.third_party_name')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" name="third_party_name" type="text" id="third_party_name" value="{{old('third_party_name')}}" placeholder="{{__('site.third_party_name')}}">
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.mada_commission')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-solid form-control-lg" id="mada_commission" 	name="mada_commission" type="text" value="{{old('mada_commission')}}" placeholder="{{__('site.mada_commission')}}" readonly> 
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->

																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-form-label">{{__('site.mada_commission_received')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="mada_commission_received" type="radio" value="no" checked>
																		</div>
																		<label class="col-form-label">{{__('site.no')}}</label>
																		<div class="col-xl-1">
																			<input class="form-control" name="mada_commission_received" type="radio" value="yes">
																		</div>
																		<label class="col-form-label">{{__('site.yes')}}</label>
																	</div>
																	<!--end::Group-->



																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.notes')}}</label>
																		<div class="col-lg-9 col-xl-9">
																			<textarea class="form-control form-control-solid form-control-lg" rows="10" name="notes" type="text" id="notes" value="{{old('notes')}}" placeholder="{{__('site.notes')}}"></textarea>
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
                                  <button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
																	</div>
																</div>
																<!--end::Wizard Actions-->
															</div>
														</div>
  

</form>

</div>
</div>
</div>
