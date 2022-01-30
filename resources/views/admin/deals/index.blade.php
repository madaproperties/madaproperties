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
						<a href="{{request()->fullUrlWithQuery(['exportData' => '1'])}}" class="btn btn-primary font-weight-bolder" target="_blank">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>


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
									<th>{{__('site.country')}}</th>
									<th>{{__('site.project')}}</th>
									<th>{{__('site.unit_name')}}</th>
									<th>{{__('site.price')}}</th>
									<th>{{__('site.total_invoice')}}</th>
									<th>{{__('site.mada_commission')}}</th>
									<th>{{__('site.vat_amount')}}</th>
									<th>{{__('site.down_payment')}}</th>
									<th>{{__('site.deal_date')}}</th>
									<th>{{__('site.invoice_date')}}</th>	
									<th>{{__('site.Agent')}}</th>
									<th>{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($deals as $deal)
								<tr>
									<td class="pl-0">
										<span class="text-muted font-weight-bold text-muted d-block">{{$deal->country ? $deal->country->name : 'N/A'}}</span>
									</td>
									<td class="pl-0">
										<span class="text-muted font-weight-bold text-muted d-block">{{$deal->project->name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->unit_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->price)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->total_invoice)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->mada_commission)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->vat_amount)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->down_payment)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->deal_date}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->invoice_date}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->agent ? substr($deal->agent->email, 0, strpos($deal->agent->email, "@")) : 'N/A'}}</span>
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
