@extends('admin.layouts.main')
@section('content')
@php 
$exportName = request()->fullUrlWithQuery(['exportData' => '1']);
$exportUrl = explode('?',$exportName);
$exportUrl = str_replace($exportUrl[0],route('admin.deal-developer.exportDataDeveloper'),$exportName);
@endphp

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
						<span class="card-label font-weight-bolder text-dark">{{__('site.developer')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$deals_count}} {{__('site.developer')}}</span>
					</h3>
					<div class="card-toolbar">
						@can('deal-developer-export')
						<a href="{{$exportUrl}}" class="btn btn-primary font-weight-bolder" target="_blank">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>
						@endcan

						@can('deal-developer-create')
						<a href="{{route('admin.deal-developer.create')}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
						<span class="fa fa-plus"></span> {{__('site.new').' '.__('site.developer')}}</a>
						@endcan
					</div>
				</div>
				<!--end::Header-->
				<!--end::Page Title-->
				

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
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.country')}}</th>
									<th>{{__('site.developer')}}</th>
									<th>{{__('site.company_address')}}</th>
									<th>{{__('site.trn')}}</th>
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($deals as $deal)
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->country ? $deal->country->name : 'N/A'}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->name_en}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->company_address}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$deal->trn}}</span>
									</td>
									<td>
										@can('deal-developer-edit')
										<a href="{{ route('admin.deal-developer.show',$deal->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a>																						
										@endcan
										@can('deal-developer-delete')
											<form id="destory-{{$deal->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.deal-developer.destroy',$deal->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$deal->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endcan
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$deals->links()}}
						</table>
						{{$deals->links()}}
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
