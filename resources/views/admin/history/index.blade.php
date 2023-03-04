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
						<span class="card-label font-weight-bolder text-dark">{{__('site.history')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$data_count}} {{__('site.history')}}</span>
					</h3>
					<div class="card-toolbar">

					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-0">
					@include('admin.layouts.advanced-search-history')				
					<br>
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="table table-separate table-head-custom table-checkable table-striped"  style="padding:20px">
							<tbody>
								@foreach($data as $rs)
								<tr>
									<td>
										@if($rs->request_type == 'added')
											@php($action = " <span class='bg-success text-white'>".$rs->request_type."</span>")
										@elseif($rs->request_type == 'deleted')
											@php($action = " <span class='bg-danger text-white'>".$rs->request_type."</span>")
										@elseif($rs->request_type == 'updated')
											@php($action = " <span class='bg-info text-white'>".$rs->request_type."</span>")
										@endif
										@if(!empty($rs->other_details))	
											@php($other_details = "(".$rs->other_details.")")
										@else
											@php($other_details = "")
										@endif				

										@if($rs->request_type != 'added')
											{!!$rs->module_name. ' #'.$rs->module_id. $action. $other_details.' by <b>'. $rs->user->name. '</b> at '.date('d-m-Y h:i A',strtotime($rs->created_at))!!}
										@else
											{!! 'New record '.$action.' in '.$rs->module_name. ' by <b>'. $rs->user->name. '</b> at '.date('d-m-Y h:i A',strtotime($rs->created_at))!!}
										@endif

										@if($rs->request_type == 'updated')
											<table class="">
												<tr>
													<td>Before update</td>
													<td>After update</td>
												</tr>
												<tr>
													<td><pre>{{ $rs->old_data}}</pre></td>
													<td><pre>{{ $rs->update_data}}</pre></td>
												</tr>												
											</table>
										@elseif($rs->request_type == 'added')
											<table class="">
												<tr>
													<td>Form data</td>
												</tr>
												<tr>
													<td><pre>{{ $rs->update_data}}</pre></td>
												</tr>												
											</table>
										@endif
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
@push('js')
<!-- Added By javed -->

<script>
	$('.date').datepicker({
    //format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });

  $('#to-deal').datepicker({
		//format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });
</script>
@endpush

