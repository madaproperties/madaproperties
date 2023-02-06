@foreach($activities as $activity)
<style>
  .textChnge{
    color:#aaca4f !important;
  }
</style>
<div class="card card-custom gutter-b">
  <div class="card-body">
    <!--begin::Top-->
    <div class="d-flex">
      <!--begin: Info-->
      <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
          <!--begin::User-->
          <div class="mr-3">
            <!--begin::Name-->
            @php
              $tabID = ucfirst($activity->related_model) .'-tab';
            @endphp
            <a
            data-toggle="tab" href="#" onclick="document.getElementById('{{$tabID}}').click()"
             class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3 textChnge">
              {{$activity->action}}</a>
            <!--end::Name-->
            <!--begin::Contacts-->
            <div class="d-flex flex-wrap my-2">
              <span  class="text-muted  font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
              <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                <span class="flaticon2-new-email"></span>
                <!--end::Svg Icon-->
              </span>{{$activity->user ? $activity->user->email : ''}}</span>
              <span class="text-muted  font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
              <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                <span class="flaticon-calendar-with-a-clock-time-tools"></span>
                <!--end::Svg Icon-->

              </span>
              {{ timeZone($activity->created_at) }}
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
@endforeach
