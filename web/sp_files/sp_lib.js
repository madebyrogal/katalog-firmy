jQuery(document).ready(function(){
	
	po_width = po_width.replace("px",""); 
	po_height = po_height.replace("px",""); 

	var sp_fb = '<div class="sp_likebox_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div id="sp_fb"><div class="splink">SliderPakiet</div><div id="fb-root"></div><div class="fb-like-box" data-href="'+ fb_url +'" data-width="292" data-show-faces="true" data-border-color="#fff" data-stream="false" data-header="false"></div></div>';
	
	var sp_tw = '<div class="sp_tw_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div id="sp_tw"><div class="twitter_slider"><div id="twitter_inside"></div></div></div>';
	
	var sp_gg = '<div class="sp_gg_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div id="sp_gg"><img src="sp_files/img/tab_gg_border.png" class="sp_gg_border" /><iframe src="http://widget.gadu-gadu.pl/index.php?id='+ gg_url +'" height="320px" width="230px" frameborder="0"></iframe></div></div>';
	
	var sp_gp = '<div class="sp_gp_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div id="sp_gp"><div style="position: static;"><div id="page-badge-border"></div><div class="g-plus" data-href="//plus.google.com/'+ gp_url +'" data-rel="publisher"></div></div></div>';
	
	var sp_all = '<div class="sp_all_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div id="sp_all"><object  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="350px" height="300px"><param name="movie" value="https://allewidget.pl/w1.swf?0.0789202656596899" /><param name="flashvars" value="'+ all_url +'" /><param name="wmode" value="transparent" /><embed src="https://allewidget.pl/w1.swf?0.6071268622763455" type="application/x-shockwave-flash" width="350px" height="300px" flashvars="'+ all_url +'"></embed></object></div></div>';
	
	var sp_po = '<div class="sp_po_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div class="sp_polecamy" style="width: '+ po_width +'px; height: '+ po_height + 'px;"><div class="inside">' + po_value +'</div></div></div>';
	
	var sp_nk = '<div class="sp_nk_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div id="sp_nk"><div style="width: 280px;height: 320px;border-radius: 6px; border: 2px #ebebeb solid;"><div class="nk-group-box" data-nk-group-id="' + nk_url +'" data-nk-width="280" data-nk-height="320" data-nk-border-color="#ebebeb" data-nk-bg="#ffffff" data-nk-header-footer-bg="#ebebeb" data-nk-header-text-color="#000" data-nk-group-desc-bg=\"#e9eff3\" data-nk-group-desc-color="#8d9297" data-nk-footer-link-color="#000"></div></div></div></div>';
	
	var sp_yt = '<div class="sp_yt_img"><img src="sp_files/img/tab_arrow.png" class="sp_tab_arrow" /><div id="sp_yt"><div class="sp_facebook-like-box"><div class="inner"><iframe id="sp_fr" src="http://www.youtube.com/subscribe_widget?p='+ yt_url +'" style="border: 0 none;height: 110px;overflow: hidden;width: 276px;" scrolling="no" frameBorder="0"></iframe></div></div></div>';
	
	jQuery("body").append("<div class=\"sliderpack_r\" style=\"top:" + height + ";\"></div>");
	jQuery(".sliderpack_r").append("<img src=\"sp_files/img/slider_top.png\" style=\"position: absolute;top: -9px;right: 0px;\" alt=\"\" /><img src=\"sp_files/img/slider_bottom.png\" style=\"position: absolute;bottom: -9px;right: 0px;\" alt=\"\" />");
		
	if (fb_status == 'fb_on'){
			jQuery(".sliderpack_r").append(sp_fb);
	}
	if (tw_status == 'tw_on'){
	
		jQuery(".sliderpack_r").append(sp_tw);	
		
                var twtr;
		twtr = new TWTR.Widget({
		id: 'twitter_inside',
		version: 2,
		type: 'profile',
		rpp: 4,
		interval: 30000,
		width: 315,
		height: 300,
		theme: {
		shell: {
			background: '#33b0dc',
			color: '#ffffff'
		},
		tweets: {
			background: '#fff',
			color: '#000',
			links: '#33b0dc'
		}
		},
		features: {
			loop: false,
			live: false,
			scrollbar: true,
			avatars: true,
			behavior: 'all'	
		}
		}).render().setUser(tw_url).start();                
	}
	if (gg_status == 'gg_on'){
			jQuery(".sliderpack_r").append(sp_gg);
	}
	
	if (gp_status == 'gp_on'){
			jQuery(".sliderpack_r").append(sp_gp);
	}
	
	if (all_status == 'all_on'){
			jQuery(".sliderpack_r").append(sp_all);
	}
	
	if (po_status == 'po_on'){
			jQuery(".sliderpack_r").append(sp_po);
	}
	
	if (yt_status == 'yt_on'){
			jQuery(".sliderpack_r").append(sp_yt);
	}
	
	if (nk_status == 'nk_on'){
			jQuery(".sliderpack_r").append(sp_nk);
	}
	
	jQuery(".sp_likebox_img").mouseenter(function() {
		
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sp_likebox_img .sp_tab_arrow").show();
		jQuery('#sp_fb').show();			
		
	});	
	
	jQuery('#sp_fb, #sp_tw, #sp_gg, #sp_gp, #sp_all, #sp_polecamy, #sp_yt, #sp_nk').click(function(e) {
            e.stopPropagation();
        });
	
	jQuery('html').click(function() {
		jQuery(".sp_likebox_img .sp_tab_arrow").hide();
		jQuery('#sp_fb').hide();
    });
	
	jQuery(".sp_tw_img").mouseenter(function() {
	
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sp_tw_img .sp_tab_arrow").show();
		jQuery('#sp_tw').show();
		
	});	
	
	jQuery('html').click(function() {
		jQuery(".sp_tw_img .sp_tab_arrow").hide();
        jQuery('#sp_tw').hide();
    });	
	
	jQuery(".sp_gg_img").mouseenter(function() {
	
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
	
		jQuery(".sp_gg_img .sp_tab_arrow").show();
		jQuery("#sp_gg").show();
		
		
	});	
	
	jQuery('html').click(function() {
		jQuery(".sp_gg_img .sp_tab_arrow").hide();
        jQuery('#sp_gg').hide();
    });	
	
	jQuery(".sp_all_img").mouseenter(function() {
	
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
	
		jQuery(".sp_all_img .sp_tab_arrow").show();
		jQuery("#sp_all").show();
		
	});	
	
	jQuery('html').click(function() {
        jQuery(".sp_all_img .sp_tab_arrow").hide();
		jQuery("#sp_all").hide();
    });	
	
	jQuery(".sp_po_img").mouseenter(function() {
	
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
	
		jQuery(".sp_po_img .sp_tab_arrow").show();
		jQuery(".sp_polecamy").show();
		
	});	
	
	jQuery('html').click(function() {
        jQuery(".sp_po_img .sp_tab_arrow").hide();
		jQuery(".sp_polecamy").hide();
    });
	
	jQuery(".sp_yt_img").mouseenter(function() {
	
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
	
		jQuery(".sp_yt_img .sp_tab_arrow").show();
		jQuery("#sp_yt").show();		
		
	});	
	
	jQuery(document).click(function() {
		jQuery(".sp_yt_img .sp_tab_arrow").hide();
        jQuery('#sp_yt').hide();
    });
	
	jQuery(".sp_gp_img").mouseenter(function() {
		
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
	
		jQuery(".sp_gp_img .sp_tab_arrow").show();
		jQuery("#sp_gp").show();	
		
	});	
	
	jQuery('html').click(function() {
            jQuery('.sp_gp_img .sp_tab_arrow').hide();
            jQuery('#sp_gp').hide();
    });
	
	jQuery(".sp_nk_img").mouseenter(function() {
	
		jQuery(".sliderpack_r").children("div").children("div").each(function()
		{
			jQuery(this).hide();
		});
		
		jQuery(".sliderpack_r").children("div").children("img").each(function()
		{
			jQuery(this).hide();
		});
	
		jQuery(".sp_nk_img .sp_tab_arrow").show();
		jQuery("#sp_nk").show();		
		
	});	
	
	jQuery('html').click(function() {
            jQuery('.sp_nk_img .sp_tab_arrow').hide();
            jQuery('#sp_nk').hide();
    });
	
	var nVba = 1;
	var nVzb = 9999999;

	var count_r = jQuery(".sliderpack_r").children("div:visible").length;
	
	if (count_r == 0) { jQuery(".sliderpack_r").css("display","none"); }
	
	jQuery(".sliderpack_r").children("div").each(function()
	{
		//if (jQuery(this).css("visibility") == "visible")
		if(jQuery(this).is(':visible'))
		{
			if (count_r == 1) { nV_margin = 0; } else if (nVba == count_r) { nV_margin = 0; } else { nV_margin = 10; }
			jQuery(this).css('margin-bottom', '' + nV_margin + 'px');
			jQuery(this).css('z-index', '' + nVzb + '');
			nVba++
			nVzb--;
		}
		else
		{
		
		}
	});
	
});

if(nk_status == "nk_on") {

	(function() {
	var id = 'nk-widget-sdk';
	var js, first_js = document.getElementsByTagName('script')[0];
	if (document.getElementById(id)) return;
	js = document.createElement('script'); 
	js.id = id; js.async = true;
	js.type = 'text/javascript';
	js.src = 'http://nk.pl/script/packs/nk_widgets_all.js';
	first_js.parentNode.insertBefore(js, first_js);
	}());

}

if(gp_status == "gp_on") {

window.___gcfg = {lang: 'pl'};

(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
  
}

if(fb_status == "fb_on") {

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1&appId=111820618963644";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

}