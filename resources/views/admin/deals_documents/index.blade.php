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
@php 
$exportName = request()->fullUrlWithQuery(['exportData' => '1']);
$exportUrl = explode('?',$exportName);
$exportUrl = str_replace($exportUrl[0],route('admin.deal.exportDataDeals'),$exportName);
@endphp

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:10px">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Profile Change Password-->
			<div class="w-100">
				<!--begin::Content-->
				<div class="w-100">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0 py-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">{{__('site.deals')}}</span>
					</h3>
					<div class="card-toolbar">
						<a href="{{route('admin.deal-project-list')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-list"></span> {{__('site.deal documents')}}</a>
					</div>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->
				<form class="ml-5 formSearchh" action="">
				</form>

				<!--begin::Body-->
				<div class="card-body py-0">

					<!--begin::Table-->
					<div class="table-responsive">
					{{$deals->withQueryString()->links()}}
					<div class="custom-table-responsive">							
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.deal_date')}}</th>
									<th>{{__('site.project')}}</th>
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
										<span class="text-muted font-weight-bold">{{isset($deal->project->project_name) ? $deal->project->project_name : ''}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->agent ? substr($deal->agent->email, 0, strpos($deal->agent->email, "@")) : 'N/A'}}</span>
									</td>
									<td>
										<div class="editPro">
											@can('deal-edit')
											<a href="{{ route('admin.deal-documents-list',$deal->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Documents list"><i class="fa fa-folder"></i></a>																						
											@endcan
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
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
