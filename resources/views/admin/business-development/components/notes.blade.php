@foreach($notes as $note)
<div class="card card-custom gutter-b">
  <div class="card-body">
    <!--begin::Top-->
    <div class="d-flex">
      <!--begin: Info-->
      <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="">
        <div class="dropdown dropdown-inline">
          <span class="btn btn-clean  btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ki ki-bold-more-hor"></i>
          </span>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <!--begin::Navigation-->
            <ul class="navi navi-hover py-5">

              <li class="navi-item">
                <span data-toggle="modal" data-target="#edit-note-{{$note->id}}" class="navi-link">
                  <span class="navi-icon">
                    <i class="flaticon2-edit"></i>
                  </span>
                  <span class="navi-text">{{__('site.Edit11')}}</span>
                </span>
              </li>

            </ul>
            <!--end::Navigation-->
          </div>
        </div>
      </div>
        <div class="t-ar-right">
          <!--begin::User-->

          <div class="">
              {!! $note->description !!}
            <!--begin::Contacts-->

            <div class="d-flex flex-wrap my-2">
              <span  class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
              <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                <span class="flaticon2-new-email"></span>
                <!--end::Svg Icon-->
              </span>{{$note->user ? $note->user->email : ''}}</span>
              <span class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
              <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                <span class="flaticon-calendar-with-a-clock-time-tools"></span>
                <!--end::Svg Icon-->
              </span>
              {{ timeZone($note->created_at) }}
              </span>
            </div>
            <!--end::Contacts-->
          </div>
          <!--begin::User-->
        </div>
        <!--end::Title-->

      </div>
      <!--end::Info-->
    </div>
    <!--end::Top-->

  </div>
</div>
  @include('admin.business-development.components.edit-note')
@endforeach
