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
//$exportUrl = str_replace($exportUrl[0],route('admin.busnisess-development-leads.exportDataDeals'),$exportName);
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
						<span class="text-muted mt-3 font-weight-bold font-size-sm">count {{__('site.leads')}}</span>
					</h3>
					<div class="card-toolbar">

					@can('busniess-development-create')
						<a href="{{route('admin.business-development-leads.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-plus"></span> {{__('site.New Lead')}}</a>
							<div class="dropdown dropdown-inline mr-2">
							<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="svg-icon svg-icon-md" style="color:#fff">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
									<i class="fas fa-database" style="color:#fff"></i>
								<!--end::Svg Icon-->
							</span>{{__('site.Import Data') }}</button>
							<!--begin::Dropdown Menu-->
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
										<a href="{{ asset('public/files/business-leads-import-samplev1.xlsx') }}" class="navi-link">
											<span class="navi-text">{{__('site.sample') }}</span>
										</a>
									</li>

								</ul>
								<!--end::Navigation-->
							</div>
							<!--end::Dropdown Menu-->
						</div>
					@endcan
					</div>
					<!-- Modal -->
					<div class="modal fade" id="importData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<form method="post" id="import-data-form" action="{{route('admin.importBusinessLeadsData')}}" enctype="multipart/form-data">
								<div class="modal-content">

									<div class="modal-body">
											@csrf
										<div class="form-group">
											<label for="exampleInputEmail1">File</label>
											<input type="file" name="file" class="form-control" required>
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
				</div>
				<!--end::Header-->
			   <!--  -->
               <form class="ml-5 formSearchh" action="" >


                         
                     <input type="hidden" name="" value="" />
                         


											<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
												<input type="text"
                        name="search" style=""
                        class="form-control" id="kt_subheader_search_form" value="" placeholder="{{ __('site.search') }}">

												<div

												class="input-group-append">
													<span class="input-group-text">
														<span class="svg-icon">
															<button type="submit" class="btn btn-sm btn-success ">
															    <i
															    style="font-size: 14px;padding: 6px;"
															    class="fas fa-search  "></i>
															 </button>
														</span>
														<!--<i class="flaticon2-search-1 icon-sm"></i>-->
													</span>
												</div>

											</div>
										  </form>

			   <!--  -->
           
				<!--begin::Body-->
				<div class="card-body py-0">
					@if(userRole() != 'business developement sales')
						<div class="assign-delete-buttons">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assign-busnisess-development-leads">
													Assign <i class="fa fa-users"></i></button>
							@can('commercial-delete')
								<button type="button" class="btn btn-primary delete-all">
													Delete <i class="fa fa-trash"></i>
								</button>
							@endcan
						</div> 
					@endif

					<!--begin::Table-->
					<div class="table-responsive">
					
					<div class="custom-table-responsive">							
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
								@if(userRole() != 'business developement sales')
									<th><input type="checkbox" id="check_all"></th>
								@endif								
									<th>{{__('site.country')}}</th>
									<th>{{__('site.brand_name')}}</th>
									<th>{{__('site.activity')}}</th>
									<th>{{__('site.activity_type')}}</th>
									@if(userRole() != 'business developement sales')
									<th>{{__('site.Assigned To')}}</th>
									<th>{{__('site.Created By')}}</th>

									@endif
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody> 
								@foreach($business_leads as $business)
								<tr>
									@if(userRole() != 'business developement sales')
									<td><input type="checkbox" class="checkbox" data-id="{{$business->id}}"></td>
									@endif
									<td>
										<a class="text-dark" href="{{route('admin.business-development-leads.detail',$business->id)}}">
											<span class="text-muted font-weight-bold">{{$business->country}}</span>
										</a>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$business->brand_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$business->business_category}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$business->activity_type}}</span>
									</td>
									
									@if(userRole() != 'business developement sales')
									<td>
									{{$business->user ? explode('@',$business->user->name)[0] : ''}}
									</td>
									<td>
									{{$business->creator ? explode('@',$business->creator->name)[0] : ''}}
									</td>
									@endif
									
									<td>
										<div class="editPro">
									@can('busniess-development-edit')
									<a href="{{route('admin.business-development-leads.detail',$business->id)}}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="View details"><i class="fa fa-eye"></i></a>																						
									@endcan
									@can('busniess-development-edit')
									<a href="{{route('admin.business-development-leads.show',$business->id)}}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit"><i class="fa fa-edit"></i></a>																						
									@endcan
									@can('busniess-development-delete')
											<form id="destory-" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('')"></i></a>
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
						<!-- links -->
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

$(document).ready(function () {
	$('#check_all').on('click', function(e) {
		if($(this).is(':checked',true)){
			$(".checkbox").prop('checked', true);
		} else {
			$(".checkbox").prop('checked',false);
		}
	});
	$('.checkbox').on('click',function(){
		if($('.checkbox:checked').length == $('.checkbox').length){
			$('#check_all').prop('checked',true);
		}else{
			$('#check_all').prop('checked',false);
		}
	});

	// Assign multiple leads
	$('.assign-all').on('click', function(e) {
		var idsArr = [];
		$(".checkbox:checked").each(function() {
			idsArr.push($(this).attr('data-id'));
		});
		if(idsArr.length <=0){
			alert("Please select atleast one Lead.");
		}  else {
			if(confirm("Are you sure, you want to Assign Selected Leads ?")){

				if(!$('#assigned-seller').val())
				{
					return alert('please select User To Assign To');
				}
				var strIds = idsArr.join(",");
				$.ajax({
					url: "{{ route('admin.business-development-leads.multiple-assign') }}",
					type: 'POST',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: 'ids='+strIds+"&id="+$('#assigned-seller').val(),
					success: function (data) {
						console.log(data);
						if (data.status == true) {
							location.reload();
						} else {
							alert('Whoops Something went wrong!!');
						}
					}, error: function (data) {
						alert(data.responseText);
					}
				});
			}
		}
	});

	// Added by Javed to delete multiple records
	$('.delete-all').on('click', function(e) {
		var idsArr = [];
		$(".checkbox:checked").each(function() {
			idsArr.push($(this).attr('data-id'));
		});
		if(idsArr.length <=0){
			alert("Please select atleast one Lead.");
		}  else {
			if(confirm("Are you sure, you want to Delete Selected Leads ?")){

				var strIds = idsArr.join(",");
				$.ajax({ 
					url: "{{ route('admin.business-development-leads.multiple-delete') }}",
					type: 'POST',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: 'ids='+strIds,
					success: function (data) {
						if (data.status == true) {
							location.reload();
						} else {
							alert('Whoops Something went wrong!!');
						}
					}, error: function (data) {
						alert(data.responseText);
					}
				});
			}
		}
	});
	//End 

});

</script>
@endpush	

