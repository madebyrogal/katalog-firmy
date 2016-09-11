/*
// Configuration related to overlay
overlayBgColor: 		'#000',		// (string) Background color to overlay; inform a hexadecimal value like: #RRGGBB. Where RR, GG, and BB are the hexadecimal values for the red, green, and blue values of the color.
overlayOpacity:			0.8,		// (integer) Opacity value to overlay; inform: 0.X. Where X are number from 0 to 9

// Configuration related to navigation
fixedNavigation:		false,		// (boolean) Boolean that informs if the navigation (next and prev button) will be fixed or not in the interface.

// Configuration related to images
imageLoading:			'images/lightbox-ico-loading.gif',		// (string) Path and the name of the loading icon
imageBtnPrev:			'images/lightbox-btn-prev.gif',			// (string) Path and the name of the prev button image
imageBtnNext:			'images/lightbox-btn-next.gif',			// (string) Path and the name of the next button image
imageBtnClose:			'images/lightbox-btn-close.gif',		// (string) Path and the name of the close btn
imageBlank:				'images/lightbox-blank.gif',			// (string) Path and the name of a blank image (one pixel)

// Configuration related to container image box
containerBorderSize:	10,			// (integer) If you adjust the padding in the CSS for the container, #lightbox-container-image-box, you will need to update this value
containerResizeSpeed:	400,		// (integer) Specify the resize duration of container image. These number are miliseconds. 400 is default.

// Configuration related to texts in caption. For example: Image 2 of 8. You can alter either "Image" and "of" texts.
txtImage:				'Image',	// (string) Specify text "Image"
txtOf:					'of',		// (string) Specify text "of"

// Configuration related to keyboard navigation
keyToClose:				'c',		// (string) (c = close) Letter to close the jQuery lightBox interface. Beyond this letter, the letter X and the SCAPE key is used to.
keyToPrev:				'p',		// (string) (p = previous) Letter to show the previous image
keyToNext:				'n',		// (string) (n = next) Letter to show the next image.

// Don�t alter these variables in any way
imageArray:				[],
activeImage:			0
*/
$(document).ready(function() {

    $('a.picture').livequery(function(event) {
        $('a.picture').lightBox({
            fixedNavigation: false,
            txtImage:   '',
            txtOf:  '/',
            imageLoading: '/images/lightbox/lightbox-ico-loading.gif',
            imageBtnPrev: '/images/lightbox/lightbox-btn-prev.gif',
            imageBtnNext: '/images/lightbox/lightbox-btn-next.gif',
            imageBtnClose: '/images/lightbox/lightbox-btn-close.gif',
            imageBlank: '/images/lightbox/lightbox-blank.gif'
        });
        return false;
    });

    $('a.picture_one').livequery(function(event) {
        $('a.picture_one').lightBox({
            fixedNavigation: false,
            txtImage:   '',
            txtOf:  '/',
            imageLoading: '/images/lightbox/lightbox-ico-loading.gif',
            imageBtnPrev: '/images/lightbox/lightbox-btn-prev.gif',
            imageBtnNext: '/images/lightbox/lightbox-btn-next.gif',
            imageBtnClose: '/images/lightbox/lightbox-btn-close.gif',
            imageBlank: '/images/lightbox/lightbox-blank.gif',
            activeImage: 1
        });
        return false;
    });

    $('.one_picture_product').click(function() {
        var path  = $(this).children('img').attr('src');
        path = path.replace('min/', 'max/');
        $('#main_picture_gallery a').children('img').attr('src', path);

        path = path.replace('thumbnails/max/', 'pictures/');
        var title =  $(this).children('img').attr('title');
        $('#main_picture_gallery a').attr('href', path);
        $('#main_picture_gallery a').attr('title', title);
    });

    $('a.movie').livequery(function(event) {
        $('a.movie').lightBox({
            fixedNavigation: false,
            txtImage:   '',
            txtOf:  '/',
            imageLoading: '/images/lightbox/lightbox-ico-loading.gif',
            imageBtnPrev: '/images/lightbox/lightbox-btn-prev.gif',
            imageBtnNext: '/images/lightbox/lightbox-btn-next.gif',
            imageBtnClose: '/images/lightbox/lightbox-btn-close.gif',
            imageBlank: '/images/lightbox/lightbox-blank.gif'
        });        
        return false;
    });

    $('a.movie').click(function() {
       jQuery('#lightbox-loading').hide();

       var swf = jQuery(this).attr('href');
       var width = jQuery(this).attr('width');
       var height = jQuery(this).attr('height');


       var html = '<img style="position: absolute; right: -15px; top: -15px; cursor: pointer;" src="/themes/default/img/close.png" />';
       html += '<iframe src="' + swf + '" width="'+ width +'" height="' + height +'" frameborder="0"></iframe>';

       height = parseInt(height) + 20;
       width = parseInt(width) + 20;
       
       jQuery('#lightbox-container-image').html(html);
       jQuery('#lightbox-container-image-box').css('width', width + 'px');
       jQuery('#lightbox-container-image-box').css('height', height + 'px');
    });

    $('a.project_image').click(function() {
//        var name = jQuery(this).next('span.name').text();
//        var l = jQuery(this).next('span.name').next('div.link').html();
//
//        var content = '<strong>' + name + '</strong><br />' + l;
//
//        jQuery('#lightbox-image-details').html(content);

          jQuery('#lightbox-image-details-caption').css('display', 'block');
          jQuery('#lightbox-image-details-caption').css('text-decoration', 'underline');
          jQuery('#lightbox-image-details-caption').css('cursor', 'pointer');
          jQuery('#lightbox-image-details-caption').click(function() {
                var details = jQuery('#lightbox-image-details-caption').html();
                details = details.split('<br>');
                window.open('http://' + details[1]);
                //alert(details[1]);
                return false;
          });

    });

    jQuery('#lightbox-container-image-box').ready(function () {
//        //jQuery('#lightbox-nav').
//        alert('asdf');
//        //jQuery('#lightbox-image-details').text('asdf');
//        //return false;
    });

});