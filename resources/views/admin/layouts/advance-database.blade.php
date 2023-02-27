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
  <div class="row">
     <!--- row -->
   <!-- added by fazal -26-02-23 -->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.client country')}}</label>
      <select class="form-control" name="user_country_id">
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
      <label for="country">{{__('site.Project country')}}</label>
      <select class="form-control" name="country_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($project_country as $countrie)
            <option
            {{ Request('country_id') == $countrie->id ? 'selected':  '' }}
            value="{{$countrie->id}}">{{$countrie->name_en}}</option>
        @endforeach
      </select>
    </div>

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
    @endif
    <!-- fazal 25-02 -->
      @if(auth()->user()->time_zone =='Asia/Riyadh' && auth()->user()->rule != 'admin')

      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Zone')}}</label>
        <select class="form-control" name="zone_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($zones as $zone)
              <option {{request('zone_id') == $zone->id ? 'selected' : ''}}
                      value="{{$zone->id}}"> {{$zone->zone_name}}</option>
               @endforeach
        </select>
      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Districts')}}</label>
        <select class="form-control" name="district_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($districts as $district)
              <option {{request('district_id') == $district->id ? 'selected' : ''}}
                      value="{{$district->id}}"> {{$district->name}}</option>
               @endforeach
        </select>
      </div>
      @elseif(auth()->user()->time_zone=='Asia/Dubai' && auth()->user()->rule != 'admin')
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Community')}}</label>
        <select class="form-control" name="community_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($communities as $community)
              <option {{request('community_id') == $community->id ? 'selected' : ''}}
                      value="{{$community->id}}"> {{$community->name_en}}</option>
               @endforeach
        </select>
      </div>
      
          <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site. Sub Community')}}</label>
        <select class="form-control" name="subcommunity_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($subcommunities as $subcommunity)
              <option {{request('subcommunity_id') == $subcommunity->id ? 'selected' : ''}}
                      value="{{$subcommunity->id}}"> {{$subcommunity->name_en}}</option>
               @endforeach
        </select>
      </div>
      @else
       <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Zone')}}</label>
        <select class="form-control" name="zone_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($zones as $zone)
              <option {{request('zone_id') == $zone->id ? 'selected' : ''}}
                      value="{{$zone->id}}"> {{$zone->zone_name}}</option>
               @endforeach
        </select>
      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Districts')}}</label>
        <select class="form-control" name="district_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($districts as $district)
              <option {{request('district') == $district->id ? 'selected' : ''}}
                      value="{{$district->id}}"> {{$district->name}}</option>
               @endforeach
        </select>
      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Community')}}</label>
        <select class="form-control" name="community_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($communities as $community)
              <option {{request('community_id') == $community->id ? 'selected' : ''}}
                      value="{{$community->id}}"> {{$community->name_en}}</option>
               @endforeach
        </select>
      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site. Sub Community')}}</label>
        <select class="form-control" name="subcommunity_id"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
                @foreach($subcommunities as $subcommunity)
              <option {{request('subcommunity_id') == $subcommunity->id ? 'selected' : ''}}
                      value="{{$subcommunity->id}}"> {{$subcommunity->name_en}}</option>
               @endforeach
        </select>
      </div>

      @endif
      <!-- end -->
    
   <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.status')}}</label>
      <select class="form-control" name="status">
        <option value="">{{__('site.choose')}}</option>
        @foreach($status as $statu)
         <option
         {{Request('status') == $statu->id ? 'selected' : ''}}
         value="{{$statu->id}}">{{$statu->name}}</option>
         @endforeach
      </select>
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
    
    <!--end::Group-->

  </div> <!-- end row -->
<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
</form>

</div>
</div>
</div>
