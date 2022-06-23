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
      <label for="country">{{__('site.property_type')}}</label>
        <select class="form-control"  name="property_type">
        <option value="">{{ __('site.choose') }}</option>
        @foreach($purposetype as $purpType)
        <option {{Request('property_type') == $purpType->name ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.bedroom')}}</label>
      <select class="form-control"  name="bedroom">
        <option value="">{{__('site.choose')}}</option>
        <option {{old('bedroom') == '1' ? 'selected' : ''}} value="1">1</option>
        <option {{old('bedroom') == '2' ? 'selected' : ''}} value="2">2</option>
        <option {{old('bedroom') == '3' ? 'selected' : ''}} value="3">3</option>
        <option {{old('bedroom') == '4' ? 'selected' : ''}} value="4">4</option>
        <option {{old('bedroom') == '5' ? 'selected' : ''}} value="5">5</option>
        <option {{old('bedroom') == '6' ? 'selected' : ''}} value="6">6</option>
      </select>
    </div>
    
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.developer')}}</label>
      <select class="form-control" name="developer_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($developer as $dev)
         <option
         {{Request('developer_id') == $dev->id ? 'selected' : ''}}
         value="{{$dev->id}}">{{$dev->name}}</option>
         @endforeach
      </select>
    </div>
    
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.payment_status')}}</label>
      <select class="form-control"  name="payment_status">
        <option {{old('payment_status') == '' ? 'selected' : ''}} value="">{{ __('site.choose') }}</option>
        <option {{old('payment_status') == 'cash-bank' ? 'selected' : ''}} value="cash-bank">{{__('site.cash-bank')}}</option>
        <option {{old('payment_status') == 'cash-bank-sarkani' ? 'selected' : ''}} value="cash-bank-sarkani">{{__('site.cash-bank-sarkani')}}</option>
      </select>
    </div>

  </div> <!-- end row -->
<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
</form>

</div>
</div>
</div>
