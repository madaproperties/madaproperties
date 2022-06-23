@push('js')
    @if(isset($showClass))
        <script>
             $('.modal').addClass('show');
        </script>
    @endif
@endpush

@if($log->type == 'email')
<!-- Add Log-email Modal-->
<div class="modal fade" id="edit-log-{{$log->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{{__('site.log email')}}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="edit-log-{{$log->id}}-form" action="{{route('admin.logs.update',$log->id)}}" method="POST">
              @csrf
              @method('PUT')
              <input type="hidden" value="email" name="type" />
             <div class="card-body">
              <input type="hidden" value="{{$log->contact_id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{ __('site.Date') }}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="edit-datetimepicker-log-{{$log->id}}" data-target-input="nearest">
                         <input value="{{$log->date }}" required type="text" class="form-control form-control-solid datepicker-input"
                         data-toggle="datetimepicker"
                          name="date" data-target="#edit-datetimepicker-log-{{$log->id}}">
                         <div class="input-group-append" data-target="#edit-datetimepicker-log-{{$log->id}}" data-toggle="datetimepicker">
                           <span class="input-group-text">
                             <i class="ki ki-calendar"></i>
                           </span>
                         </div>
                       </div>
                     </div>
                   </div>
                </div>
                <div class="col-md-6 col-sm--12">
                 <div class="form-group ">
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="edit-log-datetimepicker-{{$log->id}}" data-target-input="nearest">
                     <input required value="{{$log->time }}" type="text" class="form-control form-control-solid timepicker-input"
                     data-toggle="datetimepicker"
                      name="time" data-target="#edit-log-datetimepicker-{{$log->id}}">
                     <div class="input-group-append" data-target="#edit-log-datetimepicker-{{$log->id}}-time" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
                <label class="d-block">{{__('site.description')}}</label>
                <textarea name="description"  id="log-description-{{$log->id}}">{{$log->description }}</textarea>
              </div>
              
        <!--begin::Group-->
        @if(isset($contact))
         <div class="form-group ">
          <label class="">{{__('site.status')}}</label>
         
            <select class="form-control"  name="status_id" style="width:100%">
              @foreach($status as $statu)
              <option
              {{$log->contact->status_id == $statu->id ? 'selected' : ''}}
              value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
              @endforeach
            </select>
          
        </div>
        <!--end::Group-->
        <!--begin::Group-->
        <div class="form-group  fv-plugins-icon-container">
          <label class="">{{__('site.lead type')}}</label>
          <div class="">
            <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
            <option value="">choose</option>
             @foreach(lead_types() as $lead_type)
              <option
              {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
              value="{{$lead_type}}">{{$lead_type}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!--end::Group-->
         <!--begin::Group-->
        <div class="form-group  fv-plugins-icon-container">
          <label class="">{{__('site.lead type')}}</label>
          <div class="">
            <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
            <option value="">choose</option>
             @foreach(lead_types() as $lead_type)
              <option
              {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
              value="{{$lead_type}}">{{$lead_type}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!--end::Group-->
        @endif
        <!--end::Group-->
        
             </div>
             <div class="card-footer">
              <button type="submit" form="edit-log-{{$log->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="edit-log-{{$log->id}}-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit Log-email Model -->
@endif

@if($log->type == 'call')
<!-- Add Log-CALL Modal-->
<div class="modal fade" id="edit-log-{{$log->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.log call')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="edit-log-{{$log->id}}-form" action="{{route('admin.logs.update',$log->id)}}" method="POST">
              @csrf
              @method('PUT')
              <input type="hidden" value="call" name="type" />
             <div class="card-body">
              <input type="hidden" value="{{$log->contact_id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{ __('site.Date') }}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="edit-datetimepicker-log-{{$log->id}}" data-target-input="nearest">
                         <input value="{{$log->date }}" required type="text" class="form-control form-control-solid datepicker-input"
                         data-toggle="datetimepicker"
                          name="date" data-target="#edit-datetimepicker-log-{{$log->id}}">
                         <div class="input-group-append" data-target="#edit-datetimepicker-log-{{$log->id}}" data-toggle="datetimepicker">
                           <span class="input-group-text">
                             <i class="ki ki-calendar"></i>
                           </span>
                         </div>
                       </div>
                     </div>
                   </div>
                </div>
                <div class="col-md-6 col-sm--12">
                 <div class="form-group ">
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="edit-log-datetimepicker-{{$log->id}}" data-target-input="nearest">
                     <input required value="{{$log->time }}" type="text" class="form-control form-control-solid timepicker-input"
                     data-toggle="datetimepicker"
                      name="time" data-target="#edit-log-datetimepicker-{{$log->id}}">
                     <div class="input-group-append" data-target="#edit-log-datetimepicker-{{$log->id}}" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
               <label for="task-type">{{__('site.call outCome')}}</label>
               @php
                 $outcomes = ['busy','connected','no Answer','Wrong Number'];
               @endphp
               <select name="call_outcome" class="form-control" required>
                 <option value="">select Option</option>
                 @foreach($outcomes as $outcome)
                   <option
                   {{ strtolower($log->call_outcome) == strtolower($outcome) ? 'selected' : ''}}
                    value="{{$outcome}}">{{__('site.'.strtolower($outcome))}}</option>
                 @endforeach
               </select>
             </div>
              <div class="form-group">
                <label class="d-block">{{__('site.description')}}</label>
                <textarea name="description"  id="log-description-{{$log->id}}">{{$log->description }}</textarea>
              </div>
                
                    <!--begin::Group-->
        @if(isset($contact))
         <div class="form-group ">
          <label class="">{{__('site.status')}}</label>
         
            <select class="form-control"  name="status_id" style="width:100%">
              @foreach($status as $statu)
              <option
              {{$log->contact->status_id == $statu->id ? 'selected' : ''}}
              value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
              @endforeach
            </select>
          
        </div>
        <!--end::Group-->
        <!--begin::Group-->
        <div class="form-group  fv-plugins-icon-container">
          <label class="">{{__('site.lead type')}}</label>
          <div class="">
            <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
            <option value="">choose</option>
             @foreach(lead_types() as $lead_type)
              <option
              {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
              value="{{$lead_type}}">{{$lead_type}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!--end::Group-->
        @endif
        
             </div>
             <div class="card-footer">
              <button type="submit" form="edit-log-{{$log->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="edit-log-{{$log->id}}-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit Log-CALL Model -->
@endif


@if($log->type == 'meeting')
<!-- Add meeting Modal-->
<div class="modal fade {{ isset($showClass) ? 'show' : ''}}" id="edit-log-{{$log->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.log meeting')}} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="edit-log-{{$log->id}}-form" action="{{route('admin.logs.update',$log->id)}}" method="POST">
              @csrf
              @method('PUT')
              <input type="hidden" value="meeting" name="type" />
             <div class="card-body">
               <div>
                 <label>{{__('site.duration')}}</label>
                 <select name="duration" class="form-control" >
                   <option value="">select</option>
                   @foreach($durations as $duration)
                     <option
                     {{$log->duration == $duration ? 'selected' : ''}}
                      value="{{$duration}}">{{$duration}}</option>
                   @endforeach
                 </select>
               </div>
             <hr />
              <input type="hidden" value="{{$log->contact_id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{ __('site.Date') }}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="edit-datetimepicker-log-{{$log->id}}" data-target-input="nearest">
                         <input value="{{$log->date }}" required type="text" class="form-control form-control-solid datepicker-input"
                         data-toggle="datetimepicker"
                          name="date" data-target="#edit-datetimepicker-log-{{$log->id}}">
                         <div class="input-group-append" data-target="#edit-datetimepicker-log-{{$log->id}}" data-toggle="datetimepicker">
                           <span class="input-group-text">
                             <i class="ki ki-calendar"></i>
                           </span>
                         </div>
                       </div>
                     </div>
                   </div>
                </div>
                <div class="col-md-6 col-sm--12">
                 <div class="form-group ">
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="edit-log-datetimepicker-{{$log->id}}-time" data-target-input="nearest">
                     <input required value="{{$log->time }}" type="text" class="form-control form-control-solid timepicker-input"
                     data-toggle="datetimepicker"
                      name="time" data-target="#edit-log-datetimepicker-{{$log->id}}-time">
                     <div class="input-group-append" data-target="#edit-log-datetimepicker-{{$log->id}}-time" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
               <label for="task-type">{{__('site.meeting outcome')}}</label>
               @php
                 $outcomes = ['scheduled','completed','no show','canceled'];
               @endphp
               <select name="call_outcome" class="form-control" required>
                 <option value="">select Option</option>
                 @foreach($outcomes as $outcome)
                   <option
                   {{$log->call_outcome == $outcome ? 'selected' : ''}}
                    value="{{$outcome}}">{{__('site.'.$outcome)}}</option>
                 @endforeach
               </select>
             </div>
              <div class="form-group">
                <label class="d-block">Description</label>
                <textarea name="description"  id="log-description-{{$log->id}}">{{$log->description }}</textarea>
              </div>
              
                  <!--begin::Group-->
         @if(isset($contact))
         <div class="form-group ">
          <label class="">{{__('site.status')}}</label>
         
            <select class="form-control"  name="status_id" style="width:100%">
              @foreach($status as $statu)
              <option
              {{$log->contact->status_id == $statu->id ? 'selected' : ''}}
              value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
              @endforeach
            </select>
          
        </div>
        <!--end::Group-->
        <!--begin::Group-->
        <div class="form-group  fv-plugins-icon-container">
          <label class="">{{__('site.lead type')}}</label>
          <div class="">
            <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
            <option value="">choose</option>
             @foreach(lead_types() as $lead_type)
              <option
              {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
              value="{{$lead_type}}">{{$lead_type}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!--end::Group-->
        @endif
        <!--end::Group-->

              @if(!isset($contact))
              <hr />
              <div class="form-group">
                <label for="task-type">{{__('site.contact')}}</label>
                <div>
                  @php
                    $showRoute = $log->contact ? route('admin.contact.show',$log->contact->id) : '#';
                  @endphp
                  <a href="{{ $showRoute }}">
                    {{$log->contact ? $log->contact->fullname : ''}}
                  </a>
                </div>
              </div>
              <hr />
              <div class="form-group">
                <label for="task-type">{{__('site.account')}}</label>
                <div>
                  <p>
                    {{$log->user ? $log->user->email : ''}}
                  </p>
                </div>
              </div>
              @endif

             </div>
             <div class="card-footer">
              <button type="submit" form="edit-log-{{$log->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="edit-log-{{$log->id}}-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit meeting Model -->
@endif

@if($log->type == 'whatsapp')
<!-- Add Log-CALL Modal-->
<div class="modal fade " id="edit-log-{{$log->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.log whatsapp')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="edit-log-{{$log->id}}-form" action="{{route('admin.logs.update',$log->id)}}" method="POST">
              @csrf
              @method('PUT')
              <input type="hidden" value="whatsapp" name="type" />
             <div class="card-body">
              <input type="hidden" value="{{$log->contact_id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{ __('site.Date') }}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="edit-datetimepicker-log-{{$log->id}}" data-target-input="nearest">
                         <input value="{{$log->date }}" required type="text" class="form-control form-control-solid datepicker-input"
                         data-toggle="datetimepicker"
                          name="date" data-target="#edit-datetimepicker-log-{{$log->id}}">
                         <div class="input-group-append" data-target="#edit-datetimepicker-log-{{$log->id}}" data-toggle="datetimepicker">
                           <span class="input-group-text">
                             <i class="ki ki-calendar"></i>
                           </span>
                         </div>
                       </div>
                     </div>
                   </div>
                </div>
                <div class="col-md-6 col-sm--12">
                 <div class="form-group ">
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="edit-log-datetimepicker-{{$log->id}}" data-target-input="nearest">
                     <input required value="{{$log->time }}" type="text" class="form-control form-control-solid timepicker-input"
                     data-toggle="datetimepicker"
                      name="time" data-target="#edit-log-datetimepicker-{{$log->id}}">
                     <div class="input-group-append" data-target="#edit-log-datetimepicker-{{$log->id}}" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
                <label class="d-block">{{__('site.description')}}</label>
                <textarea name="description"  id="log-description-{{$log->id}}">{{$log->description }}</textarea>
             </div>
             
             
             
                 <!--begin::Group-->
        @if(isset($contact))
         <div class="form-group ">
          <label class="">{{__('site.status')}}</label>
         
            <select class="form-control"  name="status_id" style="width:100%">
              @foreach($status as $statu)
              <option
              {{$log->contact->status_id == $statu->id ? 'selected' : ''}}
              value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
              @endforeach
            </select>
          
        </div>
        <!--end::Group-->
        <!--begin::Group-->
        <div class="form-group  fv-plugins-icon-container">
          <label class="">{{__('site.lead type')}}</label>
          <div class="">
            <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
            <option value="">choose</option>
             @foreach(lead_types() as $lead_type)
              <option
              {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
              value="{{$lead_type}}">{{$lead_type}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!--end::Group-->
        @endif
        </div>
        <!--end::Group-->
        
             </div>
             <div class="card-footer">
              <button type="submit" form="edit-log-{{$log->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="edit-log-{{$log->id}}-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit Log-CALL Model -->
@endif

@push('js')
<script defer>
var id = `#log-description-`+{{$log->id}};
var KTCkeditor = function () {
    // Private functions
    var demos = function () {
        ClassicEditor
      .create( document.querySelector(id) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );
    }
    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();
KTCkeditor.init();
</script>
@endpush

