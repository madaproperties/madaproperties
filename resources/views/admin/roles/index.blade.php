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
						<span class="card-label font-weight-bolder text-dark">{{__('site.Roles Management')}}</span>
					</h3>
					<div class="card-toolbar">
                        @can('role-create')
                        <a class="btn btn-success" href="{{ route('admin.roles.create') }}"> Create New Role</a>
                        @endcan
					</div>
				</div>
				<!--end::Header-->

				<!--begin::Body-->
				<div class="card-body py-0">
					<!--begin::Table-->
					<div class="table-responsive">
                    <table class=" text-center table table-separate table-head-custom table-checkable table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="editPro">
                                    @can('role-edit')
                                        <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
                                    @endcan
                                    @can('role-delete')
                                        <form id="destory-{{$role->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
                                            action="{{ route('admin.roles.destroy',$role->id) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
                                            <i class="fa fa-trash" onclick="submitForm('{{$role->id}}')"></i></a>
                                            <button type="submit" style="display:none"></button>
                                        </form>                                    
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>


                    {!! $roles->render() !!}
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
