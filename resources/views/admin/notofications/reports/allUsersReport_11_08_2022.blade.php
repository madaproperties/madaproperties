{{$userReport->withQueryString()->links()}}
<div class="card-body" style="background:#fff;margin:10px 0">
<!--begin: Datatable-->
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Card-->
			<div class="table-responsive">
				<h4>
					{{__('site.contacts')}}
				</h4>
				<table class="table" style="background:#f4f4f4">
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
							@endphp
							<tr>
								<th>{{$rs->name}}</th>
								@foreach($status as $state)
								<th scope="row">
									<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id={{$state->id}}">
										@php
										$leadTotal = App\Contact::where('status_id',$state->id)->where('user_id',$rs->id)->count();
										$finalTotal += $leadTotal;
										@endphp
										{{ $leadTotal }}
									</a>
								</th>
								@endforeach
								<th>
									<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id=">
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

<div class="card-body">
	<div class="card card-custom" style="padding:20px">
		<div class="table-responsive">
			<table class="table  table-separate table-head-custom table-checkable">
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
					@foreach($userReport as $rs)
						@php
						$activities = App\Log::where('user_id',$rs->id)->where('is_log','1')->get();
						@endphp
						<tr>
							<th>{{$rs->name}}</th>
							<td>{{ $activities->where('type','call')->count()}}</td>
							<td>{{ $activities->where('type','meeting')->count()}}</td>
							<td>{{ $activities->where('type','whatsapp')->count()}}</td>
							<td>{{ $activities->where('type','email')->count()}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		<!--end: Datatable-->
		</div>
	</div>
</div>
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
				<table class="table" style="background:#f4f4f4">
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
									->whereDate('updated_at', '<=', Carbon\Carbon::today()->subDays( 14 ))
									->get();
							@endphp

							<tr>
								<th>{{$rs->name}}</th>
								@foreach($status as $state)
									<th scope="row">
										<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id={{$state->id}}&last_update_to={{$last14days}}">
											@php
											$leadTotal = $status_not_changed_after_1_week->where('status_id',$state->id)->count();
											$finalTotal += $leadTotal;
											@endphp
											{{$leadTotal}}
										</a>
									</th>
								@endforeach
								<th>
									<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$rs->id}}&status_id=&last_update_to={{$last14days}}">
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


