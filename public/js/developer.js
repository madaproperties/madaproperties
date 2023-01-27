$(document).ready(function(){
	$(".property-price").on('input keyup keypress blur change',function(){
		if($(this).attr('name') == 'yprice'){
			if($(this).val() != ''){
				if(!$('[name="default_price"]').is(':checked')) { 
					$(".property-price-year")[0].checked = true;
				}
				$(".property-price-year").attr('disabled',false);
			}else{
				$(".property-price-year").attr('disabled',true);
				$(".property-price-year")[0].checked = false;
			}
		}else if($(this).attr('name') == 'mprice'){
			if(!$('[name="default_price"]').is(':checked')) { 
				$(".property-price-month")[0].checked = true;
			}
			if($(this).val() != ''){
				$(".property-price-month").attr('disabled',false);
			}else{
				$(".property-price-month").attr('disabled',true);
				$(".property-price-month")[0].checked = false;
			}
		}else if($(this).attr('name') == 'wprice'){
			if(!$('[name="default_price"]').is(':checked')) { 
				$(".property-price-week")[0].checked = true;
			}
			if($(this).val() != ''){
				$(".property-price-week").attr('disabled',false);
			}else{
				$(".property-price-week")[0].checked = false;
				$(".property-price-week").attr('disabled',true);
			}
		}else if($(this).attr('name') == 'dprice'){
			if(!$('[name="default_price"]').is(':checked')) { 
				$(".property-price-day")[0].checked = true;
			}
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
			$(".priceInRent").hide();
			$(".priceInSale").show();
		}else{
			$(".priceInRent").show();
			$(".priceInSale").hide();
		}
	});

	$('#buildup_area,#price').on('input keyup keypress blur change',function(){
		if($("#price").val() != '' && $("#buildup_area").val() != ''){
			$("#price_unit").val($("#price").val()/$("#buildup_area").val());
		}
	});
	$('#title_count').html($('[name="title"]').val().length);
	$('#title_ar_count').html($('[name="title_ar"]').val().length);
	$('[name="title"]').on('input keyup keypress blur change',function(){
		$('#title_count').html($('[name="title"]').val().length);
	});
	$('[name="title_ar"]').on('input keyup keypress blur change',function(){
		$('#title_ar_count').html($('[name="title_ar"]').val().length);
	});
	$('#description').on('input keyup keypress blur change',function(){
		$('#description_count').html($('[name="description"]').value.length);
	});
	$('[name="description_ar"]').on('input keyup keypress blur change',function(){
		$('#description_ar_count').html($('[name="description_ar"]').val().length);
	});

});

$(document).ready(function(){
	$("#community").change(function(e) {
		e.preventDefault();    
		var community_id = $(this).val();
		var csrf_token = $('meta[name=csrf-token]').attr('content');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					},                    
			url: getSubCommunityUrl+'?community_id='+community_id,
			type: 'GET',
			data:{community_id:community_id},
			success: function (data) {
				$("#loadingHolder").hide();
				$('#sub_community').html(data);
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});     
});

function countChar(val,description='description') {
	var len = val.value.length;
	$('#'+description+'_count').html(len);
};