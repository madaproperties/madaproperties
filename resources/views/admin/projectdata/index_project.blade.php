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
$exportUrl = str_replace($exportUrl[0],route('admin.project-data.exportProjectData'),$exportName);
@endphp


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
						<span class="card-label font-weight-bolder text-dark">{{__('site.project')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$data_count}} {{__('site.project')}}</span>
					</h3>
					<div class="card-toolbar">
						@can('project-export')
							<a href="{{$exportUrl}}" class="btn btn-primary font-weight-bolder" id="exportButton" target="_blank" onclick="exportdata()">
								<span class="svg-icon svg-icon-md">
								<i class="fas fa-database" style="color:#fff"></i>
								</span>{{__('site.export') }}
							</a>
						@endcan
						@can('project-create')
							<a href="{{route('admin.project-data.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
							<span class="fa fa-plus"></span> {{__('site.new').' '.__('site.project')}}</a>

							<a href="#" data-toggle="modal" data-target="#projectImportData" class="btn btn-success font-weight-bolder font-size-sm">
								<span class="svg-icon svg-icon-md">
								<i class="fas fa-database"></i>
								</span>{{__('site.Import Data') }}
							</a>
						@endcan
					</div>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->

				<!--begin::Body-->
				<div class="card-body py-0">
					@include('admin.projectdata.advanced-search')
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.unit_name')}}</th>
									<th>{{__('site.project')}}</th>
									<th>{{__('site.property_type')}}</th>
									<th>{{__('site.bedroom')}}</th>
									<th>{{__('site.price')}}</th>
									<th>{{__('site.created_at')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $project)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$project->unit_name}}</span></span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$project->project ? $project->project->name : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$project->property_type}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$project->bedroom}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$project->price}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$project->created_at}}</span>
									</td>
									<td>
										@can('project-edit')
											<a href="{{ route('admin.project-data.show',$project->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
										@endcan
										<a href="{{ route('project.brochure',$project->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" target="_blank" title="Brochure"><i class="fa fa-print"></i></a>																						
										@can('project-delete')
											<form id="destory-{{$project->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.project-data.destroy',$project->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$project->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endcan
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$data->links()}}
						</table>
						{{$data->links()}}
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
<div class="modal fade" id="projectImportData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form method="post" id="import-data-form" action="{{route('admin.projectImportData')}}" enctype="multipart/form-data">
	<div class="modal-content">

		<div class="modal-body">
					@csrf
					<div class="form-group">
					<label for="exampleInputEmail1">File <a href="{{ url('public/files/project-import-sample.xlsx') }}" target="_blank"> Download example file</a></label>
					<input type="file" name="file"
						class="form-control" required>
					</div>
		</div>
		<div class="modal-footer">
				<button type="submit" form="import-data-form" class="btn btn-primary">Uplode</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
	</div>
</div>
@endsection
<script>
function submitForm(id){
	$("#destory-"+id).submit();
}
</script>
