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
$exportUrl = str_replace($exportUrl[0],route('admin.property.index'),$exportName);

//$saleCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&sale_rent=1'.'&ADVANCED=search'.'&status=1';
//$rentCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&sale_rent=2'.'&ADVANCED=search'.'&status=1';
//$commercialSaleCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&property_type=2'.'&sale_rent=1'.'&ADVANCED=search';
//$commercialRentCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&property_type=2'.'&sale_rent=2'.'&ADVANCED=search';
//$pendingApprovalCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&status=4'.'&ADVANCED=search';
//$offlinePropertyCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&status=6'.'&ADVANCED=search';

$saleCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&sale_rent=1'.'&ADVANCED=search'.'&status=1&'.'user_id='.request()->get('user_id');
$rentCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&sale_rent=2'.'&ADVANCED=search'.'&status=1&'.'user_id='.request()->get('user_id');
$commercialSaleCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&property_type=2'.'&sale_rent=1'.'&ADVANCED=search&'.'user_id='.request()->get('user_id');
$commercialRentCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&property_type=2'.'&sale_rent=2'.'&ADVANCED=search&'.'user_id='.request()->get('user_id');
$pendingApprovalCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&status=4'.'&ADVANCED=search&'.'user_id='.request()->get('user_id');
$offlinePropertyCountUrl = route('admin.property.index').'?pt='.request()->get('pt').'&status=6'.'&ADVANCED=search&'.'user_id='.request()->get('user_id');


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
						<span class="card-label font-weight-bolder text-dark">{{__('site.property')}}</span>
						<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$property_count}} {{__('site.property')}}</span>
					</h3>
					<div class="card-toolbar">


						@can('property-export')
						<a href="" class="btn btn-primary font-weight-bolder" id="exportButton" target="_blank" onclick="exportdata()">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>
                        @endcan	
                        <a href="{{$exportUrl}}" class="btn btn-primary font-weight-bolder" target="_blank">
							<span class="svg-icon svg-icon-md">
							<i class="fas fa-database" style="color:#fff"></i>
							</span>{{__('site.export') }}
						</a>
						@can('property-create')
							<a href="{{route('admin.property.create',array_merge(request()->all()))}}" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
							<span class="fa fa-plus"></span> {{__('site.New property')}}</a>
                        @endcan						
					</div>
				</div>
				<div class="card-header border-0 py-5">
					<div class="card-toolbar">
						<a href="{{$saleCountUrl}}" class="btn btn-primary font-weight-bolder">
							{{__('site.sale') .'('.$propertyData['sale_count'].')' }}
						</a>
						<a href="{{$rentCountUrl}}" class="btn btn-primary font-weight-bolder">
							{{__('site.rent') .'('.$propertyData['rent_count'].')' }}
						</a>
						<a href="{{$commercialSaleCountUrl}}" class="btn btn-primary font-weight-bolder">
							{{__('site.commercial') .' '.__('site.sale') .'('.$propertyData['commercial_sale_count'].')' }}
						</a>
						<a href="{{$commercialRentCountUrl}}" class="btn btn-primary font-weight-bolder">
							{{__('site.commercial') .' '.__('site.rent') .'('.$propertyData['commercial_rent_count'].')' }}
						</a>
						<a href="{{$pendingApprovalCountUrl}}" class="btn btn-primary font-weight-bolder">
							{{'Pending Approval ('.$propertyData['pending_approval_count'].')' }}
						</a>
						<a href="{{$offlinePropertyCountUrl}}" class="btn btn-primary font-weight-bolder">
							{{'Offline Property ('.$propertyData['offline_property_count'].')' }}
						</a>
					</div>
				</div>
				<!--end::Header-->
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
					@include('admin.layouts.advanced-search-properties')
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.id')}}</th>
									<th>{{__('site.ref')}}</th>
									<th>{{__('site.permit_no')}}</th>
									<th>{{__('site.category')}}</th>
									<th>{{__('site.status')}}</th>
									<th>{{__('site.title')}}</th>
									<th>{{__('site.Agent')}}</th>
									<th>{{__('site.created_at')}}</th>
									<th>{{__('site.updated_at')}}</th> 
									<!-- added by fazal 09-07-2024 -->
									<th>{{__('site.listed_days')}}</th> 
									 <!-- end -->
									<th style="min-width:150px">{{__('site.action')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($properties as $property)
								<tr>
									<td>
										<span>{{$property->id}}</span>
									</td>
									<td>
										<span>{{$property->crm_id}}</span>
										<p><b>Type : {{$property->sale_rent == 1 ? 'Sale' : 'Rent'}}</b></p>
									</td>
									<td>
										<span>{{$property->str_no}}</span>
									</td>
									<td>
										<span>{{$property->category ? $property->category->category_name : 'N/A'}}</span>
										<p><b>Location :{{$property->communityId ? $property->communityId->name_en : 'N/A'}}</b></p>
										@if($property->building_name)
											<p><b>
												{{$property->building_name}}</b></p>
										@endif
									</td>
									<td>
									    @if($property->off_line_property==1)
									    <span>Offline Property</span>
									    @else
									    <span>{{__('config.status.'.$property->status)}}</span>
									    @endif
										
										@if($property->sale_rent == 1)
											<p><b>Price : {{$property->price ? $property->price : $property->yprice}}</b></p>
										@else
											@if($property->yprice)
												<p><b>Yearly Price : {{ $property->yprice }}</b></p>
											@elseif($property->mprice)
												<p><b>Monthly Price : {{ $property->mprice }}</b></p>
											@elseif($property->wprice)
												<p><b>Weekly Price : {{ $property->wprice }}</b></p>
											@else
												<p><b>Price : {{ $property->price }}</b></p>
											@endif
										@endif
			
									</td>
									<td>
										<span>{{$property->title}}</span>
										<p>Beds :
										 
										 @if($property->bedrooms==0)
										<span>Studio</span>
										@else
										{{$property->bedrooms}}
										@endif
										
										</p>
									</td>
									<td>
										<span>Agent :{{$property->agent ? explode('@',$property->agent->name)[0] : ''}}
                                        </span>
										
									</td>
									<td>
										<span>{{($property->created_at)}}</span>
									</td>																		
									<td>
										<span>{{($property->last_updated)}}</span>
									</td>
									<!--added by fazal on 09-07-2024  -->
                                     <td>
                                      @php
										 $fromDate = Carbon\Carbon::parse($property->created_at);
                                         $toDate = Carbon\Carbon::parse(Carbon\Carbon::now());
                                         $days = $fromDate->diffInDays($toDate);
                                         echo('created '.$days.' days ago'); 
										@endphp
									</td>
									<!-- end -->
									<td>
									<div class="editPro">
										@can('property-edit')
											@if(userRole() == 'admin'  || userRole() == 'sales admin uae')
												<a href="{{ route('admin.property.show',$property->id).'?'.http_build_query(['pt'=>request()->get('pt')]) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details in english"><i class="fa fa-edit"></i></a>																						
											@else
												<a href="{{ route('admin.property.show',$property->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details in english"><i class="fa fa-edit"></i></a>																						
											@endif
										@endif
										<a href="{{ route('property.brochure',$property->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Brochure"><i class="fa fa-print"></i></a>																						
										@can('property-delete')
											<form id="destory-{{$property->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
												action="{{ route('admin.property.destroy',$property->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
												<i class="fa fa-trash" onclick="submitForm('{{$property->id}}')"></i></a>
												<button type="submit" style="display:none"></button>
											</form>
										@endif
	</div>
									</td>
								</tr>
								@endforeach
							</tbody>
							{{$properties->withQueryString()->links()}}
						</table>
						{{$properties->withQueryString()->links()}}
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
