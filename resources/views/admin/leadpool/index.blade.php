@push('css')
    <style>
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
	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
		   <div class="container">
				 <!--begin::Card-->
					<div class="card card-custom gutter-b">
						<div class="card-header flex-wrap border-0 pt-6 pb-0">
							<div class="card-title">
								<h3 class="card-label">{{ __('site.contacts') }}
								<span class="d-block text-muted pt-2 font-size-sm">{{$contactsCount}} Contact's</span></h3>
							</div>

							<!--begin: Datatable-->
							@include('admin.layouts.advanced-search-lead-pool')
							<!--begin::Body-->
							<div class="table-responsive pt-5">
									<div class="{{$contacts->withQueryString()->links() == ''? 'assign-delete-buttons' : 'page-button'}}">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assign-leads-pool-confirm">
																Assign to me <i class="fa fa-plus"></i></button>
										
									</div>
								{{ $contacts->withQueryString()->links() }}
						<div class="custom-table-responsive">							
							<table class="{{ request()->has('export') ? 'table-export' : ''}} text-center table table-separate table-head-custom table-checkable table-striped" id="" style="padding:20px">
								<thead>
									<tr>
										<th><input type="checkbox" id="check_all"></th>
										<th>ID</th>
										<th>{{__('site.Name')}}</th>
										<!--<th>{{__('site.Phone')}}</th>-->
										<th>{{__('site.country')}} </th>
										<th>{{__('site.project')}} </th>
										<th>{{__('site.status')}}</th>
										<th>{{__('site.Created')}}</th>
										<th>{{__('site.Last Updated')}}</th>
										<th>{{__('site.Assigned To')}}</th>
										<th>{{__('site.Created By')}}</th>
									</tr>
								</thead>
								<tbody>
								@if(count($contacts))
									@php
									$userDataTemp = \App\User::where('id',auth()->id())->first();
									@endphp
									@foreach($contacts as $contact)
										@if(($userDataTemp->time_zone=='Asia/Dubai' && date('l') != 'Sunday') || ($userDataTemp->time_zone=='Asia/Riyadh' && date('l') != 'Friday'))

										<tr id="tr_{{$contact->id}}">
											<td><input type="checkbox" class="checkbox" data-id="{{$contact->id}}"></td>
											<td>
											{{$contact->id}}
											</td>
											<td>
												{{$contact->fullname}}
											</td>

											<td>{{$contact->country ? $contact->country->name : ''}}</td>
											<td>{{$contact->project ? $contact->project->name : ''}}</td>
											<td>{{$contact->status?$contact->status->name : ''}}</td>
											<td>
												{{ timeZone($contact->created_at) }}
											</td>
											<td>
												{{ !empty($contact->updated_at) ? timeZone($contact->updated_at) : 'N/A' }}
											</td>
											<td>
												{{$contact->user ? explode('@',$contact->user->name)[0] : ''}}
											</td>
											<td>
											{{$contact->creator ? explode('@',$contact->creator->name)[0] : ''}}
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="10">No data found</td>
									</tr>
								@endif
								</tbody>
							</table>
							</div>
							{{ $contacts->withQueryString()->links() }}
							<!--end: Datatable-->
						</div>
					</div>
					</div>
					<!--end::Card-->
       </div>
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->

@endsection
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
		} else if(idsArr.length > 5){
			alert("You can not select more than 5 leads at time in one day.");
		}  else {
			var strIds = idsArr.join(",");
			$.ajax({
				url: "{{ route('admin.leadpool.multiple-assign') }}",
				type: 'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: 'ids='+strIds,
				success: function (data) {
					if (data.status == true) {
						window.location.href = "{{ route('admin.lead-pool.index') }}";
					} else {
						alert(data.message);
					}
				}, error: function (data) {
					alert(data.responseText);
				}
			});
		}
	});

});
</script>

<!-- Added By javed -->
<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endpush
