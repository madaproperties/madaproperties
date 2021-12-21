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
    @if(count($purpose)>1)
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.Purpose')}}</label>
      <select class="form-control" name="purpose">
        <option value="">{{__('site.choose')}}</option>
        @foreach($purpose as $purp)
          <option {{old('purpose') == $purp ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
        @endforeach
      </select>
    </div>
    @endif

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

  </div> <!-- end row -->
<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
</form>

</div>
</div>
</div>
