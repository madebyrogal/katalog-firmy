jQuery(document).ready(function() {
	jQuery('#main').load("zawartosc.php");
    jQuery('#menu li a').on('click', function(e){
		jQuery('a.current').removeClass('current');
		jQuery(this).closest('a').addClass('current');
        e.preventDefault();
        var page_url=$(this).prop('href');
        jQuery('#main').load(page_url, function(response, status, xhr) {
			if (status == "error") {
				var msg = "Przepraszamy ale wystąpił błąd: ";
				jQuery("#main").html(msg + xhr.status + " " + xhr.statusText);
			}
		});

    });
});