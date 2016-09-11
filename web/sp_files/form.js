jQuery(document).ready(function() {

	jQuery("#forms").submit(function() {
		var email_val = jQuery("#email").val();
		jQuery("#result").html('<div id="loading"><img src="ajax-loader.gif"> Trwa weryfikacja...</div>');
		$.ajax({
			url: "zapisz.php",
			type: "POST",
			data: {email : email_val},
			dataType: "html",
			success: function(data){
				jQuery("#result").html(data);
			},
			error: function(){
				jQuery("#result").html('Wystąpił błąd. Spróbuj ponownie lub skontaktuj się z administratorem.');
			}
		});
		
		/*
		jQuery("#loading").css("visiblity","visible");
		jQuery.post('zapisz.php', { email: email_val }, function(result){
			jQuery("#loading").css("visiblity","hidden");
			jQuery("#result").html(result);
		});
		return false; // prevent normal submit
		*/
		
	});

});