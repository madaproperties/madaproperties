@foreach($tasks as $task)
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
              <a href="#" class="d-flex align-items-center text-dark  font-size-h5 font-weight-bold mr-3">
                {{$task->name}}</a>
              <!--end::Name-->
              <!--begin::Contacts-->
              <div class="d-flex flex-wrap my-2">
                <a href="#" class="text-muted  font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                  <span class="flaticon2-new-email"></span>
                  <!--end::Svg Icon-->
                </span>{{$task->user ? $task->user->email : ''}}</a>
                <a href="#" class="text-muted  font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                  <span class="flaticon-calendar-with-a-clock-time-tools"></span>
                  <!--end::Svg Icon-->
                </span>
                    {{ timeZone($task->created_at) }}
                </a>
              </div>
              <!--end::Contacts-->
            </div>
            <!--begin::User-->
            <!--begin::Actions-->
            <div class="my-lg-0 my-1">
              <a href="#" data-toggle="modal" data-target="#edit-task-{{$task->id}}" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">{{__('site.Edit')}}</a>
            </div>
            <!--end::Actions-->
          </div>
          <!--end::Title-->
          <!--begin::Content-->
          <div class="d-flex align-items-center flex-wrap justify-content-between">
            <!--begin::Description-->
            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
              {!! $task->description !!}
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
      <!--begin::Bottom-->
      <div class="d-flex align-items-center flex-wrap">
        <!--begin: Item-->
        <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
          <span class="mr-4">
            <i class="flaticon-chat-1 icon-2x text-muted font-weight-bold"></i>
          </span>
          <div class="d-flex flex-column">
            <span class="text-dark-75 font-weight-bolder font-size-sm">{{$task->type}}</span>
          </div>
        </div>
        <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
          <span class="mr-4">
            <i class="flaticon-event-calendar-symbol icon-2x text-muted font-weight-bold"></i>
          </span>
          <div class="d-flex flex-column">
            <span class="text-dark-75 font-weight-bolder font-size-sm">{{$task->date}}</span>
          </div>
        </div>
        <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
          <span class="mr-4">
            <i class="flaticon-calendar-with-a-clock-time-tools icon-2x text-muted font-weight-bold"></i>
          </span>
          <div class="d-flex flex-column">
            <span class="text-dark-75 font-weight-bolder font-size-sm">{{$task->time}}</span>
          </div>
        </div>
        <!--end: Item-->

      </div>
      <!--end::Bottom-->
    </div>
  </div>
  @include('admin.business-development.components.edit-task')
@endforeach
