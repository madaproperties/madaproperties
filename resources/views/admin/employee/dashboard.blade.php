@push('css')
    <style>
        .row .card-body
        {
            background:#9fce31;
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
						

						
						</div>
                   

						<div class="card-body table-responsive" style="padding:20px">
							     <img src="{{ asset('public/imgs/UAEflag.png') }}">
							   <h4 style="text-align:center;">WELCOME TO <span style="font-weight: bold; color: #9fc538;">MADA PROPERTIES</span></h4>
							  <div class="row">
							      
							      <div class="col-xl-4">
                                        <!--begin::Tiles Widget 2-->
                                        
                                          <div class="text-center card card-custom bg-success  gutter-b" style="">
                                          <!--begin::Body-->
                                          <div class="card-body d-flex flex-column p-0">
                                            <!--begin::Stats-->
                                            <div class="flex-grow-1 card-spacer-x pt-6 pb-6">
                                              <div class="text-inverse-danger font-weight-bold">
                                                Total Employees
                                              </div>
                                              <div class="text-inverse-danger font-weight-bolder font-size-h1">
                                                
                                              </div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Chart-->
                                            <!--end::Chart-->
                                          </div>
                                          <!--end::Body-->
                                        </div>
                                        
                                        <!--end::Tiles Widget 2-->
                                      </div>
                                      
                                      <div class="col-xl-4">
                                        <!--begin::Tiles Widget 2-->
                                        
                                          <div class="text-center card card-custom bg-success  gutter-b" style="">
                                          <!--begin::Body-->
                                          <div class="card-body d-flex flex-column p-0">
                                            <!--begin::Stats-->
                                            <div class="flex-grow-1 card-spacer-x pt-6 pb-6">
                                              <div class="text-inverse-danger font-weight-bold">
                                               Birthdays  
                                              </div>
                                              <div class="text-inverse-danger font-weight-bolder font-size-h1">
                                                
                                              </div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Chart-->
                                            
                                            <!--end::Chart-->
                                          </div>
                                          <!--end::Body-->
                                        </div>
                                        
                                        <!--end::Tiles Widget 2-->
                                      </div>
                                      
                                      <div class="col-xl-4">
                                        <!--begin::Tiles Widget 2-->
                                        
                                          <div class="text-center card card-custom bg-success  gutter-b" style="">
                                          <!--begin::Body-->
                                          <div class="card-body d-flex flex-column p-0">
                                            <!--begin::Stats-->
                                            <div class="flex-grow-1 card-spacer-x pt-6 pb-6">
                                              <div class="text-inverse-danger font-weight-bold">
                                                Work Anniversary 
                                              </div>
                                              <div class="text-inverse-danger font-weight-bolder font-size-h1">
                                               
                                              </div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Chart-->
                                     
                                            <!--end::Chart-->
                                          </div>
                                          <!--end::Body-->
                                        </div>
                                        
                                        <!--end::Tiles Widget 2-->
                                      </div>
							      
							  </div>
							
							<!--end: Datatable-->
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
<script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('public/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
@endpush
