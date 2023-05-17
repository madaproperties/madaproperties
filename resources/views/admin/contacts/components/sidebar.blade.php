
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
                <a href="#" data-toggle="modal" data-target="#edit-contact" class="navi-link">
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
    <p class="font-weight-bolder font-size-h5 text-dark-75 ">{{$contact->fullname}}</p>
    <div class="text-muted">{{$contact->project ? $contact->project->name : ''}}</div>
    <div class="mt-2 btnSuccc">
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
    @if($contact->fullname)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.fullname')}}:</span>
    {{$contact->fullname}}
  </div>
  <hr />
  @endif
  
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.email')}}:</span>
    <a href="mailto:{{ $contact->email }}" class="text-muted text-hover-primary">
        {{ $contact->email }}    
    </a>
  </div>
  <hr />
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.Phone')}}:</span>
    <span class="text-muted">
        	{{$contact->country ? $contact->country->code : ''}}{{ str_starts_with($contact->phone,0) ? 
					substr($contact->phone,1) 
					: $contact->phone }}
    </span>
  </div>
  <hr />
  @if($contact->scound_phone)
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="font-weight-bold mr-2">{{__('site.scound Phone')}}:</span>
      <span class="text-muted">{{$contact->scound_phone}}</span>
    </div>
    <hr />
  @endif
  
  @if($contact->project)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.project')}}:</span>
    <span class="text-muted">{{$contact->project ? $contact->project->name : ''}}</span>
  </div>
  <hr />
  @endif
   
  @if($contact->unitCountry)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.unit country')}}:</span>
    
    <span class="text-muted">
        @php
            if($contact->project):
                $c = App\Country::where('id',$contact->project->country_id)->first();
                
                if($c):
                    echo $c->name;
                endif;
            endif;
        @endphp
            
        </span>
  </div>
  <hr />
  @endif
  
  @if($contact->unitCity)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.unit city')}}:</span>
    <span class="text-muted">{{$contact->unitCity ? $contact->unitCity->name : ''}}</span>
  </div>
  <hr />
  @endif
  @if($contact->unit_zone)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.Unit Zode')}}:</span>
    <span class="text-muted">{{$contact->unit_zone}}</span>
  </div>
  <hr />
  @endif
  @if(auth()->id() == $contact->user_id)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.contact owner')}}:</span>
    <span class="text-muted">You</span>
  </div>
  @else
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.contact owner')}}:</span>
    <span class="text-muted">
        
        {{ $contact->user ? explode('@',$contact->user->name)[0] : '' }}
     </span>
  </div>
  @endif
  <hr />
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.language')}}:</span>
    <span class="text-muted">{{$contact->lang}}</span>
  </div>
  <hr />
  @if($contact->country)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.country')}}:</span>
    <span class="text-muted">{{$contact->country ? $contact->country->name : ''}}</span>
  </div>
  <hr />
  @endif
  
  @if($contact->city_id)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.city')}}:</span>
    <span class="text-muted">{{$contact->city ? $contact->city->name : ''}}</span>
  </div>
  <hr />
  @endif
  @if($contact->status)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.status')}}:</span>
    <span class="text-muted">{{$contact->status?$contact->status->name : ''}}</span>
  </div>
  <hr />
  @endif
  
  @if($contact->budget)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{__('site.budget')}}:</span>
    <span class="text-muted">{{$contact->budget}}</span>
  </div>
  <hr />
  @endif
  
  @if($contact->currency)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.currency')}}:</span>
    <span class="text-muted">{{$contact->Currency?$contact->Currency->CurrencyName:''}}</span>
  </div>
  <hr />
  @endif

@if($contact->campaign)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.campaign')}}:</span>
    <span class="text-muted">{{$contact->campaign}}</span>
  </div>
  <hr />
 @endif
 
 @if($contact->source)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.source')}}:</span>
    <span class="text-muted">{{$contact->source}}</span>
  </div>
  <hr />
  @endif
  
  @if($contact->medium)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.medium')}}:</span>
    <span class="text-muted">{{$contact->medium}}</span>
  </div>
  <hr />
  @endif
  
  @if($contact->content)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.content')}}:</span>
    <span class="text-muted">{{$contact->content}}</span>
  </div>
  <hr />
  @endif
  
  
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.last contacted')}}:</span>
    <span class="text-muted">{{!empty($LastConnected) ? $LastConnected->date : __('site.not contaccted')}}</span>
  </div>
  <hr />
  

  @if($contact->lead_type)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.lead type')}}:</span>
    <span class="text-muted">{{ $contact->lead_type }}</span>
  </div>
  <hr />
  @endif
  
  @if($contact->last_mile_conversion)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.last mile conversion')}}:</span>
    <span class="text-muted">{{ $contact->mileCoversion ? $contact->mileCoversion->name : '' }}</span>
  </div>
  <hr />
  @endif
  @if($contact->purpose)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.Purpose')}}:</span>
    <span class="text-muted">{{ $contact->purpose }}</span>
  </div>
  <hr />
  @endif
  @if($contact->purpose_type)
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.purpose type')}}:</span>
    <span class="text-muted">{{ $contact->purpose_type }}</span>
  </div>
  <hr />
  @endif
  <!--
  @if(isset($contact->investmentcountry_id))
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ __('site.Investment Country')}}:</span>
    <span class="text-muted">{{ $contact->investmentcountry_id }}</span>
  </div>
  <hr />
  @endif-->
  @if(isset($contact->campaign_country) && !empty($contact->campaign_country))
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="font-weight-bold mr-2">{{ 'campaign country'}}:</span>
    <span class="text-muted">{{App\Country::where('id',$contact->campaign_country)->first()->name_en}}</span>
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
