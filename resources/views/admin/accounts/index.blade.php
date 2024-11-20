@extends('admin.layouts.main')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:10px">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">

									<!--end::Mobile Toggle-->
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">{{__('site.Accounts')}}</h5>
										<!--end::Page Title-->

									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->

							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Change Password-->
								<div class="d-flex flex-row">
									<!--begin::Aside-->
									@include('admin.layouts.aside')
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
									<!--begin::Header-->
									<div class="card-header border-0 py-5">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bolder text-dark">{{__('site.Accounts')}}</span>
											<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$users_count}} {{__('site.Accounts')}}</span>
										</h3>
										<div class="card-toolbar">
											<a href="#" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
											<span class="svg-icon svg-icon-md svg-icon-white">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24"></polygon>
														<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
														<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>{{__('site.New Account')}}</a>
										</div>
									</div>
									<!--end::Header-->
									<form class="ml-5" action="">
										<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
											<input type="text" name="search" style="" class="form-control" id="kt_subheader_search_form" value="{{request('search')}}" placeholder="{{ __('site.search') }} {{__('site.email')}}">
										</div><br>
										<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
											<select class="form-control"  name="active">
												<option>All</option>
												<option {{Request('active') == '1' ? 'selected' : ''}} value="1">Active</option>
												<option {{Request('active') == '0' ? 'selected' : ''}} value="0">In Active</option>
											</select>
											<div class="input-group-append">
												<span class="input-group-text">
													<span class="svg-icon">
														<button type="submit" class="btn btn-sm btn-success ">
															<i style="font-size: 14px;padding: 6px;" class="fas fa-search"></i>
														</button>
													</span>
													<!--<i class="flaticon2-search-1 icon-sm"></i>-->
												</span>
											</div>
										</div><br>
									</form>									
									<!--begin::Body-->
									<div class="card-body py-0">
										<!--begin::Table-->
										<div class="table-responsive">
										{{ $users->withQueryString()->links() }}
										<div class="custom-table-responsive">							
											<table class="table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
												<thead>
													<tr class="text-left">
				<th style="">{{__('site.ID')}}</th>
				<th style="">{{__('site.email')}}</th>
				<th style="">{{__('site.time_zone')}}</th>
				<th style="">{{__('site.status')}}</th>
				<th style="">{{__('site.Rule')}}</th>
				<th style="">{{__('site.last login')}}</th>
				<th class="pr-0 " style="">{{__('site.action')}}</th>
													</tr>
												</thead>
												<tbody>
													@foreach($users as $user)
													<tr>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">#{{$user->id}}</span>
														</td>

														<td>
															<span class="text-muted font-weight-bold">{{$user->email}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$user->time_zone}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$user->active ? 'active' : 'inActive'}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{ userRole($user->rule) }}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$user->last_login}}
														</td>
	
														<td class="pr-0 ">

															<a href="javascript:void(0)" onclick="loadViewInPupUp({{$user->id}})" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">	                            <i class="fa fa-edit"></i>
														 </a>

														@if(auth()->user()->rule == 'admin')
														<div class="editPro">
															<form id="destory-{{$user->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
															  action="{{ route('admin.accounts.destroy',$user->id) }}" method="POST" >
																@csrf
																@method('DELETE')
																<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
																<i class="fa fa-trash" onclick="submitForm('{{$user->id}}')"></i></a>
																<button type="submit" style="display:none"></button>
															</form>
														</div>
														@endif
													
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											</div>
											{{ $users->withQueryString()->links() }}
										</div>
										<!--end::Table-->
									</div>
									<!--end::Body-->
								</div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Change Password-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!-- new Account --->
					<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
					<!--begin::Header-->
					<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
					<h3 class="font-weight-bold m-0">{{__('site.New Account')}}</h3>

					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="offcanvas-content pr-5 mr-n5">
						<!--begin::Header-->
						<div class="d-flex align-items-center mt-5">

						<div class="d-flex flex-column">

							<div class="navi mt-2">
								<form class="form" method="post" id="new-account" action="{{route('admin.accounts.index')}}"  enctype="multipart/form-data">
									@csrf
										<div class="card-body">

											<div class="form-group">
												<label>{{__('site.name')}}:</label>
												<input type="text" required class="form-control" name="username" value="{{old('username')}}" autocomplete="off">
											</div>

											<div class="form-group">
												<label>{{__('site.email')}}:</label>
												<input type="email" required class="form-control" name="email" value="{{old('email')}}"  autocomplete="off">
											</div>
											<div class="form-group">
												<label>{{__('site.employee_id')}}:</label>
												<input type="text" class="form-control" name="employee_id" value="{{old('employee_id')}}"  autocomplete="off">
											</div>

											<div class="form-group">
												<label>{{__('site.nationality')}}:</label>
												<select class="form-control " id="nationality" name="nationality" data-select2-id="" tabindex="-1" aria-hidden="true">
													<option value="">{{ __('site.choose') }}</option>
													@foreach($countries as $country)
														<option {{old('nationality') == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
													@endforeach
												</select>
											</div>

											<div class="form-group">
												<label>{{__('site.mobile_no')}}:</label>
												<input type="text" class="form-control" name="mobile_no" value="{{old('mobile_no')}}" autocomplete="off" >
											</div>
											<div class="form-group">
												<label>{{__('site.department')}}:</label>
												<select class="form-control" name="department" id="department">
													<option value="">{{ __('site.choose') }}</option>
													<option {{old('department') == 'Primary' ? 'selected' : ''}} value="Primary">{{__('site.Primary')}}</option>
													<option {{old('department') == 'Secondary' ? 'selected' : ''}} value="Secondary">{{__('site.Secondary')}}</option>
												</select>
											</div>
											<div class="form-group">
												<label>{{__('site.designation')}}:</label>
												<input type="text" class="form-control" name="designation" value="{{old('designation')}}" autocomplete="off" >
											</div>
											<div class="form-group">
												<label>{{__('site.user_pic')}}:</label>
												<input type="file" class="form-control" name="user_pic">
											</div>

											

											
							<div class="form-group">
										<label class="text-alert">
								{{ __('site.TimeZone') }}
														    </label>
							<div class="">
                              <select name="time_zone" class="form-control form-control-lg form-control-solid mb-2" required>
                                  
  					<option value="en">{{__('site.choose')}}</option>
  					@foreach(timeZones() as $zone)
  					<option 
  					{{ old('time_zone') == $zone ? 'selected' : '' }}
  					value="{{ $zone }}">{{$zone }}</option>
  					@endforeach
  														</select>
														</div>
													</div>

											<div class="form-group">
												<label>{{__('site.Rera Available')}}:</label>
												<select class="form-control is_rera_active" name="is_rera_active" id="is_rera_active">
												<option value="">{{__('site.choose')}}</option>
												{!! selectOptions(__('config.yes_no'),old('is_rera_active')) !!}
												</select>
											</div>
											<div class="form-group rera-user" style="display:none">
												<label>{{__('site.rera_user')}}:</label>
												<select name="rera_user_id" class="form-control form-control-lg form-control-solid mb-2 ">
													<option value="" class="selcted-default-leader" selected>{{__('site.select option')}}</option>
													@foreach($reraUsers as $reraUser)
														<option
														{{$reraUser->id == old('rera_user_id') ? 'selected' : ''}}
														value="{{$reraUser->id}}">{{$reraUser->name}}</option>
													@endforeach
												</select>
												<!--added by fazal on 20-10-23-->
												<input type="checkbox" id="publicprofile" name="public_profile" value="1">
												<label for="publicprofile"> Public Profile</label>
												<!--end-->
												<br>
											</div>
											<div class="form-group rera_number" style="display:none">
												<label>{{__('site.Rera Number')}}:</label>
												<input type="text" class="form-control" name="rera_number" value="{{old('rera_number')}}" autocomplete="off">
											</div>
											

											<div class="separator separator-dashed my-5"></div>
											<div class="form-group">
												<label>{{__('site.positions')}}: </label>
												<select name="position_types[]" multiple
												 class="form-control form-control-lg form-control-solid mb-2" required="">
													@foreach($positions as $position)
														<option
														@if(is_array(old('position_types')))
															{{in_array($position,old('position_types')) ? 'selected' : ''}}
														@else
															{{strpos(old('position_types'),$position)  ? 'selected' : ''}}
														@endif

														value="{{$position}}">{{$position}}</option>
													@endforeach
												</select>
											</div>
											<div class="separator separator-dashed my-5"></div>
											<div class="form-group">
												<label>{{__('site.Rule')}}:</label>
												<select name="rule" id="select-create-rule" class="form-control form-control-lg form-control-solid mb-2 select-rule" required>
													<option value="" >{{__('site.select option')}}</option>
													@foreach($roles as $zone)
													<option 
													{{ old('rule') == $zone ? 'selected' : '' }}
													value="{{ $zone }}">{{$zone }}</option>
													@endforeach
												</select>
											</div>

											<div class="form-group select-leader" style="display:none">
												<label>{{__('Leader')}}:</label>
												<select name="leader" class="form-control form-control-lg form-control-solid mb-2 leadersOne">
													<option value="" class="selcted-default-leader" selected>{{__('site.select leader')}}</option>
													@foreach($leaders as $leader)
														<option value="{{$leader->id}}">{{$leader->name}}</option>
													@endforeach
												</select>
											</div>

											<div class="form-group leadersArray" style="display:none">
												<label>{{__('Leader')}}:</label>
												<select name="leaders[]" class="form-control form-control-lg form-control-solid mb-2 " multiple>
													@foreach($leaders as $leader)
														<option value="{{$leader->id}}">{{$leader->name}}</option>
													@endforeach
												</select>
											</div>

										</div>

										<div class="card-footer">
											<button type="submit" form="new-account" class="btn btn-primary mr-2">{{__('site.save')}}</button>
											<button id="kt_quick_user_close" class=" btn btn-secondary">{{__('site.cancel')}}</button>
										</div>
									</form>


							</div>
						</div>
					</div>
					<!--end::Header-->

					</div>
					<!--end::Content-->
					</div>

@endsection
@push('js')
	<script>
			$(document).ready(function (){

				function selectLeader(id)
				{
					let el = $('#'+id);
					let val = el.val();
					if(val == 'assistant sales director') {
						el.parent('.form-group').next('.form-group').css('display','none');
						$('.leadersArray').css('display','block');
					} else {
						$('.leadersArray').css('display','none');
						if(val == 'sales' || val == 'sales admin' || val == 'commercial sales' || val == 'business developement sales') {
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
				$(".is_rera_active").on('change', function(){
					if($(this).val() == '2'){ // yes
						$(".rera-user").show();
						$(".rera_number").hide();
					}else{
						$(".rera-user").hide();
						$(".rera_number").show();
					}
				});
				// select all rule and work with them
				document.querySelectorAll('.select-rule').forEach(el => {
						selectLeader(el.id);
				});


			});

function submitForm(id){
	$("#destory-"+id).submit();
}			
	</script>
	


<script>
function loadViewInPupUp(id){
  let token = $('meta[name=csrf-token]').attr('content');
  let route = '{{route("admin.accounts.getDetailsByAjax")}}';
  $("#loadingHolder").show();
  $.ajax({
    type:'POST',
    url: route,
    data:{_token:token,id:id},
    success: (res) => {
      $('#getPupUpByAjax').html(res);
      $('#getPupUpByAjax').modal();
      $("#loadingHolder").hide();
    },
    error: function(res){
      $('#getPupUpByAjax').html(res);
      $('#getPupUpByAjax').modal();
      $("#loadingHolder").hide();
    }
  });

}
</script>

	
@endpush
