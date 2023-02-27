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
			$("#price").attr('required',true);
			$('[name="yprice"]').attr('required',false);
		}else{
			$(".priceInRent").show();
			$(".priceInSale").hide();
			$("#price").attr('required',false);
			$('[name="yprice"]').attr('required',true);
		}
	});

	$('#buildup_area,#price').on('input keyup keypress blur change',function(){
		if($("#price").val() != '' && $("#buildup_area").val() != ''){
			$("#price_unit").val($("#price").val()/$("#buildup_area").val());
		}
	});
	$('#title_count').html($('[name="title"]').val().length);
	$('#title_ar_count').html($('[name="title_ar"]').val().length);
	$('#notes_count').html($('[name="notes"]').val().length);
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
	$('[name="notes"]').on('input keyup keypress blur change',function(){
		$('#notes_count').html($('[name="notes"]').val().length);
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
	
	$('#zone_id').on('change', function () {
		var id = this.value;
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},      
			url: fetchDistrict,
			type: "POST",
			data: {
				zone_id: id,
				_token: csrfToken
			},
			dataType: 'json',
			success: function (result) {
				$('#district_id').html('<option value="">Select</option>');

				$.each(result.districts, function (key, value) {
					$("#district_id").append('<option value="' + value
						.id + '">' + value.name + '</option>');
				});
			}
		});
		
	}); 
});
$(function() {
    
    $('#property_form').validate({
        ignore: [],
        invalidHandler: function() {
            setTimeout(function() {
				var tempVar = 1;
				$('.nav-tabs a small.error').remove();
                var validatePane = $('.tab-content .tab-pane:has(.form-control.error)').each(function() {
					var id = $(this).attr('id');
					$('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="error"> Required</small>');
					$('a[href^="#' + id + '"]').click();
					return false;
                });
               
			}); 
        }
	});
	
	
    
});
