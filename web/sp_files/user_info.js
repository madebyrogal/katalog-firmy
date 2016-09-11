jQuery(document).ready(function(){

	var email = jQuery("#email").val();
	var url = jQuery("#url").val();
	var ver = "SHlkcmE0NTA=";
	
	var userinfo = "<iframe src=\"http://akt.sliderpakiet.pl/userinfo.php?email="+ email +"\&ver="+ ver +"&url="+ url +"\" scrolling=\"no\" frameborder=\"0\" style=\"border:0px #000 solid; overflow:hidden; width:100%; height:80px;\" allowTransparency=\"true\"></iframe>";
	
	jQuery('#info_result').html('<div id="loading"><img src="img/ajax-loader.gif"> Trwa sprawdzanie aktualizacji...</div>').delay(500).queue(function() {
		jQuery(this).html(userinfo)
	});

});