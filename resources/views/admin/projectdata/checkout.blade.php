@push('css')
    <style>
        /*.row .card-body
        {
            background:#9fce31;
        }*/
        .availability-unit table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
.book_now .btn.btn-primary{width: 100%;
    font-size: 20px;
    border-radius: 0;}
    .term_condition{padding:15px 0px 15px 0px;}
    .payment_heading{padding:20px 0px 20px 0px;}
.green{color:#9FCE30;}
body#kt_body .contentArea{padding-left:0;width:100%;}
#kt_header,
#kt_header_mobile,
.menuSideView{display:none;}
.availability-unit td, th {
  border: 1px solid #ebedf3;
  text-align: left;
  padding: 15px;
  padding-left: 20px;
  font-size:13px;
}
h3.unit_banner{text-align: center;
    background: #000;
    color: #fff;
    width: fit-content;
    margin: auto;
    padding: 5px 10px 10px 10px;
    margin-top: 20px;}
.availability-unit .card.card-custom > .card-body {
    padding-bottom: 10px !important;
}
.bottom_header{    background: url(/public/imgs/bannermada.jpg);
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
    padding-bottom: 30px;
    padding-top: 30px;
    height:300px;
}
.projectdetails a{width: 160px;
    margin-right: 15px;
    margin-left: 15px;font-size:18px;}
.projectdetails{justify-content: center;
    padding-top: 50px;}
.availability-unit a{color:#000;}
.bg-available{background:#9fc538;color:#fff;}
.bg-reserve{background:#ffff00;color:#000 !important;}
.bg-sold{background:#F64E60;}
.availability-unit tr:nth-child(even) {
  background-color: #f5ffe0;
}
.border_div{border: 1px solid rgba(217, 217, 217, 0.45);}
div#units{padding:30px;}
        .availability-unit .collapsible {
            color: black;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
           font-size: 15px;
           text-align: center;
           margin-bottom:20px;
        }
       .availability-unit .btn-info
       {
        margin:30px;
    width: 170px;
    border-radius: 5px;
    font-size: 16px;
    /*text-transform: uppercase !important;*/
       }
       .availability-unit .bg-success .bg-danger .bg-primary
       {
        width: 17px;
        height: 17px;
       }
       .availability-unit .modal-body .sold{
       color: #ff0000;
    font-size: 15px;
    font-weight: 500;
    padding: 10px;
    max-width: 300px;
    text-align: center;
    margin: auto;
       }
       .availability-unit .floor{
        text-align: left;

       }
       h4.floor {
    padding-top: 30px;
    padding-bottom: 10px;
}
.floor_box {
     padding: 30px 20px 30px 20px;
    box-shadow: 0 0 5px #e2cece;
    margin: 20px 0px 20px 0px;
     border-radius:6px;
     
}
       .availability-unit .view{
         margin-top: 5px;
       }
       .availability-unit .modal-body .reserved{
        color: #ff0000;
    font-size: 15px;
    font-weight: 500;
    max-width: 300px;
    padding: 10px;
    margin: auto;
       }
       .card-header img{padding: 20px 0px 20px 0px;width:200px;height:auto;}
       .availability-unit .unitlist{
         padding-top:50px;
         padding-bottom:50px;
         margin: 0px 0px 45px 0px;
         background:#f7f7f7;
         border-radius:6px;
       }
       .unitlist ul{display: flex; margin: auto;padding-left:0;}
       .unitlist ul li {
    padding: 10px;
    list-style-position: inside;
    font-size:16px;
}
 .unitlist span {
    padding-right: 10px;
    display:flex;
}
.unitlist .col-xl-4{display:flex;}
       .unitlist button{padding:10px;width: 10px;
    height: 10px;}
       .availability-unit embed{
        border: 3px solid black; 
        margin-left: 15px;
       }
       .availability-unit .brochure{
        margin-left: 91px; 
        margin-right: 30px;
       }
       .availability-unit h4
       {
        font-size:21px;
        text-transform: uppercase;
       }
     /* .unitlist ul li.available{color:#9fc538;}
       .unitlist ul li.reserved{color:#ffff00;}
        .unitlist ul li.sold{color:#F64E60;}*/
         .unitlist ul li{}
       .availability-unit h2{
            font-size: 24px;
            text-transform: uppercase;
            color: #9fc538;
            font-weight: 500;
            padding-bottom: 50px;
            text-decoration: underline;
       }
       .inf .card-body{
        padding:20px;
       }
       .availability-unit .projectdetails
       {
       margin-bottom:30px;
       margin-left: 20px;
       justify-content:Center;
       }
       .availability-unit .brochureinf
       {
        margin: 5px;
       }
       .developer-logo{
         display: block;
  margin-left: auto;
  margin-right: auto;
  width: 300px;
       }
 
       
     @media screen and (max-width: 979px) {
 .unit_box {
    margin-bottom: 10px;
}
.unitlist button {
    padding: 7px;
    width: 7px;
    height: 7px;
}
.unitlist ul {
    display: block;
}
      .floor_box .row{margin:auto;}
        .availability-unit .floor {
    text-align: center;
}
}
      @media screen and (max-width: 768px) {
          .unitlist .col-xl-4{display:block;}
        .floor_box .row{margin:auto;}
        .availability-unit .floor {
    text-align: center;
}
 .unit_box {
    margin-bottom: 10px;
}
.unitlist ul {
    display: block;
}
.modal-open .modal{overflow:visible;}
.unitlist button {
    padding: 7px;
    width: 7px;
    height: 7px;
}
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
         	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
				<!--begin::Entry-->
				<div class="d-flex flex-column-fluid">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Card-->
						<div class="card card-custom card-transparent">
							<div class="card-header m-auto flex-wrap border-0">
								<img class="logo" src="{{ asset('public/imgs/logo.png') }}" width="50" />
							
							</div>
							<div class="bottom_header">
                            <!--<img class="developer-logo" src="{{ asset('public/uploads/projectData/'.$image->developer->developer_logo) }}">-->
                            <!--updated by fazal on 30-03-->
                            <img class="developer-logo" src="{{ asset('public/uploads/projectData/'.$project_name['project_logo']) }}">
                            <!--end-->
                            <h2 align="center" >{{$project_name['name']}}</h2>  
								<h3 class="unit_banner">Unit Name: {{ $unit->unit_name}}</h3>-->
							</div>
							<div class="card-body p-0">
								<!--begin::Wizard-->
								<div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">

									<!--begin::Card-->
									<div class="card card-custom card-shadowless rounded-top-0">
										<!--begin::Body-->
										<div class="card-body p-0">
											<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-12">
													<!--begin::Wizard Form-->
													<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('projectPayment.payment')}}" id="kt_form"   enctype="multipart/form-data">
														@csrf
														<div class="row justify-content-center">
														<div class="col-xl-5 border_div">
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

																	<!--begin::Group-->
																
																	<!--end::Group-->
																	
																	<div class="form-group row fv-plugins-icon-container text-center">
																		<div class="col-lg-8 col-xl-8">
																			<h4>Unit Name: {{ $unit->unit_name}}</h4>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-4 col-lg-4">{{__('site.floor_no')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			{{ $unit->floor_no}}
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-4 col-lg-4">{{__('site.area_bua')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			{{ $unit->area_bua}}
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-4 col-lg-4">{{__('site.price')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			{{ $unit->price}}
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-4 col-lg-4">{{__('site.down_payment')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			{{ $unit->down_payment}}
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																		<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-4 col-lg-4">{{__('site.bedroom')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			{{ $unit->bedroom}}
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																

																	
																	<!--begin::Group-->
																	


																</div>
															</div>
														<div class="col-xl-7 border_div px-10">
																<!--begin::Wizard Step 1-->
																<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
																	<!--begin::Group-->
																	<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container payment_heading">
																	    <h3 class="w-100">Payment</h3>
																	<p>In order to book accommodation, you need to </br><span class="green">deposit SAR 10,000</span> of the total booking payment.</p>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-4 col-form-label">{{__('site.CustomerName')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			<input class="form-control form-control-solid form-control-lg" 	name="CustomerName" type="text" value="{{old('CustomerName')}}" placeholder="{{__('site.CustomerName')}}" required>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
                                                                    <div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-4 col-form-label">{{__('site.National Id')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			<input class="form-control form-control-solid form-control-lg" maxlength="20" name="PassportNumber" type="text" value="{{old('PassportNumber')}}" placeholder="{{__('site.National Id')}}" required>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--begin::Group-->
																	
																		<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-4 col-form-label">{{__('site.CustomerEmail')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			<input class="form-control form-control-solid form-control-lg" 	name="CustomerEmail" type="email" value="{{old('CustomerEmail')}}" placeholder="{{__('site.CustomerEmail')}}" required>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																	<!--end::Group-->
<!--begin::Group-->
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-4 col-form-label">{{__('site.CustomerMobile')}}</label>
																		<div class="col-lg-8 col-xl-8">
																			<input class="form-control form-control-solid form-control-lg" maxlength="10" name="CustomerMobile" type="number" value="{{old('CustomerMobile')}}" placeholder="{{__('site.CustomerMobile')}}" required>
																			<div class="fv-plugins-message-container"></div>
																		</div>
																	</div>
																		<div class="form-group row fv-plugins-icon-container">
                                                                <div class="col-lg-12 col-xl-12 term_condition">
                                                                    <p><input type="checkbox" name="termsAndConditions" required><span>I Agree to <a href="{{route('projectdata.termsAndConditions')}}">terms and conditions</a></span></p>
                                                                </div>
																<div class="col-lg-12 col-xl-12 book_now">
																	<input type="submit" class="btn btn-primary font-weight-bolder" value="{{__('site.BookNow')}}"/>
																</div>
															</div>
																	<!--end::Group-->
																</div>
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

@endsection
@push('js')

@endpush
