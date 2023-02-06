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
        .custom-table-responsive{
            margin-top :25px;
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
						<span class="card-label font-weight-bolder text-dark">{{__('site.project')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{count($datas)}} {{__('site.project')}}</span>
					</h3>
					<div class="card-toolbar">
						
						
							<a href="{{route('admin.secondary-create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
							<span class="fa fa-plus"></span> {{__('site.new').' '.__('site.project')}}</a>

							
						
					</div>
				</div>
				
				<!--end::Header-->
				<!--end::Page Title-->

				<!--begin::Body-->
				<div class="card-body py-0">
				 @include('admin.secondary.advance-search')	
					<!--begin::Table-->
					<div class="table-responsive">
					{{$datas->links()}} 
					<div class="custom-table-responsive">							
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.country')}}</th>
									<th>{{__('site.project')}}</th>
									<th>{{__('site.property_type')}}</th>
									<th>{{__('site.bedroom')}}</th>
									<th>{{__('site.price')}}</th>
									<th>{{__('site.created_at')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($datas as $project)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$project->country ? $project->country->name : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$project->project_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$project->type}}</span>
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
										<div class="editPro">
										
											<a href="{{ route('admin.secondary.show',$project->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
										
										<a href="{{ route('secondaryproject.brochure',$project->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Brochure"><i class="fa fa-print"></i></a>																						
										
											<form id="destory-{{$project->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.secondary.destroy',$project->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$project->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
						{{$datas->links()}}
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
		<form method="post" id="import-data-form" action="" enctype="multipart/form-data">
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
