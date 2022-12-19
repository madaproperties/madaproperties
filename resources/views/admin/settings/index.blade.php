@extends('admin.layouts.main')
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
										<h5 class="text-dark font-weight-bold my-1 mr-5">{{__('site.settings')}}</h5>
										<!--end::Page Title-->

									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->

							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Change Password-->
								<div class="row">
									<!--begin::Aside-->
									@include('admin.layouts.aside')
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="col-sm-8">
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
									<!--begin::Header-->
									<div class="card-header border-0 py-5">
										<h2><i class="fa fa-cog"></i> {{__('site.target')}}</h2>
									</div>
									<!--end::Header-->
									<!--begin::Body-->
									<div class="card-body py-0">

						<form class="form" id="settings-form" method="POST" action="{{route('admin.settings.store')}}">
                        @csrf

                        <div class="card-body">

                        		@foreach($settings_columns as $column)
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-alert">{{$column->name}}</label>
									<div class="col-lg-9 col-xl-6">
										<input type="number" class="form-control form-control-lg form-control-solid mb-2" required="" name="{{$column->name}}" value="{{ $column->value }}">
									</div>
								</div>
								@endforeach

							</div>
							<button type="submit" form="settings-form" class="btn btn-primary mr-2">save</button>
						</form>
										<!--end::Table-->
									</div>
									<!--end::Body-->
								</div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Change Password-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
			

					</div>
					<!--end::Content-->
					</div>

@endsection
