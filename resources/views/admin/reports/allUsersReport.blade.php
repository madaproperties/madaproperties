{{$userReport->withQueryString()->links()}}
@php 
$exportName = request()->fullUrlWithQuery(['userStatusReport' => '1']);
$exportUrl = explode('?',$exportName);
$exportUrl = str_replace($exportUrl[0],route('admin.report.userStatusReport'),$exportName);
@endphp
<div class="card-body" style="background:#fff;margin:10px 0">
<!--begin: Datatable-->
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Card-->
			<div class="table-responsive">
				<h4>
					{{__('site.contacts')}}
				</h4>
				<a href="{{ $exportUrl }}" class="btn btn-primary font-weight-bolder pull-left" target="_blank">
					<span class="svg-icon svg-icon-md">
					<i class="fas fa-database" style="color:#fff"></i>
					</span>{{__('site.export') }}
				</a>
				<table class=" text-center table table-separate table-head-custom table-checkable table-striped">
					<thead>
						<tr>
							<th>Name</th>
							@foreach($status as $state)
								<th>{{$state->name}}</th>
							@endforeach
							<th>Total</th>
						</tr>
					</thead>
						<tbody>
						@php 			
							if(!empty(Request('from')) && !empty(Request('to'))){
								$from = date('Y-m-d 00:00:00', strtotime(Request('from')));
								$to = date('Y-m-d 23:59:59', strtotime(Request('to')));
							}
							
							if(!empty(Request('last_update_from')) && !empty(Request('last_update_to'))){
								$last_update_from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
								$last_update_to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
							}
						@endphp

						@foreach($userReport as $rs)
							@php
							$finalTotal = 0;
							@endphp
							<tr>
								<th>{{$rs->name}}</th>
								@foreach($status as $state)
								<th scope="row">
									<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id={{$state->id}}&from={{Request('from')}}&to={{Request('to')}}&project_id={{Request('project_id')}}&campaign_id={{Request('campaign_id')}}&country_id={{Request('country_id')}}&last_update_from={{Request('last_update_from')}}&last_update_to={{Request('last_update_to')}}">
										@php

										$leadTotal = App\Contact::where('status_id',$state->id)->where('user_id',$rs->id);
										if(!empty(Request('from')) && !empty(Request('to'))){
											$leadTotal = $leadTotal->whereBetween('created_at',[ $from,$to ]);
										}
										if(!empty(Request('last_update_from')) && !empty(Request('last_update_to'))){
											$leadTotal = $leadTotal->whereBetween('updated_at',[ $last_update_from,$last_update_to ]);
										}
										if(!empty(Request('country_id'))){
											$leadTotal = $leadTotal->where('unit_country',Request('country_id'));
										}
										if(!empty(Request('project_id'))){
											$leadTotal = $leadTotal->where('project_id',Request('project_id'));
										}
										if(!empty(Request('campaign_id'))){
											$leadTotal = $leadTotal->where('campaign',Request('campaign_id'));
										}	
										if(userRole() == 'sales director'){
											$leadTotal = $leadTotal->whereHas('project', function($q2) {
												$q2->where('projects.country_id',getSalesDirectorCountryId());
											});
										}
										$leadTotal = $leadTotal->count();
										$finalTotal += $leadTotal;
										@endphp
										{{ $leadTotal }}
									</a>
								</th>
								@endforeach
								<th>
									<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id=&from={{Request('from')}}&to={{Request('to')}}&project_id={{Request('project_id')}}&campaign_id={{Request('campaign_id')}}&country_id={{Request('country_id')}}&last_update_from={{Request('last_update_from')}}&last_update_to={{Request('last_update_to')}}">
									{{$finalTotal}}
								</th>
							</tr>
							@endforeach
						</tbody>
				</table>
			</div>
			<!--end::Card-->
		</div>
	</div>
<!--end: Datatable-->
</div>

@php 
$exportName = request()->fullUrlWithQuery(['userStatusReport' => '2']);
$exportUrl = explode('?',$exportName);
$exportUrl = str_replace($exportUrl[0],route('admin.report.userStatusReport'),$exportName);
@endphp

<div class="card-body">
	<div class="card card-custom" style="padding:20px">
		<div class="table-responsive">
			<a href="{{ $exportUrl }}" class="btn btn-primary font-weight-bolder pull-left" target="_blank">
				<span class="svg-icon svg-icon-md">
				<i class="fas fa-database" style="color:#fff"></i>
				</span>{{__('site.export') }}
			</a>
			<table class="ext-center table table-separate table-head-custom table-checkable table-striped">
				<thead>
					<tr>
						<td>Name</td>
						<td>Call</td>
						<td>Meeting</td>
						<td>WhatsApp</td>
						<td>Email</td>
					</tr>
				</thead>
				<tbody>
					@php
					$callFinalTotal=0;
					$meetingFinalTotal=0;
					$whatsappFinalTotal=0;
					$emailFinalTotal=0;
					@endphp
					@foreach($userReport as $rs)
						@php
							$activities = App\Log::where('user_id',$rs->id);
							if(!empty(Request('from')) && !empty(Request('to'))){
								$activities = $activities->whereBetween('log_date',[ $from,$to ]);
							}
							if(!empty(Request('last_update_from')) && !empty(Request('last_update_to'))){
								$last_update_from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
								$last_update_to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
								$activities = $activities->whereBetween('updated_at',[ $last_update_from,$last_update_to]);
							}
							$activities = $activities->get();
						@endphp
						<tr>
							<th>{{$rs->name}}</th>
							@php
								$call = $activities->where('type','call')->count();
								$meeting = $activities->where('type','meeting')->count();
								$whatsapp = $activities->where('type','whatsapp')->count();
								$email = $activities->where('type','email')->count();
								$callFinalTotal+=$call;
								$meetingFinalTotal+=$meeting;
								$whatsappFinalTotal+=$whatsapp;
								$emailFinalTotal+=$email;

							@endphp
							<td>{{ $call }}</td>
							<td>{{ $meeting}}</td>
							<td>{{ $whatsapp}}</td>
							<td>{{ $email}}</td>
						</tr>
					@endforeach
					<tr>
						<th>Total </th>
						<td>{{$callFinalTotal}}</td>
						<td>{{$meetingFinalTotal}}</td>
						<td>{{$whatsappFinalTotal}}</td>
						<td>{{$emailFinalTotal}}</td>
					</tr>
				</tbody>
			</table>
		<!--end: Datatable-->
		</div>
	</div>
</div>
@php 
$exportName = request()->fullUrlWithQuery(['userStatusReport' => '3']);
$exportUrl = explode('?',$exportName);
$exportUrl = str_replace($exportUrl[0],route('admin.report.userStatusReport'),$exportName);
@endphp

<!--start: Datatable-->
<div class="card-body" style="background:#fff;margin:10px 0">
<!--begin: Datatable-->
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Card-->
			<div class="table-responsive">
				<h4>
				{{'Last 2 week leads'}}
				</h4>
				<a href="{{ $exportUrl }}" class="btn btn-primary font-weight-bolder pull-left" target="_blank">
					<span class="svg-icon svg-icon-md">
					<i class="fas fa-database" style="color:#fff"></i>
					</span>{{__('site.export') }}
				</a>
				<table class="ext-center table table-separate table-head-custom table-checkable table-striped">
					<thead>
						<tr>
							<th>Name</th>
							@foreach($status as $state)
								<th>{{$state->name}}</th>
							@endforeach
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($userReport as $rs)
							@php
							$finalTotal = 0;
							$two_week_report = App\Contact::select('id','user_id','status_id','status_changed_at')
									->where('user_id',$rs->id)
									->whereDate('updated_at', '>=', Carbon\Carbon::today()->subDays( 14 ));

							if(!empty(Request('country_id'))){
								$two_week_report = $two_week_report->where('country_id',Request('country_id'));
							}										
							if(!empty(Request('project_id'))){
								$two_week_report = $two_week_report->where('project_id',Request('project_id'));
							}										
							if(userRole() == 'sales director'){
								$two_week_report = $two_week_report->whereHas('project', function($q2) {
									$q2->where('projects.country_id',getSalesDirectorCountryId());
								});
							}								
							$two_week_report = $two_week_report->get();
							@endphp

							<tr>
								<th>{{$rs->name}}</th>
								@foreach($status as $state)
									<th scope="row">
										<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id={{$state->id}}&last_update_from={{$last14days}}&project_id={{Request('project_id')}}&country_id={{Request('country_id')}}">
											@php
											$leadTotal = $two_week_report->where('status_id',$state->id)->count();
											$finalTotal += $leadTotal;
											@endphp
											{{$leadTotal}}
										</a>
									</th>
								@endforeach
								<th>
									<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id=&last_update_from={{$last14days}}&project_id={{Request('project_id')}}&country_id={{Request('country_id')}}">
									{{$finalTotal}}
								</th>
							</tr>
						@endforeach
						</tbody>
				</table>
			</div>
			<!--end::Card-->
		</div>
	</div>
<!--end: Datatable-->
</div>

@php 
$exportName = request()->fullUrlWithQuery(['userStatusReport' => '4']);
$exportUrl = explode('?',$exportName);
$exportUrl = str_replace($exportUrl[0],route('admin.report.userStatusReport'),$exportName);
@endphp

<!--start: Datatable-->
<div class="card-body" style="background:#fff;margin:10px 0">
<!--begin: Datatable-->
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Card-->
			<div class="table-responsive">
				<h4>
				{{'2 week have passed and the status has not changed'}}
				</h4>
				<a href="{{ $exportUrl }}" class="btn btn-primary font-weight-bolder pull-left" target="_blank">
					<span class="svg-icon svg-icon-md">
					<i class="fas fa-database" style="color:#fff"></i>
					</span>{{__('site.export') }}
				</a>
				<table class="ext-center table table-separate table-head-custom table-checkable table-striped" style="background:#f4f4f4">
					<thead>
						<tr>
							<th>Name</th>
							@foreach($status as $state)
								<th>{{$state->name}}</th>
							@endforeach
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($userReport as $rs)
							@php
							$finalTotal = 0;
							$status_not_changed_after_1_week = App\Contact::select('id','user_id','status_id','status_changed_at')
									->where('user_id',$rs->id)
									->whereDate('updated_at', '<=', Carbon\Carbon::today()->subDays( 14 ));

							if(!empty(Request('country_id'))){
								$status_not_changed_after_1_week = $status_not_changed_after_1_week->where('country_id',Request('country_id'));
							}										
							if(!empty(Request('project_id'))){
								$status_not_changed_after_1_week = $status_not_changed_after_1_week->where('project_id',Request('project_id'));
							}										
							if(userRole() == 'sales director'){
								$status_not_changed_after_1_week = $status_not_changed_after_1_week->whereHas('project', function($q2) {
									$q2->where('projects.country_id',getSalesDirectorCountryId());
								});
							}									
							$status_not_changed_after_1_week = $status_not_changed_after_1_week->get();									
							@endphp

							<tr>
								<th>{{$rs->name}}</th>
								@foreach($status as $state)
									<th scope="row">
										<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id={{$state->id}}&last_update_to={{$last14days}}&project_id={{Request('project_id')}}&country_id={{Request('country_id')}}">
											@php
											$leadTotal = $status_not_changed_after_1_week->where('status_id',$state->id)->count();
											$finalTotal += $leadTotal;
											@endphp
											{{$leadTotal}}
										</a>
									</th>
								@endforeach
								<th>
									<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id=&last_update_to={{$last14days}}&project_id={{Request('project_id')}}&country_id={{Request('country_id')}}">
									{{$finalTotal}}
								</th>
							</tr>
						@endforeach
						</tbody>
				</table>
			</div>
			<!--end::Card-->
		</div>
	</div>
<!--end: Datatable-->
</div>

{{$userReport->withQueryString()->links()}}


