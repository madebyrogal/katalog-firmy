/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


jQuery(document).ready(function () {
    'use strict';

    var $ = jQuery;

    // break out of iframes
    if (top.location !== self.location) {
        top.location = self.location.href;
    }

    // initial header mode
    var headerMode = $.cookie('melica_header_mode');
    if(headerMode !== undefined && headerMode === '1') {
        $('#header').addClass('inverted');
    }

    $('a[href^="#melica-header-"]').on('click', function() {
        var $anchor = $(this).attr('href');

        if($anchor === '#melica-header-white') {
            window.melicaHeaderMode(0);
        } else {
            window.melicaHeaderMode(1);
        }

        return false;
    });

});

window.melicaHeaderMode = function(mode) {
    'use strict';

    var $ = jQuery;

    var header = $('#header');
    if(mode === 1) {
        header.addClass('inverted');
    } else {
        header.removeClass('inverted');
    }

    $.cookie('melica_header_mode', mode, { expires: 7, path: '/' });

    return false;
};