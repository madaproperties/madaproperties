

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

						<a href="#" data-toggle="modal" data-target="#databaseImportData" class="btn btn-success font-weight-bolder font-size-sm">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database"></i>
							</span>{{__('site.Import Data') }}
						</a>
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
				 
                @include('admin.layouts.advance-database')
                

				<!--begin::Body-->
				<div class="card-body table-responsive">


						<!-- Modal -->
						<!--<div class="modal fade" id="assign-leads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
						<!--<div class="modal-dialog" role="document">-->
						<!--	<div class="modal-content">-->
						<!--	<div class="modal-header">-->
						<!--		<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
						<!--		<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
						<!--		<span aria-hidden="true">&times;</span>-->
						<!--		</button>-->
						<!--	</div>-->
						<!--	<div class="modal-body">-->
						<!--		<div class="form-group">-->
						<!--		<label for="exampleFormControlSelect1">users</label>-->
						<!--		<select class="form-control" id="assigned-seller" name="seller">-->
						<!--			@foreach($sellers as $seller)-->
						<!--			<option value="{{$seller->id}}">{{$seller->name}}</option>-->
						<!--			@endforeach-->
						<!--		</select>-->
						<!--		</div>-->
						<!--	</div>-->
						<!--	<div class="modal-footer">-->
						<!--		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
						<!--		<button style="margin: 5px;" class="btn btn-info btn-xs assign-all" data-url="">-->
						<!--		Assing-->
						<!--		</button>-->
						<!--	</div>-->
						<!--	</div>-->
						<!--</div>-->
						<!--</div>-->
						<br />

                

					<!--begin::Table-->
				<div class="table-responsive">
					@if(userRole() != 'sales')
					<div class="{{$data->withQueryString()->links() == ''? 'assign-delete-buttons' : 'page-button'}}">
						<button type="button" class="btn btn-primary"
						data-toggle="modal" data-target="#assign-leads">
						Assing <i class="fa fa-users"></i>
						</button>
					</div>
					@endif					
					{{$data->withQueryString()->links()}}
					<div class="custom-table-responsive">							
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									@if(userRole() != 'sales')
										<th><input type="checkbox" id="check_all"></th>
                                    @endif
										<th>{{__('site.Name')}}</th>
										<th>{{__('site.Phone')}}</th>
										<th>{{__('site.country')}} </th>
										<th>{{__('site.project')}} </th>
										<!--<th>{{__('site.city')}}</th>-->
										<th>{{__('site.status')}}</th>
										<th>{{__('site.Created')}}</th>
										<th>{{__('site.Last Updated')}}</th>
										@if(userRole() != 'seller')
										<th>{{__('site.Assigned To')}}</th>
										<th>{{__('site.Created By')}}</th>

										@endif
										@can('contact-delete')
										<th>#</th>
										@endcan
								</tr>
							</thead>
							<tbody>
								@foreach($data as $rs)
								<tr>
									@if(userRole() != 'sales')
									<td><input type="checkbox" class="checkbox" data-id="{{$rs->id}}"></td>
									@endif
									<td>
										<a class="text-dark" href="{{route('admin.database-records.show',$rs->id)}}">
											<span class="text-muted font-weight-bold">{{$rs->name}}</span>
										</a>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->phone}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->country ? $rs->country->name : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->project_id}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->statusName ? $rs->statusName->name_en : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->created_at}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->updated_at}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold"> {{$rs->user ? explode('@',$rs->user->name)[0] : ''}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->creator ? explode('@',$rs->creator->name)[0] : ''}}</span>
									</td>
									<td>
									<div class="editPro">
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
									</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
						{{$data->withQueryString()->links()}}
					<!--end::Table-->
				</div>
				<!--end::Body-->
			</div>
		</div>
		<!--end::Content-->
	</div>
	<!--end::Profile Change Password-->
</div>
<div class="modal fade" id="databaseImportData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form method="post" id="import-data-form" action="{{route('admin.databaseImportData')}}" enctype="multipart/form-data">
	<div class="modal-content">

		<div class="modal-body">
					@csrf
					<div class="form-group">
						@if(auth()->user()->rule != 'admin' && auth()->user()->time_zone =='Asia/Riyadh' )
					<label for="exampleInputEmail1">File <a href="{{ url('public/files/database-import-sample-ksa.xlsx') }}" target="_blank"> Download example file</a></label>
					@elseif(auth()->user()->rule != 'admin' && auth()->user()->time_zone =='Asia/Dubai' )
					<label for="exampleInputEmail1">File <a href="{{ url('public/files/database-import-sample-uae.xlsx') }}" target="_blank"> Download example file</a></label>
					@else
					<label for="exampleInputEmail1">File <a href="{{ url('public/files/database-import-sample.xlsx') }}" target="_blank"> Download example file</a></label>
					@endif
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
			if(confirm("Are you sure, you want to assign selected records ?")){
				if(!$('#assigned-seller').val())
				{
					return alert('please select User To Assign To');
				}
				var strIds = idsArr.join(",");
				$.ajax({
					url: "{{ route('admin.database.multiple-assign') }}",
					type: 'POST',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: 'ids='+strIds+"&id="+$('#assigned-seller').val(),
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
});
</script>
<script>
	$(`#from-date,#lastupdatefrom-date,#meeting-from-date`).datepicker({
    //format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });

  $(`#to-date,#lastupdateto-date,#meeting-to-date`).datepicker({
		//format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });
</script>
@endpush	
