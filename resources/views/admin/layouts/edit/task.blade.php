<!-- Add Task Modal-->
<div class="modal fade" id="edit-task-{{$task->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('site.edit task')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
  <div class="card card-custom">
 <!--begin::Form-->
   <form id="{{$task->id}}-task-form" action="{{route('admin.tasks.update',$task->id)}}" method="POST">
     @csrf
     @method('PUT')
    <div class="card-body">


    <div>
      <label>{{__('site.name')}}</label>
      <input type="text" name="name" class="form-control" value="{{$task->name}}" >
    </div>
    <hr />
     <input type="hidden" value="{{$contact->id}}" name="contact_id">
     <div class="row">
       <div class="col-md-6 col-sm--12">
         <div class="form-group ">
    				<label class="">{{__('site.Date')}}</label>
    				<div class="">
    					<div class="input-group input-group-solid date" id="kt_datetimepicker_3" data-target-input="nearest">
    						<input required type="text" class="form-control form-control-solid datetimepicker-input"
                value="{{$task->date}}"
                name="date" data-target="#kt_datetimepicker_3">
    						<div class="input-group-append" data-target="#kt_datetimepicker_3" data-toggle="datetimepicker">
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
  				<div class="input-group input-group-solid date" id="kt_datetimepicker_4" data-target-input="nearest">
  					<input required type="text"
            value="{{$task->time}}"
            class="form-control form-control-solid datetimepicker-input" name="time" data-target="#kt_datetimepicker_4">
  					<div class="input-group-append" data-target="#kt_datetimepicker_4" data-toggle="datetimepicker">
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
       <label>{{__('site.description')}}</label>
       <textarea name="description" id="task-description">{{ $task->description }}</textarea>
     </div>

     <div class="form-group">
			<label for="task-type">{{__('site.type')}}</label>
			<select name="type" class="form-control" id="task-type" required>
        <option>{{__('site.select option')}}</option>
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

    </div>
    <div class="card-footer">
     <button type="submit" form="{{$task->id}}-task-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
     <button type="reset" form="{{$task->id}}-task-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
    </div>
   </form>
   <!--end::Form-->
  </div>

            </div>
        </div>
    </div>
</div>
<!--- Eit Information Model -->
