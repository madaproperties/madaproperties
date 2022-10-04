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
        <title>Mada Properties</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0"/>

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="../inc/css/intlTelInput.css">

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    

    <!--forms-->
    <script src="../js/jquery.form.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
		<script src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
		<script src="../inc/js/intlTelInput.js"></script>
    <script src="../js/main.js"></script>
    

    </head>

    <body data-spy="scroll">

<a href="javascript:" id="return-to-top"><i class="icon-arrow-up"></i></a>

<div class="cd-popup" role="alert">

        <div class="cd-popup-container">
          <div class="contact100-form-title" style="background-image: url(img/4.jpg);  border-radius: 30px 30px 0 0;">
         
            </div>

            <div class="text-center">
              <h3 class="modal-title">
              REGISTER FOR MORE INFORMATION</h3>
              <p>
               Please fill the form
              </p>
              </div>
              <div class="modal-body header-form">
          <form action="submit.php" method="post" role="form"  id="submitForm" class="submitForm" name="submitForm">
            <div class="form-row">
              <div class="col-md-12 form-group">
              <input  placeholder="First Name" type="text" name="first_name" class="form-control" id="edit-submitted-first-name" data-rule="minlen:4" required>
              </div>
              <div class="col-md-12 form-group">
              <input  placeholder="Last Name" type="text" name="last_name" class="form-control" id="edit-submitted-last-name" data-rule="minlen:4">
              </div>
              <div class="col-md-12 form-group">
            <input  placeholder="Email" type="text" name="email" class="form-control" id="edit-submitted-last-name" data-rule="minlen:4"  required>
            </div>
            </div>

            <div class="form-item phone">
              <input  placeholder="Mobile" type="text" name="phone_number" class="form-control" id="phone" value="<?php if (isset($arg['phone'])) { print $arg['#phone']; } ?>" size="60" maxlength="128" autocomplete="off">
      <?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>Phone number field accept only  9 digits</label>"; } ?>
    </div>
    <div class="form-item" style="display: none">

                      <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">

                      <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">

                      <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">

                      <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">

                      <input type="hidden" name="iso2" id="iso2" value="<?php if (isset($gclid)) { echo $gclid; } ?>">

                      <input type="hidden" name="language" value="english">

                      <input type="hidden" name="project" value="<? echo $project ?>">
    </div>
            <div class="form-actions text-center pt-5"><input class="form-submit w-100 p-2" type="submit" value="REGISTER" style="background-color: #9FCE31"></div>
          </form>
</div>
<a href="#0" class="cd-popup-close img-replace">Close</a>
</div>


        </div> <!-- cd-popup-container -->



<section id="header-section">

<div class="cover-v1" data-aos="fade" style="background-image: url('img/2.jpg');" id="home-section">
  <div class="container"><div class="logo text-center pt-3">
    <img src="img/mada-logo-white.png" style="width:200px" class="logo"></div>
    <div class="row align-items-center">
        
      <div class="col-md-9 invest-title"  data-aos="fade-up">
        <h1 class="heading">Make Dubai Your Second Home</h1>
        <h2 class="subheading">Let’s Find the Right Property For You</h2>
        <div class="pop-up-button"><a href="" class="button cd-popup-trigger">GET QUOTATION</a></div>

    </div>


  <!--<a href="#about-section" class="mouse-wrap smoothscroll">
    <span class="mouse">
      <span class="scroll"></span>
    </span>
    <span class="mouse-label">Scroll</span>
  </a>-->

</div>
</section>


<section class="ftco-section ftco-about">
<div class="container">
<div class="row no-gutters">
<div class="cover-v2 col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center"  data-aos="fade-up" data-aos-delay="100" 
style="background-image: url(img/6.jpg);">
</div>
<div class="col-md-6 wrap-about" data-aos="fade-up" data-aos-delay="100">
  <div class="about-section about-section-white pl-md-5">
    <h2 class="mb-4 about-text"><span style="color: #baff18">Explore different investment opportunities</span> across multiple prime 
      locations here in Dubai, and </h2> 
      <h2 class="subheading" style="color:#baff18; font-size: 36px">START LIVING THE DUBAI LIFE</h2>
  </div>
</div>
</div>
</div>
</section>

<section class="ftco-section">
<div class="container">
<div class="row tabulation mt-4">
<div class="col-md-4 order-md-last">
<ul class="nav nav-pills nav-fill d-md-flex d-block flex-column">
  <li class="nav-item text-left" data-aos="fade-up">
    <div class="dbox w-100 d-flex align-items-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <img src="img/icon/Payment Plan.png" style="height: 70px">
      </div>
      <div class="text pl-3">
      <p><span>Convenient Payment Plans</a></p>
      </div>
      </div>
  </li>
  <li class="nav-item text-left" data-aos="fade-up">
    <div class="dbox w-100 d-flex align-items-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <img src="img/icon/Tourism.png" style="height: 70px">
      </div>
      <div class="text pl-3">
      <p><span>Booming Tourism & Hospitality</a></p>
      </div>
      </div>
  </li>
  <li class="nav-item text-left" data-aos="fade-up">
    <div class="dbox w-100 d-flex align-items-start">
      <div class="icon d-flex align-items-center justify-content-center">
      <img src="img/icon/High Rental.png" style="height: 70px">
      </div>
      <div class="text pl-3">
      <p><span>High Rental Yields (7-10%)</p>
      </div>
      </div>
  </li>
  <li class="nav-item text-left" data-aos="fade-up">
    <div class="dbox w-100 d-flex align-items-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <img src="img/icon/Tax Free.png" style="height: 70px">
      </div>
      <div class="text pl-3">
      <p><span>Totally Tax-Free Properties</a></p>
      </div>
    </div>
  </li>
  <li class="nav-item text-left" data-aos="fade-up">
    <div class="dbox w-100 d-flex align-items-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <img src="img/icon/Safe Living.png" style="height: 70px">
      </div>
      <div class="text pl-3">
      <p><span>Safe & Sound Living (World’s 2nd Safest City)s</a></p>
      </div>
      </div>
  </li>
  <li class="nav-item text-left" data-aos="fade-up">
    <div class="dbox w-100 d-flex align-items-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <img src="img/icon/World Class Infra.png" style="height: 70px">
      </div>
      <div class="text pl-3">
      <p><span>World-Class Infrastructure</a></p>
      </div>
      </div>
  </li>
  <li class="nav-item" data-aos="fade-up"> 
    <div class="dbox w-100 d-flex align-items-center">
      <div class="icon d-flex align-items-center justify-content-center">
        <img src="img/icon/Free Hold.png" style="height: 70px">
      </div>
      <div class="text pl-3">
      <p><span>100% Freehold Ownership</a></p>
      </div>
      </div>
  </li>
</ul>
</div>
<div class="col-md-8">
<div class="tab-content" data-aos="fade-up">
  <div class="invest-title-2 container p-0 active" id="services-1">
    <h2 class="invest-text-2">WHY YOU SHOULD INVEST IN DUBAI?</h2>
    <div class="img" style="background-image: url(img/7.jpg);"></div>
    
  </div>
  
</div>
</div>
</div>

</div>
</div>
</section>

<section class="ftco-section ftco-about-2">
<div class="container">
<div class="row no-gutters">
<div class="col-md-6 wrap-about" data-aos="fade-up" data-aos-delay="100">
  <div class="about-section about-section-white">
    <h2 class="mb-4 dubai-text"><span style="color: #baff18">Own your dream home</span> in DUBAI with a wide selection of <span style="color: #baff18">apartments, villas, townhouses, mansions, and plots,</span> and get the best offers & opportunities</h2>
  </div>
</div>
<div class="cover-v2 col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center"  data-aos="fade-up" data-aos-delay="100" 
style="background-image: url(img/10.jpg);">
</div>
</div>
</div>
</section>

<section>
<div class="text-center justify-content-center">
<h2 class="section-title" data-aos="fade">Featured Premium Communities in Dubai</h2>
</div>
<div class="sub-block-2-2" id="projects">

<div class="container">

  <div class="row">

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="re-card">
              <img src="img/dch.jpg" alt="">
              <div class="re-card-info">
                  <h3>DUBAI CREEK HARBOUR</h3>
                
              </div>
              <div class="card-buttons">
                
                  <button class="cd-popup-trigger">Learn
                      More
                  </button>
              </div>
          </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="re-card">
              <img src="img/lagoons.jpg" alt="">
              <div class="re-card-info">
                  <h3>Damac Lagoons</h3>
                
              </div>
              <div class="card-buttons">
                 
                   
                  <button class="cd-popup-trigger">Learn
                      More
                  </button>
              </div>
          </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="re-card">
              <img src="img/Mina Rashid.jpg" alt="">
              <div class="re-card-info">
                <h3>Mina Rashid</h3>
                 
              </div>
              <div class="card-buttons">
               
                  <button class="cd-popup-trigger">Learn
                      More
                  </button>
              </div>
          </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="re-card">
              <img src="img/Beachfront.jpg" alt="">
              <div class="re-card-info">
                  <h3>Emaar Beachfront</h3>
                
              </div>
              <div class="card-buttons">
               
                  <button class="cd-popup-trigger">Learn
                      More
                  </button>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="re-card">
              <img src="img/Downtown.jpg" alt="">
              <div class="re-card-info">
                  <h3>Downtown Dubai</h3>
               
              </div>
              <div class="card-buttons">
            
                  <button class="cd-popup-trigger">Learn
                      More
                  </button>
              </div>
          </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
        <div class="re-card">
            <img src="img/MBR.jpg" alt="">
            <div class="re-card-info">
                <h3>Mohammed Bin Rashid</h3>
             
            </div>
            <div class="card-buttons">
          
                <button class="cd-popup-trigger">Learn
                    More
                </button>
            </div>
        </div>
    </div>

      </div>
      
  </div>
</div>
</div>
</div>
</section>


<section class="chooseus-section spad cover-v3 mb-5" style="background-image: url(img/13.jpg);">
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="chooseus-text text-center">
            <div class="section-title">
                <h4></h4>
            </div>
            <p>In recent years, Dubai has become one of the most desirable cities in the world to live in. 
              In its bustling business, commerce, and tourism destination, investors have been able to explore opportunities.</p>

            <p>From a wide selection of property offers you a wide range of rental yields, completely tax-free and 100% 
              freehold ownership, Dubai offers a high rental yield of 7 to 10% annual. </p>

           <p>As a result of its world-class infrastructure, Dubai & the UAE is the second safest country in the world today, 
            demonstrating its cosmopolitan culture, tourism, and growing population.</p>

          <p>
            Known for its long-term visa policies and stable currency, Dubai is an attractive place to invest, 
            work, and reside.
          </p>
          </div>
    </div>
</div>
</div>
</section>

<div class="site-section" id="faq-section">
<div class="col-12 text-center" data-aos="fade">
<h2 class="section-title">HOW TO BUY A PROPERTY IN DUBAI?</h2>
<p>Frequently asked questions about purchasing a property in Dubai</p>
</div>
</div>
<div class="container faq">
<div class="row">
<div class="col-lg-6">
<div class="accordion" id="accordionExample">
<div class="card" data-aos="fade-up" data-aos-delay="100">
  <div class="card-header" id="headingOne">
    <h2 class="mb-0">
      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        The Law for Buying Property in Dubai
      </button>
    </h2>
  </div>

  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
    <div class="card-body mb-0 pb-0">
      The Real Estate Law No. 7 of 2006: Land Registration Law governs the legal issues of purchasing a property in Dubai.
      <ul>
        <li>UAE Citizen</li>
        <li>GCC Citizen</li>
      </ul>
    </div>
  </div>
</div>
<div class="card"  data-aos="fade-up" data-aos-delay="200">
  <div class="card-header" id="headingTwo">
    <h2 class="mb-0">
      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Knowing your Budget
      </button>
    </h2>
  </div>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <div class="card-body">
      Many of us have been guilty of beginning the house-buying process by looking at properties 
      posted online, only to be disappointed when our dream home is out of our price range. Remember 
      that the deposit is not the only charge to consider; there are also transfer fees, agency fees, 
      sales progression fees, mortgage arrangement fees, and mortgage insurance expenses to consider.
    </div>
  </div>
</div>
<div class="card"  data-aos="fade-up" data-aos-delay="300">
  <div class="card-header" id="headingThree">
    <h2 class="mb-0">
      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Buyer and Seller contact agreement
      </button>
    </h2>
  </div>
  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
    <div class="card-body">
      The first step after finding the suitable property is to negotiate and specify the terms of sale with the seller. 
      When you and the seller agree on the conditions of sale, be sure there are no misunderstandings about the selling 
      price, manner of payment, or any other vital issues.
    </div>
  </div>
</div>
</div>
</div>
<div class="col-lg-6">
<div class="accordion" id="accordionExample">
  <div class="card"  data-aos="fade-up" data-aos-delay="500">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
          Sign the Agreement of Sale
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Signing the sale agreement, also known as the Memorandum of Understanding, is the next stage in purchasing property 
        in Dubai (MOU). It is a contractual agreement between the buyer and seller that outlines the terms and specifics of 
        an agreement, including each party's needs and responsibilities. 

      </div>
    </div>
  </div>
  <div class="card"  data-aos="fade-up" data-aos-delay="600">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
          The Process of Sale Progression
        </button>
      </h2>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Mada Properties will be there for you every step of the way, from the developer's No Objections Certificate (NOC) 
        through the transfer, to make the process as simple as possible for you. They operate as a liaison between you, 
        the buyer, the seller, the developer, and the banks involved, and with their years of expertise, they are
        incredibly proactive and know the process thoroughly and out. To prevent delays, your sales progressor will 
        double-check that all of your documentation are in order before starting the process.
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>
<div class="cover-v5 p-3" id="contact">
<div class="container">
<div class="row">
    <div class="col-lg-6 ">
        <h2 class="contact-text text-lg-start">INVEST IN DUBAI NOW!</h2>
        <h2 class="contact-text-2 text-lg-start">REGISTER FOR MORE INFORMATION</h2>
    </div>
    <div class="col-lg-6 footer_form">
       
    <form action="submit.php" method="post" role="form"  id="submitForm" class="submitForm" name="submitForm">
              <div class="form-row">
                <div class="col-md-12 form-group">
                <input  placeholder="First Name" type="text" name="first_name" class="form-control" id="edit-submitted-first-name" data-rule="minlen:4" value="<?php if (isset($arg['firstname'])) { print $arg['firstname']; } ?>" size="60" maxlength="128" required>
      <?php if (isError($errors,"firstname")) { print "<label id='edit-submitted-first-name-error' class='error' for='edit-submitted-first-name'>Please, enter your first name</label>"; } ?>
                </div>
                <div class="col-md-12 form-group">
                <input  placeholder="Last Name" type="text" name="last_name" class="form-control" id="edit-submitted-last-name" data-rule="minlen:4" value="<?php if (isset($arg['lastname'])) { print $arg['lastname']; } ?>" size="60" maxlength="128">
                <?php if (isError($errors,"lastname")) { print "<label id='edit-submitted-last-name-error' class='error' for='edit-submitted-last-name'>Please enter your last name</label>"; } ?>
                </div>
                <div class="col-md-12 form-group">
              <input  placeholder="Email" type="text" name="email" class="form-control" id="edit-submitted-last-name" data-rule="minlen:4"  value="<?php if (isset($arg['email'])) { print $arg['email']; } ?>"  size="60" required>
              <?php if (isError($errors,"email")); ?>
              </div>
              </div>
              
              <div class="form-item phone">
              <input  placeholder="Mobile" type="text" name="phone_number" class="form-control" id="phone5" value="<?php if (isset($arg['phone'])) { print $arg['#phone']; } ?>" size="60" maxlength="128" autocomplete="off">
      <?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>Phone number field accept only  9 digits</label>"; } ?>
    </div>
    <div class="form-item" style="display: none">

                      <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">

                      <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">

                      <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">

                      <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">

                      <input type="hidden" name="iso2" id="iso4" value="<?php if (isset($gclid)) { echo $gclid; } ?>">

                      <input type="hidden" name="language" value="english">

                      <input type="hidden" name="project" value="<? echo $project ?>">
    </div>
              <div class="form-actions pt-3"><input class="form-submit w-100 p-2  text-center " type="submit" value="REGISTER" style="background-color: #9FCE31"></div>
            </form>
    </div>
</div>
</div>
</div>
<footer>
<div class="container-fluid">
  <div class="row">
      <div class="col-lg-3 d-flex flex-column align-items-center justify-content-between">
          <img src="img/mada-logo-white.png" alt="" class="logo my-4 my-lg-0" style="height:50px">
         
      </div>
      <div class="contact-us-list col-lg-3 d-flex flex-column justify-content-between">
          <div class="call-us mb-3 text-center text-lg-start">
             <p><span class="fab fa-whatsapp"> <a target="_blank" class="action-whatsapp" href="https://wa.me/<? echo preg_replace("/[^A-Za-z0-9]/", "", $whatsapp_number); ?>?text=<? echo $whatsapp_txt_en; ?>"><? echo $whatsapp_number; ?></a></p>
          </div>
      </div>
      <div class="contact-us-list col-lg-3 d-flex flex-column align-items-center justify-content-between">
      <div class="follow-us text-center text-lg-start mb-3 mb-lg-0">
              <div class="scicons">
                <ul class="list-unstyled footer-link d-flex footer-social justify-content-center">
                <li><a href="https://www.facebook.com/madapropertiesuae" class="p-2"><span class="fab fa-facebook-f"></span></a></li>
                <li><a href="https://www.instagram.com/madaproperties.uae/" class="p-2"><span class="fab fa-instagram"></span></a></li>
                <li><a href="https://twitter.com/MadaPropUAE" class="p-2"><span class="fab fa-twitter"></span></a></li>
                <li><a href="https://www.linkedin.com/company/mada-properties-uae" class="p-2"><span class="fab fa-linkedin"></span></a></li>
                </ul>
              </div>
          </div>
</div>
          <div class="col-lg-3 d-flex flex-column justify-content-between">
          <div class="call-us mb-3 text-center text-lg-start">
          <a href="privacy-policy.php" class="privacy-policy"><p>Privacy Policy</p></a>
</div>
</div>

</div>
      

      <div class="col-lg-12 contact-us-list">
          <div class="call-us mb-3 text-center text-lg-start">
  
          <div class="col-12 copyright">© <?php echo date("Y"); ?> Copyright Mada Properties.</div>
              <p></p>
          </div>
      </div>
  </div>
</div>
</footer>

<div id="myModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
    <div class="contact100-form-title"  
    style="background-image: url(img/4.jpg); border-radius: 30px 30px 0 0;"> 

        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
      
      <h3 class="modal-title">
        REGISTER FOR MORE INFORMATION</h3>
        <p class="text-center" >
          Answer the fields below
        </p>
              <div class="modal-body">
              <form action="submit.php" method="post" role="form"  id="submitForm3" class="submitForm" name="submitForm3">
              <div class="form-row">
                <div class="col-md-12 form-group">
                <input  placeholder="First Name" type="text" name="first_name" class="form-control" id="edit-submitted-first-name" data-rule="minlen:4" value="<?php if (isset($arg['firstname'])) { print $arg['firstname']; } ?>" size="60" maxlength="128" required>
      <?php if (isError($errors,"firstname")) { print "<label id='edit-submitted-first-name-error' class='error' for='edit-submitted-first-name'>Please, enter your first name</label>"; } ?>
                </div>
                <div class="col-md-12 form-group">
                <input  placeholder="Last Name" type="text" name="last_name" class="form-control" id="edit-submitted-last-name" data-rule="minlen:4" value="<?php if (isset($arg['lastname'])) { print $arg['lastname']; } ?>" size="60" maxlength="128">
                <?php if (isError($errors,"lastname")) { print "<label id='edit-submitted-last-name-error' class='error' for='edit-submitted-last-name'>Please enter your last name</label>"; } ?>
                </div>
                <div class="col-md-12 form-group">
              <input  placeholder="Email" type="text" name="email" class="form-control" id="edit-submitted-last-name" data-rule="minlen:4"  value="<?php if (isset($arg['email'])) { print $arg['email']; } ?>"  size="60" required>
              <?php if (isError($errors,"email")); ?>
              </div>
              </div>
              
              <div class="form-item phone">
              <input  placeholder="Mobile" type="text" name="phone_number" class="form-control" id="phone4" value="<?php if (isset($arg['phone'])) { print $arg['#phone']; } ?>" size="60" maxlength="128" autocomplete="off">
      <?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>Phone number field accept only  9 digits</label>"; } ?>
    </div>
    <div class="form-item" style="display: none">

                      <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">

                      <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">

                      <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">

                      <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">

                      <input type="hidden" name="iso2" id="iso3" value="<?php if (isset($gclid)) { echo $gclid; } ?>">

                      <input type="hidden" name="language" value="english">

                      <input type="hidden" name="project" value="<? echo $project ?>">
    </div>
              <div class="form-actions text-center pt-5"><input class="form-submit w-100 p-2" type="submit" value="REGISTER" style="background-color: #9FCE31"></div>
            </form>
              </div>
          </div>
      </div>

<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>

<script src="js/mainaos.js"></script>
      
</html>