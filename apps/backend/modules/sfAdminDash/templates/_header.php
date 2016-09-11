<?php
/**
* We need to make sure this plugin is backward compatible. 
* The in the original, this template was invoked by "include_partial",
* which means that now it won't work. Therefore, we set a variable in the 
* component code, and if it is not present - we call the component
*/

if (!isset($called_from_component)):
  include_component('sfAdminDash', 'header');
else:
?>


<?php 
  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
  /** @var string|null Link to the module (for breadcrumbs) */ $module_link = $sf_data->getRaw('module_link');
  /** @var string|null Link to the action (for breadcrumbs) */ $action_link = $sf_data->getRaw('action_link');
?> 

<?php if ($sf_user->isAuthenticated()): ?> 
  <div id='sf_admin_theme_header'>
    <a href='<?php echo url_for('homepage') ?>'><?php echo image_tag(sfAdminDash::getProperty('web_dir').'/images/header_text', array('alt' => 'Home')); ?></a>

    <a title="Przejdź do strony" target="_blank" style="float: right; margin-right: 20px; padding-top: 5px;" href='<?php echo T::getSiteNameUrl(); ?>'><?php echo image_tag(sfAdminDash::getProperty('web_dir').'/images/icons/frontpage', array('alt' => 'Przejdź do strony')); ?></a>
  </div>

<?php /*
 */ ?>
  <div class="backend_tabs">
    <ul>
        <li id="cms_switcher_of" class="backend_tab_active">Ocean firm</li>
        <li id="cms_switcher_cms" class="backend_tab_not_active">CMS</li>
        <li id="cms_switcher_crm" class="backend_tab_not_active">CRM</li>
    </ul>
    <div class="clear"></div>
  </div>

  <div id='sf_admin_menu'>    
    <?php include_partial('sfAdminDash/menu', array('items' => $items, 'categories' => $categories)); ?>
    
    <?php if (sfAdminDash::getProperty('logout') && $sf_user->isAuthenticated()): ?>
      <div id="logout"><?php echo link_to(__('Logout', null, 'sf_admin_dash'), sfAdminDash::getProperty('logout_route', '@sf_guard_signout ')); ?> <?php echo $sf_user; ?></div>
    <?php endif; ?>
    <div class="clear"></div>
  </div>

  <?php if (sfAdminDash::getProperty('include_path')): ?>
      <?php if ($sf_context->getModuleName() != 'sfAdminDash' && $sf_context->getActionName() != 'dashboard'): ?>
    <div id='sf_admin_path'>
      <span class="sf_admin_path_separator">»</span>
      <strong><a href='<?php echo url_for('homepage'); ?>'><?php echo 'Panel administracyjny'; ?><?php //echo sfAdminDash::getProperty('site'); ?></a></strong>
        <span class="sf_admin_path_separator">»</span>
        <?php echo null !== $module_link ? link_to(__($module_link_name), $module_link) : __($module_link_name); ?>
        <?php if (null != $action_link): ?>
          <span class="sf_admin_path_separator">»</span>
          <?php echo link_to(__(ucfirst($action_link_name), null, 'sf_admin'), $action_link); ?>
        <?php endif ?>
    </div>
      <?php endif; ?>
  <?php endif; ?>
<?php include_partial('sfAdminDash/move_filters'); ?>
<?php endif; ?>


<?php endif; // BC check if ?>

<script type="text/javascript">
  jQuery('document').ready(function() {

    cookie_cms_part = readMyCookie('cms_part');
    if (cookie_cms_part) {
      jQuery('.backend_tab_active').removeClass('backend_tab_active');
      jQuery('#cms_switcher_' + cookie_cms_part).addClass('backend_tab_active');
    }

    cms_part = jQuery('.backend_tab_active').attr('id').replace('cms_switcher_', '');
    jQuery('.cms_menu_maincategory').hide();
    jQuery('.cms_part_' + cms_part).show();

    jQuery('.backend_tabs').find('li').click(make_cms_tab_active);

    function make_cms_tab_active() {
      jQuery('.backend_tab_active').addClass('backend_tab_not_active');
      jQuery('.backend_tab_active').removeClass('backend_tab_active');
      jQuery(this).addClass('backend_tab_active');
      jQuery(this).removeClass('backend_tab_not_active');

      cms_part = jQuery(this).attr('id').replace('cms_switcher_', '');
      jQuery('.cms_menu_maincategory').hide();
      jQuery('.cms_part_' + cms_part).show();

      document.cookie = "cms_part="+cms_part+"; path=/";
    }

    jQuery('.backend_tabs').find('li').hover(
      function() {
        jQuery(this).addClass('backend_tab_hover');
      },
      function() {
        jQuery(this).removeClass('backend_tab_hover');
      }
    )

    function readMyCookie(cookieName) {
     var theCookie=""+document.cookie;
     var ind=theCookie.indexOf(cookieName+"=");
     if (ind==-1 || cookieName=="") return "";
     var ind1=theCookie.indexOf(";",ind);
     if (ind1==-1) ind1=theCookie.length;
     return unescape(theCookie.substring(ind+cookieName.length+1,ind1));
    }
    

  })

  
//  function createCookie(name,value,days) {
//    if (days) {
//      var date = new Date();
//      date.setTime(date.getTime()+(days*24*60*60*1000));
//      var expires = "; expires="+date.toGMTString();
//    }
//    else var expires = "";
//    document.cookie = name+"="+value+expires+"; path=/";
//  }
//
//  function readCookie(name) {
//    var nameEQ = name + "=";
//    var ca = document.cookie.split(';');
//    for(var i=0;i < ca.length;i++) {
//      var c = ca[i];
//      while (c.charAt(0)==' ') c = c.substring(1,c.length);
//      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
//    }
//    return null;
//  }
//
//  function eraseCookie(name) {
//    createCookie(name,"",-1);
//  }
//
//  function savePortal(data)
//  {
//    createCookie('portal_layout',data,null);
//  }
//
//  function getPortal()
//  {
//    var portal_layout = readCookie('portal_layout');
//    if(portal_layout != null)
//    {
//      var columns = portal_layout.split(',');
//      jQuery.each(columns,function(index,value){
//        var column_id = index+1;
//        var vars = value.split('&');
//        var column = jQuery('#column_'+column_id);
//        jQuery.each(vars,function(index,variable){
//          var tmp = variable.split('=');
//          var portlet_id = tmp[1];
//          var portlet = jQuery('#portlet_'+portlet_id);
////          var portlet = jQuery('#portlet_menu_'+portlet_id);
//          if(portlet_id != 'undefined')
//          {
//            column.append(portlet);
//          }
//        });
//      });
//    }
//  }
//
//jQuery(document).ready(function()
//{
//  getPortal();  //draw it from cookie :)
//
//  jQuery(".column").sortable({
//    connectWith: '.column',
//    stop: function() {
//        var data = new Array();
//				jQuery(".column").each(function(index,value){
//          data[index] = jQuery(this).sortable("serialize");
//				});
//        savePortal(data);
//    }
//  });
//
//  jQuery(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
//  .find(".portlet-header")
//  .addClass("ui-widget-header ui-corner-all")
//  .prepend('<span class="ui-icon ui-icon-minusthick"></span>')
//  .end()
//  .find(".portlet-content");
//
//  jQuery(".portlet-header .ui-icon").click(function() {
//    jQuery(this).toggleClass("ui-icon-minusthick").toggleClass("ui-icon-plusthick");
//    jQuery(this).parents(".portlet:first").find(".portlet-content").toggle();
//  });
//
//  jQuery(".column").disableSelection();
//
//});
</script>