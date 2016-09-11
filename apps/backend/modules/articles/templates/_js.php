<?php include(sfConfig::get('sf_app_dir').'/templates/_tinymce.php'); ?>
<script type="text/javascript">
    <?php echo Articles::generateJs() ?>

    jQuery(function() {
        hideCustomFields($('#articles_artcategory_id').val());
    })

    jQuery(document).ready(function(){

temp_style = jQuery('#articles_<?php echo Lang::getDefaultLanguage(); ?>_content_ifr').attr('style');
jQuery('#articles_<?php echo Lang::getDefaultLanguage(); ?>_content_ifr').attr('style', temp_style + 'height: 500px');

      apply_gallery_preview();
      jQuery('.double_list').find('a').click(apply_gallery_preview);
      apply_insert_image_link();

      function apply_insert_image_link(){
        jQuery('.insert_image_link').click(function() {
          url = jQuery(this).closest('.back_image').find('.picture_one').attr('href');
          html = '<img src="' + url + '" />';
          tinyMCE.execCommand('mceInsertContent',false,html);
        })

        jQuery('.insert_image_as_link_link').click(function() {
          url = jQuery(this).closest('.back_image').find('.picture_one').attr('href');
          src = jQuery(this).closest('.back_image').find('.picture_one').find('img').attr('src');
          html = '<a class="picture" href="' + url + '"><img src="' + src + '" /></a>';
          tinyMCE.execCommand('mceInsertContent',false,html);
        })
      };

      function apply_gallery_preview(){
        jQuery('.sf_admin_form_field_galleries_list').find('option').click(function() {load_gallery_preview(jQuery(this))});
      };

      function load_gallery_preview(link_object){

        url_edit = '/backend.php/galleries/' + link_object.val() + '/edit';
        gallery_name = link_object.html();

        jQuery('#gallery_preview_loader').show();
        jQuery('#gallery_preview').html('');

        jQuery.ajax(
        {
          type: "GET",
          url: url_edit,
          success: function(msg)
          {
            jQuery('#gallery_preview_loader').hide();

            gallery_edit_link = '<a class="gallery_edit_link" href="' + url_edit + '">Edytuj galerię: <strong>' + gallery_name + '</strong></a>';

            jQuery('#gallery_preview').html(gallery_edit_link + '<div id="gallery_preview_inside">' + msg + '</div>');
            jQuery('#gallery_preview').append(jQuery('#gallery_preview').find('#back_images'));
            jQuery('#gallery_preview').append(jQuery('#gallery_preview').find('#multiupload'));
            jQuery('#gallery_preview_inside').remove();
            jQuery('#gallery_preview').find('#back_images').find('.sf_admin_td_actions').before('<div class="like_link insert_image_link">Wstaw</div>');
            jQuery('#gallery_preview').find('#back_images').find('.sf_admin_td_actions').before('<div class="like_link insert_image_as_link_link">Wstaw miniaturę</div>');
            apply_insert_image_link();
            jQuery('#gallery_preview').find('#back_images').find('.sf_admin_td_actions').remove();
            jQuery('#gallery_preview').find('#back_images').find('input').remove();

            jQuery('#submit_files').click(function() {
              jQuery('#gallery_preview iframe').load(function()
              {
                load_gallery_preview(link_object);
              });
            });

            jQuery('#gallery_preview').find('input:submit').click(function() {
              return false;
            });

          }
        });
      };

    });
</script>

<style type="text/css">
  #articles_<?php echo Lang::getDefaultLanguage(); ?>_content_parent {
    float: left;
    margin-right: 20px;
  }
</style>
