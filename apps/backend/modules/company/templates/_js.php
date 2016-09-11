<?php include(sfConfig::get('sf_app_dir').'/templates/_tinymce.php'); ?>

<script type="text/javascript">
    
    jQuery(document).ready(function(){

      apply_gallery_preview();

      function apply_gallery_preview(){
        load_gallery_preview(jQuery('#company_gallery_id'));
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
