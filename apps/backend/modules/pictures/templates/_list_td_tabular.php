<div class="back_image">
    <a class="picture" style="height: <?php echo stgConfig::get('pictures_settings_thumbnail_min_height') + 10 ?>px" href="<?php echo T::getSiteNameUrl() . '/uploads/pictures/' . $pictures->getFile(); ?>">
        <img style="" src="<?php echo T::getSiteNameUrl(); ?>/uploads/thumbnails/min/<?php echo $pictures->getFile() ?>" />
    </a>
    <ul class="sf_admin_td_actions" style="margin-top: 10px;">
        <?php echo $helper->linkToEdit($pictures, array('label' => 'Edytuj', 'ui-icon' => 'pencil', 'params' => 'class= sf_button_inline ui-state-default ui-priority-secondary sf_button  sf_button-icon-left  ui-corner-all  ', 'class_suffix' => 'edit',)) ?>
        <?php echo $helper->linkToDelete($pictures, array('label' => 'Usuń', 'ui-icon' => 'trash', 'params' => 'class= sf_button_inline ui-state-default ui-priority-secondary sf_button  sf_button-icon-left  ui-corner-all  ', 'confirm' => 'Na pewno chcesz usunąć?', 'class_suffix' => 'delete',)) ?>
        <?php echo link_to('Pokaż', '/uploads/pictures/' . $pictures->getFile()); ?>
    </ul>
</div>
