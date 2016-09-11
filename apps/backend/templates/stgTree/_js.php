<?php $URL_TREE_UPDATE = url_for($this->getModuleName()).'/treeUpdate'; ?>
<?php $URL_TREE_OBJECT_EDIT = url_for($this->getModuleName()).'/TEMP_ID/edit'; ?>

<script type="text/javascript">

var url_object_edit_array = new Array();
    url_object_edit_array['Galleries'] = '<?php echo url_for('galleries').'/TEMP_ID/edit'; ?>';
    url_object_edit_array['ArtCategories'] = '<?php echo url_for('art_categories').'/TEMP_ID/edit'; ?>';
    url_object_edit_array['Articles'] = '<?php echo url_for('articles').'/TEMP_ID/edit'; ?>';
    url_object_edit_array['CatalogCategory'] = '<?php echo url_for('catalog_category').'/TEMP_ID/edit'; ?>';
    url_object_edit_array['CatalogProduct'] = '<?php echo url_for('catalog_product').'/TEMP_ID/edit'; ?>';
    url_object_edit_array['Category'] = '<?php echo url_for('category').'/TEMP_ID/edit'; ?>';

$(document).ready(function(){

//  jQuery('.move_area').hover(
  jQuery('.node_box').hover(
//    function() {jQuery(this).parent().addClass('node_box_hover')},
//    function() {jQuery(this).parent().removeClass('node_box_hover')}
    function() {jQuery(this).addClass('node_box_hover')},
    function() {jQuery(this).removeClass('node_box_hover')}
  );

  //drzewko
  $('ol.sortable').nestedSortable({
//    update: function(event, ui) {update_tree_in_db();},
    update: function(event, ui) {update_tree_in_db($(this).attr('id'));},
    disableNesting: 'no-nest',
    forcePlaceholderSize: true,
    handle: 'div',
    items: 'li',
    opacity: .6,
    placeholder: 'placeholder',
    tabSize: 25,
    tolerance: 'pointer',
    toleranceElement: '> div'
  });

  // kliknięcie w link edycji w elemencie drzewa
  jQuery('.ajax_edit_link').click(function(){

    // kolorowanie aktywnego elementu
//    jQuery(this).closest('.sortable').find('li').find('.node_box').removeClass('stgtree_active_element');
    jQuery('.sortable').find('li').find('.node_box').removeClass('stgtree_active_element');
    jQuery(this).closest('li').children('.node_box').addClass('stgtree_active_element');

    // podpięcie linku pod ajaxowe edit
    object_id = jQuery(this).closest('li').attr('id').replace('list_', '')
    load_ajax_edit(object_id);

    return false;
  })

});

function update_tree_in_db(tree_id) {
//  list = $('ol.sortable');
  list = $('#' + tree_id);
  arraied = list.nestedSortable('toArray', {startDepthCount: 0});
  root_tmp = list.attr('id').split('_'); // id roota bierze się z 'id' listy -> jest to ostatni człon 'id' rozdzielanego znakiem podkreślenia '_'
  root_id = root_tmp[root_tmp.length-1];
  string = generate_data_get_request_string(arraied, root_id);

  jQuery.ajax({
    type: "POST",
    url: "<?php echo $URL_TREE_UPDATE; ?>",
    data: 'data=' + string,
    success: function(msg){/* alert('OK'); */}
  });
}

function generate_data_get_request_string(obj, root_id) {
  def_obj_separator = '|';
  def_field_separator = '#';
  def_value_separator = ':';
  str = '';
  for(i in obj) {
    obj_separator = (i != 0) ? def_obj_separator : '';
    item_id = obj[i]['item_id'];
    item_lft = obj[i]['left'];
    item_rgt = obj[i]['right'];
    item_level = obj[i]['depth'];
    is_item = (typeof(item_id) != 'undefined');
    item_id = (item_id == 'root') ? root_id : item_id;
    if (is_item) {
      str += obj_separator;
      str += 'id' + def_value_separator + item_id;
      str += def_field_separator;
      str += 'lft' + def_value_separator + item_lft;
      str += def_field_separator;
      str += 'rgt' + def_value_separator + item_rgt;
      str += def_field_separator;
      str += 'level' + def_value_separator + item_level;
    }
  }
  return str;
}

function load_ajax_edit(object_id) {
  url_edit = "<?php echo $URL_TREE_OBJECT_EDIT; ?>";
  url_edit = url_edit.replace('TEMP_ID', object_id);
  location.assign(url_edit);
//      jQuery('#ajax_box').hide();
      /*jQuery('#ajax_box_loader').show();
      
  jQuery.ajax(
  {
    type: "GET",
    url: url_edit,
    success: function(msg)
    {
        
//      jQuery('#ajax_box').show();
      jQuery('#ajax_box_loader').hide();
      
      jQuery('#ajax_box').html(msg);
      
      tabs();
      
      apply_tabs();
      
      make_submit_by_ajax(object_id);
      
      jQuery('#ajax_box').find('.sf_admin_action_delete').remove();
      jQuery('#ajax_box').find('.sf_admin_action_list').remove();
//      disapply_tinymce();
apply_tinymce();
      jQuery('#ajax_box2').html('');
      hide_unwanted_elements();
      hide_default_language_label();
    }
  });*/
};

function make_submit_by_ajax(object_id) {
    
//  jQuery('.sf_admin_action_save').find('input').click(function() {
  jQuery('.sf_admin_actions').find('input:submit').click(function() {
        
      jQuery(this).hide();
      jQuery(this).after('<div class="ajax_loader"></div>');

      existing_tabs_html = jQuery('#sf_admin_header').html();

      jQuery('#ajax_box').find('.notice').remove();
      jQuery('#ajax_box').find('.error').remove();
      disapply_tinymce();
      jQuery.ajax(
      {
        type: "PUT",
        url: jQuery(this).closest('form').attr('action'),
//        data: jQuery(this).closest('form').serialize(),
        data: jQuery(this).closest('form').serialize() + '&_is_ajax_request=true',
        success: function(msg)
        {
          jQuery('#ajax_box').html(msg);
          tabs();
          apply_tabs();
          make_submit_by_ajax(object_id);
          if (typeof(object_id) != "undefined") {
            jQuery('.node_name_' + object_id).html(jQuery('.sf_admin_form_field_name').find('input').attr('value'));
            jQuery('.node_name_' + object_id).html(jQuery('.sf_admin_form_field_<?php echo Lang::getDefaultLanguage(); ?>').find('input:first').attr('value'));
          }
          jQuery('#sf_admin_header').html(existing_tabs_html);
          link_first_tab_as_return();
          load_ajax_object();
          remove_unwanted_elements();
          hide_unwanted_elements();
          if (get_module_name() != 'art_categories'
           && get_module_name() != 'catalog_category'
           && get_module_name() != 'category'
              ) {
            change_translation();
          }
          hide_default_language_label();
        }
      });

    return false;
  });
  
  $("#sf_admin_header").append('<h5 class="tabsLink" id="ajax_object_tab"></h5>');
  check_object_tab();
  jQuery('#menus_model').change(function() { check_object_tab(); });
};

function get_module_name() {
  return '<?php echo sfContext::getInstance()->getModuleName(); ?>';
}


function check_object_tab() {
  models = array_keys(url_object_edit_array);
  choosed_model = jQuery('#menus_model').val();

  // Jeżeli wybrano model, dla którego zdefiniowano url w "url_object_edit_array"
  if (in_array(models, choosed_model)) {
    // Utworzenie zakładki obiektu
    generate_object_tab(choosed_model);
    jQuery('#menus_' + choosed_model).change(function(){ generate_object_tab(choosed_model); });
  }
  else {
    // Wyczyść zakładkę obiektu
    clear_object_tab();
  }

}

function generate_object_tab(model_string) {
  object_text = jQuery('#menus_' + model_string).find('option:selected').text();
  object_id = jQuery('#menus_' + model_string).find(':selected').val();

  url_edit = url_object_edit_array[model_string];
  url_edit = url_edit.replace('TEMP_ID', object_id);

  jQuery('#ajax_object_tab').show();
  jQuery('#ajax_object_tab').html('<a href="' + url_edit + '">' + object_text + '</a>');

  load_ajax_object();
}

function load_ajax_object() {
  default_form_vals_serialized = jQuery('#ajax_box').find('form').serialize();
  jQuery('#ajax_object_tab').find('a').click(function() {

    jQuery('#ajax_box_loader').show();

    if ((jQuery('#ajax_box').find('form').serialize() == default_form_vals_serialized) ? true : confirm('Czy chcesz opuścić formularz bez zapisywania?')) {
      existing_tabs_html = jQuery('#sf_admin_header').html();
      jQuery.ajax(
      {
        type: "GET",
        url: jQuery(this).attr('href'),
        data: jQuery(this).closest('form').serialize(),
        success: function(msg)
        {
          jQuery('#ajax_box_loader').hide();

          jQuery('#ajax_box').html(msg);
          tabs();
          apply_tabs();
          make_submit_by_ajax();

          remove_unwanted_elements();
          change_translation();

          jQuery('#sf_admin_header').html(existing_tabs_html);
          jQuery('#sf_admin_header').find('h5').removeClass('active');
          jQuery('#sf_admin_header').find('#ajax_object_tab').closest('h5').addClass('active');
          link_first_tab_as_return();
          apply_tinymce();
          hide_default_language_label();
          jQuery('#ajax_box2').html('<a href="' + url_edit + '">Przejdź do trybu pełnej edycji</a>');
        }
      });
    }

    return false;
  });
}

// usuwanie niektórych treści załadowanego kodu
function remove_unwanted_elements() {
  jQuery('.article_versions_box').remove();
  jQuery('#ajax_box').find('.sf_admin_action_delete').remove();
  jQuery('#ajax_box').find('.sf_admin_action_list').remove();
  jQuery('.sf_admin_form_field_comments_list').hide();

  if (jQuery('#ajax_box').find('.sf_admin_action_publish').length > 0) {
    jQuery('#ajax_box').find('.sf_admin_action_save').remove();
  }
}

// pokazuje tą wersję językową (np. artykułu), do której należy menu (czyli ten root drzeka ma taki lang)
function change_translation() {
  default_lang = '<?php echo Lang::getDefaultLanguage(); ?>';
  tree_lang = jQuery('#ajax_lang').html();

  if (tree_lang != default_lang) {
    jQuery('.sf_admin_form_field_' + default_lang).hide();
    jQuery('#sf_fieldset_t__umaczenia').find('.sf_admin_form_row').hide();
    jQuery('.sf_admin_form_field_' + tree_lang).show();
//    jQuery('#sf_fieldset_t__umaczenia').find('.sf_admin_form_row').insertAfter(jQuery('.sf_admin_form_field_' + default_lang));
    jQuery('#sf_fieldset_t__umaczenia').show();
    jQuery('#sf_fieldset_t__umaczenia').find('h2').hide();
  }
}

function hide_unwanted_elements() {
  jQuery('.sf_admin_form_field_parent_id').hide();
  jQuery('#files_file').after('<a style="text-decoration: underline;" href="files/' + jQuery('.stgtree_active_element').closest('li').attr('id').replace('list_', '') + '/edit">Przejdź do trybu pełnej edycji.</a>');
  jQuery('#files_file').remove();
}

function link_first_tab_as_return() {
  default_form_vals_serialized = jQuery('#ajax_box').find('form').serialize();
  jQuery('#sf_admin_header').find('h5').not('#ajax_object_tab').click(function(){
    if ((jQuery('#ajax_box').find('form').serialize() == default_form_vals_serialized) ? true : confirm('Czy chcesz opuścić formularz bez zapisywania?')) {
      object_id = jQuery('.stgtree_active_element').closest('li').attr('id').replace('list_', '');
      load_ajax_edit(object_id);
    }
  });
}

function clear_object_tab() {
  jQuery('#ajax_object_tab').html('');
  jQuery('#ajax_object_tab').hide();
}

function array_keys( arr ) {
  var ret = new Array();
  for (var i in arr) {
    ret.push(i);
  }
  return ret;
}

function in_array( arr , element ) {
  for (var i in arr) {
    if (arr[i] == element) {
      return true;
    }
  }
  return false;
}

</script>