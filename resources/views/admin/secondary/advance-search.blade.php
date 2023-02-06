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
  <h3 class="text-center">Advanced Search</h2> <hr />
  <input type="hidden" name="ADVANCED" value="search">

  <div class="row"> <!--- row -->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.agent')}}</label>
      <select class="form-control" name="agent_id">
        <option value="">Choose</option>
        @foreach($agents as $agent)
        <option value="{{$agent->id}}">{{$agent->email}}</option>
        @endforeach
            <option>
            </option>
        
      </select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.property_type')}}</label>
        <select class="form-control"  name="property_type">
        <option value="">{{ __('site.choose') }}</option>
        @foreach($purposetypes as $purpType)
        <option {{Request('property_type') == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.Zone')}}</label>
        <select class="form-control"  name="zone_id">
        <option value="">Choose</option>
        @foreach($zones as $zone)
        <option {{Request('zone') == $zone->zone_name ? 'selected' : ''}} value="{{$zone->id}}">{{$zone->zone_name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.District')}}</label>
        <select class="form-control"  name="district_id">
        <option value="">Choose</option>
        @foreach($districts as $district)
        <option {{Request('district') == $district->name ? 'selected' : ''}} value="{{$district->id}}">{{$district->name}}</option>
        @endforeach
      </select>
    </div>
   

  </div> <!-- end row -->
<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
</form>

</div>
</div>
</div>
