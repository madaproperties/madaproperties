$(document).ready(function(){
	$(".property-price").on('input keyup keypress blur change',function(){
		if($(this).attr('name') == 'yprice'){
			if($(this).val() != ''){
				$(".property-price-year").attr('disabled',false);
			}else{
				$(".property-price-year").attr('disabled',true);
				$(".property-price-year")[0].checked = false;
			}
		}else if($(this).attr('name') == 'mprice'){
			if($(this).val() != ''){
				$(".property-price-month").attr('disabled',false);
			}else{
				$(".property-price-month").attr('disabled',true);
				$(".property-price-month")[0].checked = false;
			}
		}else if($(this).attr('name') == 'wprice'){
			if($(this).val() != ''){
				$(".property-price-week").attr('disabled',false);
			}else{
				$(".property-price-week")[0].checked = false;
				$(".property-price-week").attr('disabled',true);
			}
		}else if($(this).attr('name') == 'dprice'){
			if($(this).val() != ''){
				$(".property-price-day").attr('disabled',false);
			}else{
				$(".property-price-day")[0].checked = false;
				$(".property-price-day").attr('disabled',true);
			}
		}
	});
	$('[name="sale_rent"]').click(function(){
		if($(this).val() == 1){
			$("#priceInRent").hide();
			$(".priceInSale").show();
		}else{
			$("#priceInRent").show();
			$(".priceInSale").hide();
		}
	});

	$('#buildup_area,#price').on('input keyup keypress blur change',function(){
		if($("#price").val() != '' && $("#buildup_area").val() != ''){
			$("#price_unit").val($("#price").val()/$("#buildup_area").val());
		}
	});

});