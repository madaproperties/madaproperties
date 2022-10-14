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
						<span class="card-label font-weight-bolder text-dark">{{__('site.developer name')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$data_count}} {{__('site.developer')}}</span>
					</h3>
					<div class="card-toolbar">
						<a href="{{route('admin.project-developer.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-plus"></span> {{__('site.new').' '.__('site.developer name')}}</a>
					</div>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->

				<!--begin::Body-->
				<div class="card-body py-0">
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.developer name')}}</th>
									<th>{{__('site.bank_name')}}</th>
									<th>{{__('site.iban')}}</th>
									<th>{{__('site.created_at')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $deal)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{!empty($deal->bank_name) ? $deal->bank_name : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{!empty($deal->iban) ? $deal->iban : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->created_at}}</span>
									</td>
									<td>
										<a href="{{ route('admin.project-developer.show',$deal->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
										<form id="destory-{{$deal->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
											action="{{ route('admin.project-developer.destroy',$deal->id) }}" method="POST" >
											@csrf
											@method('DELETE')
											<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
											<i class="fa fa-trash" onclick="submitForm('{{$deal->id}}')"></i></a>
											<button type="submit" style="display:none"></button>
										</form>
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
