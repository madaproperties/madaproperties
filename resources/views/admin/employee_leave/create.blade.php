@extends('admin.layouts.main')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">

         	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
				<!--begin::Subheader-->
				<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
					<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
						<!--begin::Details-->
						<div class="d-flex align-items-center flex-wrap mr-2">
							<!--begin::Title-->
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.Employee Leave')}}</h5>
							<!--end::Title-->
							<!--begin::Separator-->
							<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
							<!--end::Separator-->

						</div>
						<!--end::Details-->
						<!--begin::Toolbar-->

						<!--end::Toolbar-->
					</div>
				</div>
				<!--end::Subheader-->

				<!--begin::Entry-->
				<div class="d-flex flex-column-fluid">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Card-->
						<div class="card card-custom card-transparent">
							<div class="card-body p-0">
								<!--begin::Wizard-->
								<div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">

									<!--begin::Card-->
									<div class="card card-custom card-shadowless rounded-top-0">
										<!--begin::Body-->
										<div class="card-body p-0">
											<div class="row py-8 px-8 py-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-12">
													<ul class="nav nav-tabs" id="myTab" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic">
																<span class="nav-icon">
																	<i class="fa fa-building"></i>
																</span>
																<span class="nav-text">{{__('site.basic')}}</span>
															</a>
														</li>
														
													</ul>
					
													<!--begin::Wizard Form-->
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.employee_leave.store')}}" id="kt_form" enctype="multipart/form-data">
														@csrf
														<div class="tab-content mt-5" id="myTabContent">
															<div class="tab-pane fade active show" id="basic" role="tabpanel" aria-labelledby="basic-tab">
																<div class="row col-xl-12">
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.employee')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control form-control-solid form-control-lg" name="employee_id">
																						<option value="">Select</option>
																						@foreach($employees as $employee)
                                                                                          <option value="{{$employee->id}}">{{$employee->employee_name}}</option>
																						@endforeach
																						
																					</select>

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>

																			<!--end::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.start_date')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="start_date" type="date" value="{{old('emp_no')}}" >
																					
																				</div>
																			</div>
																			<!--  -->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Description')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<textarea class="form-control form-control-solid form-control-lg" 	name="description"  value="{{old('emp_no')}}"></textarea>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>

																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			
																			
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
                                                                            <!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->

																			
																		</div>
																	</div>
																	
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.leave')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control form-control-solid form-control-lg" name="leave_id">
																						<option value="">Select</option>
																						@foreach($leaves as $leave)
																						<option value="{{$leave->id}}">{{$leave->leave_name}}</option>
																						@endforeach
																					</select>

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

                                                                            <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.end_date')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="end_date" type="date">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
                                                                        <!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
                                                                            <!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->
																			<!--begin::Group-->
																			
																			<!--end::Group-->

																		</div>
																	</div>
																</div>
															</div>
															
															
															
																													
														</div>
														<div class="col-xl-12">																				
															<!--begin::Wizard Actions-->
															<div class="d-flex justify-content-between border-top pt-10 mt-15">
																<div>
																	<input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
																</div>
															</div>
															<!--end::Wizard Actions-->
														</div>
													</div>
													
												</form>
													<!--end::Wizard Form-->
												</div>
											</div>
										</div>
										<!--end::Body-->
									</div>
									<!--end::Card-->
								</div>
								<!--end::Wizard-->
							</div>
						</div>
					<!--end::Card-->
					</div>
				<!--end::Container-->
				</div>
			<!--end::Entry-->
			</div>
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->
</div>
<!--end::Content-->
@include('admin.property.image_uploader')
@include('admin.property.document_uploader')

@include('admin.property.portals')
@endsection

@push('js')
<script>
var KTCkeditor = function () {    
	var demos = function () {
		ClassicEditor
			.create( document.querySelector( '#description' ) )
			.then( editor => {
			})
			.catch( error => {
				console.error( error );
			});
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();
// Initialization
KTCkeditor.init();
</script>
@endpush

