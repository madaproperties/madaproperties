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
				<div class="col-sm-8">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
					<div class="card-header border-0 py-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">{{__('site.Advanced Export')}}</span>
					</h3>
					<div class="card-toolbar">


						<a href="{{route('admin.deal.index')}}" class="btn btn-primary font-weight-bolder" target="_blank">
							<span class="svg-icon svg-icon-md">
							</span>{{__('site.deals')}}
						</a>

						@if(userRole() == 'admin')
							<a href="{{route('admin.deal_project.index')}}" class="btn btn-primary font-weight-bolder" target="_blank">
								<span class="svg-icon svg-icon-md">
								</span>{{__('site.deals') .' '. __('site.project')}}
							</a>


							<a href="{{route('admin.deal.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
							<span class="fa fa-plus"></span> {{__('site.New Deal')}}</a>
						@endif
						</div>
					</div>
				<!--begin::Body-->
				<div class="card-body py-0">
				@include('admin.layouts.advanced-export-deals')
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
$(document).ready(function(){
	$('#advanceButton').click();
});
</script>
