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
										<h5 class="text-dark font-weight-bold my-1 mr-5">{{__('site.Leave')}}</h5>
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
									
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
									<!--begin::Header-->
									<div class="card-header border-0 py-5">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bolder text-dark">{{__('site.Employees Leave')}}</span>
											<span class="text-muted mt-3 font-weight-bold font-size-sm"> {{__('site.employees leave')}}</span>
										</h3>
										<div class="card-toolbar">
											<a href="#" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
											<span class="svg-icon svg-icon-md svg-icon-white">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
												  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
												</svg>
												<!--end::Svg Icon-->
											</span>{{__('site.Add New')}}</a>
										</div>
									</div>
									<!--end::Header-->
									<!-- <form class="ml-5" action="">
										<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
											<input type="text" name="search" style="" class="form-control" id="kt_subheader_search_form" value="{{request('search')}}" placeholder="{{ __('site.search') }}">
										</div><br>
									</form>	 -->
									
									<!--begin::Body-->
									<div class="card-body py-0">
										<!--begin::Table-->
										<div class="table-responsive">
											<table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
												<thead>
													<tr class="text-left">
														
														<th style="min-width: 150px">{{__('site.Employee')}}</th>
														<th style="min-width: 150px">{{__('site.leave')}}</th>
														<th style="min-width: 150px">{{__('site.days')}}</th>
														<th style="min-width: 150px">{{__('site.start date')}}</th>
														<th style="min-width: 150px">{{__('site.end date')}}</th>
														<th style="min-width: 150px">{{__('site.description')}}</th>
														<th style="min-width: 150px">{{__('site.Status')}}</th>
														<th class="pr-0 " style="min-width: 150px">{{__('site.action')}}</th>
													</tr>
												</thead>
												<tbody>
													@foreach($leaves as $leave)
													<tr>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">{{$leave->employee ? $leave->employee->employee_name : 'N/A'}}</span>
														</td>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">{{$leave->leave ? $leave->leave->leave_name : 'N/A'}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$leave->days}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$leave->start_date}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$leave->end_date}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$leave->description}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">@if($leave->status==1) On Leave @else Completed @endif</span>
														</td>

														<td class="pr-0 ">

															<a href=""
															data-toggle="modal" data-target="#edit-{{$leave->id}}"
															class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">	 
														<i class="fa fa-edit"></i>
														 </a>
													     </td>
													 </tr>
													<div class="modal fade" id="edit-{{$leave->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
										    <div class="modal-dialog" role="document">
									        <div class="modal-content">
									            <div class="modal-header">
									                <h5 class="modal-title" id="exampleModalLabel">{{__('site.edit')}}</h5>
									                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                    <i aria-hidden="true" class="ki ki-close"></i>
									                </button>
									            </div>
									            <div class="modal-body">
																<form class="form" method="post" id="edit-{{$leave->id}}-form"
																action="{{route('admin.employeeleave.update',$leave->id)}}">
																	@csrf
																	@method('PUT')
																	<div class="card-body">
																		<div class="form-group">
																			<label>{{__('site.Employee Name')}}:</label>
																			<select class="form-control" name="employee_id">
																			<option value="">choose</option>
																			@foreach($employees as $employe)
																			<!-- <option value="{{$employe->id}}">{{$employe->employee_name}}</option> -->
                                                                          <option {{$leave->employee_id == $employe->id ? 'selected' : ''}} value="{{$employe->id}}" data-select2-id="{{$employe->id}}">{{$employe->employee_name}}</option>
                                                                        @endforeach
																		</select>
                                                                        <div class="form-group">
																			<label>{{__('site.Leave Name')}}:</label>
																			<select class="form-control" name="leave_id">
																		@foreach($leaves_names as $lea)
																		 <option {{$leave->leave_id == $lea->id ? 'selected' : ''}} value="{{$lea->id}}" data-select2-id="{{$lea->id}}">{{$lea->leave_name}}</option>
                                                                        @endforeach
																		</select>
																		</div>
																		<!-- <div class="separator separator-dashed my-5"></div> -->
																		<div class="form-group">
																			<label>{{__('site.days')}}:</label>
																			<input type="number" name="days" value="{{$leave->days}}" class="form-control" >
																		</div>
																		<div class="form-group">
																			<label>{{__('site. start date')}}:</label>
																			<input type="date" name="start_date" value="{{$leave->start_date}}" class="form-control" >
																		</div>
																		<div class="form-group">
																			<label>{{__('site.end date')}}:</label>
																			<input type="date" name="end_date" value="{{$leave->end_date}}" class="form-control" >
																		</div>
																		<div class="form-group">
																			<label>{{__('site.status')}}:</label>
																			<select class="form-control" name="status">
																				<option value="1">On leave</option>
																				<option value="0">Completed</option>
																			</select>
																		</div>
																		
																	<div class="card-footer">
																		<button type="submit" form="edit-{{$leave->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
																	</div>
																</form>
																
									            </div>

									        </div>
										    </div>
										</div> 

											
                                  @endforeach
														</td>
													</tr>
													
												</tbody>
												
											</table>
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
					<h3 class="font-weight-bold m-0">New Leave</h3>

					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="offcanvas-content pr-5 mr-n5">
						<!--begin::Header-->
						<div class="d-flex align-items-center mt-5">
                        <div class="d-flex flex-column">

							<div class="navi mt-2">
								<form class="form" method="post" id="new-project" action="{{route('admin.employeeleave.store')}}">
									@csrf
									<div class="card-body">
                                        <div class="form-group" >
										<label>{{__('site.employee')}}:</label>
										<!-- <input type="text" name="leave_name" value="{{old('leave_name')}}" class="form-control" > -->
										<select class="form-control" name="employee_id">
											<option value="">choose</option>
											@foreach($employees as $employe)
											<option value="{{$employe->id}}">{{$employe->employee_name}}</option>
											@endforeach
										</select>
											</div>
											<div class="form-group">
												<label>{{__('site.leave')}}:</label>
												<select class="form-control" name="leave_id">
											<option value="">choose</option>
											@foreach($leaves_names as $lea)
											<option value="{{$lea->id}}">{{$lea->leave_name}}</option>
											@endforeach
										</select>
											</div>
										<div class="form-group">
										<label>{{__('site.no of days')}}:</label>
										<input type="text" name="days" value="" class="form-control" > 
										</div>
										<div class="form-group">
										<label>{{__('site.start date')}}:</label>
										<input type="date" name="start_date" class="form-control" > 
										</div>	
                                        <div class="form-group">
										<label>{{__('site.end date')}}:</label>
										<input type="date" name="end_date" class="form-control" > 
										</div>
										<div class="form-group">
										<label>{{__('site.description')}}:</label>
										<textarea name="description" class="form-control" > </textarea>
										</div>
									
                                      <!--end::Group-->
											<div class="separator separator-dashed my-5"></div>
										</div>
										<div class="card-footer">
											<button type="submit" form="new-project" class="btn btn-primary mr-2">{{__('site.save')}}</button>
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
