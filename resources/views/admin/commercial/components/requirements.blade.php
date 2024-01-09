@php($i=count($requirements))
@foreach($requirements as $requirement)
<div class="card card-custom gutter-b">
    <div class="card-body">
      <!--begin::Top-->
      <div class="d-flex">
        <!--begin: Info-->
        <div class="flex-grow-1">
          <!--begin::Title-->
          <span class="d-flex align-items-center font-size-h4">
                {{__('site.requirement')}} {{ $i--}}</span>
          <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
            <!--begin::User-->
            <div class="mr-3">
              <!--begin::Name-->
              <a href="#" class="d-flex align-items-center text-dark  font-size-h5 font-weight-bold mr-3">
              {{__('site.status')}} : {{$requirement->status}}</a>
              <!--end::Name-->
              <!--begin::Contacts-->
              <div class="d-flex flex-wrap my-2">
                <a href="#" class="text-muted  font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                  <span class="flaticon-calendar-with-a-clock-time-tools"></span>
                  <!--end::Svg Icon-->
                </span>
                    {{ timeZone($requirement->created_at) }}
                </a>
              </div>
              <!--end::Contacts-->
            </div>
            <!--begin::User-->
            
            <!--begin::Actions-->
            <div class="my-lg-0 my-1">
              <a href="#" data-toggle="modal" data-target="#edit-requirement-{{$requirement->id}}" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{__('site.Edit')}}</a>
            </div>
            <!--end::Actions-->
          </div>
          <!--end::Title-->
          <!--begin::Content-->
          <div class="row font-weight-bold text-dark-50">
            <!--begin::Description-->
            <div class="col-sm-4">
            {{__('site.contact_person_name')}} : {!! $requirement->contact_person?$requirement->contact_person->name : 'N/A'  !!}
            </div>
            <div class="col-sm-4">
            {{__('site.city')}} : {!! $requirement->city?$requirement->city->name_en : 'N/A'  !!}
            </div>
            <!--begin::Description-->
            <div class="col-sm-4">
            {{__('site.zone')}} : {!! $requirement->zone?$requirement->zone->zone_name : 'N/A' !!}
            </div>
            <!--begin::Description-->
          </div>
           
            <!--end::Description-->
          <div class="row font-weight-bold text-dark-50">
            <div class="col-sm-4">
              {{__('site.district')}} : {!! $requirement->district?$requirement->district->name : 'N/A' !!}
            </div>
            <!--end::Description-->
            <!--begin::Description-->
            <div class="col-sm-4">
            {{__('site.street info')}} : {!! $requirement->street_info !!}
            </div>
            <!--end::Description-->
            <!--begin::Description-->
            <div class="col-sm-4">
            {{__('site.expanding_date')}} : {!! $requirement->expanding_date !!}
            </div>
            <!--end::Description-->
          </div>

          <div class="row font-weight-bold text-dark-50">
            <!--begin::Description-->
            <div class="col-sm-4">
            {{__('site.expanding year')}} : {!! $requirement->expanding_year !!}
            </div>
            <!--end::Description-->
            <!--begin::Description-->
            <div class="col-sm-4">
            {{__('site.target_size')}} : {!! $requirement->target_size_from .'-'.$requirement->target_size_to !!}
            </div>
            <!--end::Description-->
            <!--begin::Description-->
            <div class="col-sm-4">
            {{__('site.description')}} : {!! $requirement->description?$requirement->description : 'N/A' !!}
            </div>
            <!--end::Description-->
          </div>

          <!--end::Content-->
        </div>
        <!--end::Info-->
      </div>
      <!--end::Top-->
      <!--begin::Separator-->
      <div class="separator separator-solid my-7"></div>
      <!--end::Separator-->
    </div>
  </div>
  @include('admin.commercial.components.edit-requirement')
@endforeach
@push('js')

<script>
	var getDistricts = "{{route('admin.requirements.getDistricts')}}";
  function getDistrict(zone_id,requirement_id){	
		var csrf_token = $('meta[name=csrf-token]').attr('content');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					},                    
			url: getDistricts+'?zone_id='+zone_id,
			type: 'GET',
			data:{zone_id:zone_id},
			success: function (data) {
				$("#loadingHolder").hide();
				$('#district_id_edit_'+requirement_id).html(data);
			},
			cache: false,
			contentType: false,
			processData: false
		});
	}

</script>
<script>
	var getDistricts = "{{route('admin.requirements.getDistricts')}}";
  $("#zone_id").change(function(e) {
		e.preventDefault();    
		var zone_id = $(this).val();
		var csrf_token = $('meta[name=csrf-token]').attr('content');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					},                    
			url: getDistricts+'?zone_id='+zone_id,
			type: 'GET',
			data:{zone_id:zone_id},
			success: function (data) {
				$("#loadingHolder").hide();
				$('#district_id_add').html(data);
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});

</script>
@endpush
