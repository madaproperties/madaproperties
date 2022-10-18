



$(document).ready(function(){



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

		  required:"Please Type your first name",

		  minlength:"Enter at least 2 characters"

		},

		email: {

		  email: "Your email address must be in the format of name@domain.com."

		},

		phone_number:{

			required :"Please enter phone number",

			number : "Please enter valid phone number",

			maxlength: "Phone number field accept only 12 digits",

			minlength: "Phone number field accept only 9 digits"

			

		}

	}

  });



  $("#submitForm3").validate({

	rules: {

	  first_name:{

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

	  required:"Required: Type your First Name",

	  minlength:"Your first name must contain at least 2 characters"

	},

	email: {

	  email: "Your email address should be in the for of name@domain.com"

	},

	phone_number:{

		required :"Please, Specify your 9-digit mobile phone number",

		number : "Your mobile phone must be in numbers",

		maxlength: "The mobile number must be in 12 digits",

		minlength: "The mobile number must be in 9 digits"

		

	}

  }



});



$("#submitForm4").validate({

	rules: {

	  first_name:{

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

	  required:"Required: Type your First Name",

	  minlength:"Your first name must contain at least 2 characters"

	},

	email: {

	  email: "Your email address should be in the for of name@domain.com"

	},

	phone_number:{

		required :"Please, Specify your 9-digit mobile phone number",

		number : "Your mobile phone must be in numbers",

		maxlength: "The mobile number must be in 12 digits",

		minlength: "The mobile number must be in 9 digits"

		

	}

  }

  

});



$("#submitForm2").validate({

	rules: {

	  first_name:{

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

	  required:"Required: Type your First Name",

	  minlength:"Your first name must contain at least 2 characters"

	},

	email: {

	  email: "Your email address should be in the for of name@domain.com"

	},

	phone_number:{

		required :"Please, Specify your 9-digit mobile phone number",

		number : "Your mobile phone must be in numbers",

		maxlength: "The mobile number must be in 12 digits",

		minlength: "The mobile number must be in 9 digits"

		

	}

  }



});

	function onResize(){

        w = $(window).width();

        h = $(window).height();

		// console.log(h);

	    h = h - 85;

		$("#header-img").css("height", h + "px");

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

	  initialCountry: "gb",

	  preferredCountries: ['nl'],

	  utilsScript: "../inc/js/utils.js"

	});

	$('#iso2').val($("#phone").intlTelInput("getSelectedCountryData").iso2);



	$('#phone').on('countrychange', function(e) {

	  $('#iso2').val($("#phone").intlTelInput("getSelectedCountryData").iso2);

	});

	

	$("#phone4").intlTelInput({

		hiddenInput: "country_code",

		separateDialCode:true,

		initialCountry: "gb",

		preferredCountries: ['nl'],

		utilsScript: "../inc/js/utils.js"

	  });

	  $('#iso3').val($("#phone4").intlTelInput("getSelectedCountryData").iso2);

	

	  $('#phone4').on('countrychange', function(e) {

		$('#iso3').val($("#phone4").intlTelInput("getSelectedCountryData").iso2);

	  });



	  $("#phone5").intlTelInput({

		hiddenInput: "country_code",

		separateDialCode:true,

		initialCountry: "gb",

		preferredCountries: ['nl'],

		utilsScript: "../inc/js/utils.js"

	  });

	  $('#iso4').val($("#phone4").intlTelInput("getSelectedCountryData").iso2);

	

	  $('#phone5').on('countrychange', function(e) {

		$('#iso4').val($("#phone5").intlTelInput("getSelectedCountryData").iso2);

	  });

	

	

	  

}); 







function initMap() {

	const myLatLng = {lat: 24.7864508795801, lng: 46.624143264418116};

	const map = new google.maps.Map(document.getElementById("map"), {

	zoom: 15,

	center: myLatLng,

	clickableIcons: false

	});

	new google.maps.Marker({

	position: myLatLng,

	map,

	});

}