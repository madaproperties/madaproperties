@extends('admin.layouts.main')

@push('css')
    <style>
        p {
            color:#000;
        }
    </style>
@endpush
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:10px">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">

									<!--end::Mobile Toggle-->
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">{{__('site.Notofications')}}</h5>
										<!--end::Page Title-->

									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->

							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Change Password-->
								<div class="d-flex flex-row">
									<!--begin::Aside-->
									@include('admin.layouts.aside')
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">

												<!--begin::List Widget 10-->
												<div class="card card-custom card-stretch gutter-b">
													<!--begin::Header-->
													<div class="card-header border-0">
<h3 class="card-title font-weight-bolder text-dark">{{__('site.Notofications')}}({{count($notes)}})</h3>
													</div>
													<!--end::Header-->
													<!--begin::Body-->
													<div class="card-body pt-0">
														<!--begin::Item-->

@foreach($notes as $note)
<div class="mb-6" style="background: #fafbfc;padding: 10px;border: 1px solid #eee;">
<!--begin::Content-->
<div class="d-flex align-items-center flex-grow-1">
<!--begin::Section-->
<div class=" flex-wrap align-items-center justify-content-between w-100">
	<!--begin::Info-->
	<div class="d-flex flex-column align-items-cente py-2 w-75">
		<!--begin::Title-->
{!! $note->description !!}
		<!--end::Title-->
		<!--begin::Data-->
		<span class="text-muted font-weight-bold" style="margin:5px 0">
			<span class="flaticon-calendar-with-a-clock-time-tools"></span>
			{{$note->created_at->diffForHumans()}}
		</span>
		<span class="text-muted font-weight-bold">
			<span class="flaticon-user"></span>
			{{$note->createor ? $note->createor->name : __('site.unknown')}}
		</span>
		<br />
		@if(!$note->completed)
		<a href="{{route('admin.notofications.switch',$note->id)}}" class="btn btn-success" style="width:10%">
		    <i class="fa fa-check"></i>
		</a>
		@else 
		<a href="{{route('admin.notofications.switch',$note->id)}}" class="btn btn-danger" style="width:10%">
		    <i class="fa fa-times"></i>
		</a>
		@endif
		<!--end::Data-->
	</div>
	<!--end::Info-->
</div>
<!--end::Section-->
</div>
<!--end::Content-->
</div>
<!--end::Item-->
@endforeach
</div>
													<!--end: Card Body-->
												</div>
												<!--end: Card-->

									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Change Password-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>

@endsection
