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
$exportUrl = str_replace($exportUrl[0],route('admin.database-records.exportDatabaseRecords'),$exportName);
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
						<span class="card-label font-weight-bolder text-dark">{{__('site.database_records')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$data_count}} {{__('site.deals')}}</span>
					</h3>
					<div class="card-toolbar">

					@can('database-records-export')
						<a href="{{$exportUrl}}" class="btn btn-primary font-weight-bolder" id="exportButton" target="_blank" onclick="exportdata()">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>
					@endcan
					@can('database-records-create')
						<a href="{{route('admin.database-records.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-plus"></span> {{__('site.New database record')}}</a>
					@endcan
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
						<input type="text" name="search" style="" class="form-control" id="kt_subheader_search_form" value="{{request('search')}}" placeholder="{{ __('site.search') }}">
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
									<th>{{__('site.phone')}}</th>
									<!-- <th>{{__('site.country')}}</th>
									<th>{{__('site.city')}}</th>
									<th>{{__('site.area')}}</th> -->
									<th>{{__('site.project_name')}}</th>
									<th>{{__('site.building_name')}}</th>
									<th>{{__('site.unit_name')}}</th>
									<th>{{__('site.price')}}</th>
									<th>{{__('site.bedroom')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $rs)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->email}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->phone}}</span>
									</td>
									<!-- <td>
										<span class="text-muted font-weight-bold">{{$rs->country ? $rs->country->name : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->city}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->area}}</span>
									</td> -->
									<td>
										<span class="text-muted font-weight-bold">{{$rs->project_id}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->building_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->unit_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->price}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->bedroom}}</span>
									</td>
									<td>
									@can('database-records-edit')
									<a href="{{ route('admin.database-records.show',$rs->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
									@endcan
									@can('database-records-delete')
											<form id="destory-{{$rs->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.database-records.destroy',$rs->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$rs->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endcan
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$data->withQueryString()->links()}}
						</table>
						{{$data->withQueryString()->links()}}
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
