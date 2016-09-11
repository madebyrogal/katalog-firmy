/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support): 
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

(function ($) {
    'use strict';

    $('.wphunters-import').click(function () {
        var $button = $(this);

        var $import_true = confirm('Are you sure to import demo content? It will overwrite the existing data.');
        if ($import_true == false) return;

        var $spinner = $('.spinner', $button.parent()).addClass('is-active');

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        // but check is needed :)
        if(ajaxurl === undefined) {
            var ajaxurl = 'admin-ajax.php';
        }

        $.post(ajaxurl, { 'action': 'import_demo_action' }, function (response) {
            $spinner.removeClass('is-active');

            if($.trim(response) == '' || !response.length) {
                response = 'Internal error has occurred. Try again.'
            }

            $('.import-message p').html(response);
            $('.import-message').slideDown('fast');
        });
    });

    $('.wphunters-tune').click(function () {
        var $button = $(this);

        var $import_true = confirm('Are you sure?');
        if ($import_true == false) return;

        var $spinner = $('.spinner', $button.parent()).addClass('is-active');

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        // but check is needed :)
        if(ajaxurl === undefined) {
            var ajaxurl = 'admin-ajax.php';
        }

        $.post(ajaxurl, { 'action': 'tunewp_action' }, function (response) {
            $spinner.removeClass('is-active');

            if($.trim(response) == '' || !response.length) {
                response = 'Internal error has occurred. Try again.'
            }

            $('.tune-message p').html(response);
            $('.tune-message').slideDown('fast');
        });
    });
})(jQuery);