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
						<span class="card-label font-weight-bolder text-dark">{{__('site.bookings')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$data_count}} {{__('site.bookings')}}</span>
					</h3>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->
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
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.payment ref.')}}</th>
									<th>{{__('site.project details')}}</th>
									<th>{{__('site.customer details')}}</th>
									<th>{{__('site.created_at')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $rs)
								<tr>
									<td>
										@php
											$paymentData = json_decode($rs->payment_response , true);
										@endphp
										<p class="text-muted font-weight-bold">{{$paymentData['paymentId']}}</p>
									</td>
									<td>
										<p class="text-muted font-weight-bold">{{__('site.project name')}} : <a class="web-project" href="{{route('projectdata.view',$rs->unit->project_id)}}" target="_blank"> {{$rs->unit->project->name}}</a></p>
										<p class="text-muted font-weight-bold">{{__('site.unit_name')}} : {{$rs->unit->unit_name}}</p>
									</td>
									<td>
										@php
											$customerData = json_decode($rs->customer_info , true);
										@endphp
										<span class="text-muted font-weight-bold">{{ucfirst(__('site.name'))}} : {{$customerData['CustomerName']}}</span><br>
										<span class="text-muted font-weight-bold">{{ucfirst(__('site.email'))}} : {{$customerData['CustomerEmail']}}</span><br>
										@if($customerData['CustomerCivilId'])
											<span class="text-muted font-weight-bold">{{__('site.PassportNumber')}} : {{$customerData['CustomerCivilId']}}</span><br>
										@endif
										@if($customerData['CustomerMobile'])
											<span class="text-muted font-weight-bold">{{__('site.mobile no.')}} : {{$customerData['CustomerMobile']}}</span><br>
										@endif
										@if($customerData['InvoiceValue'])
											<span class="text-muted font-weight-bold">{{__('site.InvoiceAmount')}} : SAR {{$customerData['InvoiceValue']}}</span>
										@endif
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$rs->created_at}}</span>
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$data->links()}}
						</table>
						{{$data->links()}}
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
