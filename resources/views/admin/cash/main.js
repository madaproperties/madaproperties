
$(document).ready(function(){
	$("#phone").intlTelInput({
	  hiddenInput: "country_code",
	  separateDialCode:true,
	  initialCountry: "sa",
	  preferredCountries: ['ae', 'sa'],
	  utilsScript: "inc/js/utils.js"
	});
	$('#iso2').val($("#phone").intlTelInput("getSelectedCountryData").iso2);

	$('#phone').on('countrychange', function(e) {
	  $('#iso2').val($("#phone").intlTelInput("getSelectedCountryData").iso2);
	});

	onResize();

	$(window).resize(function() {
		onResize();
	});

    var w, h, isMobile = false;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Opera Mobile|Kindle|Windows Phone|PSP|AvantGo|Atomic Web Browser|Blazer|Chrome Mobile|Dolphin|Dolfin|Doris|GO Browser|Jasmine|MicroB|Mobile Firefox|Mobile Safari|Mobile Silk|Motorola Internet Browser|NetFront|NineSky|Nokia Web Browser|Obigo|Openwave Mobile Browser|Palm Pre web browser|Polaris|PS Vita browser|Puffin|QQbrowser|SEMC Browser|Skyfire|Tear|TeaShark|UC Browser|uZard Web|wOSBrowser|Yandex.Browser mobile/i.test(navigator.userAgent)) { isMobile = false; }

    if (isMobile === true) {
	  $("#register").addClass( "hide" );
	}
	$( ".register" ).click(function() {
	  $("#register").removeClass( "hide" );
	  $("#register").addClass( "show" );
	  $("body").css({'position': 'relative', 'left': '0px', 'overflow-y': 'hidden', 'width': '100%', 'height': '100%', 'right': '0px', 'top': '0px', 'bottom': '0px'});
	});
	$( ".close" ).click(function() {
	  $("#register").removeClass( "show" );
	  $("#register").addClass( "hide" );
	  $("body").removeAttr("style");
	});

	$("#submitForm").validate({
	  rules: {
		first_name:{
		  required: true,
		  minlength: 2
		},
		last_name:{
		  required: true,
		  minlength: 2
		},
		phone_number: {
		  required: true,
		  number: true,
		  maxlength: 12,
		  minlength: 9
		},
		email: {
			email: true,
		}
	},
	messages: {
		first_name: {
		  required:"يرجى تحديد اسمك الأول",
		  minlength:"يجب أن يحتوي اسمك الأول على 2 كاركترس على الأقل"
		},
		last_name: {
		  required:"يرجى تحديد اسمك الأخير",
		  minlength:"يجب أن يحتوي اسمك الأخير على 2 كاركترس على الأقل"
		},
		email: {
		  email: "يجب أن يكون عنوان بريدك الإلكتروني في شكل name@domain.com"
		},
		phone_number:{
			required :"يرجى تحديد رقم هاتفك الجوال المكون من 9 أرقام",
			number : "يجب أن يكون هاتفك النقال في الأرقام",
			maxlength: "يجب أن يكون رقم الجوال في 12 أرقام",
			minlength: "يجب أن يكون رقم الجوال في 9 أرقام"
			
		}
	}
  });
	function onResize(){
        w = $(window).width();
        h = $(window).height();
		// console.log(h);
	    h = h - 85;
	//	$("#header-img").css("height", h + "px");
       // $("#slider-wrapper").css("height", h + "px");
		registerbox = document.getElementById("submitForm").offsetHeight;
		// console.log(registerbox);
		bar = registerbox + 110;
	}
	$('.gallery').slick({
		dots: true,
		lazyLoad: 'ondemand',
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		arrows:true,
		rtl: true,
		autoplay:true,
		autoplaySpeed: 2000,
		pauseOnHover: false,
	});

	$("#phone").intlTelInput({
	  hiddenInput: "country_code",
	  separateDialCode:true,
	  initialCountry: "sa",
	  preferredCountries: ['ae', 'sa'],
	  utilsScript: "inc/js/utils.js"
	});
	$('#iso2').val($("#phone").intlTelInput("getSelectedCountryData").iso2);

	$('#phone').on('countrychange', function(e) {
	  $('#iso2').val($("#phone").intlTelInput("getSelectedCountryData").iso2);
	});
});

function initMap() {
	const myLatLng = {lat: 25.01805038389564, lng: 55.2366830230472};
	const map = new google.maps.Map(document.getElementById("map"), {
	zoom: 14,
	center: myLatLng,
	clickableIcons: false
	});
	new google.maps.Marker({
	position: myLatLng,
	map,
	});
}