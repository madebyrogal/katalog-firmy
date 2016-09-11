<?php if (count($pictures) > 0): ?>

    <?php $counter = 0; ?>
    <div id="back_images">
        <?php foreach ($pictures as $picture): ?>
            <?php include_partial('pictures/picture', array('picture' => $picture, 'delete_from' => 'galleries_deletepicture')) ?>
            <?php /*
              <?php if(++$counter % 5 == 0): ?>
              <div style="clear: left;">&nbsp;</div>
              <?php endif; ?>
             */ ?>
        <?php endforeach; ?>
    </div>
    <?php echo link_to('Usuń zaznaczone obrazki', url_for($delete_from, array('picture_id' => null)), array('id' => 'delete_selected_pictures_link')); ?>
<?php endif; ?>

<script type="text/javascript">
    var delete_url;
    var link = jQuery('#delete_selected_pictures_link');

    jQuery(function() {
        delete_url = link.attr('href');
        link.hide();
    });

    function change_delete_url(id)
    {
        var ids = [];
        jQuery('.check_picture:checked').each(function(i){
            ids[i] = $(this).val();
        });
        if (ids.length) {link.show();} else {link.hide();}
        link.attr('href', delete_url + ids );
    }
</script>