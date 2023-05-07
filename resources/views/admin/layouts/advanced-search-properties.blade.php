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
            <a href="{{route('admin.property.index').'?'.http_build_query(['pt'=>request()->get('pt')]) }}">
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
  <input type="hidden" name="pt" value="{{request()->get('pt')}}">

  <div class="row"> <!--- row -->
    @if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'leader' || userRole()=='sales')
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.status')}}</label>
      <select class="form-control" name="status">
        <option value="">{{__('site.choose')}}</option>
        {!! selectOptions(__('config.status'),Request('status')) !!}
      </select>
    </div>
    @endif
    @if(count($sellers))
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.agent')}}</label>
      <select class="form-control" name="user_id">
        <option value="">{{__('site.choose')}}</option>
        @foreach($sellers as $seller)
        <option {{ Request('user_id') == $seller->id ? 'selected':  '' }} value="{{$seller->id}}">{{$seller->name}}</option>
        @endforeach
      </select>
    </div>
    @endif

    <!--begin::Group-->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.category')}}</label>
      <select class="form-control"  name="category_id">
        <option value="" >{{ __('site.choose') }}</option>
        @foreach($categories as $category)
        <option {{ Request('category_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
        @endforeach
      </select>                                       
    </div>
    <!--end::Group-->
    <!--begin::Group-->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.property_type')}}</label>
      <select class="form-control" name="property_type">
        <option value="">{{__('site.choose')}}</option>
        <option value="1">{{__('site.residential')}}</option>
        <option value="2">{{__('site.commercial')}}</option>
      </select>                                         
    </div>
    <!--end::Group-->
    <!--begin::Group-->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.type')}}</label>
      <select class="form-control" name="sale_rent">
        <option value="">{{__('site.choose')}}</option>
        {!! selectOptions(__('config.sale_rent'),Request('sale_rent')) !!}
      </select>                                         
    </div>
    <!--end::Group-->    
    <!--begin::Group-->
    <div class="form-group col-md-4 col-sm-12">
      <label for="country">{{__('site.portals')}}</label>
      <select class="form-control" name="portals">
        <option value="">{{__('site.choose')}}</option>
        {!! selectOptions(__('config.portals'),Request('portals')) !!}
      </select>                                         
    </div>
    <!--end::Group-->
    <!--begin::Group-->
    <!--<div class="form-group col-md-4 col-sm-12">-->
    <!--  <label for="country">{{__('site.category')}}</label>-->
    <!--  <select class="form-control"  name="category_id">-->
    <!--    <option value="">{{ __('site.choose') }}</option>-->
    <!--    @foreach($categories as $category)-->
    <!--    <option {{ Request('category_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>-->
    <!--    @endforeach-->
    <!--  </select>-->
    <!--</div>-->
    <!--end::Group-->


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
    <div class="form-group col-md-4 col-sm--12">
      <div class="form-group ">
          <label class="">{{__('site.updated')}} {{ __('site.from') }} </label>
          <div class="">
            <div class="input-group input-group-solid date"
            id="updated_from" data-target-input="nearest">
              <input value="{{request('updated_from')}}" type="text"
              max="{{date('d-m-Y')}}"
              class="form-control form-control-solid datetimepicker-input datepicker"
              data-toggle="datetimepicker"
              name="updated_from" data-target="#updated_from" autocomplete="off">
              <div class="input-group-append" data-target="#updated_from" data-toggle="datetimepicker">
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
          <label class="">{{__('site.updated')}} {{ __('site.to') }}</label>
          <div class="">
            <div class="input-group input-group-solid date to-date-el"  data-target-input="nearest">
              <input value="{{request('updated_to')}}" type="text" id="updated_to" class="form-control form-control-solid datetimepicker-input datepicker"
              data-toggle="datetimepicker"
              min="{{date('d-m-Y')}}"
              name="updated_to" data-target="#updated_to" autocomplete="off">
              <div class="input-group-append" data-target="#updated_to" data-toggle="datetimepicker">
                <span class="input-group-text">
                  <i class="ki ki-calendar"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>

    @if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales director' || userRole() == 'sales admin saudi')
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
    <!-- added by fazal  -->
    @if(isset($communities) && count($communities)>0)
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Community')}}</label>
        <select class="form-control" name="community"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
            @foreach($communities as $community)
              <option {{request('community') == $community->id ? 'selected' : ''}}
                      value="{{$community->id}}">{{$community->name_en}}</option>
            @endforeach
        </select>
      </div>
      @endif
    <!--end  -->
     <!-- added by fazal -->
     <div class="form-group col-md-4 col-sm-12">
      <div class="form-group ">
          <label class="">{{__('site.min price')}}</label>
          <div class="">
            <div class="input-group input-group-solid">
              <input value="{{request('min_price')}}" type="text" class="form-control form-control-solid"
              name="min_price" autocomplete="off">
            </div>
          </div>
        </div>
    </div>
     <!-- end  -->
       <!-- added by fazal -->
     <div class="form-group col-md-4 col-sm-12">
      <div class="form-group ">
          <label class="">{{__('site.max price')}}</label>
          <div class="">
            <div class="input-group input-group-solid">
              <input value="{{request('max_price')}}" type="text" class="form-control form-control-solid"
              name="max_price" autocomplete="off">
            </div>
          </div>
        </div>
    </div>
     <!-- end  -->
      <div class="form-group col-md-4 col-sm-12">
        <label for="country">{{__('site.Bedroom')}}</label>
        <select class="form-control" name="bedrooms"  data-select2-id="" tabindex="-1" aria-hidden="true">
          <option value="">{{ __('site.choose') }}</option>
          
            @for($i=0;$i<=10;$i++)
            @if($i==0)
            <option value="0">Studio</option>
            @else
            <option value="{{$i}}">{{$i}}</option>
            @endif
             @endfor
        </select>
      </div>
    
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

  $('#to').datepicker({
    //format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });
</script>
@endpush