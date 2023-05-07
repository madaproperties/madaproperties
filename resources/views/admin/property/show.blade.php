@extends('admin.layouts.main')
@section('content')
<style>
	.property_form span.suffixPlot {
    bottom: 17px;
    right: 20px;
}
	@media(max-width:767px){
	.rowCrtt{
    margin:0px !important;
	margin-bottom:15px !important;
	}
	.property_form span.suffixPlot {
    
    right: 15px;
}
	.tabRoleSec li{
		width:50% !important;
		margin:0px !important;
	}
	.tabRoleSec li a{
		text-align:center;
		width:100%;
		display:block !important;
		margin:auto !important;
	}
	.btnCatt .btn{
		padding: 5px 3px;
    font-size: 10px;
    display: block;
	text-align:center;
	}
	.formRdo .radio{
		justify-content:center;
		margin:5px auto !important;
	}
	.property_form span.check{
		width:100% !important;
		text-align:center;
	}
	.rowCrtt .form-control{
		padding:8px 0px !important;
	}

}

</style>
<!--begin::Content-->
<div class="d-flex flex-column flex-column-fluid property_form" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">

         	<div>
				<!--begin::Subheader-->
				<div class="subheader subheader-transparent" id="kt_subheader">
					<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
						<!--begin::Details-->
						<div class="d-flex align-items-center flex-wrap mr-2 ">
							<!--begin::Title-->
							<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"></h5>
							<!--end::Title-->
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
						<div class="card-custom card-transparent">
							<div class="card-body p-0">
								<!--begin::Wizard-->
								<div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">

									<!--begin::Card-->
									<div class="card-custom card-shadowless rounded-top-0">
										<!--begin::Body-->
										<div class="card-body p-0">
											<div class="row px-lg-10">
											<ul class="nav nav-tabs tabRoleSec" id="myTab" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic">
																<span class="nav-icon">
																	<i class="fa fa-building"></i>
																</span>
																<span class="nav-text">{{__('site.property_details')}}</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="files-tab" data-toggle="tab" href="#files" aria-controls="notes">
																<span class="nav-icon">
																	<i class="fa fa-image"></i>
																</span>
																<span class="nav-text">{{__('site.media')}}</span>
															</a>
														</li>
														
														<li class="nav-item">
															<a class="nav-link" id="location-tab" data-toggle="tab" href="#location" aria-controls="location">
																<span class="nav-icon">
																	<i class="fa fa-edit"></i>
																</span>
																<span class="nav-text">{{__('site.location')}}</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" aria-controls="notes">
																<span class="nav-icon">
																	<i class="fa fa-edit"></i>
																</span>
																<span class="nav-text">{{__('site.notes')}}</span>
															</a>
														</li>
														<!--edited by fazal-->
														 @if(userRole() == 'admin' || userRole() == 'sales admin uae') 
														<li class="nav-item">
															<a class="nav-link" id="verification-tab" data-toggle="tab" href="#verification" aria-controls="verification">
																<span class="nav-icon">
																	<i class="fa fa-barcode"></i>
																</span>
																<span class="nav-text">{{__('site.verification')}}</span>
															</a>
														</li>
														@endif
													</ul>
													
												<div class="col-xl-12 col-xxl-12">
													<!--begin::Wizard Form-->
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.property.update',$property->id)}}" id="property_form" enctype="multipart/form-data">
														@csrf
														@method('PATCH')
														<input type="hidden" name="pt" value="{{request()->get('pt')}}">
														<div class="tab-content mt-5" id="myTabContent">
															<div class="tab-pane fade active show" id="basic" role="tabpanel" aria-labelledby="basic-tab">
																<div class="row col-xl-12 card mt-5 rowCrtt">
																	<div class="col-xl-12">
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-12 col-lg-12 col-form-label blue-label">{{__('site.type')}}</label>
																		</div>
																		<!--end::Group-->					

																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container w-100 formSecCust">
																			<div class="row rowTextView">
																				<div class="col-md-6 col-lg-5 col-xxl-3 col-xl-4">
																					<div class="row">
																					<div class="col-xl-6 text-center col-6 formRdo">
																				<label class="col-form-label w-100 text-center lblCust">
																					
																				<input class="form-control radio" name="property_type" type="radio" value="1" {{$property->property_type == 1 ? 'checked' : ''}}>
																				<div class="custCheck">
																				<svg class="property_icons w-100" fill="#000000" height="60px" width="60px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
																						viewBox="0 0 512.213 512.213" xml:space="preserve">
																					<g transform="translate(0 1)">
																						<g>
																							<g>
																								<path d="M489.067,187.8L292.8,13.72c-20.48-19.627-52.907-19.627-73.387,0l-65.707,59.733v-23.04h8.533
																									c5.12,0,8.533-3.413,8.533-8.533V7.747c0-5.12-3.413-8.533-8.533-8.533H59.84c-5.12,0-8.533,3.413-8.533,8.533V41.88
																									c0,5.12,3.413,8.533,8.533,8.533h8.533v98.133L23.147,187.8c-5.973,5.973-7.68,13.653-5.12,21.333
																									c2.56,6.827,10.24,11.947,17.92,11.947h32.427v238.933H59.84c-5.12,0-8.533,3.413-8.533,8.533v34.133
																									c0,5.12,3.413,8.533,8.533,8.533h392.533c4.267,0,8.533-3.413,8.533-9.387v-34.133c0-2.56-0.853-4.267-2.56-5.973
																									c-1.707-1.707-3.413-2.56-5.973-2.56h-8.533V220.227h32.427c8.533,0,15.36-4.267,17.92-11.947
																									C496.747,201.453,495.04,192.92,489.067,187.8z M477.973,203.16c-0.853,0.853-1.707,0.853-1.707,0.853h-40.96
																									c-5.12,0-8.533,3.413-8.533,8.533v256c0,5.12,3.413,8.533,8.533,8.533h8.533v17.067H68.373V477.08h8.533
																									c5.12,0,8.533-3.413,8.533-8.533v-256c0-5.12-3.413-8.533-8.533-8.533h-40.96c-0.853,0-1.707,0-1.707-0.853s0-1.707,0.853-2.56
																									l47.787-40.96c1.707-1.707,2.56-4.267,2.56-6.827V41.88c0-5.12-3.413-8.533-8.533-8.533h-8.533V16.28h85.333v17.067h-8.533
																											c-5.12,0-8.533,3.413-8.533,8.533v51.2c0,3.413,1.707,6.827,5.12,9.387c3.413,0.853,6.827,0.853,9.387-1.707l80.213-73.387
																											c13.653-13.653,34.987-13.653,49.493,0l196.267,174.08C477.973,201.453,478.827,202.307,477.973,203.16z"/>
																										<path d="M375.573,340.547h-70.588c-2.963-5.087-8.466-8.533-14.746-8.533h-8.533v-22.094
																											c24.955-10.182,42.667-34.736,42.667-63.239c0-37.547-30.72-68.267-68.267-68.267s-68.267,30.72-68.267,68.267
																											c0,28.504,17.712,53.058,42.667,63.239v22.094h-8.533c-6.28,0-11.782,3.447-14.746,8.533H136.64
																											c-9.387,0-17.067,7.68-17.067,17.067v51.2c0,9.387,7.68,17.067,17.067,17.067h70.588c2.963,5.086,8.466,8.533,14.746,8.533
																											h68.267c6.28,0,11.782-3.447,14.746-8.533h70.588c9.387,0,17.067-7.68,17.067-17.067v-51.2
																											C392.64,348.227,384.96,340.547,375.573,340.547z M247.573,329.453v-14.507c5.973,0.853,11.093,0.853,17.067,0v14.507H247.573z
																											M205.637,255.213h7.803c5.12,0,8.533-3.413,8.533-8.533s-3.413-8.533-8.533-8.533h-7.803
																											c3.623-21.355,20.581-38.313,41.937-41.937v7.803c0,5.12,3.413,8.533,8.533,8.533c5.12,0,8.533-3.413,8.533-8.533v-7.803
																											c21.355,3.623,38.313,20.581,41.937,41.937h-7.803c-5.12,0-8.533,3.413-8.533,8.533s3.413,8.533,8.533,8.533h7.803
																											c-3.139,18.504-16.289,33.705-33.639,39.794c-0.775-0.031-1.55,0.055-2.325,0.313c-9.387,2.56-19.627,2.56-29.013,0
																											c-0.455,0-0.911,0.004-1.366,0.013C222.411,289.475,208.834,274.057,205.637,255.213z M136.64,357.613h68.267v51.2H136.64
																											V357.613z M221.973,417.347V349.08h68.267v68.267H221.973z M375.573,408.813h-68.267v-51.2h68.267V408.813z"/>
																										<path d="M256.107,255.213c2.56,0,4.267-0.853,5.973-2.56l17.067-17.067c3.413-3.413,3.413-8.533,0-11.947s-8.533-3.413-11.947,0
																											l-17.067,17.067c-3.413,3.413-3.413,8.533,0,11.947C251.84,254.36,253.547,255.213,256.107,255.213z"/>
																									</g>
																								</g>
																							</g>
																							</svg>
                                                                                          
																							{{__('site.residential')}}
																							</div></label>

																							</div>
																							<div class="col-xl-6 text-center col-6 formRdo">
																																											<label class="col-form-label w-100 text-center lblCust">
																																											
																																											<input class="form-control radio" name="property_type" type="radio" value="2" {{$property->property_type == 2 ? 'checked' : ''}}>
																																											<div class="custCheck">
																																											<svg class="w-100" fill="#000000" width="60px" height="60px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M 10 3.8828125 L 3 7.3828125 L 3 28 L 17 28 L 29 28 L 29 10 L 17 10 L 17 7.3828125 L 10 3.8828125 z M 10 6.1171875 L 15 8.6171875 L 15 26 L 5 26 L 5 8.6171875 L 10 6.1171875 z M 7 10 L 7 12 L 9 12 L 9 10 L 7 10 z M 11 10 L 11 12 L 13 12 L 13 10 L 11 10 z M 17 12 L 27 12 L 27 26 L 17 26 L 17 12 z M 7 14 L 7 16 L 9 16 L 9 14 L 7 14 z M 11 14 L 11 16 L 13 16 L 13 14 L 11 14 z M 19 14 L 19 16 L 21 16 L 21 14 L 19 14 z M 23 14 L 23 16 L 25 16 L 25 14 L 23 14 z M 7 18 L 7 20 L 9 20 L 9 18 L 7 18 z M 11 18 L 11 20 L 13 20 L 13 18 L 11 18 z M 19 18 L 19 20 L 21 20 L 21 18 L 19 18 z M 23 18 L 23 20 L 25 20 L 25 18 L 23 18 z M 7 22 L 7 24 L 9 24 L 9 22 L 7 22 z M 11 22 L 11 24 L 13 24 L 13 22 L 11 22 z M 19 22 L 19 24 L 21 24 L 21 22 L 19 22 z M 23 22 L 23 24 L 25 24 L 25 22 L 23 22 z"/></svg>
																																											{{__('site.commercial')}} </div>
																																											
																																										</label>	
																																										</div>
																																										
																																																																													</div>
</div>


<div class="col-md-6 col-lg-5 col-xxl-3 col-xl-4">
	<div class="row">

	<div class="col-xl-6 text-center col-6 formRdo">
																																											<label class="col-form-label w-100 text-center lblCust">
																																											
																							<input class="form-control radio" name="sale_rent" type="radio" value="1" {{$property->sale_rent == 1 ? 'checked' : ''}}>
																							<div class="custCheck">
																																											<svg class="w-100" fill="#000000" height="60px" width="60px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
																								viewBox="0 0 285 285" xml:space="preserve">
																							<g>
																								<g>
																									<path d="M272.046,32.385H12.954C5.798,32.385,0,38.189,0,45.342v194.317c0,7.153,5.798,12.957,12.954,12.957
																										c7.153,0,12.955-5.804,12.955-12.957V58.297h68.015v6.541c-6.349,1.469-11.433,4.976-13.888,9.654H45.341
																										c-3.578,0-6.476,2.898-6.476,6.476v136.024c0,3.575,2.898,6.476,6.476,6.476h207.275c3.575,0,6.476-2.9,6.476-6.476V80.967
																										c0-3.578-2.901-6.476-6.476-6.476h-34.697c-2.453-4.679-7.537-8.186-13.889-9.654v-6.541h68.016
																										c7.156,0,12.954-5.802,12.954-12.955S279.202,32.385,272.046,32.385z M246.134,210.51H51.82V87.446h194.314V210.51z
																										M191.076,64.837c-6.349,1.472-11.433,4.976-13.879,9.654H120.76c-2.449-4.679-7.533-8.183-13.882-9.654v-6.541h84.198
																										L191.076,64.837L191.076,64.837z"/>
																									<path d="M79.229,172.405c-11.829,0-10.193-9.262-16.535-9.262c-2.848,0-4.917,1.992-4.917,4.843c0,5.56,6.63,12.973,21.452,12.973
																										c14.104,0,21.094-6.915,21.094-16.18c0-5.984-2.709-12.326-13.4-14.751l-9.76-2.208c-3.708-0.854-7.984-1.995-7.984-5.554
																										c0-3.569,2.993-6.064,8.408-6.064c10.904,0,9.905,7.626,15.32,7.626c2.854,0,5.347-1.704,5.347-4.626
																										c0-6.843-10.762-11.977-19.881-11.977c-9.905,0-20.454,4.277-20.454,15.679c0,5.489,1.927,11.334,12.546,14.04l13.18,3.349
																										c3.989,0.996,4.988,3.278,4.988,5.347C88.633,169.055,85.284,172.405,79.229,172.405z"/>
																									<path d="M109.507,180.674c2.78,0,4.416-0.931,5.205-3.207l3.064-8.554h18.812l2.99,8.554c0.856,2.276,2.712,3.207,5.276,3.207
																										c2.993,0,5.489-2.282,5.489-5.13c0-1.287-0.717-3.349-1.144-4.494l-14.111-39.265c-1.283-3.634-3.634-4.271-6.271-4.271h-2.78
																										c-2.848,0-4.7,0.924-5.699,3.559l-15.106,39.976c-0.427,1.145-1.138,3.207-1.138,4.494
																										C104.092,178.676,106.3,180.674,109.507,180.674z M127.251,140.197h0.146l6.624,20.596h-13.684L127.251,140.197z"/>
																									<path d="M163.229,179.743H187.6c3.349,0,6.055-1.707,6.055-4.914s-2.706-4.917-6.055-4.917h-19.525v-36.556
																										c0-3.494-2.276-5.841-5.842-5.841s-5.845,2.347-5.845,5.841v39.549C156.388,178.107,159.1,179.743,163.229,179.743z"/>
																									<path d="M207.045,179.743h28.005c3.42,0,5.913-0.993,5.913-4.7c0-3.708-2.493-4.704-5.913-4.704h-23.159v-12.401h19.81
																										c3.065,0,5.489-0.854,5.489-4.49c0-3.634-2.424-4.487-5.489-4.487h-19.81v-11.117h22.59c3.42,0,5.916-0.996,5.916-4.704
																										c0-3.705-2.495-4.701-5.916-4.701h-27.437c-4.131,0-6.84,1.636-6.84,6.837v37.629
																										C200.205,178.107,202.914,179.743,207.045,179.743z"/>
																								</g>
																							</g>
																							</svg>
																							{{__('site.sale')}} </div>

																																											</label>
																																											</div>
										



	<div class="col-xl-6 text-center col-6 formRdo">
																																											<label class="col-form-label w-100 text-center lblCust">
																																											<input class="form-control radio" name="sale_rent" type="radio" value="2" {{$property->sale_rent == 2 ? 'checked' : ''}}>
																																											<div class="custCheck">
																																											<svg class="w-100" fill="#000000" height="60px" width="60px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
																								viewBox="0 0 512 512" xml:space="preserve">
																							<g>
																								<g>
																									<path d="M211.772,239.087c3.797-2.022,7.023-4.548,9.651-7.578c4.702-5.376,7.074-11.776,7.074-18.987
																										c0-4.872-1.126-9.327-3.302-13.184c-2.15-3.789-5.103-6.946-8.798-9.438c-3.448-2.321-7.501-4.096-11.998-5.265
																										c-4.275-1.109-9.003-1.673-13.978-1.673h-27.725v94.865h24.149V245.24l26.402,32.589h30.575L211.772,239.087z M203.375,216.9
																										c-0.725,1.229-1.749,2.21-3.149,3.063c-1.553,0.947-3.499,1.698-5.803,2.21c-2.372,0.512-4.898,0.785-7.578,0.836v-18.133h3.447
																										c2.202,0,4.378,0.222,6.4,0.648c1.775,0.384,3.354,0.973,4.651,1.749c0.947,0.546,1.698,1.289,2.253,2.202
																										c0.503,0.828,0.751,1.937,0.751,3.302C204.348,214.494,204.023,215.825,203.375,216.9z"/>
																								</g>
																							</g>
																							<g>
																								<g>
																									<polygon points="270.899,255.787 270.899,240.486 303.795,240.486 303.795,218.453 270.899,218.453 270.899,205.005 
																										305.271,205.005 305.271,182.963 246.741,182.963 246.741,277.828 305.647,277.828 305.647,255.787 		"/>
																								</g>
																							</g>
																							<g>
																								<g>
																									<polygon points="370.466,182.963 370.466,233.805 334.217,182.963 313.668,182.963 313.668,277.828 337.323,277.828 
																										337.323,226.987 373.572,277.828 394.121,277.828 394.121,182.963 		"/>
																								</g>
																							</g>
																							<g>
																								<g>
																									<polygon points="401.041,182.963 401.041,205.005 425.199,205.005 425.199,277.828 449.348,277.828 449.348,205.005 
																										473.498,205.005 473.498,182.963 		"/>
																								</g>
																							</g>
																							<g>
																								<g>
																									<path d="M512,64V38.4H64V0H38.4v38.4H0V64h38.4v422.4H12.8c-7.074,0-12.8,5.726-12.8,12.8c0,7.074,5.726,12.8,12.8,12.8h76.8
																										c7.074,0,12.8-5.726,12.8-12.8c0-7.074-5.726-12.8-12.8-12.8H64V64h89.591v38.4H128c-14.14,0-25.6,11.46-25.6,25.6v204.8
																										c0,14.14,11.46,25.6,25.6,25.6h358.4c14.14,0,25.6-11.46,25.6-25.6V128c0-14.14-11.46-25.6-25.6-25.6h-25.6V64H512z M179.191,64
																										H435.2v38.4H179.191V64z M486.4,128v204.8H128V128H486.4z"/>
																								</g>
																							</g>
																							</svg>			
																							{{__('site.rent')}} </div>
																					</label>
																				
																				</div>
										
	</div>
</div>
																			</div>	
																			




																																											
																																																				</div>
																		</div>
																	</div>
																	
																</div>
																<div class="row col-xl-12 card mt-5 rowCrtt">
																	<div class="col-xl-12">
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-12 col-lg-12 col-form-label blue-label">{{__('site.Specifications')}}</label>
																		</div>
																		<!--end::Group-->					

																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="title_deed" type="text" value="{{$property->title_deed}}" placeholder="{{__('site.title_deed')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select class="form-control"  name="category_id" required>
																						<option value="" >{{ __('site.property_type') }} <span class="error">*</span></option>
																						@foreach($categories as $category)
																						<option {{ $property->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
																						@endforeach
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="furnished" id="furnished" class="form-control">
																					<option value="">{{ __('site.Furnished') }}</option>
																						{!! selectOptions(__('config.furnished'),$property->furnished) !!}																					
																					</select>
																				</div>
																			</div>
														
																			@if((auth()->user()->time_zone == 'Asia/Riyadh' && userRole() != 'admin' && userRole() != 'sales admin uae') || request()->get('pt') == 'saudi')
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="bedrooms" id="bedrooms" class="form-control">
																					<option value="" >{{ __('site.bedrooms') }}</option>
																						{!! selectOptions(__('config.bedrooms'),$property->bedrooms) !!}	
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="living_room" id="living_room" class="form-control">
																					<option value="" >{{ __('site.living_room') }}</option>
																						{!! selectOptions(__('config.bedrooms'),$property->living_room) !!}	
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="guest_room" id="guest_room" class="form-control">
																					<option value="" >{{ __('site.guest_room') }}</option>
																						{!! selectOptions(__('config.bedrooms'),$property->guest_room) !!}	
																					</select>
																				</div>
																				
																			</div>
																			@else		
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="bedrooms" id="bedrooms" class="form-control">
																					<option value="" >{{ __('site.bedrooms') }}</option>
																						{!! selectOptions(__('config.bedrooms'),$property->bedrooms) !!}	
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="bathrooms" id="bathrooms" class="form-control">
																					<option value="" >{{ __('site.Baths') }}</option>
																						{!! selectOptions(__('config.bathrooms'),$property->bathrooms) !!}	
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="parking_areas" id="parking_areas" class="form-control">
																					<option value="" >{{ __('site.parking') }}</option>
																						{!! selectOptions(__('config.parking_areas'),$property->parking_areas) !!}
																					</select>
																				</div>
																			</div>
																			@endif
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="parking_type" id="parking_type" class="form-control">
																					<option value="" >{{ __('site.parking_type') }}</option>
																						{!! selectOptions(__('config.parking_type'),$property->parking_type) !!}
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="fitted" id="fitted" class="form-control">
																					<option value="" >{{ __('site.Furnishing_type') }}</option>
																						{!! selectOptions(__('config.fitted'),$property->fitted) !!}
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="developer" type="text" value="{{$property->developer}}" placeholder="{{__('site.developer')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->		
                                                                            <!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="floor" type="text" value="{{$property->floor}}" placeholder="{{__('site.floor')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="stage" id="stage" class="form-control">	
																					<option value="" >{{ __('site.stage') }}</option>
																					{!! selectOptions(__('config.stage'),$property->stage) !!}	
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="project_status" id="project_status" class="form-control">
																					<option value="" >{{ __('site.project_status') }}</option>
																						{!! selectOptions(__('config.project_status'),$property->project_status) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->	
																			<div class="form-group row fv-plugins-icon-container">	
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="measure_unit" id="measure_unit" class="form-control">
																					<option value="" >{{ __('site.unit_meas') }}</option>
																						{!! selectOptions(__('config.measure_unit'),$property->measure_unit) !!}
																					</select>
																				</div>																			
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="plot_size" type="text" value="{{$property->plot_size}}" placeholder="{{__('site.plot')}}">
																					<span class="suffix-text suffixPlot">sqft</span>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																				<!-- <div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="dewa" type="text" value="{{$property->dewa}}" placeholder="{{__('site.dewa')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div> -->
																				<!-- <div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="maint_fee" type="text" value="{{$property->maint_fee}}" placeholder="{{__('site.maint_fee')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div> -->

																				
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" id="buildup_area" name="buildup_area" type="text" value="{{$property->buildup_area}}" placeholder="{{__('site.bua')}} *" required>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				
																				
																				<!-- <div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="is_managed" id="is_managed" class="form-control">
																					<option value="" >{{ __('site.managed') }}</option>
																						{!! selectOptions(__('config.yes_no'),$property->is_managed) !!}
																					</select>
																				</div> -->

																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select class="form-control" name="source_id">
																						<option value="">{{ __('site.source') }}</option>
																						@foreach($sources as $source)
																						<option {{$property->source_id == $source->id ? 'selected' : ''}} value="{{$source->id}}">{{$source->name}}</option>
																						@endforeach      
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select class="form-control" name="campaign_id">
																						<option value="">{{__('site.campaign')}}</option>
																						@foreach($campaigns as $campaign)
																						<option {{ $property->campaign_id == $campaign->id ? 'selected' : ''}} value="{{$campaign->id}}">{{$campaign->name}}</option>
																						@endforeach
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="availability" id="availability" class="form-control">
																						<option value="">{{ __('site.choose') }} {{__('site.availability')}}</option>
																						{!! selectOptions(__('config.availability'),$property->availability) !!}
																					</select>
																				</div>
																			</div>		
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="is_exclusive" id="is_exclusive" class="form-control">
																						<option value="">{{ __('site.choose') }} {{__('site.exclusive')}}</option>
																						{!! selectOptions(__('config.yes_no'),$property->is_exclusive) !!}
																					</select>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="next_available" type="date" value="{{$property->next_available}}" placeholder="{{__('site.available_from')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select name="layout_type" id="layout_type" class="form-control">
																						<option value="">{{ __('site.choose') }} {{__('site.layout_type')}}</option>
																						{!! selectOptions(__('config.layout_type'),$property->layout_type) !!}
																					</select>
																				</div>
																			</div>

																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-3 col-lg-3">
																					<input class="form-control form-control-solid form-control-lg" 	name="no_of_floors" type="text" value="{{$property->no_of_floors}}" placeholder="{{__('site.no_of_floors')}}">																					
																					<div class="fv-plugins-message-container"></div>																				
																				</div>
																			</div>
																			

																			<!--end::Group-->	

																			<!--start::Group-->	
																																					
																		</div>
																	</div>
																</div>
																<div class="row col-xl-12 card mt-5 rowCrtt">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-12 col-lg-12 col-form-label blue-label">{{__('site.price')}} <span class="error">*</span></label>
																			</div>
																			<!--end::Group-->					
																			<!--begin::Group-->
																			<!--begin::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container priceInRent" style="{{$property->sale_rent == 1 ? 'display:none' : ''}}">
																				<div class="col-xs-3 col-sm-3 col-lg-3">																				
																					<div class="border p-5">																					
																					<label class="w-100 text-center">YEAR</label>
																						<input class="form-control form-control-solid form-control-lg property-price" name="yprice" type="text" value="{{$property->yprice}}" placeholder="{{__('site.yearly_price')}}"  {{$property->sale_rent == 2 ? 'required' : ''}}>																					
																						<span class="suffix-text">AED</span>
																						<div class="fv-plugins-message-container"></div>
																						<div class="col-xs-3 col-sm-3 col-lg-3 fl col-3">
																							<input class="form-control property-price-year" name="default_price" type="radio" value="year" {{ (empty($property->yprice)) ? 'disabled' : ''}} {{ ($property->default_price == 'year') ? 'checked' : ''}}>
																						</div>
																						<div class="col-xs-9 col-sm-9 col-lg-9 mt10 col-9">
																							<span>{{__('site.default_price')}}</span>
																						</div>
																					</div>																				
																				</div>
																				<div class="col-xs-3 col-sm-3 col-lg-3">																				
																					<div class="border p-5">																					
																					<label class="w-100 text-center">MONTH</label>
																						<input class="form-control form-control-solid form-control-lg property-price" name="mprice" type="text" value="{{$property->mprice}}" placeholder="{{__('site.monthly_price')}}">																					<span class="suffix-text">AED</span>
																						<div class="fv-plugins-message-container"></div>
																						<div class="col-xs-3 col-sm-3 col-lg-3 fl col-3">
																							<input class="form-control property-price-month" name="default_price" type="radio" value="month" {{ (empty($property->mprice)) ? 'disabled' : ''}} {{ ($property->default_price == 'month') ? 'checked' : ''}}>
																						</div>
																						<div class="col-xs-9 col-sm-9 col-lg-9 mt10 col-9">
																						<span>{{__('site.default_price')}}</span>
																						</div>
																					</div>																				
																				</div>
																				<div class="col-xs-3 col-sm-3 col-lg-3">																				
																					<div class="border p-5">																					
																					<label class="w-100 text-center">WEEK</label>
																						<input class="form-control form-control-solid form-control-lg property-price" 	name="wprice" type="text" value="{{$property->wprice}}" placeholder="{{__('site.weekly_price')}}"><span class="suffix-text">AED</span>
																						<div class="fv-plugins-message-container"></div>
																						<div class="col-xs-3 col-sm-3 col-lg-3 fl col-3">
																							<input class="form-control property-price-week" name="default_price" type="radio" value="week" {{ (empty($property->wprice)) ? 'disabled' : ''}} {{ ($property->default_price == 'week') ? 'checked' : ''}}>
																						</div>
																						<div class="col-xs-9 col-sm-9 col-lg-9 mt10 col-9">
																						<span>{{__('site.default_price')}}</span>
																						</div>
																					</div>																				
																				</div>
																				<div class="col-xs-3 col-sm-3 col-lg-3">																				
																					<div class="border p-5">																					
																					<label class="w-100 text-center">DAILY</label>
																						<input class="form-control form-control-solid form-control-lg property-price" name="dprice" type="text" value="{{$property->dprice}}" placeholder="{{__('site.day_price')}}"><span class="suffix-text">AED</span>
																						<div class="fv-plugins-message-container"></div>
																						<div class="col-xs-3 col-sm-3 col-lg-3 fl col-3">
																							<input class="form-control property-price-day" name="default_price" type="radio" value="day" {{ (empty($property->dprice)) ? 'disabled' : ''}} {{ ($property->default_price == 'day') ? 'checked' : ''}}>
																						</div>
																						<div class="col-xs-9 col-sm-9 col-lg-9 mt10 col-9">
																						<span>{{__('site.default_price')}}</span>
																						</div>
																					</div>	
																				</div>	
																				<!---->
																				<div class="col-xs-3 col-sm-3 col-lg-3" >																					
																					<select name="cheques" id="cheques" class="form-control">
																						<option value="" >{{ __('site.Cheques') }}</option>
																						{!! selectOptions(__('config.cheques'),$property->cheques) !!}		
																					</select>																				
																				</div>
																				<!---->
																			</div>
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-3 col-lg-3 priceInSale" style="{{$property->sale_rent == 2 ? 'display:none' : ''}}">
																					<input class="form-control form-control-solid form-control-lg" id="price" name="price" type="text" value="{{$property->price}}" placeholder="{{__('site.price')}}" {{$property->sale_rent == 1 ? 'required' : ''}}>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																				<div class="col-xs-12 col-sm-3 col-lg-3 priceInSale" style="{{$property->sale_rent == 2 ? 'display:none' : ''}}">
																					<input class="form-control form-control-solid form-control-lg" id="price_unit" 	name="price_unit" type="text" value="{{$property->price_unit}}" placeholder="{{__('site.price_unit')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																				

																				<div class="col-xs-12 col-sm-3 col-lg-3 priceInSale" style="{{$property->sale_rent == 2 ? 'display:none' : ''}}">
																					<input class="form-control form-control-solid form-control-lg" 	name="maint_fee" type="text" value="{{$property->maint_fee}}" placeholder="{{__('site.maint_fee')}}">																					
																					<div class="fv-plugins-message-container"></div>																				
																				</div>
																				<!---->
																				<div class="col-xs-12 col-sm-3 col-lg-3 priceInSale" style="{{$property->sale_rent == 2 ? 'display:none' : ''}}">																					
																					<select name="financial_status" id="financial_status" class="form-control">		
																					<option value="" >{{ __('site.financial_status') }}</option>	
																					{!! selectOptions(__('config.financial_status'),$property->financial_status) !!}
																					</select>																				
																				</div>
																				<!---->
																			</div>	

																			<!--<div class="form-group row fv-plugins-icon-container">-->
																			<!--<div class="col-xs-12 col-sm-3 col-lg-3 priceInSale" style="{{$property->sale_rent == 2 ? 'display:none' : ''}}">																					-->
																			<!--		<select name="financial_status" id="financial_status" class="form-control">		-->
																			<!--		<option value="" >{{ __('site.financial_status') }}</option>	-->
																			<!--		{!! selectOptions(__('config.financial_status'),$property->financial_status) !!}-->
																			<!--		</select>																				-->
																			<!--	</div>																					-->
																			<!--</div>-->
																																						
																		</div>
																	</div>
																</div>	
																<div class="row col-xl-12 card mt-5 rowCrtt btnCatt">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-12 col-lg-12 col-form-label blue-label">{{__('site.Select Amenities')}}</label>
																			</div>
																			<!--end::Group-->					
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-xs-12 col-sm-4 col-lg-4 col-4">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#features_modal_unit">
																					{{__('site.unit_features')}} <i class="fa fa-menu"></i> ({{count($property->unitFeatures)}})
                  																	</button>
																				</div>
																				<div class="col-xs-12 col-sm-4 col-lg-4 col-4">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#features_modal_dev">
																					{{__('site.dev_feature')}} <i class="fa fa-menu"></i> ({{count($property->devFeatures)}})
                  																	</button>
																				</div>
																			
																				<div class="col-xs-12 col-sm-4 col-lg-4 col-4">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#features_modal_life_style">
																					{{__('site.lifestyle')}} <i class="fa fa-menu"></i> ({{count($property->lifeStyleFeatures)}})
                  																	</button>
																				</div>
																			</div><br>
																			<!--end::Group-->

																			<div class="col-xs-12 col-sm-12 col-lg-12 col-12">
																				<input type="text" class="form-control form-control-solid form-control-lg" data-role="tagsinput" name="nearest_facilities" placeholder="{{__('site.nearest_facilities')}}" value="{{$property->nearest_facilities}}">																					
																			</div>
																		</div>


																	</div>
																</div>	


																<div class="row col-xl-12 card mt-5 rowCrtt">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-12 col-lg-12 col-form-label blue-label">{{__('site.description')}} <span class="error">*</span></label>
																		</div>
																		<!--end::Group-->					

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-lg-12 col-xl-12">
																					<input class="form-control form-control-solid form-control-lg" 	name="title" type="text" value="{{$property->title}}" placeholder="{{__('site.title')}}(English)" required>
																					<span class="redCount" id="title_count">0</span>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-lg-12 col-xl-12">
																					<textarea class="form-control form-control-solid form-control-lg" rows="10" name="description" id="description" placeholder="{{__('site.description')}}(English)">{!!$property->description!!}</textarea>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-lg-12 col-xl-12">
																					<input class="form-control form-control-solid form-control-lg" 	name="title_ar" type="text" value="{{$property->title_ar}}" placeholder="{{__('site.title')}}(Arabic)">
																					<span class="redCount" id="title_ar_count">0</span>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<div class="col-lg-12 col-xl-12">
																					<textarea class="form-control form-control-solid form-control-lg" rows="10" name="description_ar" id="description2" placeholder="{{__('site.description')}}(Arabic)" >{!!$property->description_ar!!}</textarea>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																		</div>
																	</div>
																</div>	
														
																<div class="row col-xl-12 card mt-5 rowCrtt">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-12 col-lg-12 col-form-label blue-label">{{__('site.owner_details')}}</label>
																		</div>

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.mobile')}} <span class="error">*</span></label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="mobile" type="text" value="{{$property->mobile}}" placeholder="{{__('site.mobile')}}" required>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.owner_name')}} <span class="error">*</span></label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="owner_name" type="text" value="{{$property->owner_name}}" placeholder="{{__('site.owner_name')}}" required>
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.email')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="email" type="text" value="{{$property->email}}" placeholder="{{__('site.email')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			
																		</div>
																	</div>
																</div>
																<div class="row col-xl-12 card mt-5 rowCrtt">																				
																	<!--begin::Wizard Actions-->
																	<div class="d-flex justify-content-between border-top pt-5 pb-5 m-auto">
																		<div>
																			<a href="#files" data-target="#files" data-toggle="tab" aria-controls="files" class="btn btn-primary font-weight-bolder px-9 py-4 nav-link" onclick="changeTab('#files')">
																			{{__('site.next')}}
																			<span class="nav-icon ml-5">
																					<i class="fa fa-arrow-right"></i>
																				</span>
																			</a>
																		</div>
																	</div>
																	<!--end::Wizard Actions-->
																</div>

															</div>
															<div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
																<div class="row col-xl-12 card">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																		
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				
																				<label class="col-xs-12 col-sm-3 col-lg-3 col-form-label">{{__('site.photos')}} ({{__('site.can attach more than one')}})</label>
																				<div class="col-xs-12 col-sm-3 col-lg-3">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#image_uploader">
                    																	Add Images <i class="fa fa-image"></i> ({{count($property->images)}})
                  																	</button>
																					
																					<!-- <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="photos[]" multiple>
																					<div class="fv-plugins-message-container"></div> -->
																				</div>
																				<label class="col-xs-12 col-sm-3 col-lg-3 col-form-label">{{__('site.documents')}} ({{__('site.can attach more than one')}})</label>
																				<div class="col-xs-12 col-sm-3 col-lg-3">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#document_uploader">
                    																	Add Documents <i class="fa fa-folder"></i> ({{count($property->documents)}})
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xs-12 col-sm-3 col-lg-3 col-form-label">{{__('site.floor_plan')}} ({{__('site.can attach more than one')}})</label>
																				<div class="col-xs-12 col-sm-3 col-lg-3">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#floor_plan_uploader">
                    																	Add Images <i class="fa fa-folder"></i> ({{count($property->floorPlans)}})
                  																	</button>
																				</div>
																			</div>
																			<!--end::Group-->



																		
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.virtual_360')}} url</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="virtual_360" type="text" value="{{$property->virtual_360}}" placeholder="{{__('site.virtual_360')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<!-- <div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.floor_plan')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="floorplan" type="file" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps">
																					<div class="fv-plugins-message-container"></div>
																					@if($property->floorplan)
																					<a href="{{env('APP_URL').'/public/uploads/'.$property->floorplan}}" target="_blank" download>Download</a>
																					@endif
																				</div>
																			</div> -->
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.video')}} url</label>
																				<div class="col-lg-9 col-xl-9">
																					<input class="form-control form-control-solid form-control-lg" 	name="video" type="text" value="{{$property->video}}" placeholder="{{__('site.video')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																																					
																			
																		</div>
																	</div>
																</div>
																<div class="row col-xl-12 card mt-5 rowCrtt">																				
																	<!--begin::Wizard Actions-->
																	<div class="d-flex justify-content-between border-top pt-5 pb-5 m-auto">
																		<div>
																			<a href="#basic" data-target="#basic" data-toggle="tab" class="btn btn-primary font-weight-bolder px-9 py-4" onclick="changeTab('#basic')">
																			<span class="nav-icon mr-5">
																					<i class="fa fa-arrow-left"></i>
																				</span>
																			{{__('site.previous')}}
																			</a>
																			<a href="#location" data-target="#location" data-toggle="tab" class="btn btn-primary font-weight-bolder px-9 py-4" onclick="changeTab('#location')">
																			
																			{{__('site.next')}}
																			<span class="nav-icon ml-5">
																					<i class="fa fa-arrow-right"></i>
																				</span>
																			</a>
																		</div>
																	</div>
																	<!--end::Wizard Actions-->
																</div>
															</div>
															<div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
																<div class="row col-xl-12 card">
																	<!--begin::Wizard Step 1-->
																	<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                                         
																		@if((auth()->user()->time_zone == 'Asia/Dubai' && userRole() != 'admin' && userRole() != 'sales admin uae') || request()->get('pt') == 'dubai')
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.city')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<select name="city_id" id="city_id" class="form-control" required>
																					<!-- <option value="">{{ __('site.choose') }}</option> -->
																					@foreach($cities as $city)
																					<option {{$property->city_id == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name_en}}</option>
																					@endforeach 
																				</select>
																			</div>

																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.community')}} <span class="error">*</span></label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<select name="community" id="community" class="form-control" required>
																					<option value="">{{ __('site.choose') }}</option>
																					@foreach($community as $comm)
																					<option {{$property->community == $comm->id ? 'selected' : ''}} value="{{$comm->id}}">{{$comm->name_en}}</option>
																					@endforeach 
																				</select>
																			</div>
																		</div>
																		<!--end::Group-->
																		@else
																		<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.city_name')}} </label>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select class="form-control " id="city_id"
																					name="city_id" data-select2-id="" tabindex="-1" aria-hidden="true" required>
																						<option value="2">Riyadh</option>
																					</select>
																				</div>
																				
																				<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.zone')}} </label>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select class="form-control " id="zone_id"
																					name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true" required>
																					@foreach($zones as $zone)
																						<option {{$property->zone_id == $zone->id ? 'selected' : ''}} value="{{$zone->id}}" data-select2-id="{{$zone->id}}">{{$zone->zone_name}}</option>
																					@endforeach
																					</select>
																				</div>
																			</div>
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.district')}} </label>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<select class="form-control " id="district_id"
																					name="district_id" data-select2-id="" tabindex="-1" aria-hidden="true" required>
																					@foreach($districts as $district)
																						<option {{$property->district_id == $district->id ? 'selected' : ''}} value="{{$district->id}}" data-select2-id="{{$district->id}}">{{$district->name}}</option>
																					@endforeach																				
																					</select>
																				</div>

																				<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.building')}}</label>
																				<div class="col-xs-12 col-sm-4 col-lg-4">
																					<input class="form-control form-control-solid form-control-lg" 	name="building_name" type="text" value="{{$property->building_name}}" placeholder="">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->
																		@endif
                                                                        
																	@if((auth()->user()->time_zone == 'Asia/Dubai' && userRole() != 'admin' && userRole() != 'sales admin uae')|| userRole()== 'other' || request()->get('pt') == 'dubai')
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.sub_community')}} <span class="error">*</span></label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<select name="sub_community" id="sub_community" class="form-control" required>
																					<option value="">{{ __('site.choose') }}</option>
																					@foreach($subCommunity as $comm)
																					<option {{$property->sub_community == $comm->id ? 'selected' : ''}} value="{{$comm->id}}">{{$comm->name_en}}</option>
																					@endforeach 
																				</select>
																			</div>
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.building')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="building_name" type="text" value="{{$property->building_name}}" placeholder="">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<!--end::Group-->
																		@endif
																		

																		<div class="form-group row fv-plugins-icon-container">

																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.unit')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="unitno" type="text" value="{{$property->unitno}}" placeholder="{{__('site.unit')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.street')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="street" type="text" value="{{$property->street}}" placeholder="{{__('site.street')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<!--end::Group-->
																		@if((auth()->user()->time_zone == 'Asia/Riyadh' && userRole() != 'admin' && userRole() != 'sales admin uae') || request()->get('pt') == 'saudi')
																		<div class="form-group row fv-plugins-icon-container">

																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.facing')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="facing" type="text" value="{{$property->facing}}" placeholder="{{__('site.facing')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.street_width')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="street_width" type="text" value="{{$property->street_width}}" placeholder="{{__('site.street_width')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<div class="form-group row fv-plugins-icon-container">

																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.property_length')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="border_length" type="text" value="{{$property->border_length}}" placeholder="{{__('site.property_length')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.property_width')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="border_width" type="text" value="{{$property->border_width}}" placeholder="{{__('site.property_width')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<div class="form-group row fv-plugins-icon-container">

																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.age')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="age" type="text" value="{{$property->age}}" placeholder="{{__('site.age')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<!--end::Group-->
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-12 col-lg-12 col-form-label blue-label">{{__('site.street_information')}}</label>
																		</div>

																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.street_information_one')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="street_information_one" type="text" value="{{$property->street_information_one}}" placeholder="{{__('site.street_information_one')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.street_information_two')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="street_information_two" type="text" value="{{$property->street_information_two}}" placeholder="{{__('site.street_information_two')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>
																		<div class="form-group row fv-plugins-icon-container">
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.street_information_three')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="street_information_three" type="text" value="{{$property->street_information_three}}" placeholder="{{__('site.street_information_three')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			<label class="col-xl-2 col-lg-2 col-form-label">{{__('site.street_information_four')}}</label>
																			<div class="col-xs-12 col-sm-4 col-lg-4">
																				<input class="form-control form-control-solid form-control-lg" 	name="street_information_four" type="text" value="{{$property->street_information_four}}" placeholder="{{__('site.street_information_four')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																		</div>

																		<!--end::Group-->	

																		@endif
																	</div>
																</div>
																<div class="row col-xl-12 card mt-5 rowCrtt">																				
																	<!--begin::Wizard Actions-->
																	<div class="d-flex justify-content-between border-top pt-5 pb-5 m-auto">
																		<div>
																			<a href="#files" data-target="#files" data-toggle="tab"  class="btn btn-primary font-weight-bolder px-9 py-4" onclick="changeTab('#files')">
																			<span class="nav-icon mr-5">
																					<i class="fa fa-arrow-left"></i>
																				</span>
																			{{__('site.previous')}}
																			</a>
																			<a href="#notes" data-target="#notes" data-toggle="tab"  class="btn btn-primary font-weight-bolder px-9 py-4" onclick="changeTab('#notes')">
																			{{__('site.next')}}
																			<span class="nav-icon ml-5">
																					<i class="fa fa-arrow-right"></i>
																				</span>
																			</a>
																		</div>
																	</div>
																	<!--end::Wizard Actions-->
																</div>
															</div>
															<div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
																<div class="row col-xl-12 card">
																	<!--begin::Wizard Step 1-->
																	<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																		<!--begin::Group-->
																		<div class="form-group row fv-plugins-icon-container">
																			<div class="col-lg-12 col-xl-12">
																				<textarea class="form-control form-control-solid form-control-lg" rows="5" name="notes" placeholder="{{__('site.notes')}}">{!!old('notes')!!}</textarea>
																				<span class="redCount" id="notes_count">0</span>
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			<div class="col-lg-12 col-xl-12">
																				@if(count($property->notes))
																					@foreach($property->notes as $rs)
																						<p>{!! $rs->description. ' added by <b>'.(isset($rs->user->email) ? $rs->user->email : 'N/A'). '</b> at '.$rs->created_at !!}</p>
																					@endforeach
																				@endif
																			</div>
																		</div>
																		<!--end::Group-->
																		
																		<!--end::Group-->
																	</div>
																</div>
																<div class="row col-xl-12 card mt-5 rowCrtt">																				
																	<!--begin::Wizard Actions-->
																	<div class="d-flex justify-content-between border-top pt-5 pb-5 m-auto">
																		<div>
																			<a href="#location" data-target="#location" data-toggle="tab" class="btn btn-primary font-weight-bolder px-9 py-4" onclick="changeTab('#location')">
																			<span class="nav-icon mr-5">
																					<i class="fa fa-arrow-left"></i>
																				</span>
																			{{__('site.previous')}}
																			</a>	
																		
																			@if(userRole() == 'admin' || userRole() == 'sales admin uae'  )
																				<a href="#verification" data-target="#verification" data-toggle="tab" class="btn btn-primary font-weight-bolder px-9 py-4" onclick="changeTab('#verification')">
																				{{__('site.next')}}
																				<span class="nav-icon ml-5">
																					<i class="fa fa-arrow-right"></i>
																				</span>
																				</a>
																			@else
																				<input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
																			@endif
																		</div>
																	</div>
																	<!--end::Wizard Actions-->
																</div>
															</div>
															@can('property-verification-tab') 
															<div class="tab-pane fade" id="verification" role="tabpanel" aria-labelledby="verification-tab">
																<div class="row col-xl-12 card">
																	<div class="col-xl-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																		<div class="col-xs-12">
																		<!--begin::Wizard Step 1-->
																		<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">	
																	
																			@if(userRole() == 'admin' || userRole() == 'sales admin uae')
																				<!--begin::Group-->
																				<div class="form-group row fv-plugins-icon-container">
																					<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
																					<div class="col-lg-9 col-xl-9">
																						<select name="status" id="status" class="form-control">
																							{!! selectOptions(__('config.status'),$property->status) !!}
																						</select>
																					</div>
																				</div>
																				<!--end::Group-->
																			@endif

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.agent')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<select class="form-control" name="user_id">
																						<option value="">{{__('site.choose')}}</option>
																						@foreach($sellers as $seller)
																						<option {{ $property->user_id == $seller->id ? 'selected':  '' }} value="{{$seller->id}}">{{$seller->name}}</option>
																						@endforeach
																					</select>
																				</div>
																			
																			<!--end::Group-->
																		
																			<!--begin::Group-->
																			
																			@if(userRole() == 'admin' || userRole() == 'sales admin uae') 
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.portals')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#portals_modal">
                    																	Add portals <i class="fa fa-menu"></i>  ({{count($property->portals)}})
                  																	</button>
																				</div>
																			@endif
																			</div>
																			
																			<!--end::Group-->
																			</div>
																	</div>
																			@if(userRole() == 'admin' || userRole() == 'sales admin uae' )
																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.verified')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<select name="verified" id="verified" class="form-control">
																					<option value="">{{__('site.choose')}}</option>
																						{!! selectOptions(__('config.yes_no'),$property->verified) !!}
																					</select>
																				</div>
																				
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.featured')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<select name="is_featured" id="is_featured" class="form-control">
																					<option value="">{{__('site.choose')}}</option>
																						{!! selectOptions(__('config.featured'),$property->featured) !!}
																					</select>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.unver_reas')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<select name="unverified_reason" id="unverified_reason" class="form-control">
																					<option value="">{{__('site.choose')}}</option>
																						{!! selectOptions(__('config.unverified_reason'),$property->unverified_reason) !!}
																					</select>
																				</div>
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.date')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<input class="form-control form-control-solid form-control-lg" 	name="verified_date" type="date" value="{{$property->verified_date}}" placeholder="{{__('site.date')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																			<!--end::Group-->

																			<!--begin::Group-->
																			<div class="form-group row fv-plugins-icon-container">
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.pass_p_eid')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<input class="form-control form-control-solid form-control-lg" 	name="passport_emirates_id" type="text" value="{{$property->passport_emirates_id}}" placeholder="{{__('site.pass_p_eid')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																				<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.from_a_noc_sl_form')}}</label>
																				<div class="col-xs-12 col-sm-6 col-lg-3">
																					<input class="form-control form-control-solid form-control-lg" 	name="forma_noc_slform" type="text" value="{{$property->forma_noc_slform}}" placeholder="{{__('site.from_a_noc_sl_form')}}">
																					<div class="fv-plugins-message-container"></div>
																				</div>
																			</div>
																		@endif
																		<div class="form-group row fv-plugins-icon-container">
																			
																			<label class="col-xs-12 col-sm-6 col-lg-3 col-form-label">{{__('site.permit')}}</label>
																			<div class="col-xs-12 col-sm-6 col-lg-3">
																				<input class="form-control form-control-solid form-control-lg" 	name="str_no" type="text" value="{{$property->str_no}}" placeholder="{{__('site.permit_no')}}">
																				<div class="fv-plugins-message-container"></div>
																			</div>
																			
																		</div>
																			<!--end::Group-->


																		</div>
																	</div>

																</div>
																<div class="row col-xl-12 card mt-5 rowCrtt">																				
																	<!--begin::Wizard Actions-->
																	<div class="d-flex justify-content-between border-top pt-5 pb-5 m-auto">
																		<div>
																			<a href="#notes" data-target="#notes" data-toggle="tab" class="btn btn-primary font-weight-bolder px-9 py-4" onclick="changeTab('#notes')">																			
																				<span class="nav-icon mr-5">
																						<i class="fa fa-arrow-left"></i>
																					</span>
																				{{__('site.previous')}}
																			</a>
																			<input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
																		</div>
																	</div>
																	<!--end::Wizard Actions-->
																</div>
															</div>	
															@endcan															
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
@include('admin.property.floor_plan_uploader')
@include('admin.property.dev_features')
@include('admin.property.unit_features')
@include('admin.property.life_style_features')
@include('admin.property.portals')
@endsection

@push('js')
<link href="{{ asset('public/js/tags/tagsinput.css?t='.time())}}" rel="stylesheet" type="text/css" />
<script src="{{ asset('public/js/tags/tagsinput.js').'?t='.time() }}"></script>
<script>
	var getSubCommunityUrl = "{{route('admin.property.getSubCommunityUrl')}}";
	var fetchDistrict = "{{url('fetch-district')}}";
	var csrfToken = "{{csrf_token()}}";
</script>
<script src="{{ asset('public/js/developer.js').'?t='.time() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
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
	var demos2 = function () {
		ClassicEditor
			.create( document.querySelector( '#description2' ) )
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
            demos2();
        }
    };
}();
// Initialization
KTCkeditor.init();
</script>
@endpush

