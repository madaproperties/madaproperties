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
@php 
$exportName = request()->fullUrlWithQuery(['exportData' => '1']);
$exportUrl = explode('?',$exportName);
$exportUrl = str_replace($exportUrl[0],route('admin.contact.exportDataContact'),$exportName);
@endphp

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

							<div class="card-toolbar">
								<div class="dropdown dropdown-inline">
									<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="svg-icon svg-icon-md">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"></rect>
												<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
												<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
									    {{ request('filter_status') ? $status->where('id',request('filter_status'))->first()->name : __('site.all')}}
									</button>
									<!--begin::Dropdown Menu-->
									<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
										<!--begin::Navigation-->
										<ul class="navi flex-column navi-hover py-2">

										    <li class="navi-item">
												<a href="{{ request()->has('my-contacts') ? '?my-contacts=get&' : '?'}}" class=" navi-link">
													<span  class="{{ !request('filter_status')  ? 'text-warning': ''}} navi-text">{{ __('site.all') }}</span>
												</a>
											</li>


											@foreach($status as $state)
											<li class="navi-item">
												<a href="{{ request()->has('my-contacts') ? '?my-contacts=get&' : '?'}}filter_status={{$state->id}}" class="navi-link">
													<span	class="{{ request('filter_status') == $state->id  ? 'text-warning': ''}} navi-text">{{$state->name}}</span>
												</a>
											</li>
											@endforeach
										</ul>
										<!--end::Navigation-->
									</div>
									<!--end::Dropdown Menu-->
								</div>

								<!--begin::Button-->
								@can('contact-create')
								<a href="{{route('admin.contact.create')}}" class="btn btn-primary font-weight-bolder">
								<span class="svg-icon svg-icon-md">
									<i class="fa fa-user"></i>
								</span>{{ __('site.New Contacts') }}</a>
								@endcan
								<!--end::Button-->
								    	<!--begin::Button-->


								<!--begin::Button-->

								@can('contact-export')
								<a href="{{$exportUrl}}" class="btn btn-primary font-weight-bolder" target="_blank">
								<span class="svg-icon svg-icon-md">
								<i class="fas fa-database" style="color:#fff"></i>
								</span>{{__('site.export') }}</a>
								@endcan

                @if(userRole() == 'admin')
                <a href="?duplicated=get" class="btn btn-primary font-weight-bolder">
								<span class="svg-icon svg-icon-md">
									<i class="fa fa-users"></i>
								</span>
								    duplicated
								</a>
								<a href="?unassigned=get" class="btn btn-primary font-weight-bolder">
								<span class="svg-icon svg-icon-md">
                                <i class="fas fa-users-slash"></i>
								</span>un unassigned</a>
								@endif
								<!--end::Button-->

								@can('contact-import')
								<div class="dropdown dropdown-inline">
									<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="svg-icon svg-icon-md" style="color:#fff">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
											<i class="fas fa-database" style="color:#fff"></i>
										<!--end::Svg Icon-->
									</span>{{__('site.Import Data') }}</button>
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
												<a href="{{ asset('public/files/mada-import-sampleV2.xlsx') }}" class="navi-link">
													<span class="navi-text">{{__('site.sample') }}</span>
												</a>
											</li>

										</ul>
										<!--end::Navigation-->
									</div>
									<!--end::Dropdown Menu-->
								</div>
								@endcan
								<!--end::Button-->
								<!-- Modal -->
								<div class="modal fade" id="importData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
										<form method="post" id="import-data-form" action="{{route('admin.importData')}}" enctype="multipart/form-data">
								    <div class="modal-content">

								      <div class="modal-body">
													@csrf
												  <div class="form-group">
												    <label for="exampleInputEmail1">File</label>
												    <input type="file" name="file"
														class="form-control" required>
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
						</div>


                       <!--end::Page Title-->
                      <form class="ml-5 formSearchh" action="" >


                          @foreach(request()->all() as $pram => $val)
                          @if($pram != 'search')
                     <input type="hidden" name="{{$pram}}" value="{{$val}}" />
                          @endif
                          @endforeach


											<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
												<input type="text"
                        name="search" style=""
                        class="form-control" id="kt_subheader_search_form" value="{{request('search')}}" placeholder="{{ __('site.search') }}">

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
  										<!--begin::Breadcrumb-->

						<div class="card-body table-responsive" style="padding:20px">



                
                <br />


                @include('admin.layouts.advanced-search')

               
							<!--begin: Datatable-->
				<!--begin::Body-->
				<div class="table-responsive pt-5">
							@if(userRole() != 'sales')
								<div class="{{$contacts->withQueryString()->links() == ''? 'assign-delete-buttons' : 'page-button'}}">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assign-leads">
															Assign <i class="fa fa-users"></i></button>
									@can('contact-delete')
										<button type="button" class="btn btn-primary delete-all">
															Delete <i class="fa fa-trash"></i>
										</button>
									@endcan
								</div>
                			@endif


							{{ $contacts->withQueryString()->links() }}
						<div class="custom-table-responsive">							
							<table class="{{ request()->has('export') ? 'table-export' : ''}} text-center table table-separate table-head-custom table-checkable table-striped" id="" style="padding:20px">

                <thead>
									<tr>
                    @if(userRole() != 'sales')
										<th><input type="checkbox" id="check_all"></th>
                    @endif
										<th>ID</th>
										<th>{{__('site.Name')}}</th>
										<!--<th>{{__('site.Phone')}}</th>-->
										<th>{{__('site.country')}} </th>
										<th>{{__('site.project')}} </th>
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
									@foreach($contacts as $contact)
									
                      <tr id="tr_{{$contact->id}}">
    @if(userRole() != 'sales')
    <td><input type="checkbox" class="checkbox" data-id="{{$contact->id}}"></td>
    @endif

											<td><a class="text-dark" href="{{route('admin.contact.show',$contact->id)}}">
                        {{$contact->id}}</a>
                      </td>
											<td><a class="text-dark" href="{{route('admin.contact.show',$contact->id)}}">
                        {{$contact->fullname}}</a>
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
											@if(userRole() != 'seller')
<td>
    {{$contact->user ? explode('@',$contact->user->name)[0] : ''}}
 </td>
<td>
{{$contact->creator ? explode('@',$contact->creator->name)[0] : ''}}
</td>
											@endif


											<td>
											<div class="editPro">
											@can('contact-delete')
											<form id="destory-{{$contact->id}}" class="delete"
											onsubmit="return confirm('{{__('site.confirm')}}');"
											action="{{ route('admin.contact.destroy',$contact->id) }}" method="POST" >
											@csrf
											@method('DELETE')
											<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$contact->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
											</div>


											@endcan
											</td>
										</tr>



									@endforeach

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
function submitForm(id){
	$("#destory-"+id).submit();
}
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
					url: "{{ route('admin.contacts.multiple-assign') }}",
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
					url: "{{ route('admin.contacts.multiple-delete') }}",
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

<!-- Added By javed -->
<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
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
