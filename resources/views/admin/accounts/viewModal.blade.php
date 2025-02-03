@php
$userRole = $user->roles->pluck('name','name')->first();
@endphp
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('site.Edit Account')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="edit-{{$user->id}}-form" action="{{route('admin.accounts.update',$user->id)}}"  enctype="multipart/form-data">
						@csrf
						@method('PUT')
								<div class="card-body">
										<div class="separator separator-dashed my-5"></div>
										<div class="form-group">
											<label>{{__('site.name')}}:</label>
											<input type="text" required="" class="form-control" name="username" value="{{$user->username}}" autocomplete="off">
										</div>
										<div class="form-group">
											<label>{{__('site.email')}}:</label>
											<input type="email" required="" class="form-control" name="email" value="{{$user->email}}" autocomplete="off">
										</div>										
										<div class="form-group">
											<label>{{__('site.employee_id')}}:</label>
											<input type="text" class="form-control" name="employee_id" value="{{$user->employee_id}}" autocomplete="off">
										</div>

										<div class="form-group">
											<label>{{__('site.nationality')}}:</label>
											<select class="form-control " id="nationality" name="nationality" data-select2-id="" tabindex="-1" aria-hidden="true">
												<option value="">{{ __('site.choose') }}</option>
												@foreach($countries as $country)
													<option {{$user->nationality == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label>{{__('site.mobile_no')}}:</label>
											<input type="text" class="form-control" name="mobile_no" value="{{$user->mobile_no}}" autocomplete="off">
										</div>
										<div class="form-group">
											<label>{{__('site.department')}}:</label>
											<select class="form-control" name="department" id="department">
												<option value="">{{ __('site.choose') }}</option>
												<option {{$user->department == 'Primary' ? 'selected' : ''}} value="Primary">{{__('site.Primary')}}</option>
												<option {{$user->department == 'Secondary' ? 'selected' : ''}} value="Secondary">{{__('site.Secondary')}}</option>
											</select>
										</div>
										<div class="form-group">
											<label>{{__('site.designation')}}:</label>
											<input type="text" class="form-control" name="designation" value="{{$user->designation}}" autocomplete="off">
										</div>
										<div class="form-group">
											<label>{{__('site.user_pic')}}:</label>
											<div class="fv-plugins-message-container"></div>
											@if($user->user_pic)
												<img src="{{$user->user_pic}}" width="50%">
											@endif
											<input type="file" class="form-control" name="user_pic" >
										</div>



										<div class="form-group ">
											<label class="">{{ __('site.time_zone')}}</label>
											<div class="">
												<select name="time_zone" class="form-control form-control-lg form-control-solid mb-2" required>
													<option value="en">{{__('site.choose')}}</option>
													@foreach(timeZones() as $zone)
													<option 
													{{ $user->time_zone == $zone ? 'selected' : '' }}
													value="{{ $zone }}">{{$zone }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group">
											<label>{{__('site.Rera Available')}}:</label>
											<select class="form-control is_rera_active" name="is_rera_active" id="is_rera_active">
											<option value="">{{__('site.choose')}}</option>
											{!! selectOptions(__('config.yes_no'),$user->is_rera_active) !!}
											</select>
										</div>

										<div class="form-group rera-user" style="{{$user->is_rera_active == '2' ? 'display:block' : 'display:none'}}">
											<label>{{__('site.rera_user')}}:</label>
											<select name="rera_user_id" class="form-control form-control-lg form-control-solid mb-2 ">
												<option value="" class="selcted-default-leader" selected>{{__('site.select option')}}</option>
												@foreach($reraUsers as $reraUser)
													<option
													{{$reraUser->id == $user->rera_user_id ? 'selected' : ''}}
													 value="{{$reraUser->id}}">{{$reraUser->name}}</option>
												@endforeach
											</select>
											<!--added by fazal on 20-10-23-->
												@if($user->public_profile == 1)
											<input type="checkbox" id="publicprofile" name="public_profile" checked value ="0">
											@else
											<input type="checkbox" id="publicprofile" name="public_profile" value="1">
											@endif
												<label for="publicprofile"> Public Profile</label>
												<!---->
										</div>


										<div class="form-group rera_number" style="{{$user->is_rera_active == '1' ? 'display:block' : 'display:none'}}">
											<label>{{__('site.Rera Number')}}:</label>
											<input type="text" class="form-control" name="rera_number" value="{{$user->rera_number}}" autocomplete="off">
										</div>
										
										<div class="separator separator-dashed my-5"></div>
										<div class="form-group">
											<label>{{__('site.positions')}}: </label>
											<select name="position_types[]" multiple
											 class="form-control form-control-lg form-control-solid mb-2" required="">
												@foreach($positions as $position)
													<option
													@if(is_array($user->position_types))
														{{in_array($position,$user->position_types) ? 'selected' : ''}}
													@else
														{{strpos($user->position_types,$position)  ? 'selected' : ''}}
													@endif
													value="{{$position}}">{{$position}}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label>{{__('site.Rule')}}:</label>
											<select name="rule"
											id="edit-{{$user->id}}-rule"
											 class="form-control form-control-lg form-control-solid mb-2 select-rule" required="">
											 <option value="" >{{__('site.select option')}}</option>
											 	@foreach($roles as $role)
													<option 
													{{ $user->roles->pluck('name','name')->first() == $role ? 'selected' : '' }}
													value="{{ $role }}">{{$role }}</option>
												@endforeach
											</select>
										</div>
										
										@if($userRole == 'sales admin' || $userRole == 'assistant sales director' || $userRole == 'sales' || $userRole == 'commercial sales')
										<div class="form-group select-leader leadersOne" style="display:{{ ($userRole == 'sales admin' || $userRole == 'sales' || $userRole == 'commercial sales') ? 'block' : 'none' }}">
											<label>{{__('site.Leader')}}:</label>
											<select name="leader" class="form-control form-control-lg form-control-solid mb-2">
												@foreach($leaders as $leader)
													<option
													@if(is_array($user->leader))
														{{in_array($leader->id, $user->leader) ? 'selected' : ''}}
													@else
														{{strpos($user->leader, $leader->id)  ? 'selected' : ''}}
													@endif
													value="{{ $leader->id }}" >
														{{ $leader->name }}
													</option>
												@endforeach
											</select>
										<br>
										</div>

										<div class="form-group select-leader leadersArray" style="display:{{ $userRole == 'assistant sales director' ? 'block' : 'none' }}">
											<label>{{__('site.Leader')}}:</label>
											<select name="leaders[]" class="form-control form-control-lg form-control-solid mb-2 " multiple>
												@foreach($leaders as $leader)
													<option
													@if(is_array($user->leader))
														{{in_array($leader->id, $user->leader) ? 'selected' : ''}}
													@else
														{{strpos($user->leader, $leader->id)  ? 'selected' : ''}}
													@endif
													value="{{ $leader->id }}" >
														{{ $leader->name }}
													</option>
												@endforeach
											</select>
										<br>
										</div>
										@endif
										<div class="separator separator-dashed my-5"></div>
										
										<div class="form-group">
											<label>{{__('site.Password')}}:</label>
											<input type="password"
											 class="form-control" name="password" placeholder="">
										</div>
										<div class="separator separator-dashed my-5"></div>
										<div class="form-group select-leader">
											<label>{{__('site.status')}}:</label>
											<select name="active" class="form-control form-control-lg form-control-solid mb-2 ">
													<option
					{{$user->active  ? 'selected' : ''}} value="1">{{__('site.Active')}}</option>
													<option
					{{!$user->active  ? 'selected' : ''}} value="0">{{__('site.In Active')}}</option>
											</select>
										</div>
										<div class="separator separator-dashed my-5"></div>
										<div class="row">

											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label>{{__('site.target')}} {{__('site.email')}}:</label>
													<input type="number"
													required
													 class="form-control" name="target_email" value="{{$user->target_email}}" >
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label>{{__('site.target')}} {{__('site.call')}}:</label>
													<input type="number"
													required
													 class="form-control" name="target_call" value="{{$user->target_call}}" >
												</div>
											</div>

											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label>{{__('site.target')}} {{__('site.meeting')}}:</label>
													<input type="number"
													required
													 class="form-control" name="target_meeting" value="{{$user->target_meeting}}" >
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label>{{__('site.target')}} {{__('site.whatsapp')}}:</label>
													<input type="number"
													required
													 class="form-control" name="target_whatsapp" value="{{$user->target_whatsapp}}" >
												</div>
											</div>

										</div>

									</div>
									<div class="card-footer">
										<button type="submit" form="edit-{{$user->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
									</div>
								</form>
              </div>

          </div>
      </div>
  </div>
  <script type="text/javascript">
  	$(".is_rera_active").on('change', function(){
		if($(this).val() == '2'){ // yes
			$(".rera-user").show();
			$(".rera_number").hide();
		}else{
			$(".rera-user").hide();
			$(".rera_number").show();
		}
	});
	$(document).ready(function (){

		function selectLeader(id) {
			let el = $('#'+id);
			let val = el.val();
			if(val == 'assistant sales director' || val == 'sales admin') {
				el.parent('.form-group').next('.form-group').css('display','none');
				$('.leadersArray').css('display','block');
			} else {
				$('.leadersArray').css('display','none');
				if(val == 'sales' || val == 'commercial sales' || val == 'business developement sales') {
					el.parent('.form-group').next('.form-group').css('display','block');
				} else {
					el.parent('.form-group').next('.form-group').css('display','none');
					el.find('.selcted-default-leader').attr('selected');
				}
			}
		}

		$('.select-rule').on('change', function (){
			selectLeader($(this).attr('id'));
		});
	});

  </script>
