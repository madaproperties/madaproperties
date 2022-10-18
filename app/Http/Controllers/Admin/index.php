<?php



include '../inc/conf.php';

session_start();

$arg = "";

if(isset($_SESSION['arg'])){

	$arg = $_SESSION['arg'];

	unset($_SESSION['arg']);

}

$errors = [];

$valid = true;



if(isset($_GET["error"])) {

	$arr = $_GET["error"];

	if(isset($arr)) {

		$errors= explode("|",$arr);

		$valid = false;

	}

}



function isError($errors,$name){

	$error = "";

	if(in_array($name,$errors)){

		$error =  "error";

	}

	return $error;

}



$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;



if (isset($_GET['utm_campaign'])) {

	setcookie('utm_campaign', $_GET['utm_campaign'], time()+3600, '/', $domain);

	$utm_campaign = $_GET['utm_campaign'];

} else {

	if (isset($_COOKIE["utm_campaign"])) {

		$utm_campaign = $_COOKIE["utm_campaign"];

	}

}

if (isset($_GET['utm_medium'])) {

	setcookie('utm_medium', $_GET['utm_medium'], time()+3600, '/', $domain);

	$utm_medium = $_GET['utm_medium'];

} else {

	if (isset($_COOKIE["utm_medium"])) {

		$utm_medium = $_COOKIE["utm_medium"];

	}

}

if (isset($_GET['utm_source'])) {

	setcookie('utm_source', $_GET['utm_source'], time()+3600, '/', $domain);

	$utm_source = $_GET['utm_source'];

} else {

	if (isset($_COOKIE["utm_source"])) {

		$utm_source = $_COOKIE["utm_source"];

	}

}

if (isset($_GET['utm_content'])) {

	setcookie('utm_content', $_GET['utm_content'], time()+3600, '/', $domain);

	$utm_content = $_GET['utm_content'];

} else {

	if (isset($_COOKIE["utm_content"])) {

		$utm_content = $_COOKIE["utm_content"];

	}

}

if (isset($_GET['utm_term'])) {

	setcookie('utm_term', $_GET['utm_term'], time()+3600, '/', $domain);

	$utm_term = $_GET['utm_term'];

} else {

	if (isset($_COOKIE["utm_term"])) {

		$utm_term = $_COOKIE["utm_term"];

	}

}

if (isset($_GET['gclid'])) {

	setcookie('gclid', $_GET['gclid'], time()+3600, '/', $domain);

	$gclid = $_GET['gclid'];

} else {

	if (isset($_COOKIE["gclid"])) {

		$gclid = $_COOKIE["gclid"];

	}

}



?>

<!DOCTYPE html>

<html>

    <head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-190273587-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-190273587-1');
</script>
<!-- End Google Tag Manager -->
        <meta charset="UTF-8">

        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1" name="viewport">

        <title>داماك لاجونز بورتوفينو - فلل وتاون هاوس فاخرة</title>

        <meta name='keywords' content='Luxury villas and townhouses, Damac lagoons, real estate solutions, buy property in Dubai'>

        <meta name='description' content='Looking for Luxury Villas and Townhouses in Damac Lagoons? Contact Us Now for 3, 4 & 5 Bedroom Townhouses & 7 Bedroom Villas with outstanding specifications & features '/>

        <link rel="icon" href="../img/icons/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/style.css">

        <link rel="stylesheet" href="css/bootstrap.css">

		<link rel="stylesheet" href="../inc/css/intlTelInput.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>

		<script src="../js/jquery.form.js"></script>

		<script src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>

		<script src="../inc/js/intlTelInput.js"></script>

        <script src="js/main.js"></script>

            <!-- Global site tag (gtag.js) - Google Ads: 10871659760 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10871659760"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-10871659760'); </script> 

            <!-- Event snippet for Damac Lagoons conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-10871659760/T7rMCI_2oLYDEPC5gcAo', 'event_callback': callback }); return false; } </script> 

            <script>
   // $(document).ready(function(){
	//	$("#myModal").modal('show');
	//}); 
    setTimeout(function() {
        $('#myModal').modal();
    }, 5000);
    
            </script>

    </head>

    <body>
<div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">سجل الآن لمزيد من المعلومات</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form action="submit.php" method="post" id="submitForm3" accept-charset="UTF-8" class="submitForm3" name="submitForm3">

                            <div class="form-group">

                                <input placeholder="الاسم الأول *" type="text" id="edit-submitted-first-name" name="first_name" value="<?php if (isset($arg['firstname'])) { print $arg['firstname']; } ?>" size="60" maxlength="128" required>

                                <?php if (isError($errors,"firstname")) { print "<label id='edit-submitted-first-name-error' class='error' for='edit-submitted-first-name'>يرجى تحديد اسمك الأول</label>"; } ?>

                            </div>

                            <div class="form-group">

                                <input placeholder="الاسم الأخير *" type="text" id="edit-submitted-last-name" name="last_name" value="<?php if (isset($arg['lastname'])) { print $arg['lastname']; } ?>" size="60" maxlength="128">

                                <?php if (isError($errors,"lastname")) { print "<label id='edit-submitted-last-name-error' class='error' for='edit-submitted-last-name'>يرجى تحديد اسمك الأخير</label>"; } ?>

                            </div>

                            <div class="form-group">

                                <input placeholder="البريد الإلكتروني" type="email" id="edit-submitted-email" name="email" value="<?php if (isset($arg['email'])) { print $arg['email']; } ?>" size="60">

                                <?php if (isError($errors,"email")); ?>

                            </div>

                            <div class="form-item phone">

                                <input placeholder="رقم الجوال *" type="text" id="phone4" name="phone_number" value="<?php if (isset($arg['phone'])) { print $arg['#phone']; } ?>"  size="60" maxlength="128" autocomplete="off">

                                <?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>يرجى تحديد رقم هاتفك الجوال المكون من 9 أرقام</label>"; } ?>

                            </div>

                            <div class="form-item" style="display: none">

                            <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">

                            <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">

                            <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">

                            <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">

                            <input type="hidden" name="iso2" id="iso4" value="<?php if (isset($gclid)) { echo $gclid; } ?>">

                            <input type="hidden" name="language" value="عربي">

                            <input type="hidden" name="project" value="<? echo $project ?>">

                            </div>

                            <div class="form-actions"><input class="form-submit" type="submit" value="سجل الان" style="background-color: #9FCE31"></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <section>

            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

                    <div class="container">

                        <a class="logo me-2">

                            <img

                              src="../img/slider/mada-properties-logo-black.png"



                            />

                          </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">

                      <span class="navbar-toggler-icon"></span>

                    </button>

                    <div class="collapse navbar-collapse" id="mynavbar">

                      <div class="navbar-nav mr-auto">

                        <a class="nav-item nav-link" href="#amenities">وسائل الراحة<!--AMENITIES--></a>

                        <a class="nav-item nav-link" href="#gallery">معرض الصور<!--GALLERY--></a>

                        <a class="nav-item nav-link" href="#bedroom">غرف النوم<!--BEDROOM--></a>

                        <a class="nav-item nav-link" href="#feature">المميزات<!--FEATURES--></a>

                        <a class="nav-item nav-link" href="#projects">المشاريع<!--PROJECTS--></a>

                        <a class="nav-item nav-link" href="#invest">الاستثمار <!--INVEST--></a>

                        <a class="nav-item nav-link" href="#location">الموقع<!--LOCATION--></a> 

                        <a class="nav-item nav-link" href="#contact-us">اتصل بنا<!--CONTACT US--></a>

                        

                      </div>

                    </div>

                  </nav>

        </section>



        <section>

        <div class="bg-header">

                <div id="container-fluid overflow-hidden py-5 px-lg-0">

                 <div class="container feature py-5 px-lg-0">

                <div class="row g-5 mx-lg-0">

                    <div class="col-sm-6 project-title">

                        <h1>داماك لاجونز </h1>

                    <p>داماك لاجونز - مجمع سكني جديد حيث تحيط الفلل والتاون هاوس الساحرة بالكريستال لاجونز والشواطئ الرملية البيضاء وأجواء الجزر الاستوائية ومجموعة من التجارب الساحرة الأخرى.
                    </p>

                        <div class="project-price">

                            <p>تبدأ من 1.56 مليون درهم إماراتي</p>

                        </div>

                        <div class="short-features col-sm-12">

                            <p><i class="fa  fa-check-circle"></i>  انطلاقه جديدة للتاون هاوس 3 , 4 و 5 غرف نوم ، وللفلل 7 غرف نوم</p>

                            <p><i class="fa  fa-check-circle"></i>   إطلالات على البحيرة الكرستالية والمسطحات المائية</p>

                            <p><i class="fa  fa-check-circle"></i>  خطة سداد تصل لمدة 4 سنوات</p>

                        </div>

                    

                    </div>

                    <div class="col-sm-6 contact-header">

                    <div class="header-form" id="register">

                    <form action="submit.php" method="post" id="submitForm" accept-charset="UTF-8" class="submitForm">

                    <h2 class="contact-text">سجل الآن</h2>

                    <p class="text-contact">لمزيد من المعلومات</p>

                  <div class="form-group">

                   <input placeholder="الاسم الأول *" type="text" id="edit-submitted-first-name" name="first_name" value="<?php if (isset($arg['firstname'])) { print $arg['firstname']; } ?>" size="60" maxlength="128" required>

						<?php if (isError($errors,"firstname")) { print "<label id='edit-submitted-first-name-error' class='error' for='edit-submitted-first-name'>يرجى تحديد اسمك الأول</label>"; } ?>

                  </div>

                   <div class="form-group">

                  	<input placeholder="الاسم الأخير *" type="text" id="edit-submitted-last-name" name="last_name" value="<?php if (isset($arg['lastname'])) { print $arg['lastname']; } ?>" size="60" maxlength="128">

						<?php if (isError($errors,"lastname")) { print "<label id='edit-submitted-last-name-error' class='error' for='edit-submitted-last-name'>يرجى تحديد اسمك الأخير</label>"; } ?>

                  </div>

                  <div class="form-group">

                    	<input placeholder="البريد الإلكتروني" type="email" id="edit-submitted-email" name="email" value="<?php if (isset($arg['email'])) { print $arg['email']; } ?>" size="60" required>

						<?php if (isError($errors,"email")); ?>

                  </div>

                <div class="form-item phone">

						<input placeholder="رقم الجوال *" type="text" id="phone" name="phone_number" value="<?php if (isset($arg['phone'])) { print $arg['#phone']; } ?>"  size="60" maxlength="128" autocomplete="off">

						<?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>يرجى تحديد رقم هاتفك الجوال المكون من 9 أرقام</label>"; } ?>

					</div>

					<div class="form-item" style="display: none">

					 <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">

					 <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">

					 <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">

					 <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">

					 <input type="hidden" name="iso2" id="iso2" value="<?php if (isset($gclid)) { echo $gclid; } ?>">

					 <input type="hidden" name="language" value="عربي">

					 <input type="hidden" name="project" value="<? echo $project ?>">

					</div>

                 <div class="form-actions"><input class="form-submit" type="submit" value="سجل الان"></div>

                </form>

                    </div>

                    </div>

            </div>



        </section>



        <section id="description">

            <div class="container-fluid overflow-hidden py-5 px-lg-0">

                <div class="container feature py-5 px-lg-0">

                    <div class="row g-5 mx-lg-0">

                        <div class="col-lg-6">

                            <h6 class="text-secondary text-uppercase mb-3">داماك لاجونز</h6>

                            <h2 class="mb-5"> استمتع بعطلتك في منزلك</h2>

                            <div class="mb-3">

                                <i class="text-primary"></i>

                                <div class="ms-4">

                                    <h5>انطلاقة جديدة - بورتوفينو في داماك لاجونز</h5>

                                    <p class="mb-0"> انطلاقة جديدة - بورتوفينو في داماك لاجونز
تشع أشعة الشمس على بورتوفينو داماك لاجونز، وكأنها تحفة فنية، فإن لوحة بورتوفينو في داماك لاجونز هي عبارة عن توازن مرئي بين اللون والنمط والوحدة والتنوع.  تم بناء المكاتب ومنطقة الألعاب على هذا المفهوم، مما يمنحك عنوان مكتب خلاب، حيث يمكنك الاستمتاع بالطبيعة.

                                    </p>            

                                </div>

                            </div>

                            

                            <div class="d-flex mb-5">

                                <i class="text-primary fa-3x flex-shrink-0"></i>

                                <div class="ms-5">

                                    <h5></h5>

                                    <p class="mb-0">اكتشف نفسك في مكان واحد مع الطبيعة في مساحة مصممة لمزيج فريد من المغامرة والإثارة والمعيشة الفاخرة، مما يمنحك فرصة لاستكشاف طرق جديدة، وذلك كله فقط في بورتوفينو في داماك لاجونز.</p>

                                </div>

                            </div>

							<!--<a href="#contact-us"><p class="register">REGISTER</p></a>-->

                            <a onclick="return gtag_report_conversion('https://madaproperties.com/landing/lagoons/ar/');" href="#contact-us" class="button-register btn py-md-3 px-md-5" style="  font-weight:bold; background: #9FCE31; color: white;">سجل الآن</a>

	

                             

                        </div>

                        <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">

                            <div class="position-relative h-100">

                                <img class="position-absolute img-fluid w-100 h-100" src="../img/slider/image10.jpg" style="object-fit: cover; right:0;" alt="">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        <section id="amenities">

            <div class="container">

                <h2 class="text-center mb-5">وسائل الراحة</h2><!--Amenities-->

                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4">

                            <img src="../img/icons/Hotel.png">

                            <h6 class="mt-3 mb-3">مكاتب</h6><!--Aqua Office-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4">

                            <img src="../img/icons/Hotel.png">

                            <h6 class=" mt-3 mb-3">مكتبة مائية</h6><!--Aqua Library-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4">

                            <img src="../img/icons/Gym.png">

                            <h6 class="mt-3 mb-3">نادي رياضي مائي </h6><!--Aqua Gym-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4">

                            <img src="../img/icons/music pavilion.png">

                            <h6 class="mt-3 mb-3"> موسيقى بالهوى الطلق</h6><!--Air Music Pavillion-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4">

                            <img src="../img/icons/observatory.png">

                            <h6 class=" mt-3 mb-3">مرصد</h6><!--Observatory-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4">

                            <img src="../img/icons/Hotel.png">

                            <h6 class="mt-3 mb-3">مركز أعمال</h6><!--Business Center-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4" >

                            <img src="../img/icons/Spa.png">

                            <h6 class="mt-3 mb-3">نادي صحي في الهواء الطلق</h6><!--Outdoor SPA-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="list p-4" >

                            <img src="../img/icons/fishing lake.png">

                            <h6 class="mt-3 mb-3">بحيرة للصيد</h6><!--Fishing Lake-->

                            <p class="mb-0"></p>

                        </a>

                    </div>

                </div>

            </div>

            </div>

        </div>

        </section>



        <section id="gallery"> 

            <div class="photo-gallery">

                <div class="container">

                    <div class="intro">

                        <h2 class="text-center">معرض الصور</h2><!--gallery-->

                        <p class="text-center"></p>

                    </div>

                    <div class="row photos">

                        <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image1.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image1.jpg"></a></div>

                        <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image2.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image2.jpg"></a></div>

                        <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image3.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image3.jpg"></a></div>

                        <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image5.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image5.jpg"></a></div>

                        <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image6.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image6.jpg"></a></div>

                        <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image7.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image7.jpg"></a></div>

                        <div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image8.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image8.jpg"></a></div>

						<div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image9.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image9.jpg"></a></div>

						<div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image10.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image10.jpg"></a></div>

						<div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image11.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image11.jpg"></a></div>

						<div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image12.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image12.jpg"></a></div>

						<div class="col-sm-6 col-xs-6 col-md-4 col-lg-3 item"><a href="../img/slider/image13.jpg" data-lightbox="photos"><img class="img-fluid" src="../img/slider/image1.jpg"></a></div>

                    </div>

                    </div>

                    </div>

                    </div>

                    </div>

                </div>

            </div>

           

        </section>

        <!--Bedroom-->

        <section id="bedroom">

        <div class="container">

                <h2 class="text-center font-weight-bold">غرف النوم</h2><!--Bedroom-->

                <br>

                <!-- Nav tabs -->

                <ul class="nav nav-tabs justify-content-center" role="tablist">

                  <li class="nav-item">

                    <a class="nav-link active" data-toggle="tab" href="#home">3 غرف نوم</a><!--3 BR-->

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" data-toggle="tab" href="#menu1">4 غرف نوم</a><!--4 BR-->

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" data-toggle="tab" href="#menu2">5 غرف نوم</a><!--5 BR-->

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" data-toggle="tab" href="#menu3">7 غرف نوم</a><!--7 BR-->

                  </li>

                </ul>

              

                <!-- Tab panes -->

                <div class="tab-content">

                  <div id="home" class="container tab-pane active"><br>

                    <div class="container-fluid overflow-hidden py-5 px-lg-0">

                        <div class="container about py-5 px-lg-0">

                            <div class="row g-5 mx-lg-0">

                                <div class="col-lg-5 about-text">

                                    <h6 class="text-secondary text-uppercase mb-3">تاون هاوس</h6><!--Townhouse-->

                                    <h2 class="font-weight-bold">3 غرف نوم</h2><!--3 BR-->

                                    <p class="mb-5">Type: BL-3-M</p>

                                </div>

                                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">

                                    <div class="position-relative h-100">

                                        <img class="position-absolute img-fluid w-100 h-100" src="../img/slider/3-bed-new.jpg" alt="">

                                    </div>

                                </div>

                              

                            </div>

                        </div>

                    </div>

                  </div>

                  <div id="menu1" class="container tab-pane fade"><br>

                    <div class="container-fluid overflow-hidden py-5 px-lg-0">

                        <div class="container about py-5 px-lg-0">

                            <div class="row g-5 mx-lg-0">

                                <div class="col-lg-5 about-text">

                                    <h6 class="text-secondary text-uppercase mb-3">تاون هاوس</h6><!--Townhouse-->

                                    <h2 class="font-weight-bold">4 غرف نوم</h2><!--4 BR-->

                                    <p class="mb-5"> Type: BL-4-M</p>

                                </div>

                                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">

                                    <div class="position-relative h-100">

                                        <img class="position-absolute img-fluid w-100 h-100" src="../img/slider/4-bed-new.jpg"alt="">

                                    </div>

                                </div>

                                

                            </div>

                        </div>

                    </div>

                  </div>

                  <div id="menu2" class="container tab-pane fade"><br>

                    <div class="container-fluid overflow-hidden py-5 px-lg-0">

                        <div class="container about py-5 px-lg-0">

                            <div class="row g-5 mx-lg-0">

                                <div class="col-lg-5 about-text">

                                    <h6 class="text-secondary text-uppercase mb-3">تاون هاوس</h6><!--Townhouse-->

                                    <h2 class="font-weight-bold">5 غرف نوم</h2><!--5 BR-->

                                    <p class="mb-5"> Type: BL-5-E</p>

                                </div>

                                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">

                                    <div class="position-relative h-100">

                                        <img class="position-absolute img-fluid w-100 h-100" src="../img/slider/5-bed-new.jpg"alt="">

                                    </div>

                                </div>

                               

                            </div>

                        </div>

                    </div>

                  </div>

                  <div id="menu3" class="container tab-pane fade"><br>

                    <div class="container-fluid overflow-hidden py-5 px-lg-0">

                        <div class="container about py-5 px-lg-0">

                            <div class="row g-5 mx-lg-0">

                                <div class="col-lg-5 about-text">

                                    <h6 class="text-secondary text-uppercase mb-3">فلل</h6><!--Villa-->

                                    <h2 class="font-weight-bold">7 غرف نوم</h2><!--7 BR-->

                                    <p class="mb-5"> Type: BL-V75</p>

                                </div>

                                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">

                                    <div class="position-relative h-100">

                                        <img class="position-absolute img-fluid w-100 h-100" src="../img/slider/7-bed-new.jpg" alt="">

                                    </div>

                                </div>

                                

                            </div>

                        </div>

                    </div>

                  </div>

                </div>

              </div>

        </section>



        <!--features-->

        <section id="feature">

            <div class="more-section">

        <div class="container">

          <div class="row">

            <div class="col-lg-6 mb-4 mb-lg-0">

              <img src="../img/slider/image15.jpg" alt="Image" class="img-fluid">

            </div>

              <div class="row">

                <div class="col-md-12"><h2>المميزات:</h2><!--Features-->

                  <ul class="pt-3">

                    <li>عيش بطابع المدن الأسبانية والايطالية والفرنسية</li><!--Set Within 8 City Themes Including Spain, Italy, France-->

                    <li>فلل محيطة ببحيرة أزور بلو لاجون</li><!--Homes Surrounding an Azure Blue Lagoon-->

                    <li>طابع الجزر الاستوائية </li><!--Tropical Island Vibe Community-->

                    <li>شواطئ بيضاء رملية</li><!--White Sandy Beaches-->

                    <li>سينما عائمة</li><!--Floating Cinema-->

                    <li>مطاعم وكافيهات مائية</li><!--Water Restaurants & Cafes-->

					<li>التسليم في 2024</li><!--Handover: 2024-->

					<li>المطور: شركة داماك العقارية</li><!--Developer: Damac Properties-->

                  </ul>



                </div>

              </div>

              

              

            </div>

          </div>

        </div>

      </div>



      <div class="more-section pt-0">

        <div class="container">

          <div class="row">

            <div class="col-lg-3">

              <div class="numbers">

                <strong class="d-block">10 دقائق</strong>

                <span style="font-size: 14px;">عن نادي دبي للبولو و الفروسية</span>

              </div>

            </div>

            <div class="col-lg-3">

              <div class="numbers">

                <strong class="d-block">22 دقيقة</strong>

                <span style="font-size: 14px;">عن دبي مارينا</span>

              </div>

            </div>

            <div class="col-lg-3">

              <div class="numbers">

                <strong class="d-block">24 دقيقة</strong>

                <span style="font-size: 14px;"> عن مول الإمارات.</span>

              </div>

            </div>

            <div class="col-lg-3">

              <div class="numbers">

                <strong class="d-block">28 دقيقة</strong>

                <span style="font-size: 14px;">عن مطار آل مكتوم الدولي</span>

              </div>

            </div>

          </div>

        </div>

      </div>

        </section>

        

        <!--Latest Projects-->

        <section id="projects"class="latest-project pt-5 pb-0">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="section-title text-center">

                            <span>جديد</span>

                            <h2>آخر المشاريع</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-lg-4">

                        <div class="latest-item">

                            <div class="latest-item-pic set-bg" data-setbg="img/image7.jpg"style="background-image: url(../img/slider/damac-lagoons-nice.jpg);"></div>

                            <div class="latest-item-text">

								<span>تبدأ من 1.7 مليون درهم إماراتي</span><!--Nice - AED 1.7 Million-->

                                <h5>نيس في لاجونز داماك</h5>

                                <a onclick="return gtag_report_conversion('https://madaproperties.com/landing/lagoons/ar');" href="#contact-us">احجز الآن</a><!--Book now-->

                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">

                        <div class="latest-item">

                            <div class="latest-item-pic set-bg" data-setbg="img/slider/image3.jpg" style="background-image: url(../img/slider/damac-lagoons-costa.jpg);"></div>

                            <div class="latest-item-text">

                                <span> ابتداءً من 1.53 مليون درهم إماراتي</span><!--Costa Brava - AED 1.53 Million-->

                                <h5>كوستا برافا لاجونز داماك</h5>

                                <a onclick="return gtag_report_conversion('https://madaproperties.com/landing/lagoons/ar');" href="#contact-us">احجز الآن</a>

                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">

                        <div class="latest-item">

                            <div class="latest-item-pic set-bg" data-setbg="img/slider/image17.jpg" style="background-image: url(../img/slider/damac-lagoons-santorini.jpg);"></div>

                            <div class="latest-item-text">

                                <span>ابتداءً من 1.49 مليون درهم إماراتي</span><!--Santorini - AED 1.49 Million-->

                                <h5>سانتوريني في لاجونز داماك </h5>

                                <a onclick="return gtag_report_conversion('https://madaproperties.com/landing/lagoons/ar');" href="#contact-us">احجز الآن</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!--Invest-->

        <section id="invest">

        <div class="container-xxl py-5">

            <div class="container">

                <h2 class="text-center mb-5">لماذا الاستثمار في دبي</h2><!--Why invest in dubai?-->

                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4">

                            <img src="../img/icons/Stable-Currancy.png">

                            <h6 class="mt-3 mb-3">عملة مستقرة</h6>

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4">

                            <img src="../img/icons/World-Class-Healthcare.png">

                            <h6 class=" mt-3 mb-3">رعاية صحية عالمية المستوى</h6>

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4">

                            <img src="../img/icons/World-Class-Amenties.png">

                            <h6 class="mt-3 mb-3">وسائل راحة عالية المستوى</h6>

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4">

                            <img src="../img/icons/Open-and-free System.png">

                            <h6 class="mt-3 mb-3"> نظام مفتوح ومجاني</h6>

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4">

                            <img src="../img/icons/Stratagic-Location.png">

                            <h6 class=" mt-3 mb-3">موقع استراتيجي</h6>

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4">

                            <img src="../img/icons/Tax-Efficient.png">

                            <h6 class="mt-3 mb-3">استثمار يخضع لضرائب أقل</h6>

                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4" >

                            <img src="../img/icons/Easy-Connectivity.png">

                            <h6 class="mt-3 mb-3">تصال سهل</h6>
                            <p class="mb-0"></p>

                        </a>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">

                        <a class="cat-item rounded p-4" >

                            <img src="../img/icons/Safty-For-All.png">

                            <h6 class="mt-3 mb-3">أمان للجميع</h6>

                            <p class="mb-0"></p>

                        </a>

                    </div>

                </div>

            </div>

            </div>

        </div>

       

    </section>

        

       

        <!--Google map-->

        <section id="location">

        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">

		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14462.406863396936!2d55.23008932632481!3d25.013646103729908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f711ebc19261b%3A0x99f06416331f173f!2sDAMAC%20Lagoons!5e0!3m2!1sen!2sae!4v1649143228876!5m2!1sen!2sae" 

			style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>

        </section>





        <section id="contact-us" class="container contact-overlap pt-5">

            <div class="form">

                <form action="submit.php" method="post" role="form" class="submitForm2" id="submitForm2">

                    <h2 class="contact-text">سجل الآن</h2>

                    <p class="text-contact">لمزيد من المعلومات</p>

                  <div class="form-group">

                   <input placeholder="الاسم الأول *" type="text" id="edit-submitted-first-name" name="first_name" value="<?php if (isset($arg['firstname'])) { print $arg['firstname']; } ?>" size="60" maxlength="128" required>

						<?php if (isError($errors,"firstname")) { print "<label id='edit-submitted-first-name-error' class='error' for='edit-submitted-first-name'>يرجى تحديد اسمك الأول</label>"; } ?>

                  </div>

                   <div class="form-group">

                  	<input placeholder="الاسم الأخير *" type="text" id="edit-submitted-last-name" name="last_name" value="<?php if (isset($arg['lastname'])) { print $arg['lastname']; } ?>" size="60" maxlength="128">

						<?php if (isError($errors,"lastname")) { print "<label id='edit-submitted-last-name-error' class='error' for='edit-submitted-last-name'>يرجى تحديد اسمك الأخير</label>"; } ?>

                  </div>

                  <div class="form-group">

                    	<input placeholder="البريد الإلكتروني" type="email" id="edit-submitted-email" name="email" value="<?php if (isset($arg['email'])) { print $arg['email']; } ?>" size="60" required>

						<?php if (isError($errors,"email")); ?>

                  </div>

                <div class="form-group phone">

						<input placeholder="رقم الجوال *" type="text" id="phone2" name="phone_number" value="<?php if (isset($arg['phone'])) { print $arg['phone']; } ?>"  size="60" maxlength="128" autocomplete="off" required>

						<?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>يرجى تحديد رقم هاتفك الجوال المكون من 9 أرقام</label>"; } ?>

					</div>

           

                    <div class="form-item" style="display: none">

					 <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">

					 <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">

					 <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">

					 <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">

					 <input type="hidden" name="iso2" id=iso3 value="<?php if (isset($gclid)) { echo $gclid; } ?>">

					 <input type="hidden" name="language" value="عربي">

					 <input type="hidden" name="project" value="<? echo $project ?>">

					</div>

                 <div class="form-actions"><input class="form-submit" type="submit" value="سجل الان"></div>

                </form>

              </div>

            </div>

          </section>

        

          <!--Footer-->

        <footer id="footer" role="contentinfo">

            <div class="site-footer">

                <div class="container">

                  <div class="row  justify-content-center">

                    <div class="col-lg-6">

                      <h2>مدى العقارية </h2>

                      <p>تبحث عن أفضل مكان لشراء العقارات في دبي والرياض؟
في مدى العقارية يمكننا أن نقدم لك أفضل الحلول والخدمات العقارية التي ستساعدك في الوصول أهدافك الاستثمارية</p>

                    </div>

                  </div>

                <ul class="list-unstyled footer-link d-flex pt-5 footer-social justify-content-center ml-5">

                  <li><a href="#" class="p-2"><span class="fab fa-twitter"></span></a></li>

                  <li><a href="#" class="p-2"><span class="fab fa-facebook-f"></span></a></li>

                  <li><a href="#" class="p-2"><span class="fab fa-linkedin"></span></a></li>

                  <li><a href="#" class="p-2"><span class="fab fa-instagram"></span></a></li>

                </ul>

                <a href="privacy-policy.php" class="privacy-policy"><p>سياسة الخصوصية</p></a>

              </div>

            </div>

          </footer>

        

        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

        <script type="text/javascript">

            $(function () {

                $(document).click(function (event) {

                    var clickover = $(event.target);

                    var _opened = $(".navbar-collapse").hasClass("navbar-collapse collapse show");

                    if (_opened === true && !clickover.hasClass("navbar-toggler")) {

                        $("button.navbar-toggler").click();

                    }

                });

            });

        </script>

    </body>

</html>



