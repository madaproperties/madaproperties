@push('css')
    <style>
        .dataTables_info,.dataTables_paginate ,#DataTables_Table_0_filter
        {
            display:none;
        }
        .dt-button
        {
                padding: 5px;
                background: #000;
                color: #fff;
                border: none;
        }
        .search-from {
          padding: 20px;
          background: #fff;
          margin: 20px;
          box-shadow: 2px 2px 10px #fff, -2px -2px 10px #fff4f4;
          border:1px solid #eee;
          border-radius: 10px;
        }
    </style>
@endpush

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
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$deals_count}} {{__('site.deals')}}</span>
					</h3>
					<div class="card-toolbar">


						<a href="{{request()->fullUrlWithQuery(['exportData' => '1'])}}" class="btn btn-primary font-weight-bolder" id="exportButton" target="_blank" onclick="exportdata()">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>
						<a href="{{route('admin.deal.advanceExport')}}" class="btn btn-primary font-weight-bolder" target="_blank">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.Advanced Export')}}
						</a>


					@if(userRole() == 'admin' || !checkLeader())
						<a href="{{route('admin.deal.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-plus"></span> {{__('site.New Deal')}}</a>
					@endif
					</div>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->
				<form class="ml-5" action="">
					@foreach(request()->all() as $pram => $val)
						@if($pram != 'search')
							<input type="hidden" name="{{$pram}}" value="{{$val}}" />
						@endif
					@endforeach
					<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
						<input type="text" name="search" style="" class="form-control" id="kt_subheader_search_form" value="{{request('search')}}" placeholder="{{ __('site.search') }} {{__('site.unit_name')}}">
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
				@include('admin.layouts.advanced-search-deals')

					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.deal_date')}}</th>
									<th>{{__('site.country')}}</th>
									<th>{{__('site.project')}}</th>
									<th>{{__('site.unit_name')}}</th>
									<th>{{__('site.price')}}</th>
									<th>{{__('site.total_invoice')}}</th>
									<th>{{__('site.mada_commission')}}</th>
									<th>{{__('site.vat_amount')}}</th>
									<!--<th>{{__('site.down_payment')}}</th>-->
									<!--<th>{{__('site.invoice_date')}}</th>-->
									<th>{{__('site.Agent')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($deals as $deal)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{date('d-m-Y',strtotime($deal->deal_date))}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->country ? $deal->country->name : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{isset($deal->project->project_name) ? $deal->project->project_name : ''}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->unit_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->price, 2)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->total_invoice, 2)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->mada_commission, 2)}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{number_format($deal->vat_amount, 2)}}</span>
									</td>
									<!--<td>
										<span class="text-muted font-weight-bold">{{$deal->down_payment}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{date('d-m-Y',strtotime($deal->invoice_date))}}</span>
									</td>-->
									<td>
										<span class="text-muted font-weight-bold">{{$deal->agent ? substr($deal->agent->email, 0, strpos($deal->agent->email, "@")) : 'N/A'}}</span>
									</td>
									<td>
									@if(userRole() == 'admin' || !checkLeader())
									<a href="{{ route('admin.deal.show',$deal->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
									@endif

										<a href="{{ route('admin.deal.print',$deal->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Print commission report"><i class="fa fa-print"></i></a>																						
										<a href="{{ route('admin.deal.printBill',$deal->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Print tax invoice"><i class="fa fa-print"></i></a>																						
										@if(auth()->user()->rule == 'admin'  || !checkLeader())
											<form id="destory-{{$deal->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.deal.destroy',$deal->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$deal->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$deals->withQueryString()->links()}}
						</table>
						{{$deals->withQueryString()->links()}}
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
<script>
function submitForm(id){
	$("#destory-"+id).submit();
}
</script>
