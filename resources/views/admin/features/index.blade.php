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
	<div class="">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Profile Change Password-->
			<div class="">
				<!--begin::Content-->
				<div class="">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0 py-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">{{__('site.Feature')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$features_count}} {{__('site.Feature')}}</span>
					</h3>
					<div class="card-toolbar">				
						@can('feature-create')
							<a href="{{route('admin.features.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
							<span class="fa fa-plus"></span> {{__('site.New Feature')}}</a>
                        @endcan						
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-0">
				<form>
					<div class="input-group">
						@foreach(request()->all() as $pram => $val)
							@if($pram != 'search')
								<input type="hidden" name="{{$pram}}" value="{{$val}}" />
							@endif
						@endforeach
						<input type="text" name="search" class="form-control form-control-lg" value="{{request('search')}}" placeholder="{{ __('site.search') }}">
						<div class="input-group-append">
							<button type="submit" class="btn btn-lg btn-default">
							<i class="fa fa-search"></i>
							</button>
						</div>
					</div>
				</form>	
					<!--begin::Table-->
					<div class="table-responsive">
					{{$features->withQueryString()->links()}}
					<div class="custom-table-responsive">							
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.name')}}</th>
									<th>{{__('site.type')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($features as $feature)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$feature->feature_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">
											{{__('config.feature_type.'.$feature->feature_type)}}
										</span>
									</td>
									<td>
									<div class="editPro">
										@can('feature-edit')
											<a href="{{ route('admin.features.show',$feature->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
										@endif
										@can('feature-delete')
											<form id="destory-{{$feature->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.features.destroy',$feature->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$feature->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endif
									</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
						{{$features->withQueryString()->links()}}
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
