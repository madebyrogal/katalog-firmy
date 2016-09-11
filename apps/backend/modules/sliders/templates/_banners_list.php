<?php

    $slider_id =  $sf_params->get('slider_id');           
    $banners = Doctrine::getTable('Sliders')->find($slider_id)->getSliderBannersByPosition();
?>

<?php foreach($banners as $banner): ?>

    <div style="border: 1px solid grey; padding: 10px; float: left; margin: 10px;">
        <img src="<?php echo $banner->getPath() ?>" />
    </div>
    <div style="float: left; margin: 10px;">
        <ul>
            <li><a href="<?php echo url_for('slider_banners_edit', $banner) ?>">Edytuj</a></li>
            <li><?php echo link_to('Usuń', url_for('slider_banners_remove', $banner), 'confirm=Jesteś pewien?') ?></li>
            <li><a href="<?php echo url_for('slider_banners_setup', $banner) ?>">Do góry</a></li>
            <li><a href="<?php echo url_for('slider_banners_setdown', $banner) ?>">Na dół</a></li>
        </ul>
    </div>
    <div style="clear: both;"></div>

<?php endforeach; ?>

<div style="clear: both;"></div>