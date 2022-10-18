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

    @if($showCreatedBy)
    <div class="form-group col-md-3 col-sm-12">
      <label for="country">{{__('site.user')}}</label>
      <select class="form-control" name="user_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($createdBy as $user)
            <option
            {{ Request('user_id') == $user->id ? 'selected':  '' }}
            value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>
    </div>
    @endif
    <div class="form-group col-md-3 col-sm-12">
      <label for="country">{{__('site.request_type')}}</label>
      <select class="form-control"  name="request_type" id="request_type">
        <option value="">{{ __('site.choose') }}</option>
				<option {{Request('request_type') == 'added' ? 'selected' : ''}} value="added">{{__('site.added')}}</option>
				<option {{Request('request_type') == 'updated' ? 'selected' : ''}} value="updated">{{__('site.updated')}}</option>
				<option {{Request('request_type') == 'deleted' ? 'selected' : ''}} value="deleted">{{__('site.deleted')}}</option>
			</select>
    </div>


    <div class="form-group col-md-3 col-sm--12">
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
    <div class="form-group col-md-3 col-sm--12">
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
  </div> <!-- end row -->
<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
</form>

</div>
</div>
</div>
