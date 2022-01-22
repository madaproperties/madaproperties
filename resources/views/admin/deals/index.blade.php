@extends('admin.layouts.main')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:10px">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Profile Change Password-->
			<div class="d-flex flex-row">
				<!--begin::Content-->
				<div class="flex-row-fluid ml-lg-8">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0 py-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">{{__('site.deals')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{count($deals)}} {{__('site.deals')}}</span>
					</h3>
					<div class="card-toolbar">
						<a href="{{route('admin.deal.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-plus"></span> {{__('site.New Deal')}}</a>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-0">
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
							<thead>
								<tr class="text-left">
									<th style="min-width: 150px">{{__('site.project')}}</th>
									<th style="">{{__('site.price')}}</th>
									<th style="min-width: 150px">{{__('site.mada_commission')}}</th>
									<th class="pr-0 " style="min-width: 150px">{{__('site.agent_commission_amount')}}</th>
									<th class="pr-0 " style="min-width: 150px">{{__('site.agent_leader_commission_amount')}}</th>
									<th class="pr-0 " style="min-width: 150px">{{__('site.third_party_amount')}}</th>
									<th class="pr-0 ">{{__('site.total_invoice')}}</th>
									<th class="pr-0">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($deals as $deal)
								<tr>
									<td class="pl-0">
										<span class="text-muted font-weight-bold text-muted d-block">{{$deal->project->name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->price}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->mada_commission}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->agent_commission_amount}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->agent_leader_commission_amount}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->third_party_amount}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->total_invoice}}</span>
									</td>
									<td>

										<a href="{{ route('admin.deal.show',$deal->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
										@if(auth()->user()->rule == 'admin')
											<form id="destory-{{$deal->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.deal.destroy',$deal->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger">
													{{__('site.delete')}}
												</button>
											</form>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$deals->links()}}
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

@endsection
