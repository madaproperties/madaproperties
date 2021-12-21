<!-- Add Task Modal-->
<div class="modal fade {{ isset($showClass) ? 'show' : ''}}" id="edit-task-{{$task->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.edit task')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">
                  <!--begin::Form-->
                  <form id="edit-task-form-{{$task->id}}" action="{{route('admin.tasks.update',$task->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div>
                        <label>{{__('site.name')}}</label>
                        <input type="text" name="name" class="form-control" value="{{$task->name}}" >
                      </div>
                      <hr />
                      <input type="hidden" value="{{$task->contact_id}}" name="contact_id">
                      <div class="row">
                        <div class="col-md-6 col-sm--12">
                          <div class="form-group ">
                            <label class="">{{__('site.Date')}} </label>
                            <div class="">
                              <div class="input-group input-group-solid date" id="edit-datetimepicker-task-{{$task->id}}" data-target-input="nearest">
                                <input value="{{$task->date}}" required type="text" class="form-control form-control-solid datetimepicker-input"
                                data-toggle="datetimepicker"
                                name="date" data-target="#edit-datetimepicker-task-{{$task->id}}">
                                <div class="input-group-append" data-target="#edit-datetimepicker-task-{{$task->id}}" data-toggle="datetimepicker">
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
                            <label class="">{{__('site.Time')}}</label>
                            <div class="">
                              <div class="input-group input-group-solid date" id="edit-task-datetimepicker-{{$task->id}}" data-target-input="nearest">
                                <input required value="{{$task->time}}" type="text" class="form-control form-control-solid datetimepicker-input"
                                data-toggle="datetimepicker"
                                name="time" data-target="#edit-task-datetimepicker-{{$task->id}}">
                                <div class="input-group-append" data-target="#edit-task-datetimepicker-{{$task->id}}" data-toggle="datetimepicker">
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
                        <textarea name="description" id="task-description-edit-{{$task->id}}">{{$task->description}}</textarea>
                      </div>

                      <div class="form-group">
                        <label for="task-type">{{__('site.type')}}</label>
                        <select name="type" class="form-control" required>
                          <option value="">{{__('site.select option')}}</option>
                          <option
                          {{$task->type == 'email' ? 'selected' : '' }}
                          value="email">{{__('site.email')}}</option>
                          <option
                          {{$task->type == 'call' ? 'selected' : '' }}
                          value="call">{{__('site.call')}}</option>
                          <option
                          {{$task->type == 'whatsapp' ? 'selected' : '' }}
                          value="whatsapp">{{__('site.whatsapp')}}</option>
                        </select>
                      </div>

                      @if(!isset($contact))
                      <div class="form-group">
                        <label for="task-type">{{__('site.contact')}}</label>
                        <div>
                          @php
                            $showRoute = $task->contact ? route('admin.contact.show',$task->contact->id) : '#';
                          @endphp
                          <a href="{{ $showRoute }}">
                            {{$task->contact ? $task->contact->fullname : ''}}
                          </a>
                        </div>
                      </div>
                      <hr />
                      <div class="form-group">
                        <label for="task-type">{{__('site.account')}}</label>
                        <div>
                          <p>
                            {{$task->user ? $task->user->email : ''}}
                          </p>
                        </div>
                      </div>
                      @endif

                    </div>
                    <div class="card-footer">
                      <button type="submit" form="edit-task-form-{{$task->id}}" class="btn btn-primary mr-2">{{__('site.save')}}</button>
                      <button type="reset" form="edit-task-form-{{$task->id}}" data-dismiss="modal" class="btn btn-secondary">{{__('site.cancel')}}</button>
                    </div>
                  </form>
                  <!--end::Form-->

                </div>
            </div>
        </div>
    </div>
</div>
<!--- Eit Information Model -->
@push('js')
<script>
  var taskID = {{$task->id}};
  var id = `#edit-datetimepicker-task-`+taskID;
  $(id).datetimepicker({
      format: 'L',
  });
  var timeId = '#edit-task-datetimepicker-'+taskID;
  $(timeId).datetimepicker({
      format: 'LT'
  });
</script>
@endpush
@push('js')
<script defer>
var id = `#task-description-edit-`+{{$task->id}};
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
