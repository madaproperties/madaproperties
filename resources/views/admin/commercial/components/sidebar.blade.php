
<style>
  .btnSuccc .btn.btn-success{
    background:#9fc538 !important;
  }
</style>
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
                <a href="{{ route('admin.commercial-leads.show',$commercial->id) }}" class="navi-link">
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
    <div class="mt-2 btnSuccc">
      <a href="#" class="btn btn-sm btn-success  py-2"  data-toggle="modal" data-target="#add-requirement">{{__('site.requirements')}}</a>
      <a href="#" class="btn btn-sm btn-success  py-2"  data-toggle="modal" data-target="#add-task">{{__('site.Task')}}</a>
      <a href="#" class="btn btn-sm btn-success  py-2"  data-toggle="modal" data-target="#add-note">{{__('site.Note')}}</a>
      <a href="#" class="btn btn-sm btn-success  py-2"  data-toggle="modal" data-target="#add-new-meeting">{{__('site.meeting')}}</a>

        <a href="#" class="btn btn-sm btn-success  py-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{__('site.Logs')}}
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <!--begin::Navigation-->
          <ul class="navi navi-hover ">

            <li class="navi-separator mb-3 opacity-70"></li>
            <li class="navi-item">
              <a href="#" data-toggle="modal" data-target="#add-log-call" class="navi-link">
                  <span class="label text-center label-xl label-inline label-light-success">{{__('site.call')}}</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" data-toggle="modal" data-target="#add-log-email" class="navi-link">
                <span class="label text-center label-xl label-inline label-light-success">{{__('site.email')}}</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link" data-toggle="modal" data-target="#add-log-meeting">
                  <span class="label text-center label-xl label-inline label-light-success">{{__('site.meeting')}}</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link" data-toggle="modal" data-target="#add-log-whatsapp">
                  <span class="label text-center label-xl label-inline label-light-success">{{__('site.whatsapp')}}</span>
              </a>
            </li>

          </ul>
          <!--end::Navigation-->
        </div>

    </div>
  </div>
</div>

<div class="py-9">
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.country')}}:</span>
    <span class="text-muted">{{$commercial->country ? $commercial->country : 'N/A'}}</span>
  </div>
  <hr />
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.brand_name')}}:</span>
    <span class="text-muted">{{$commercial->brand_name ? $commercial->brand_name : 'N/A'}}</span>
  </div>
  <hr />
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.activity_name')}}:</span>
    <span class="text-muted">{{$commercial->activity_name ? $commercial->activity_name : 'N/A'}}</span>
  </div>
  <hr />
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.activity_type')}}:</span>
    <span class="text-muted">{{$commercial->activity_type ? $commercial->activity_type : 'N/A'}}</span>
  </div>
  <hr />
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.location')}}:</span>
    <span class="text-muted">{{$commercial->location ? $commercial->location : 'N/A'}}</span>
  </div>
  <hr />
  @php
    $i=1;
  @endphp
  @if($commercial->contact_persons)
    @foreach($commercial->contact_persons as $contact_person) 
    <h4>Contact Person {{$i++}}</h4>
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="font-weight-bold mr-2">{{ __('site.name')}}:</span>
      <span class="text-muted">{{$contact_person->name ? $contact_person->name : 'N/A'}}</span>
    </div>
    <hr />
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="font-weight-bold mr-2">{{ __('site.designation')}}:</span>
      <span class="text-muted">{{$contact_person->designation ? $contact_person->designation : 'N/A'}}</span>
    </div>
    <hr />
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="font-weight-bold mr-2">{{ __('site.email')}}:</span>
      <span class="text-muted">{{$contact_person->email ? $contact_person->email : 'N/A'}}</span>
    </div>
    <hr />
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="font-weight-bold mr-2">{{ __('site.phone')}}:</span>
      <span class="text-muted">{{$contact_person->phone ? $contact_person->phone : 'N/A'}}</span>
    </div>
    <hr /> 
    @endforeach
  @endif
</div>
<!--end::sidebar-->

</div>
<!--end::Body-->
</div>
<!--end::Profile Card-->
</div>
<!--end::Aside-->
