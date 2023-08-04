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
.arabic_terms{direction: rtl;
    text-align: right;}
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
										    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10 arabic_terms">
												<div class="col-xl-12 col-xxl-10">
												    <h2 class="text-center">شروط وأحكام التسجيل</h2> 
												    <p>شكراً لاختياركم شركة مدى العقارية لحجز وحدتكم. هذه الشروط والأحكام ("الاتفاقية" أو "الشروط") هي عقد بينك وبين شركة مدى العقارية، فيرجى قراءتها بعناية:</p>
												</div>
												<div class="col-xl-12 col-xxl-10">
                                                    <h3>سياسة الحجز:</h3>
                                                    <p>1.	يقر العميل بأن رسوم التسجيل غير مستردة وغير قابلة للتحويل.</p>
                                                    <p>2.	يدرك العميل بأن رسوم التسجيل هي ضمان لحجز الوحدة المتاحة أو الخدمة المطلوبة.</p>
                                                    <p>3.	يوافق العميل على دفع الدفعة الأولى والرسوم الأخرى خلال 48 ساعة من وقت الحجز.</p>
                                                    <p>4.	يقر العميل بأن عدم دفع الدفعة الأولى والرسوم الأخرى خلال 48 ساعة من وقت الحجز سوف يتسبب بإلغاء حجز الوحدة المختارة، وسوف يتم إعادة إتاحتها لعملاء آخرين.</p>
                                                    <p>5.	يدرك العميل بأن رسوم التسجيل تعتبر منفصلة عن أي رسوم أو تكاليف إضافية متعلقة بالمنتج أو الخدمة المطلوبة.</p>
                                                    <p>6.	يوافق العميل على دفع أي رسوم أو تكاليف إضافية بالتوافق مع الشروط والأحكام المحددة من قبل الشركة أو الخدمة.</p>
                                                    <p>7.	يقر العميل بأن الشركة أو الخدمة غير مسؤولة عن أي تغيير أو إلغاء يقوم به العميل للحجز.</p>
                                                    <p>8.	يوافق العميل على الامتثال لجميع الشروط والأحكام المحددة من قبل الشركة أو الخدمة فيما يخص رسوم الحجز غير المستردة.</p>
                                                    <p>9.	يدرك العميل بأن الشركة أو الخدمة قد تقوم بإجراء تعديلات على هذه الشروط والأحكام في أي وقت، وبأن مراجعتها من وقت لآخر للاطلاع على التحديثات هي مسؤولية العميل.</p>
                                                </div>
                                                <div class="col-xl-12 col-xxl-10">
                                                    <h3>معلومات الحجز:</h3>
                                                    <p>1.	يعتبر العميل المسؤول الوحيد عن توفير معلومات تسجيل دقيقة وكاملة عند الحجز.</p>
                                                    <p>2.	يدرك العميل بأن أي أخطاء أو نواقص مرتكبة في معلومات الحجز قد تؤدي إلى التأخير، رسوم إضافية، أو إلغاء الحجز.</p>
                                                    <p>3.	يوافق العميل على مراجعة كامل معلومات التسجيل بحذر قبل تسليم طلب الحجز.</p>
                                                    <p>4.	يقر العميل بأن الشركة أو الخدمة غير مسؤولة عن أي مشكلة قد تحدث بسبب عدم صحة أو عدم اكتمال المعلومات التي قام العميل بتسجيلها.</p>
                                                    <p>5.	يوافق العميل على تزويد الشركة أو الخدمة حالاً بأي تغيير أو تحديث على المعلومات التي قام بتسجيلها.</p>
                                                    <p>6.	يوافق العميل على أن أي تغيير أو تحديث على المعلومات التي قام بتسجيلها قد يتسبب برسوم أو تكاليف إضافية.</p>
                                                    <p>7.	يوافق العميل على الامتثال لجميع الشروط والأحكام المحددة من قبل الشركة أو الخدمة فيما يخص معلومات التسجيل وسياسات الحجز.</p>
                                                    <p>8.	يقر العميل بأن عدم تقديم معلومات تسجيل دقيقة وكاملة قد يتسبب بالحجز على أي وديعة أو دفعة قام بها من أجل الحجز.</p>
                                                </div>
                                                <div class="col-xl-12 col-xxl-10">
                                                    <h3>الاستخدام القانوني لمعلومات العميل:</h3>
                                                    <p>1.	تقوم الشركة أو الخدمة بجمع هذه المعلومات الشخصية للعميل لغرض واحد فقط، وهو إنجاز المنتج أو الخدمة المطلوبة.</p>
                                                    <p>2.	يقر العميل بأن المعلومات الشخصية التي قام بتزويدها للشركة أو الخدمة هي صحيحة وكاملة.</p>
                                                    <p>3.	توافق الشركة أو الخدمة على حماية سرية معلومات العميل الشخصية وعلى استخدامها فقط للغرض الذي جُمعت من أجله.</p>
                                                    <p>4.	يقر العميل بأن المعلومات الشخصية التي قام بتزويدها للشركة أو الخدمة قد يتم مشاركتها مع طرف ثالث من مزودي الخدمة لغرض واحد فقط، وهو إنجاز المنتج أو الخدمة المطلوبة.</p>
                                                    <p>5.	يدرك العميل بأن الشركة أو الخدمة قد تستخدم المعلومات الشخصية التي قام بتزويدها من أجل أغراض تسويقية وترويجية، من بعد موافقة صريحة من العميل.</p>
                                                    <p>6.	يحق للعميل الوصول إلى المعلومات الشخصية التي قام بتزويد الشركة أو الخدمة بها، كما يحق له تحديثها، أو المطالبة بحذفها.</p>
                                                    <p>7.	يقر العميل بأن الشركة أو الخدمة غير مسؤولة عن أي ضياع أو ضرر ناتج عن مشاركته لمعلوماته الشخصية، نتيجة لدخول غير مصرح به، سرقة، أو قرصنة.</p>
                                                    <p>8.	يوافق العميل على الامتثال لجميع القوانين والتشريعات المطبقة فيما يخص استخدام أو مشاركة المعلومات الشخصية.</p>
                                                    <p>9.	يدرك العميل بأن الشركة أو الخدمة قد تقوم بإجراء تعديلات على هذه الشروط والأحكام في أي وقت، وبأن مراجعتها من وقت لآخر للاطلاع على التحديثات هي مسؤولية العميل.</p>
                                                </div>
                                                <div class="col-xl-12 col-xxl-10">
                                                    <h3>أمان معلومات الدفع:</h3>
                                                    <p>1.	يتم معالجة معاملات الدفع التي تتم عبر موقعنا الإلكتروني أو التطبيق الخاص بنا بشكل آمن ومشفر باستخدام بروتوكولات SSL أو TLS. حيث نقوم بعمل جميع الإجراءات الضرورية لضمان حماية معلوماتكم الشخصية والمالية.</p>
                                                    <p>2.	جميع طرق الدفع المتوفرة على موقعنا الإلكتروني أو التطبيق الخاص بنا تمتثل لمعيار أمان بيانات صناعة بطاقة الدفع (PCI DSS) ومعايير صناعية أخرى، وذلك لضمان سلامة وأمن معلومات الدفع الخاصة بكم.</p>
                                                    <p>3.	يكون العميل مطالب بتزويد معلومات دقيقة وكاملة عند القيام بعملية الدفع، تتضمن اسمه، عنوان فواتيره، وتفاصيل بطاقة الدفع. ونحتفظ بحق رفض أي معاملة في حال كانت المعلومات المزوّدة غير صحيحة أو مزوّرة.</p>
                                                    <p>4.	قد تتم مطالبة العميل بمصادقة هويته قبل إتمام معاملة الدفع، وقد يتضمن ذلك مصادقة ثنائية، كلمة سر للحماية، أو أي أشكال أخرى من التعريف.</p>
                                                    <p>5.	نولي خصوصيتكم كامل احترامنا، ولذا لن نقوم بمشاركة أو بيع معلوماتكم الشخصية مع أي طرف ثالث. جميع المعلومات التي تم جمعها خلال مرحلة الدفع سيتم استخدامها فقط لغرض تسيير المعاملة.</p>
                                                    <p>6.	نقوم باستخدام أدوات كشف ومنع احتيال متقدمة للتعرف على المعاملات المزوّرة وإيقافها، ولذا في حالة رصد أية معاملة مشبوهة، فإننا سنقوم بطلب معلومات إضافية أو إلغاء المعاملة بالكامل.</p>
                                                    <p>7.	لسنا مسؤولين عن أي ضياع أو ضرر قد ينتج عن الاستخدام غير المصرح به لطريقة الدفع، بما يتضمن سرقة بطاقة الائتمان أو تزويرها. ولذا نشجعكم على المحافظة على سلامة معلومات الدفع الخاصة بكم، وعلى الإبلاغ عن أي نشاط مشبوه بشكل مباشر.</p>
                                                    <p>8.	نحتفظ بحق تعديل أو تحديث هذه الشروط والأحكام في أي وقت، ويُعتبر استمرار استخدامكم لموقعنا أو التطبيق الخاص بنا بعد إتمام هذه التغييرات بمثابة موافقتكم على الشروط والأحكام المعدلة.</p>
                                               </div>
                                               <div class="col-xl-12 col-xxl-10">
                                                  <h3>الأسعار وطرق الدفع:</h3> 
                                                  <p>1.	يقر العميل بأن الأسعار المدرجة للمنتج أو الخدمة المطلوبة قابلة للتغيير من دون سابق إنذار. </p>
                                                  <p>2.	يوافق العميل على دفع مبلغ التسجيل المدرج للمنتج أو الخدمة وقت الحجز.</p>
                                                  <p>3.	يدرك العميل بأن عدم دفع مبلغ التسجيل عند الحجز قد يتسبب بإلغاء الحجز.</p>
                                                  <p>4.	يقر العميل بأنه مسؤول عن دفع أي ضرائب، رسوم، أو تكاليف متعلقة بالمنتج أو الخدمة المطلوبة، إضافة إلى السعر المدرج.</p>
                                                  <p>5.	يوافق العميل على دفع أي رسوم أو تكاليف إضافية بالتوافق مع الشروط والأحكام المحددة من قبل الشركة أو الخدمة.</p>
                                                  <p>6.	يدرك العميل بأن أي رسوم حجز أو دفعة أولى تم القيام بها من أجل الحجز هي غير مستردّة.</p>
                                                  <p>7.	يقر العميل بأن الشركة أو الخدمة قد تعمل على تقديم خطط دفع للمنتج أو الخدمة المطلوبة.</p>
                                                  <p>8.	يدرك العميل بأن عدم إتمام الدفعات بحسب خطة الدفع المتفق عليها قد يؤدي إلى إلغاء الحجز.</p>
                                                  <p>9.	يوافق العميل على الامتثال لجميع الشروط والأحكام المحددة من قبل الشركة أو الخدمة فيما يخص الأسعار وخطط الدفع.</p>
                                                  <p>10.	يقر العميل بأن الشركة أو الخدمة قد تقوم بإجراء تعديلات على هذه الشروط والأحكام في أي وقت، وبأن مراجعتها من وقت لآخر للاطلاع على التحديثات هي مسؤولية العميل.</p>
                                                </div>
											</div>
											<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-10">
                                                   <h2 class="text-center">Booking Terms and Conditions</h2> 
                                                   <p>Thank you for choosing to book your unit with Mada Properties. By making this booking you are entering an agreement with us. Please read these terms and conditions of booking below.</p>
                                                </div>
                                                <div class="col-xl-12 col-xxl-10">
                                                    <h3>Booking Policy</h3>
                                                    <p>1. The client acknowledges that the booking fee is non-refundable and non-transferable.</p>
                                                    <p>2. The client understands that the booking fee secures the reservation and guarantees availability of the product or service requested.</p>
                                                    <p>3. The client agrees to pay the down payment and other fees within 48 hours only from the time of reservation.</p>
                                                    <p>4. The client acknowledges that failure to pay the down payment and other fees within 48 hours from the time of reservation will result in cancellation of the reserved unit and it will be released to be available for other clients.</p>
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
