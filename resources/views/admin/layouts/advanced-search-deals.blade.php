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
        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Advanced Search <i class="fas fa-compress"></i>
          
          @if(request('ADVANCED'))
            <a href="{{route('admin.deal.index')}}">
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

  <div class="row"> <!--- row -->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.country')}}</label>
	  <select class="form-control " id="unit_country"
		name="unit_country" data-select2-id="" tabindex="-1" aria-hidden="true">
			<option value="">{{ __('site.choose') }}</option>
			@foreach($countries as $country)
				<option {{Request('unit_country') == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
			@endforeach
		</select>
    </div>


    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.project')}}</label>
      <select class="form-control" name="project_id">
        <option value="">{{__('site.project')}}</option>
        @foreach($projects as $project)
            <option
            {{ Request('project_id') == $project->id ? 'selected':  '' }}
            value="{{$project->id}}">{{$project->project_name}}</option>
        @endforeach
      </select>
    </div>
    @if(count($purpose)>1)
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.Purpose')}}</label>
      <select class="form-control" name="purpose">
        <option value="">{{__('site.choose')}}</option>
        @foreach($purpose as $purp)
          <option {{Request('purpose') == $purp ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
        @endforeach
      </select>
    </div>
    @endif

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.purpose type')}}</label>
      <select class="form-control"  name="purpose_type">
		<option value="">{{ __('site.choose') }}</option>
		@foreach($purposetype as $purpType)
		<option {{Request('purpose_type') == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
		@endforeach
	</select>
    </div>

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.developer_name')}}</label>
      <select class="form-control"  name="developer_id">
		<option value="">{{ __('site.choose') }}</option>
		@foreach($developer as $dev)
			<option {{Request('developer_id') == $dev->id ? 'selected' : ''}} value="{{$dev->id}}">{{$dev->name}}</option>
		@endforeach
		</select>
    </div>


	@if(count($sellers))
	<!--begin::Group-->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.Agent')}}</label>
	  <select class="form-control"  name="agent_id">
			<option value="">{{ __('site.select agent') }}</option>
			@foreach($sellers as $seller)
				<option {{Request('agent_id') == $seller->id ? 'selected' : ''}} value="{{$seller->id}}">{{$seller->name}}</option>
			@endforeach
			</select>
    </div>
	@endif
    

	@if(count($leaders))
	<!--begin::Group-->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.Leader')}}</label>
	  <select class="form-control"  name="leader_id">
		<option value="">{{ __('site.select leader') }}</option>
		@foreach($leaders as $leader)
			<option {{Request('leader_id') == $leader->id ? 'selected' : ''}} value="{{$leader->id}}">{{$leader->name}}</option>
		@endforeach
		</select>
    </div>
	@endif
    

    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.deal_date')}} {{ __('site.from') }} </label>
          <div class="">
            <div class="input-group input-group-solid date"
            id="from-deal" data-target-input="nearest">
              <input value="{{request('from')}}" type="text"
              max="{{date('d-m-Y')}}"
              class="form-control form-control-solid datetimepicker-input datepicker"
              data-toggle="datetimepicker"
              name="from" data-target="#from-deal" autocomplete="off">
              <div class="input-group-append" data-target="#from-deal" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.deal_date')}} {{ __('site.to') }}</label>
          <div class="">
            <div class="input-group input-group-solid date to-date-el"  data-target-input="nearest">
              <input value="{{request('to')}}" type="text" id="to-deal" class="form-control form-control-solid datetimepicker-input datepicker"
              data-toggle="datetimepicker"
              min="{{date('d-m-Y')}}"
              name="to" data-target="#to-deal" autocomplete="off">
              <div class="input-group-append" data-target="#to-deal" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.commission_received_date')}} {{ __('site.from') }} </label>
          <div class="">
            <div class="input-group input-group-solid date"
            id="from-commission_received_date" data-target-input="nearest">
              <input value="{{request('from_commission_received_date')}}" type="text"
              max="{{date('d-m-Y')}}"
              class="form-control form-control-solid datetimepicker-input datepicker"
              data-toggle="datetimepicker"
              name="from_commission_received_date" data-target="#from-commission_received_date" autocomplete="off">
              <div class="input-group-append" data-target="#from-commission_received_date" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.commission_received_date')}} {{ __('site.to') }}</label>
          <div class="">
            <div class="input-group input-group-solid date to-date-el"  data-target-input="nearest">
              <input value="{{request('to_commission_received_date')}}" type="text" id="to-commission_received_date" class="form-control form-control-solid datetimepicker-input datepicker"
              data-toggle="datetimepicker"
              min="{{date('d-m-Y')}}"
              name="to_commission_received_date" data-target="#to-commission_received_date" autocomplete="off">
              <div class="input-group-append" data-target="#to-commission_received_date" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>


    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.vat_received')}}</label>
      <select class="form-control"  name="vat_received">
      <option {{Request('vat_received') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
      <option {{Request('vat_received') == 'no' ? 'selected' : ''}} value="no">No</option>
      <option {{Request('vat_received') == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
		</select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.agent_leader_commission_received')}}</label>
      <select class="form-control"  name="agent_leader_commission_received">
      <option {{Request('agent_leader_commission_received') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
      <option {{Request('agent_leader_commission_received') == 'no' ? 'selected' : ''}} value="no">No</option>
      <option {{Request('agent_leader_commission_received') == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
		</select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.agent_commission_received')}}</label>
      <select class="form-control"  name="agent_commission_received">
      <option {{Request('agent_commission_received') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
      <option {{Request('agent_commission_received') == 'no' ? 'selected' : ''}} value="no">No</option>
      <option {{Request('agent_commission_received') == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
		</select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.mada_commission_received')}}</label>
      <select class="form-control"  name="mada_commission_received">
      <option {{Request('mada_commission_received') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
      <option {{Request('mada_commission_received') == 'no' ? 'selected' : ''}} value="no">No</option>
      <option {{Request('mada_commission_received') == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
		</select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.third_party')}}</label>
      <select class="form-control"  name="third_party">
      <option {{Request('third_party') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
      <option {{Request('third_party') == 'no' ? 'selected' : ''}} value="no">No</option>
      <option {{Request('third_party') == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
		</select>
    </div>

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.project_type')}}</label>
      <select class="form-control" name="project_type">
        <option {{Request('project_type') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
        <option {{Request('project_type') == 'Primary' ? 'selected' : ''}} value="Primary">{{__('site.Primary')}}</option>
        <option {{Request('project_type') == 'Secondary' ? 'selected' : ''}} value="Secondary">{{__('site.Secondary')}}</option>
      </select>
    </div>



    <!-- <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.vat')}}</label>
          <div class="">
            <div class="input-group input-group-solid date">
              <input value="{{request('vat')}}" type="text" class="form-control form-control-solid"
              name="vat" autocomplete="off">
            </div>
          </div>
        </div>
    </div>

    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.third_party_amount')}}</label>
          <div class="">
            <div class="input-group input-group-solid date">
              <input value="{{request('third_party_amount')}}" type="text" class="form-control form-control-solid"
              name="third_party_amount" autocomplete="off">
            </div>
          </div>
        </div>
    </div>

    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.mada_commission')}}</label>
          <div class="">
            <div class="input-group input-group-solid date">
              <input value="{{request('mada_commission')}}" type="text" class="form-control form-control-solid"
              name="mada_commission" autocomplete="off">
            </div>
          </div>
        </div>
    </div>-->
  </div> <!-- end row -->
<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
</form>

</div>
</div>
</div>
@push('js')
<!-- Added By javed -->

<script>
	$('.date').datepicker({
    //format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });

  $('#to-deal').datepicker({
		//format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });
</script>
@endpush