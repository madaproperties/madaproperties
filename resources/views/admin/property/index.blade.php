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
			<div class="w-100">
				<!--begin::Content-->
				<div class="w-100">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0 py-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">{{__('site.property')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$property_count}} {{__('site.property')}}</span>
					</h3>
					<div class="card-toolbar">


						@can('property-export')
						<a href="" class="btn btn-primary font-weight-bolder" id="exportButton" target="_blank" onclick="exportdata()">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>
                        @endcan						
						@can('property-create')
							<a href="{{route('admin.property.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
							<span class="fa fa-plus"></span> {{__('site.New property')}}</a>
                        @endcan						
					</div>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->
				<form class="ml-5 formSearchh" action="">
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
					@include('admin.layouts.advanced-search-properties')
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.id')}}</th>
									<th>{{__('site.ref')}}</th>
									<th>{{__('site.permit_no')}}</th>
									<th>{{__('site.status')}}</th>
									<th>{{__('site.title')}}</th>
									<th>{{__('site.updated_at')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($properties as $property)
								<tr>
									<td>
										<span>{{$property->id}}</span>
									</td>
									<td>
										<span>{{$property->crm_id}}</span>
										<p><b>Type : {{$property->sale_rent == 1 ? 'Sale' : 'Rent'}}</b></p>
									</td>
									<td>
										<span>{{$property->str_no}}</span>
									</td>
									<td>
										<span>{{__('config.status.'.$property->status)}}</span>
									</td>
									<td>
										<span>{{$property->title}}</span>
									</td>
									<td>
										<span>{{($property->last_updated)}}</span>
									</td>																		
									<td>
									<div class="editPro">
										@can('property-edit')
										<a href="{{ route('admin.property.show',$property->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details in english"><i class="fa fa-edit"></i></a>																						
										@endif
										<a href="{{ route('property.brochure',$property->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Brochure"><i class="fa fa-print"></i></a>																						
										@can('property-delete')
											<form id="destory-{{$property->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.property.destroy',$property->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$property->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endif
	</div>
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$properties->withQueryString()->links()}}
						</table>
						{{$properties->withQueryString()->links()}}
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
