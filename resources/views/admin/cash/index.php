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
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1" name="viewport">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
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
    </head>

    <body>
        <section>
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                    <div class="container-fluid">
                        <a class="logo me-2 ">
                            <img
                              src="../img/slider/mada-properties-logo-black.png"

                            />
                          </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mynavbar">
                      <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link" href="#amenities">AMENITIES</a>
                        <a class="nav-item nav-link" href="#gallery">GALLERY</a>
                        <a class="nav-item nav-link" href="#bedroom">BEDROOM</a>
                        <a class="nav-item nav-link" href="#features">FEATURES</a>
                        <a class="nav-item nav-link" href="#projects">PROJECTS</a>
                        <a class="nav-item nav-link" href="#invest">INVEST</a>
                        <a class="nav-item nav-link" href="#location">LOCATION</a>
                        <a class="nav-item nav-link" href="#contact-us">CONTACT US</a>
                      </div>
                    </div>
                  </nav>
        </section>

        <section>
            <div class="bg-header">
                <div id="header-text">
                <div class="project-title col-sm-10">
                    <h1>DAMAC LAGOONS</h1>
                    <p>Presenting DAMAC Lagoons – a new community where enchanting villas and townhouses surround crystal lagoons 
						white sandy beaches, tropical island vibes and a host of other enchanting experiences. </a>
                    
                    </div>

                    <div class="project-price">
                        <p>STARTING FROM $ 425,000</p>
                    </div>
                    <div class="short-features col-sm-12">
                        <p><i class="fa  fa-check-circle"></i> New Launch of 3, 4 & 5 BR Townhouses & 7 BR Villas</p>
                        <p><i class="fa  fa-check-circle"></i> Views of Crystal Lagoon and Water Bodies</p>
                        <p><i class="fa  fa-check-circle"></i> 4 Years Payment Plan</p>
                    </div>
                        <a href="" class="button-read btn btn-primary py-md-3 px-md-5 me-3 mt-4">INQUIRE NOW</a>
                    </div>
                </div>
            </div>

        </section>

        <section id="description">
            <div class="container-fluid overflow-hidden py-5 px-lg-0">
                <div class="container feature py-5 px-lg-0">
                    <div class="row g-5 mx-lg-0">
                        <div class="col-lg-6">
                            <h6 class="text-secondary text-uppercase mb-3">DAMAC LAGOONS</h6>
                            <h2 class="mb-5">ESCAPE TO A HOLIDAY WITHOUT EVER LEAVING HOME</h2>
                            <div class="mb-3">
                                <i class="text-primary"></i>
                                <div class="ms-4">
                                    <h5>New Launch - Portofino at Damac Lagoons</h5>
                                    <p class="mb-0">At Portofino Damac Lagoons, the sun glimmers on a ballroom floor of blue, keeping company with peachy pastels, 
										eye-catching tones, and bold statements. As with the best masterpieces of the world, 
										Portofino Damac Lagoons palette is a visual balance of color and pattern, unity, and variety. 
										Work & Play Hub is built on this concept, giving you a picturesque office address where you can enjoy nature.

									Find yourself at one with nature in a space designed for the unique mix of adventure, excitement and luxury living, giving you the chance to explore new avenues of water-first fun, only at Portofino Damac Lagoons.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-5">
                                <i class="text-primary fa-3x flex-shrink-0"></i>
                                <div class="ms-5">
                                    <h5></h5>
                                    <p class="mb-0">Find yourself at one with nature in a space designed for the unique mix of adventure, 
										excitement and luxury living, giving you the chance to explore new avenues of water-first fun.</p>
                                </div>
                            </div>
							<p class="register">REGISTER</p>
	
                             
                        </div>
                        <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute img-fluid w-100 h-100" src="../img/slider/image10.jpg" style="object-fit: cover;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="amenities">
            <div class="container">
                <h2 class="text-center mb-5">AMENITIES</h2>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4">
                            <img src="../img/icons/Hotel.png">
                            <h6 class="mt-3 mb-3">Aqua Office</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4">
                            <img src="../img/icons/Hotel.png">
                            <h6 class=" mt-3 mb-3">Aqua Library</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4">
                            <img src="../img/icons/Gym.png">
                            <h6 class="mt-3 mb-3">Aqua Gym</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4">
                            <img src="../img/icons/music pavilion.png">
                            <h6 class="mt-3 mb-3">Air Music Pavilion</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4">
                            <img src="../img/icons/observatory.png">
                            <h6 class=" mt-3 mb-3">Observatory</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4">
                            <img src="../img/icons/Hotel.png">
                            <h6 class="mt-3 mb-3">Business Center</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4" >
                            <img src="../img/icons/Spa.png">
                            <h6 class="mt-3 mb-3">Outdoor SPA</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="list p-4" >
                            <img src="../img/icons/fishing lake.png">
                            <h6 class="mt-3 mb-3">Fishing Lake</h6>
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
                        <h2 class="text-center">GALLERY</h2>
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
                <h2 class="text-center font-weight-bold">BEDROOM</h2>
                <br>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">3 Bedroom</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">4 Bedroom</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">5 Bedroom</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">7 Bedroom</a>
                  </li>
                </ul>
              
                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="home" class="container tab-pane active"><br>
                    <div class="container-fluid overflow-hidden py-5 px-lg-0">
                        <div class="container about py-5 px-lg-0">
                            <div class="row g-5 mx-lg-0">
                                <div class="col-lg-5 about-text">
                                    <h6 class="text-secondary text-uppercase mb-3">Townhouse</h6>
                                    <h1 class="mb-5 font-weight-bold">3 Bedroom</h1>
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
                                    <h6 class="text-secondary text-uppercase mb-3">Townhouse</h6>
                                    <h1 class="mb-5 font-weight-bold">4 Bedroom</h1>
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
                                    <h6 class="text-secondary text-uppercase mb-3">Townhouse</h6>
                                    <h1 class="mb-5 font-weight-bold">5 Bedroom</h1>
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
                                    <h6 class="text-secondary text-uppercase mb-3">Villa</h6>
                                    <h1 class="mb-5 font-weight-bold">7 Bedroom</h1>
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
                <div class="col-md-12"><h2>Features</h2>
                  <ul class="pt-3">
                    <li>Set Within 8 City Themes Including Spain, Italy, France</li>
                    <li>Homes Surrounding an Azure Blue Lagoon</li>
                    <li>Tropical Island Vibe Community</li>
                    <li>White Sandy Beaches</li>
                    <li>Floating Cinema</li>
                    <li>Water Restaurants & Cafes</li>
					<li>Handover: 2024</li>
					<li>Developer: Damac Properties</li>
                  </ul>

                </div>
                <!--
                <div class="col-md-6"><h2>Amenties</h2>
                  <ul class="list-unstyled float-left">
                    <li>Dolor sit amet</li>
                    <li>Obcaecati similique excepturi</li>
                    <li>Ipsum amet voluptas</li>
                    <li>Aliquid facilis est</li>
                    <li>Eligendi laborum assumenda</li>
                  </ul>
                </div>-->
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
                <strong class="d-block">10 Minutes</strong>
                <span style="font-size: 14px;">Dubai Polo & Equestrian Club</span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="numbers">
                <strong class="d-block">22 Minutes</strong>
                <span style="font-size: 14px;">Dubai Marina</span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="numbers">
                <strong class="d-block">24 Minutes</strong>
                <span style="font-size: 14px;">Mall of Emirates</span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="numbers">
                <strong class="d-block">28 Minutes</strong>
                <span style="font-size: 14px;">Al Maktoum Intl Airport</span>
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
                            <span>New</span>
                            <h2>Latest Projects</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="latest-item">
                            <div class="latest-item-pic set-bg" data-setbg="img/image7.jpg"style="background-image: url(../img/slider/damac-lagoons-nice.jpg);"></div>
                            <div class="latest-item-text">
								<span>Starting from $ 463,000</span>
                                <h5>Nice <br>at Damac Lagoons</h5>
                                <a href="#contact-us">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="latest-item">
                            <div class="latest-item-pic set-bg" data-setbg="img/slider/image3.jpg" style="background-image: url(../img/slider/damac-lagoons-costa.jpg);"></div>
                            <div class="latest-item-text">
                                <span>Starting from $ 417,000</span>
                                <h5>Costa Brava at Damac Lagoons</h5>
                                <a href="#contact-us">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="latest-item">
                            <div class="latest-item-pic set-bg" data-setbg="img/slider/image17.jpg" style="background-image: url(../img/slider/damac-lagoons-santorini.jpg);"></div>
                            <div class="latest-item-text">
                                <span>Starting from $ 406,000</span>
                                <h5>Santorini at Damac Lagoons</h5>
                                <a href="#contact-us">Book Now</a>
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
                <h1 class="text-center mb-5">WHY INVEST IN DUBAI?</h1>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4">
                            <img src="../img/icons/Stable-Currancy.png">
                            <h6 class="mt-3 mb-3">Stable Currency</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4">
                            <img src="../img/icons/World-Class-Healthcare.png">
                            <h6 class=" mt-3 mb-3">World-Class Health Care</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4">
                            <img src="../img/icons/World-Class-Amenties.png">
                            <h6 class="mt-3 mb-3">World-class Amenities</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4">
                            <img src="../img/icons/Open-and-free System.png">
                            <h6 class="mt-3 mb-3">Open and Free System</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4">
                            <img src="../img/icons/Stratagic-Location.png">
                            <h6 class=" mt-3 mb-3">Strategic Location</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4">
                            <img src="../img/icons/Tax-Efficient.png">
                            <h6 class="mt-3 mb-3">Tax Efficient</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4" >
                            <img src="../img/icons/Easy-Connectivity.png">
                            <h6 class="mt-3 mb-3">Easy Connectivity</h6>
                            <p class="mb-0"></p>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-3 pb-4">
                        <a class="cat-item rounded p-4" >
                            <img src="../img/icons/Safty-For-All.png">
                            <h6 class="mt-3 mb-3">Safety for all</h6>
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
                <form action="submit.php" method="post" role="form" class="contactForm">
                    <h2 class="contact-text">REGISTER NOW</h2>
                    <p class="text-contact">FOR MORE INFO</p>
                  <div class="form-group">
                   <input placeholder="First name *" type="text" id="edit-submitted-first-name" name="first_name" value="<?php if (isset($arg['firstname'])) { print $arg['firstname']; } ?>" size="60" maxlength="128">
						<?php if (isError($errors,"firstname")) { print "<label id='edit-submitted-first-name-error' class='error' for='edit-submitted-first-name'>Please enter your first name</label>"; } ?>
                  </div>
                   <div class="form-group">
                  	<input placeholder="Last name *" type="text" id="edit-submitted-last-name" name="last_name" value="<?php if (isset($arg['lastname'])) { print $arg['lastname']; } ?>" size="60" maxlength="128">
						<?php if (isError($errors,"lastname")) { print "<label id='edit-submitted-last-name-error' class='error' for='edit-submitted-last-name'>Please enter your last name</label>"; } ?>
                  </div>
                  <div class="form-group">
                    	<input placeholder="Email" type="email" id="edit-submitted-email" name="email" value="<?php if (isset($arg['email'])) { print $arg['email']; } ?>" size="60">
						<?php if (isError($errors,"email")); ?>
                  </div>
                <div class="form-group phone">
						<input placeholder="Mobile *" type="text" id="phone" name="phone_number" value="<?php if (isset($arg['phone'])) { print $arg['phone']; } ?>"  size="60" maxlength="128" autocomplete="off">
						<?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>Phone number field accept only  9 digits</label>"; } ?>
					</div>
                 <div class="form-group">
                        <select class="form-control " id="unit_country" name="unit_country" data-select2-id="" tabindex="-1" aria-hidden="true">
                         	<option value="">Choose Investment Country</option>
                            <option value="2" data-select2-id="2">United Arab Emirates</option>
                            <option value="1" data-select2-id="1">Saudi Arabia</option>
                        </select>
                        </div>
                            <div class="form-group">
                        <select class="form-control" name="budget" id="budget">
                        	<option value="">Budget</option>
                        	<option value=" 0 - 500,000"> 0 - 500,000</option>
                        	<option value="500,000 - 1,000,000">500,000 - 1,000,000</option>
                        	<option value="1,000,000 - 1,500,000">1,000,000 - 1,500,000</option>
                        	<option value="2,000,000 - 2,500,000">2,000,000 - 2,500,000</option>
                        	<option value="3,000,000 - 3,500,000">3,000,000 - 3,500,000</option>
                        	<option value="> 4,000,000    ">&gt; 4,000,000    </option>
                        </select>
                    </div>
                    <div class="form-item" style="display: none">
					 <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">
					 <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">
					 <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">
					 <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">
					 <input type="hidden" name="iso2" id=iso2 value="<?php if (isset($gclid)) { echo $gclid; } ?>">
					 <input type="hidden" name="language" value="english">
					 <input type="hidden" name="project" value="<? echo $project ?>">
					</div>
                 <div class="form-actions"><input class="form-submit" type="submit" value="Register Now"></div>
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
                      <h2>MADA PROPERTIES</h2>
                      <p>Looking for the best place to buy property in Dubai & Riyadh? We at Mada Properties can provide you the best real estate solutions and services that will help you reach your investment goals.</p>
                    </div>
                  </div>
                <ul class="list-unstyled footer-link d-flex pt-5 footer-social justify-content-center">
                  <li><a href="#" class="p-2"><span class="fab fa-twitter"></span></a></li>
                  <li><a href="#" class="p-2"><span class="fab fa-facebook-f"></span></a></li>
                  <li><a href="#" class="p-2"><span class="fab fa-linkedin"></span></a></li>
                  <li><a href="#" class="p-2"><span class="fab fa-instagram"></span></a></li>
                </ul>
              </div>
            </div>
          </footer>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

<div id="register" class="overlay-fixed overlay hide registerHolder">
			<form action="submit.php" method="post" id="submitForm" accept-charset="UTF-8">
			<div class="close">X</div>
				<div>
					<div class="form-item">
						<input placeholder="First name *" type="text" id="edit-submitted-first-name" name="first_name" value="<?php if (isset($arg['firstname'])) { print $arg['firstname']; } ?>" size="60" maxlength="128">
						<?php if (isError($errors,"firstname")) { print "<label id='edit-submitted-first-name-error' class='error' for='edit-submitted-first-name'>Please enter your first name</label>"; } ?>

					</div>
					<div class="form-item">
						<input placeholder="Last name *" type="text" id="edit-submitted-last-name" name="last_name" value="<?php if (isset($arg['lastname'])) { print $arg['lastname']; } ?>" size="60" maxlength="128">
						<?php if (isError($errors,"lastname")) { print "<label id='edit-submitted-last-name-error' class='error' for='edit-submitted-last-name'>Please enter your last name</label>"; } ?>
					</div>
					<div class="form-item">
						<input placeholder="Email" type="email" id="edit-submitted-email" name="email" value="<?php if (isset($arg['email'])) { print $arg['email']; } ?>" size="60">
						<?php if (isError($errors,"email")); ?>
					</div>
					<div class="form-item">
						<input placeholder="City" type="city" id="edit-submitted-city" name="city" value="<?php if (isset($arg['city'])) { print $arg['city']; } ?>" size="60">
						<?php if (isError($errors,"city")); ?>
					</div>
					<div class="form-item phone">
						<input placeholder="Mobile *" type="text" id="phone" name="phone_number" value="<?php if (isset($arg['phone'])) { print $arg['phone']; } ?>"  size="60" maxlength="128" autocomplete="off">
						<?php if (isError($errors,"phone")) { print "<label id='phone-error' class='error' for='phone'>Phone number field accept only  9 digits</label>"; } ?>
					</div>
					<div class="form-item" style="display: none">
					 <input type="hidden" name="utm_campaign" value="<?php if (isset($utm_campaign)) { echo $utm_campaign; } ?>">
					 <input type="hidden" name="utm_medium" value="<?php if (isset($utm_medium)) { echo $utm_medium; } ?>">
					 <input type="hidden" name="utm_source" value="<?php if (isset($utm_source)) { echo $utm_source; } ?>">
					 <input type="hidden" name="utm_content" value="<?php if (isset($utm_content)) { echo $utm_content; } ?>">
					 <input type="hidden" name="utm_term" value="<?php if (isset($utm_term)) { echo $utm_term; } ?>">
					 <input type="hidden" name="gclid" value="<?php if (isset($gclid)) { echo $gclid; } ?>">
					 <input type="hidden" name="language" value="en">
					 <input type="hidden" name="page_title" value="Arabian Ranches | Bliss | Landing Page">
					</div>
					<div class="form-actions"><input class="form-submit" type="submit" value="Register Now"></div>
				</div>
			</form>
		</div>