<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_component('metas', 'CompMetas') ?>  
<?php include_http_metas() ?>
<meta name="google-site-verification" content="kyn96VMBVrU-ntR_i8wWVtDqELFEMJvKrW9N4_POGZA" />
<?php include_metas() ?>  
<?php include_stylesheets() ?>
<?php include_javascripts() ?>
<?php echo Icon::generateFavicon() ?> 
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKP4ZWK8XOekFPpzySamWe-izEhdnHrFo&amp;sensor=true">
</script>
</head>
<body>
<?php /*
<div id="facebook_wrap">
  <div id="facebook_content">
	<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A//www.facebook.com/KatalogFirmyNet&amp;width=292&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;height=262" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:262px; background: #fff" allowTransparency="false"></iframe>
  </div>    
  <div id="facebook"></div>
</div>
*/ ?>
<div id="page">
 <div id="top">
  <h1><a id="logo" href="<?php echo url_for('@homepage') ?>"><img src="/images/logo.png" alt="Firmy - Katalog Firm" /></a></h1>
  <?php if($sf_user->isAuthenticated()): ?><a class="logout" href="<?php echo url_for('@user_logout') ?>">Wyloguj</a><?php endif; ?>
  <div id="menu"><?php include_component('default', 'menu', array('menu_key' => 'Menu główne', 'class' => 'menu_top')); ?></div>
  <?php include_component('default', 'quantity'); ?>        
 </div>
 <?php include_component('company', 'search'); ?>    
 <div id="content">
  <?php include_component('default', 'flashes'); ?>
  <?php if(in_array($this->getModuleName(), array('panel', 'order')) || $this->getActionName() == 'error404'): ?>
    <?php echo $sf_content ?>
   <?php else: ?>
    <div class="left">                  
      <?php if(in_array($this->getModuleName(), array('article', 'contact'))): ?>
        <h3 class="header h_menu">Menu</h3>  
        <?php include_component('default', 'menu', array('menu_key' => 'Informacje', 'class' => 'menu_category')); ?>
      <?php else: ?>
        <h3 class="header h_menu">Katalog branż</h3>
        <?php include_component('company', 'menu'); ?>     
      <?php endif; ?>
    </div>
    <div class="right">
     <?php echo $sf_content ?>
    </div>
   <?php endif; ?>              
 </div>          
 <?php //include_partial('default/partners'); ?>                    
 <div id="footer">
   <div class="footer_left"></div>
   <div class="footer_center">                  
    <div id="footer_box_1">
     <h4>Informacje</h4>
     <?php include_component('default', 'menu2', array('menu_key' => 'Informacje', 'class' => 'menu_fotter')); ?>
    </div>                                    
    <div id="footer_box_3">
     <h4>Kontakt</h4>
     <span class="tel1">693 497 601</span>                      
     <span class="tel1_text">Zadzwoń do nas!</span>                                            
     <?php /*<span class="footer_email">email: <a href="mailto:biuro@oceanfirm.pl">biuro@oceanfirm.pl</a></span>*/ ?>
    </div>                  
   </div>
   <div class="footer_right"></div>
 </div>          
 <div class="f_left">Firmy &copy; <?php echo date('Y'); ?> All rights reserved</div>
 <div class="f_right">
  <img src="/images/firmy.png" alt="Katalog-firmy.net" style="position: relative; top: 3px;" /> 
</div>
 <div class="clear"></div>
</div>
<div id="company_one_popup">
    <img src="/images/loading.gif" style="display: block" class="loading" alt="Ładowanie" />
</div>
<div id="stg-privacy-bar">
	Strona korzysta z plików cookies w celu realizacji usług zgodnie z
	<a href="<?php echo url_for('articles_show', Doctrine::getTable('Articles')->findOneByRecordKey('POLITYKA')) ?>">Polityką prywatności</a>.
	Możesz określić warunki przechowywania lub dostępu do cookies w Twojej przeglądarce.
	<a class="stg-close-bar" href="#">Zamknij »</a>
</div>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37977144-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>
