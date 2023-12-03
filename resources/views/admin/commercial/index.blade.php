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
//$exportUrl = str_replace($exportUrl[0],route('admin.commercial-leads.exportDataDeals'),$exportName);
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
						<span class="card-label font-weight-bolder text-dark">{{__('site.leads')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$commercial_count}} {{__('site.leads')}}</span>
					</h3>
					<div class="card-toolbar">

					@can('commercial-create')
						<a href="{{route('admin.commercial-leads.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-plus"></span> {{__('site.New Lead')}}</a>
					@endcan
					</div>
				</div>
				<!--end::Header-->
			

				<!--begin::Body-->
				<div class="card-body py-0">
					<!--begin::Table-->
					<div class="table-responsive">
					{{$commercial_leads->withQueryString()->links()}}
					<div class="custom-table-responsive">							
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.country')}}</th>
									<th>{{__('site.brand_name')}}</th>
									<th>{{__('site.activity')}}</th>
									<th>{{__('site.activity_type')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($commercial_leads as $commercial)
								<tr>
									<td>
										<a class="text-dark" href="{{route('admin.commercial-leads.detail',$commercial->id)}}">
											<span class="text-muted font-weight-bold">{{$commercial->country}}</span>
										</a>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$commercial->brand_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$commercial->activity_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$commercial->activity_type}}</span>
									</td>
									<td>
										<div class="editPro">
									@can('commercial-edit')
									<a href="{{ route('admin.commercial-leads.show',$commercial->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
									@endcan
									@can('commercial-delete')
											<form id="destory-{{$commercial->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.commercial-leads.destroy',$commercial->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$commercial->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endcan
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
						{{$commercial_leads->withQueryString()->links()}}
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
@push('js')
<script type="text/javascript">


</script>
@endpush	

