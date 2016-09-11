function toggle(div_id) {
	var el = document.getElementById(div_id);
	if ( el.style.display == 'none' ) {	el.style.display = 'block';}
	else {el.style.display = 'none';}
}
function blanket_size(popUpDivVar) {
	if (typeof window.innerWidth != 'undefined') {
		viewportheight = window.innerHeight;
	} else {
		viewportheight = document.documentElement.clientHeight;
	}
	if ((viewportheight > document.body.parentNode.scrollHeight) && (viewportheight > document.body.parentNode.clientHeight)) {
		blanket_height = viewportheight;
	} else {
		if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {
			blanket_height = document.body.parentNode.clientHeight;
		} else {
			blanket_height = document.body.parentNode.scrollHeight;
		}
	}
	var blanket = document.getElementById('popupframe_bg');
	blanket.style.height = blanket_height + 'px';
	var popUpDiv = document.getElementById(popUpDivVar);
	popUpDiv_height=blanket_height/2-150;//150 is half popup's height
	popUpDiv.style.top = popUpDiv_height + 'px';
}

function popup(windowname,url) {
	blanket_size(windowname);
	toggle('popupframe_bg');
	toggle(windowname);		
	jQuery(document).ready(function(){
         jQuery("#popupframe").load(url);
    });
}

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, ((jQuery(window).height() - this.outerHeight()) / 2) + 
                                                jQuery(window).scrollTop()) + "px");
    this.css("left", Math.max(0, ((jQuery(window).width() - this.outerWidth()) / 2) + 
                                                jQuery(window).scrollLeft()) + "px");
    return this;
}

jQuery(document).ready(function(){

	jQuery("#popupframe").center();
	
	jQuery("#popupframe_bg").click(function() {
		jQuery("#popupframe").hide();
		jQuery("#popupframe_bg").hide();
	});
	
});

function sciagnijsp(email_val, id_val, wer_val) {

	$.ajax({
		url: "wyslij.php",
		type: "POST",
		data: {mail : email_val, id : id_val, wersja : wer_val},
		dataType: "html",
		success: function(data) {
			alert("Link do pobrania został wysłany na podany adres");
		}
	});
	
}