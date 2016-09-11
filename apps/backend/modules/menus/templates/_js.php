<script type="text/javascript">
<?php /* // ZWYKŁE DYNAMICZNE ZAKŁADKI
  //hides all and shows selected tabs
  jQuery.fn.manageTabs = function(tabs_to_select,select_to_tabs,selected_value)
  {
    jQuery.each(tabs_to_select,function(index,value){
      if(value != undefined)  //ommit tabs not defined in array
      {
        jQuery('#tab_'+index).hide(); //hide all tabs
      }
    });
    jQuery('#tab_'+select_to_tabs[selected_value]).show();  //show selected tab
  };
*/?>

  //hides all and shows selected tabs
  jQuery.fn.manageTabs = function(tabs_to_select,select_to_tabs,selected_value)
  {
    jQuery.each(tabs_to_select,function(index,value){
      if(value != undefined)  //ommit tabs not defined in array
      {
        jQuery('#tab_'+index).hide(); //hide all tabs
        jQuery('.sf_admin_form').find('.formtab_'+index).hide();  //show selected tab
        jQuery('.sf_admin_form').find('.formtab_'+index).removeClass('active_fieldset');
      }
    });
      jQuery('.sf_admin_form').find('.formtab_0').show();
      jQuery('.sf_admin_form').find('.formtab_7').show();
      jQuery('.sf_admin_form').find('.formtab_'+select_to_tabs[selected_value]).show();  //show selected tab
      jQuery('.sf_admin_form').find('.formtab_'+select_to_tabs[selected_value]).addClass('active_fieldset');  //show selected tab
  };

  jQuery(document).ready(function(){
    apply_tabs();
    update_ajax_lang();
  })

  function update_ajax_lang() {
    jQuery('#ajax_lang').html('<?php echo $form->getObject()->getRootLang(); ?>');
  }

  // fieldsety zawsze widoczne
  function apply_never_hide_fieldsets() {
    jQuery('.formtab_0').addClass('never_hide');
    jQuery('.formtab_7').addClass('never_hide');
  };

  function apply_tabs()
  {
    var menus_model = jQuery('#menus_model'); //grab select item

    var select_to_tabs = new Array();
//    select_to_tabs['false'] = 1;
    select_to_tabs['ExternalURL'] = 1;
    select_to_tabs['ArtCategories'] = 2;
    select_to_tabs['Articles'] = 3;
    select_to_tabs['Galleries'] = 4;
    select_to_tabs['CatalogCategory'] = 5;
    select_to_tabs['CatalogProduct'] = 6;
    select_to_tabs['details'] = 7;

  //that mapping is possibl by reverting select_to_tabs - dunno proper function :)
    var tabs_to_select = new Array();
//    tabs_to_select[1] = 'false';
    tabs_to_select[1] = 'ExternalURL';
    tabs_to_select[2] = 'ArtCategories';
    tabs_to_select[3] = 'Articles';
    tabs_to_select[4] = 'Galleries';
    tabs_to_select[5] = 'CatalogCategory';
    tabs_to_select[6] = 'CatalogProduct';
    tabs_to_select[7] = 'details';

    //by default - hide NOT SELECTED TABS
    jQuery().manageTabs(tabs_to_select,select_to_tabs,menus_model.val());

    //on change update tabs to fit selection
    menus_model.change(function(){
      jQuery().manageTabs(tabs_to_select,select_to_tabs,menus_model.val())
    });

    apply_never_hide_fieldsets();
  };

</script>