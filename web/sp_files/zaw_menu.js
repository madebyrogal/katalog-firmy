jQuery(document).ready(function(){

	jQuery.ajaxSetup({cache:false})

	jQuery("#Default").click(function() {
		var height_val = "25%";
		var user_val = "admin";
		var pass_val = "jDQeULiFrG";
		var email_val = "twoj@adres.com";
		var fb_val = "fb_on";
		var fb_url_val = "https://www.facebook.com/pages/SliderPakiet/178753352227524";
		var tw_val = "tw_on";
		var tw_url_val = "_AFA_";
		var gp_val = "gp_on";
		var gp_url_val = "103293799125224033947";
		var gg_val = "gg_on";
		var gg_url_val = "d24584f6853157f02fed4eee058eb2e1f1974341";
		var po_val = "po_on";
		var po_width_val = "550px";
		var po_height_val = "220px";
		var po_value_val = '<p style="text-align: center;"><strong>TO JEST PRZYKŁADOWA ZAWARTOŚĆ BOKSU!</strong></p><p style="text-align: center;"></p><p style="text-align: center;"><strong>Zapraszamy na nasze strony:<br /></strong></p><p style="text-align: center;"><a title="DobraWitryna.pl" href="http://dobrawitryna.pl/" target="_blank"><strong><img src="http://dobra-witryna.pl/wp-content/themes/design/images/logo.jpg" alt="" width="263" height="72" /></strong></a></p><p style="text-align: center;"><strong> Strony internetowe, Identyfikacja wizualna, Obsługa profili w sieci Facebook<br /></strong></p>';
		var all_val = "all_on";
		var all_url_val = "id=1617175&w=user&search=SliderPakiet&pid=&c1=0&c2=0&c3=0&c4=0&sid=0&color=0";
		var yt_val = "yt_on";
		var yt_url_val = "dehaes87";
		var nk_val = "nk_on";
		var nk_url_val = "208207";
		jQuery(".komunikat").css("color","#000");
		jQuery(".komunikat").html('Trwa zapis...');
		jQuery.ajax({
			url: "zapisz.php",
			type: "POST",
			data: {height : height_val, user : user_val, pass : pass_val, email : email_val, fb_status : fb_val, fb_url : fb_url_val, tw_status : tw_val, tw_url : tw_url_val, gp_status : gp_val, gp_url : gp_url_val, gg_status : gg_val, gg_url : gg_url_val, po_status : po_val, po_width : po_width_val, po_height : po_height_val, po_value : po_value_val, all_status : all_val, all_url : all_url_val, yt_status : yt_val, yt_url: yt_url_val, nk_status : nk_val, nk_url : nk_url_val},
			dataType: "html",
			success: function(data){
				jQuery(".komunikat").css("color","#60971f");
				jQuery(".komunikat").html("<b>Przywrócono ustawienia domyślne.</b>"); 
			},
			error: function(){
				jQuery(".komunikat").css("color","#cd2226");
				jQuery(".komunikat").html('<b>Wystąpił błąd</b>! Spróbuj ponownie lub skontaktuj się z administratorem.');
			}
		});
		
		window.setTimeout('location.reload()', 1000);
		
	});
	
	jQuery("#Submit").click(function() {
	
		var err = jQuery('#forms').find('img[src$="bad_ico.png"]').length;
		
		if(err > "0") { 
		
			jQuery(".komunikat").css("color","#cd2226");
			jQuery(".komunikat").html('<b>Wystąpił błąd</b>! Popraw wskazane pola w formularzu.');
			
		} else {
		
		tinyMCE.triggerSave();
	
		var height_val = jQuery("#height").val();
		var user_val = jQuery("#user").val();
		var pass_val = jQuery("#pass").val();
		var email_val = jQuery("#email").val();
		var fb_val = jQuery("#fb_status").val();
		var fb_url_val = jQuery("#fb_url").val();
		var tw_val = jQuery("#tw_status").val();
		var tw_url_val = jQuery("#tw_url").val();
		var gp_val = jQuery("#gp_status").val();
		var gp_url_val = jQuery("#gp_url").val();
		var gg_val = jQuery("#gg_status").val();
		var gg_url_val = jQuery("#gg_url").val();
		var po_val = jQuery("#po_status").val();
		var po_width_val = jQuery("#po_width").val();
		var po_height_val = jQuery("#po_height").val();
		var po_value_val = jQuery("#po_value").val();
		var all_val = jQuery("#all_status").val();
		var all_url_val = jQuery("#all_url").val();
		var yt_val = jQuery("#yt_status").val();
		var yt_url_val = jQuery("#yt_url").val();
		var nk_val = jQuery("#nk_status").val();
		var nk_url_val = jQuery("#nk_url").val();
		jQuery(".komunikat").css("color","#000");
		jQuery(".komunikat").html('Trwa zapis...');
		jQuery.ajax({
			url: "zapisz.php",
			type: "POST",
			data: {height : height_val, user : user_val, pass : pass_val, email : email_val, fb_status : fb_val, fb_url : fb_url_val, tw_status : tw_val, tw_url : tw_url_val, gp_status : gp_val, gp_url : gp_url_val, gg_status : gg_val, gg_url : gg_url_val, po_status : po_val, po_width : po_width_val, po_height : po_height_val, po_value : po_value_val, all_status : all_val, all_url : all_url_val, yt_status : yt_val, yt_url: yt_url_val, nk_status : nk_val, nk_url : nk_url_val},
			dataType: "html",
			success: function(data){
				jQuery(".komunikat").css("color","#60971f");
				jQuery(".komunikat").html("<b>Zmiany zostały pomyślne zapisane.</b>");
			},
			error: function(){
				jQuery(".komunikat").css("color","#cd2226");
				jQuery(".komunikat").html('<b>Wystąpił błąd</b>! Spróbuj ponownie lub skontaktuj się z administratorem.');
			}
		});
		
		}
		
	});

    jQuery("#ustawienia").fadeIn();
    jQuery("#zaw_tabs li a").click(function() {
		jQuery("#zaw_tabs li a.current").removeClass('current');
		jQuery(this).closest('a').addClass('current');
        jQuery("#zaw_tabs li").removeClass('active');
        jQuery(this).addClass("active");
        jQuery(".tab_content").hide();
        var selected_tab = jQuery(this).attr("href");
        jQuery(selected_tab).fadeIn();
        return false;
    });
});