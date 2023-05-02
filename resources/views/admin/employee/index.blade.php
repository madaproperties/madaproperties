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
$exportUrl = str_replace($exportUrl[0],route('admin.employee.exportRecords'),$exportName);
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
						<span class="card-label font-weight-bolder text-dark">{{__('site.employee')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$employees_count}} {{__('site.employee')}}</span>
					</h3>
					<div class="card-toolbar">
                     <a href="{{route('admin.employee.create')}}" class="btn btn-primary font-weight-bolder" >
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.create new') }}
						</a>
                       <div class="dropdown dropdown-inline mr-2">
									<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="svg-icon svg-icon-md" style="color:#fff">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
											<i class="fas fa-database" style="color:#fff"></i>
										<!--end::Svg Icon-->
									</span>{{__('site.Import Data') }}</button>
									<!--begin::Dropdown Menu-->
									<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
										<!--begin::Navigation-->
										<ul class="navi flex-column  py-2">

											<li class="navi-item">
												<a href="#" class="navi-link" data-toggle="modal" data-target="#importData">
													<span class="navi-text">{{__('site.Import Data') }}</span>
												</a>
											</li>
											<li class="navi-item">
												<a href="{{ asset('public/files/mada-emp-import-sample-1.xlsx') }}" class="navi-link">
													<span class="navi-text">{{__('site.sample') }}</span>
												</a>
											</li>

										</ul>
										<!--end::Navigation-->
									</div>
									<!--end::Dropdown Menu-->
								</div> 
						
						<a href="{{$exportUrl}}" class="btn btn-primary font-weight-bolder" id="exportButton" target="_blank" onclick="exportdata()">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>
                       						
						
							
                        						
					</div>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->
					<!-- Modal -->
								<div class="modal fade" id="importData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
										<form method="post" id="import-data-form" action="{{route('admin.emp-importData')}}" enctype="multipart/form-data">
								    <div class="modal-content">

								      <div class="modal-body">
													@csrf
												  <div class="form-group">
												    <label for="exampleInputEmail1">File</label>
												    <input type="file" name="file"
														class="form-control" required>
												  </div>
								      </div>
								      <div class="modal-footer">
												<button type="submit" form="import-data-form" class="btn btn-primary">Upload</button>
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								      </div>
								    </div>
									</form>
								  </div>
								</div>
								<!-- modal end -->
				<form class="ml-5" action="">
					
					<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
						<input type="text" name="search" style="" class="form-control" id="kt_subheader_search_form" value="" placeholder="{{ __('site.search') }}">
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
					
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.name')}}</th>
									<th>{{__('site.email')}}</th>
									<th>{{__('site.department')}}</th>
									<th>{{__('site.designation')}}</th>
									<th>{{__('site.phone')}}</th>
									<th>{{__('site.status')}}</th>
                                    <th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($employees as $employee)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->employee_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->official_email}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->department}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->designation}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->phone}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">@if($employee->active_status==1)Active @else Inactive @endif</span>
									</td>
																										
									<td>
										<a href="{{ route('admin.employee.show',$employee->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>
										<a href="{{ route('admin.employee.empdetails',$employee->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Brochure"><i class="fa fa-print"></i></a>
										<form id="destory-{{$employee->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
															  action="{{ route('admin.employee.destroy',$employee->id) }}" method="POST" >
																@csrf
																@method('DELETE')
																<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
																<i class="fa fa-trash" onclick="submitForm('{{$employee->id}}')"></i></a>
																<button type="submit" style="display:none"></button>
															</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						{{$employees->links()}}
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function submitForm(id){
	$("#destory-"+id).submit();
}

</script>
