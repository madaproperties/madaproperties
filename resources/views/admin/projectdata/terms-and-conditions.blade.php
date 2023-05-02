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
#kt_content h3{padding-top:20px;}
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
.availability-unit .card.card-custom > .card-body {
    padding-bottom: 10px !important;
}
.bottom_header{    background: url(/public/imgs/bannermada.jpg);
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
    padding-bottom: 30px;
    padding-top: 30px;
    height:400px;
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
  width: 150px;
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
                            <div class="col-xl-3 col-xxl-10 mt10">
                                <a href="{{ url()->previous() }}" class="btn btn-success" style="padding:0.75rem 1.5rem">
                                    <i class="fas fa-angle-left"></i> back
                                </a>
                            </div>
							<div class="card-header m-auto flex-wrap border-0">
                            
								<img class="logo" src="{{ asset('public/imgs/logo.png') }}" width="50" />
							</div>
                            
							<div class="card-body p-0">
								<!--begin::Wizard-->
								<div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">
									<!--begin::Card-->
									<div class="card card-custom card-shadowless rounded-top-0">
										<!--begin::Body-->
										<div class="card-body p-0">
											<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-10">
                                                   <h2 class="text-center">Booking Terms and Conditions</h2> 
                                                   <p>Thank you for choosing to book your unit with Mada Properties. By making this booking you are entering an agreement with us. Please read these terms and conditions of booking below.</p>
                                                </div>
                                                <div class="col-xl-12 col-xxl-10">
                                                    <h3>Booking Policy</h3>
                                                    <p>1. The client acknowledges that the booking fee is non-refundable and non-transferable.</p>
                                                    <p>2. The client understands that the booking fee secures the reservation and guarantees availability of the product or service requested.</p>
                                                    <p>3. The client agrees to pay the booking fee at the time of reservation.</p>
                                                    <p>4. The client acknowledges that failure to pay the booking fee may result in cancellation of the reservation.</p>
                                                    <p>5. The client understands that the booking fee is separate from any additional fees or charges associated with the product or service requested.</p>
                                                    <p>6. The client agrees to pay any additional fees or charges in accordance with the terms and conditions outlined by the company or service.</p>
                                                    <p>7. The client acknowledges that the company or service is not responsible for any changes or cancellations made to the reservation by the client.</p>
                                                    <p>8. The client agrees to comply with all terms and conditions outlined by the company or service regarding non-refundable booking fees.</p>
                                                    <p>9.	The client understands that the company or service may amend these terms and conditions at any time and that it is the client's responsibility to review them periodically for updates.</p>
                                                </div>
                                               <div class="col-xl-12 col-xxl-10">
<h3>Booking Information</h3>

<p>1.	The client is solely responsible for providing accurate and complete booking information at the time of reservation.</p>
<p>2.	The client understands that any errors or omissions in the booking information provided may result in delays, additional fees, or cancellation of the reservation.</p>
<p>3.	The client agrees to review all booking information carefully before submitting the reservation request.</p>
<p>4.	The client acknowledges that the company or service is not responsible for any issues that arise because of inaccurate or incomplete booking information provided by the client.</p>
<p>5.	The client agrees to promptly notify the company or service of any changes or updates to the booking information provided.</p>
<p>6.	The client understands that any changes or updates to the booking information may result in additional fees or charges.</p>
<p>7.	The client agrees to comply with all terms and conditions outlined by the company or service regarding booking information and reservation policies.</p>
<p>8.	The client understands that failure to provide accurate and complete booking information may result in the forfeiture of any deposit or payment made towards the reservation.</p>
</div>

<div class="col-xl-12 col-xxl-10">
<h3>Client Information Legal Use</h3>

<p>1.	The company or service collects personal information from the client for the sole purpose of fulfilling the requested product or service.</p>
<p>2.	The client acknowledges that the personal information provided to the company or service is accurate and complete.</p>
<p>3.	The company or service agrees to protect the confidentiality of the client's personal information and use it only for the purpose it was collected.</p>
<p>4.	The client acknowledges that the personal information provided to the company or service may be disclosed to third-party service providers for the sole purpose of fulfilling the requested product or service.</p>
<p>5.	The client understands that the company or service may use the personal information provided for marketing or promotional purposes only with the client's explicit consent.</p>
<p>6.	The client has the right to access, update, or request the deletion of their personal information provided to the company or service.</p>
<p>7.	The client acknowledges that the company or service is not responsible for any loss or damage resulting from the disclosure of the client's personal information due to unauthorized access, theft, or hacking.</p>
<p>8.	The client agrees to comply with all applicable laws and regulations regarding the use and disclosure of personal information.</p>
<p>9.	The client acknowledges that the company or service may amend these terms and conditions at any time and that it is the client's responsibility to review them periodically for updates.</p>
</div>
<div class="col-xl-12 col-xxl-10">
<h3>Payment Details Security</h3>
<p>1.	Payment transactions made through our website or application are processed securely and encrypted using SSL or TLS protocols. We take all necessary measures to ensure the protection of your personal and financial information.</p>
<p>2.	All payment methods offered on our website or application comply with the Payment Card Industry Data Security Standards (PCI DSS) and other industry standards. This ensures that your payment information is safe and secure.</p>
<p>3.	You are required to provide accurate and complete information when making a payment, including your name, billing address, and payment card details. We reserve the right to refuse any transaction if the information provided is incorrect or fraudulent.</p>
<p>4.	You may be required to authenticate your identity before completing a payment transaction. This may include two-factor authentication, password protection, or other forms of identification.</p>
<p>5.	We respect your privacy and will never sell or share your personal information with third parties. All information collected during the payment process will be used solely for the purpose of processing the transaction.</p>
<p>6.	We use advanced fraud detection and prevention tools to identify and prevent fraudulent transactions. If we detect a suspicious transaction, we may require additional information or cancel the transaction altogether.</p>
<p>7.	We are not responsible for any losses or damages that may arise because of unauthorized use of your payment method, including credit card theft or fraud. We encourage you to keep your payment information secure and to report any suspicious activity immediately.</p>
<p>8.	We reserve the right to modify or update these terms and conditions at any time. Your continued use of our website or application after such changes have been made constitutes your acceptance of the revised terms and conditions.</p>
</div>
<div class="col-xl-12 col-xxl-10">
<h3>Prices and Payment Plans</h3>

<p>1.	The client acknowledges that the prices listed for the product or service requested are subject to change without notice.</p>
<p>2.	The client agrees to pay the booking amount listed for the product or service at the time of reservation.</p>
<p>3.	The client understands that failure to pay the booking amount at the time of reservation may result in cancellation of the reservation.</p>
<p>4.	The client acknowledges that any taxes, fees, or charges associated with the product or service requested are in addition to the listed price and are the responsibility of the client to pay.</p>
<p>5.	The client agrees to pay any additional fees or charges in accordance with the terms and conditions outlined by the company or service.</p>
<p>6.	The client understands that any booking or down payment made towards the reservation is non-refundable.</p>
<p>7.	The client acknowledges that the company or service may offer payment plans for the product or service requested.</p>
<p>8.	The client understands that failure to make payments according to the agreed-upon payment plan may result in cancellation of the reservation.</p>
<p>9.	The client agrees to comply with all terms and conditions outlined by the company or service regarding prices and payment plans.</p>
<p>10.	The client acknowledges that the company or service may amend these terms and conditions at any time and that it is the client's responsibility to review them periodically for updates.</p>
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
