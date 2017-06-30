$(document).ready(function(){
	$('#country').trigger('change');
	$('#state').trigger('change');
});
$('#country').on('change',function(){
	var countryID = $(this).val();
	//alert(countryID);
	var formData = {
		'country_id': countryID,
		'_token': $('input[name=_token]').val()
	}	 
	if(countryID){
		$.ajax({
			type:'POST',
			url: 'http://localhost/mythili/public/registration/state',
			dataType: 'json',
			data : formData,
			chache: false,
			success:function(data){
				$('select[name="state"]').empty();
				$('select[name="state"]').append('<option>Select State</option>');
				$.each(data, function(key, value) {
					$('select[name="state"]').append('<option value="'+ key +'">'+ value +'</option>');
				}); 
				
				var stateID = $("#state_id").val();
				$("#state").val(stateID).trigger('change');
			}
		}); 
	}else{
		$('#state').html('<option value="">Select State</option>');
		$('#city').html('<option value="">Select City</option>'); 
	}
});


$('#state').on('change',function(){
	var countryID = $("#country").val();
	var stateID = $(this).val();
	//$("#state_id").val(stateID);
	var formData = {
		'country_id': countryID,
		'state_id': stateID,
		'_token': $('input[name=_token]').val()
	}
	if(stateID){
		$.ajax({
			type:'POST',
			url: 'http://localhost/mythili/public/registration/city',
			dataType: 'json',
			data : formData,
			chache: false,
			success:function(data){
				$('select[name="city"]').empty();
				$('select[name="city"]').append('<option>Select City</option>');
				$.each(data, function(key, value) {
					$('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
				}); 
				
				var cityID = $("#city_id").val();
				$("#city").val(cityID).trigger('change');

			}
		}); 
	}else{
		$('#city').html('<option value="">Select City</option>'); 
	}
});