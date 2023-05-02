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
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('site.Employee')}}</h5>
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
														<li class="nav-item">
															<a class="nav-link" id="files-tab" data-toggle="tab" href="#files" aria-controls="notes">
																<span class="nav-icon">
																	<i class="fa fa-image"></i>
																</span>
																<span class="nav-text">{{__('site.documents')}}</span>
															</a>
														</li>
														
														<li class="nav-item">
															<a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" aria-controls="additional">
																<span class="nav-icon">
																	<i class="fa fa-edit"></i>
																</span>
																<span class="nav-text">{{__('site.salary')}}</span>
															</a>
														</li>
														
														<!-- <li class="nav-item">
															<a class="nav-link" id="verification-tab" data-toggle="tab" href="#verification" aria-controls="verification">
																<span class="nav-icon">
																	<i class="fa fa-barcode"></i>
																</span>
																<span class="nav-text">{{__('site.verification')}}</span>
															</a>
														</li> -->
													</ul>
					
													<!--begin::Wizard Form-->
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.employee.store')}}" id="kt_form" enctype="multipart/form-data">
														@csrf
														<div class="tab-content mt-5" id="myTabContent">
															<div class="tab-pane fade active show" id="basic" role="tabpanel" aria-labelledby="basic-tab">
																<div class="row col-xl-12">
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.emp no')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="emp_no" type="text" value="{{old('emp_no')}}" placeholder="{{__('site.emp_no')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.official_email')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="official_email" type="email" value="{{old('official_email')}}" placeholder="{{__('site.official_email')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.phone')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="phone" type="text" value="{{old('phone')}}" placeholder="{{__('site.phone')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Address')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<textarea name="address" class="form-control"></textarea>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.emergency contact name')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="emergency_contact" type="text" value="{{old('emergency_contact')}}" placeholder="{{__('site.emergency_contact')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.location')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control form-control-solid form-control-lg" name="location"><option value="">Select</option>
																						<option value="dubai">Dubai</option>
																						<option value="saudi">Saudi Arabia</option>
																					</select>

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
                                                                            <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.date_of_join')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="date_of_join" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.visa_status')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control form-control-solid form-control-lg" name="visa_status">
																						<option value="">Select</option>
																						<option value="visit">Visit Visa</option>
																						<option value="residence">Residence Visa</option>
																						<option value="sponcer">Sponcers</option>
																					</select>

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.visa_exp')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="visa_exp" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																		<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.passport_issue')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="passport_issue" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.emirates_id')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="emirates_id" type="text" value="{{old('emirates_id')}}" placeholder="{{__('site.emirates_id')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.emirates_id_exp')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="emiratesid_exp" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.labourcard_issue')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="labour_card_issue" type="date" value="{{old('labour_card_issue')}}" placeholder="{{__('site.labour_card_issue')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.insurance card issue')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="insurance_issue" type="date" value="" placeholder="">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.reporting_manager')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="reporting_manager" type="text" value="{{old('reporting_manager')}}" placeholder="{{__('site.reporting_manager')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.department')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control form-control-solid form-control-lg" name="department">
																						<option value="">Select</option>
																						<option value="sales">Sales</option>
																						<option value="marking">Marketing</option>
																						<option value="admin">Admin</option>
																						<option value="hr">HR</option>
																						<option value="it">IT</option>
																					</select>

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
	
																			
																		</div>
																	</div>
																	
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.employee name')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="employee_name" type="text" value="{{old('employee_name')}}" placeholder="{{__('site.employee_name')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group--> 
                                                                            <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.personel_email')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="personel_email" type="email" value="{{old('personel_email')}}" placeholder="{{__('site.personel_email')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.alternative_phone')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="alternative_phone" type="text" value="{{old('alternative_phone')}}" placeholder="{{__('site.alternative_phone')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.home address')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<textarea name="home_address" class="form-control"></textarea>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.emergency contact phone')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="emergency_phone" type="text" value="{{old('emergency_phone')}}" placeholder="{{__('site.emergency_phone')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.nationality')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<select class="form-control form-control-solid form-control-lg" name="country_id">
																						<option value="">Select</option>
																					    @foreach($countries as $country)
																					    <option value="{{$country->id}}">{{$country->name_en}}</option>
																						@endforeach
																					</select>

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
                                                                        <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.date_of_birth')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="date_of_birth" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.visa_issue')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="visa_issue" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
                                                                            <div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.passport_no')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="passport_no" type="text" value="{{old('passport_no')}}" placeholder="{{__('site.passport_no')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!-- end:Group -->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.passport_exp')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="passport_exp" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.emirates_id_issue')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="date" name="emirates_id_issue" class="form-control form-control-solid form-control-lg">

																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.labour_card')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="labour_card" type="text" value="{{old('labour_card')}}" placeholder="{{__('site.labour_card')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.insurance_card')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="insurance_card" type="text" value="{{old('insurance_card')}}" placeholder="{{__('site.insurance_card')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.insurance_card_exp')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="insurance_card_exp" type="date" value="{{old('labour_card_exp')}}" placeholder="{{__('site.labour_card_exp')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.designation')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="designation" type="text" value="{{old('designation')}}" placeholder="{{__('site.designation')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																		</div>
																	</div>
																</div>
															</div>
															<div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
																	

																
																<div class="row col-xl-12">
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																		
																		<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.photo')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="photo" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																		<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.passport_no')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_passport" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.visa')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_visa" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
                                                                         <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.labour card')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_labour_card" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.education_docs')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_education" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.previous_exp_certificate')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_pre_exp" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div> 
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.mol ontract')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="mol_contract" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.commission letter')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="commission_letter" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.warning letter')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="warning_letter" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.offer_letter')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="offer_letter" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.emirates_id')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_emirates_id" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																		

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.medical_certificate')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="medical_certificate" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.insurance card')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_insurance_card" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.resume')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="resume" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.previous_visa')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="doc_pre_visa" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.increment letter')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="increment_letter" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.resignation letter')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="resignation_letter" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.termination letter')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input type="file" name="tremination_letter" class="form-control form-control-solid form-control-lg">
																				</div>
																			</div>
																			<!--end::Group-->


																		</div>
																	</div>
																</div>
															</div></div>
															<div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
																<div class="row col-xl-12">
																	<div class="col-xl-6">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.basic_salary')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="basic_salary" type="text" value="{{old('basic_salary')}}" placeholder="{{__('site.basic_salary')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.hra')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="hra" type="text" value="{{old('hra')}}" placeholder="{{__('site.hra')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.other_allowance')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="other_allowance" type="text" value="{{old('other_allowance')}}" placeholder="{{__('site.other_allowance')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.total_salary')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="total_salary" type="text" value="{{old('total_salary')}}" placeholder="{{__('site.total_salary')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->


																			
																			
																		</div>
																	</div>
																	<div class="col-xl-6">

																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			

																			

																			

																			
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

