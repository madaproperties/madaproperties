

<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
  <!--begin::Profile Card-->
  
  @if(session('start_filter_url'))
	<a href="{{ session()->get('start_filter_url') }}" class="btn btn-success" style="padding:0.75rem 1.5rem">
	  <i class="fas fa-angle-left"></i> {{__('site.back') }}
	</a>
	@endif
  <div class="card card-custom card-stretch" style="height:auto;margin-top:1.25rem !important">
      

	
    <!--begin::Body-->
    <div class="card-body pt-4" style="">
        	
	
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-end">
        <div class="dropdown dropdown-inline">
          <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ki ki-bold-more-hor"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <!--begin::Navigation-->
            <ul class="navi navi-hover ">

              <li class="navi-item">
                <a href="#" data-toggle="modal" data-target="#edit-database" class="navi-link">
                  <span class="navi-icon">
                    <i class="flaticon2-edit"></i>
                  </span>
                  <span class="navi-text">{{__('site.Edit')}}</span>
                </a>
              </li>

            </ul>
            <!--end::Navigation-->
          </div>
        </div>
      </div>
      <!--end::Toolbar-->
      
      <!--begin::sidebar-->
<div class="d-flex align-items-center">
    
  <div>
    <div class="mt-2">
      <a href="#" class="btn btn-sm btn-success  py-2"  data-toggle="modal" data-target="#add-database-note">{{__('site.Note')}}</a>
    </div>
  </div>
</div>

<div class="py-9">
  @if($data->country)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.country')}}:</span>
    {{$data->country->name}}
  </div>
  <hr />
  @endif
  @if($data->project_id)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.project_name')}}:</span>
    {{$data->project_id}}
  </div>
  <hr />
  @endif
  @if($data->name)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.name')}}:</span>
    {{$data->name}}
  </div>
  <hr />
  @endif
  
  
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.email')}}:</span>
    <a href="mailto:{{ $data->email }}" class="text-muted text-hover-primary">
        {{ $data->email }}    
    </a>
  </div>
  <hr />
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.Phone')}}:</span>
    <span class="text-muted">
        	{{$data->country ? $data->country->code : ''}}{{ str_starts_with($data->phone,0) ? 
					substr($data->phone,1) 
					: $data->phone }}
    </span>
  </div>
  <hr />
  @if($data->bedroom)
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="font-weight-bold mr-2">{{__('site.bedroom')}}:</span>
      <span class="text-muted">{{$data->bedroom}}</span>
    </div>
    <hr />
  @endif
  
   
  @if($data->status)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.status')}}:</span>
    <span class="text-muted">{{$data->statusName ? $data->statusName->name_en : ''}}</span>
  </div>
  <hr />
  @endif
  
  @if($data->price)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.price')}}:</span>
    <span class="text-muted">{{$data->price}}</span>
  </div>
  <hr />
  @endif
</div>
<!--end::sidebar-->

</div>
<!--end::Body-->
</div>
<!--end::Profile Card-->
</div>
<!--end::Aside-->
