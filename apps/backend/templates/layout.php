<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>

    <?php if(!in_array($this->getActionName(), array('index'))): ?>
        <link rel="stylesheet" href="/backend/themes/css/jquery/<?php echo sfConfig::get('app_sf_admin_dash_jquery_ui') ?>/jquery-ui.custom.css" />
        <script>
        jQuery(function($){
	$.datepicker.regional['pl'] = {
		closeText: 'Zamknij',
		prevText: '&#x3c;Poprzedni',
		nextText: 'Następny&#x3e;',
		currentText: 'Dzień',
		monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
		monthNamesShort: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
		dayNames: ['Niedziela','Poniedzialek','Wtorek','Środa','Czwartek','Piątek','Sobota'],
		dayNamesShort: ['Nie','Pn','Wt','Śr','Czw','Pt','So'],
		dayNamesMin: ['N','Pn','Wt','Śr','Cz','Pt','So'],
		dateFormat: 'yy-mm-dd', firstDay: 1,
		isRTL: false};
	$.datepicker.setDefaults($.datepicker.regional['pl']);
        });
        </script>
    <?php endif; ?>
    
  </head>
  <body>
    <?php include('_js.php'); ?>
    
    <?php include_component('sfAdminDash','header'); ?>

    <?php echo $sf_content ?>

    <div style="clear: both"></div>

    <?php include_partial('sfAdminDash/footer'); ?>
    <div id="disImage"></div>
    
  </body>
</html>
