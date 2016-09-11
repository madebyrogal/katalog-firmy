<div class="back_image" id="picture-<?php echo $picture->getPrimaryKey() ?>">
    <div class="picture" style="height: <?php echo stgConfig::get('pictures_settings_thumbnail_min_height') + 10 ?>px">
        <?php if (!$picture->isDefault()): ?>
            <div>
                <input class="check_picture" title="Oznacz do usunięcia" style="float: right; clear:right;" onclick="change_delete_url(<?php echo $picture->getPrimaryKey(); ?>)" value="<?php echo $picture->getPrimaryKey(); ?>" type="checkbox" />
            </div>
        <?php endif; ?>
        <a class="picture_one" href="<?php echo '/uploads/pictures/' . $picture->getFile(); ?>" style="display: inline-block; height: <?php echo stgConfig::get('pictures_settings_thumbnail_min_height') ?>px; width: <?php echo stgConfig::get('pictures_settings_thumbnail_min_width') ?>px">
            <img style="" src="/uploads/thumbnails/min/<?php echo $picture->getFile() ?>" />
        </a>
        <p>
            <?php echo $picture->getTitle(); ?>
        </p>
    </div>
    <div class="sf_admin_td_actions">
        <?php echo link_to('Edytuj', url_for('pictures_edit', $picture)); ?>
        <?php echo link_to('Usuń', url_for($delete_from, $picture), array('class' => 'deleteImage', 'id' => $picture->getPrimaryKey())); ?>
        <?php echo link_to('Pokaż', '/uploads/pictures/' . $picture->getFile()); ?>
        <br />
        <?php if (!$picture->isDefault()): ?>
            <?php echo link_to('Ustaw jako domyślny', url_for('galleries_set_default_picture', $picture), array('id' => 'set-default-' . $picture->getPrimaryKey())); ?>
        <?php else: ?>
            <span class="default_image">To obrazek domyślny</span>
        <?php endif; ?>
    </div>
</div>