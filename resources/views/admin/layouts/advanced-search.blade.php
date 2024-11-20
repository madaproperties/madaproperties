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

  <div class="row"> <!--- row -->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.country')}}</label>
      <select class="form-control" name="country_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($countries as $countrie)
            <option
            {{ Request('country_id') == $countrie->id ? 'selected':  '' }}
            value="{{$countrie->id}}">{{$countrie->name_en}}</option>
        @endforeach
      </select>
    </div>

    @if(userRole() != 'sales')
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.assigned to')}}</label>
      <select class="form-control" name="user_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($sellers as $seller)
            <option
            {{ Request('user_id') == $seller->id ? 'selected':  '' }}
            value="{{$seller->id}}">{{$seller->name}}</option>
        @endforeach
      </select>
    </div>
    @endif

   <!-- updated by fazal on 04-01-24 -->
 @if(userRole() == 'admin' || userRole() == 'digital marketing' || userRole()=='ceo')

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.project')}} {{__('site.country')}}</label>
      <select class="form-control" name="project_country_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($countries as $countrie)
            <option
            {{ Request('project_country_id') == $countrie->id ? 'selected':  '' }}
            value="{{$countrie->id}}">{{$countrie->name_en}}</option>
        @endforeach
      </select>
    </div>
    @endif

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.project')}}</label>
      <select class="form-control" name="project_id">
        <option value="">{{__('site.project')}}</option>
        @foreach($projects as $project)
            <option
            {{ Request('project_id') == $project->id ? 'selected':  '' }}
            value="{{$project->id}}">{{$project->name}}</option>
        @endforeach
      </select>
    </div>
    

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.language')}}</label>
      <select class="form-control" name="lang">
        <option value="">{{__('site.choose')}}</option>
        @foreach(get_langs() as $lang)
            <option
            {{ Request('lang') == $lang ? 'selected':  '' }}
            value="{{$lang}}">{{$lang}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.campaign')}}</label>
      <select class="form-control" name="campaign">
        <option value="">{{__('site.choose')}}</option>
        @foreach($campaigns as $campaign)
         <option
         {{Request('campaign') == $campaign->name ? 'selected' : ''}}
         value="{{$campaign->name}}">{{$campaign->name}}</option>
         @endforeach
      </select>
    </div>

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.last mile conversion')}}</label>
      <select class="form-control" name="last_mile_conversion">
        <option value="">{{__('site.choose')}}</option>
        @foreach($miles as $mile)
         <option
         {{Request('last_mile_conversion') == $mile->id ? 'selected' : ''}}
         value="{{$mile->id}}">{{$mile->name}}</option>
         @endforeach
      </select>
    </div>
    
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.status')}}</label>
      <select class="form-control" name="status_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($status as $statu)
         <option
         {{Request('status_id') == $statu->id ? 'selected' : ''}}
         value="{{$statu->id}}">{{$statu->name}}</option>
         @endforeach
      </select>
    </div>

  <!-- Added by Javed -->
    @if(userRole() != 'sales')
      @if(isset($createdBy) && count($createdBy)>0)
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Created By')}}</label>
        <select class="form-control" name="created_by"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
            @foreach($createdBy as $choosedUser)
              <option {{request('created_by') == $choosedUser->id ? 'selected' : ''}}
                      value="{{$choosedUser->id}}">{{ explode('@',$choosedUser->email)[0]}}</option>
            @endforeach
        </select>
      </div>
      @endif
    @endif


    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.Created')}} {{ __('site.from') }} </label>
          <div class="">
            <div class="input-group input-group-solid date"
            id="from-date" data-target-input="nearest">
              <input value="{{request('from')}}" type="text"
              max="{{date('d-m-Y')}}"
              class="form-control form-control-solid datetimepicker-input"
              data-toggle="datetimepicker"
              name="from" data-target="#from-date" autocomplete="off">
              <div class="input-group-append" data-target="#from-date" data-toggle="datetimepicker">
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
          <label class="">{{__('site.Created')}} {{ __('site.to') }}</label>
          <div class="">
            <div class="input-group input-group-solid date to-date-el" id="to-date" data-target-input="nearest">
              <input value="{{request('to')}}" type="text" class="form-control form-control-solid datetimepicker-input"
              data-toggle="datetimepicker"
              min="{{date('d-m-Y')}}"
              name="to" data-target="#to-date" autocomplete="off">
              <div class="input-group-append" data-target="#to-date" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
	 <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.budget')}}</label>
      <select class="form-control"  name="budget">
        <option value="">{{ __('site.budget') }}</option>
        @foreach(budgets() as $budget)
        <option {{request('budget') == trim($budget) ? 'selected' : ''}} value="{{trim($budget)}}">{{trim($budget)}}</option>
        @endforeach
      </select>
    </div>
    <!-- End by Javed -->

    <!--begin::Group-->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.source')}}</label>
      <select class="form-control" name="source">
        <option value="">{{ __('site.source') }}</option>
        @foreach($sources as $source)
        <option {{Request('source') == $source->name ? 'selected' : ''}} value="{{$source->name}}">{{$source->name}}</option>
        @endforeach      
        </select>
    </div>
    <!--end::Group-->

 <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.purpose type')}}</label>
      <select class="form-control"  name="purpose_type">
		<option value="">{{ __('site.choose') }}</option>
		@foreach($purposetype as $purpType)
		<option {{Request('purpose_type') == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
		@endforeach
	</select>
    </div>

    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.Last Updated')}} {{ __('site.from') }} </label>
          <div class="">
            <div class="input-group input-group-solid date"
            id="lastupdatefrom-date" data-target-input="nearest">
              <input value="{{request('last_update_from')}}" type="text"
              max="{{date('d-m-Y')}}"
              class="form-control form-control-solid datetimepicker-input"
              data-toggle="datetimepicker"
              name="last_update_from" data-target="#lastupdatefrom-date" autocomplete="off">
              <div class="input-group-append" data-target="#lastupdatefrom-date" data-toggle="datetimepicker">
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
          <label class="">{{__('site.Last Updated')}} {{ __('site.to') }}</label>
          <div class="">
            <div class="input-group input-group-solid date to-date-el" id="lastupdateto-date" data-target-input="nearest">
              <input value="{{request('last_update_to')}}" type="text" class="form-control form-control-solid datetimepicker-input"
              data-toggle="datetimepicker"
              min="{{date('d-m-Y')}}"
              name="last_update_to" data-target="#lastupdateto-date" autocomplete="off">
              <div class="input-group-append" data-target="#lastupdateto-date" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="form-group col-md-4 col-sm-12">
      <div class="form-group ">
          <label class="">{{__('site.email')}}</label>
          <div class="">
            <div class="input-group input-group-solid">
              <input value="{{request('email')}}" type="text" class="form-control form-control-solid"
              name="email" autocomplete="off">
            </div>
          </div>
        </div>
    </div>

    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.Challenge lead')}}</label>
      <select class="form-control"  name="challenge_lead">
        <option {{Request('challenge_lead ') == '0' ? 'selected' : ''}} value="0">No</option>
        <option {{Request('challenge_lead') == '1' ? 'selected' : ''}} value="1">Yes</option>
      </select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.lead_category')}}</label>
      <select class="form-control"  name="lead_category" id="lead_category">
        <option value="">{{ __('site.choose') }}</option>
				<option {{Request('lead_category') == 'Primary' ? 'selected' : ''}} value="Primary">{{__('site.Primary')}}</option>
				<option {{Request('lead_category') == 'Secondary' ? 'selected' : ''}} value="Secondary">{{__('site.Secondary')}}</option>
			</select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.Meeting')}}</label>
      <select class="form-control"  name="is_meeting">
        <option {{Request('is_meeting') == '0' ? 'selected' : ''}} value="0">No</option>
        <option {{Request('is_meeting') == '1' ? 'selected' : ''}} value="1">Yes</option>
      </select>
    </div>
    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.Meeting')}} {{__('site.Created')}} {{ __('site.from') }}(Meeting should be Yes to use it)</label>
          <div class="">
            <div class="input-group input-group-solid date"
            id="meeting-from-date" data-target-input="nearest">
              <input value="{{request('meeting_from')}}" type="text"
              max="{{date('d-m-Y')}}"
              class="form-control form-control-solid datetimepicker-input"
              data-toggle="datetimepicker"
              name="meeting_from" data-target="#meeting-from-date" autocomplete="off">
              <div class="input-group-append" data-target="#meeting-from-date" data-toggle="datetimepicker">
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
          <label class="">{{__('site.Meeting')}} {{__('site.Created')}} {{ __('site.to') }}(Meeting should be Yes to use it)</label>
          <div class="">
            <div class="input-group input-group-solid date to-date-el" id="meeting-to-date" data-target-input="nearest">
              <input value="{{request('meeting_to')}}" type="text" class="form-control form-control-solid datetimepicker-input"
              data-toggle="datetimepicker"
              min="{{date('d-m-Y')}}"
              name="meeting_to" data-target="#meeting-to-date" autocomplete="off">
              <div class="input-group-append" data-target="#meeting-to-date" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
     @if(userRole() != 'sales')
      @if(isset($leaders) && count($leaders)>0)
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Team')}}</label>
        <select class="form-control" name="leader"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
            @foreach($leaders as $leader)
              <option {{request('leader') == $leader->id ? 'selected' : ''}}
                      value="{{$leader->id}}">{{ explode('@',$leader->email)[0]}}</option>
            @endforeach
        </select>
      </div>
      @endif
    @endif

  </div> <!-- end row -->
<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
</form>

</div>
</div>
</div>
