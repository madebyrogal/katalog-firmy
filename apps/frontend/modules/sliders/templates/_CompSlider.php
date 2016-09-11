<?php if($slider && $banners): ?>
<?php $buttons = $banners->count(); ?>
<div id="slider_<?php echo $slider->getPrimaryKey(); ?>">
    <div id="controller_<?php echo $slider->getPrimaryKey(); ?>" class="hidden">

        <?php foreach($banners as $banner): ?>
            <span class="jFlowControl_<?php echo $slider->getPrimaryKey(); ?>"></span>
       <?php endforeach; ?>
    </div>

    <a class="sliderbutton_left jFlowPrev_<?php echo $slider->getPrimaryKey(); ?>"></a>

    <div class="jFlowButtons">
        <?php //for($i = 0; $i < $buttons; $i++): ?>
        <?php for($i = 1; $i <= $buttons; $i++): ?>
       <a class="jFlowButton <?php echo ($i == 1) ? 'jFlowActive' : '' ?>"> <span><?php echo $i ?></span> </a>
        <?php endfor; ?>
    </div>

    <a class="sliderbutton_right jFlowNext_<?php echo $slider->getPrimaryKey(); ?>"></a>

    <div style="height: <?php echo $slider->getHeight(); ?>px; width: <?php echo $slider->getWidth(); ?>px; clear: both; overflow: hidden; position: relative;" id="slider_content_<?php echo $slider->getPrimaryKey(); ?>">
         <?php foreach($banners as $banner): ?>
            <?php if($banner->getLink() != ""): ?><a href="<?php echo $banner->getLink(); ?>" target="<?php echo $banner->getTarget(); ?>"><?php endif; ?>
            <div style="background: url('<?php echo $banner->getPath(); ?>'); height: <?php echo $slider->getHeight(); ?>px; width: <?php echo $slider->getWidth(); ?>px;">

            </div>
            <?php if($banner->getLink() != ""): ?></a><?php endif; ?>
         <?php endforeach; ?>
    </div>

</div>
<script type="text/javascript">
$(function() {
    $("div#controller_<?php echo $slider->getPrimaryKey(); ?>").jFlow({
        controller: ".jFlowControl_<?php echo $slider->getPrimaryKey(); ?>",
        slideWrapper : "#jFlowSlide_<?php echo $slider->getPrimaryKey(); ?>",
        slides: "#slider_content_<?php echo $slider->getPrimaryKey(); ?>",
        width: "<?php echo $slider->getWidth(); ?>px",
        height: "<?php echo $slider->getHeight(); ?>px",
        prev: ".jFlowPrev_<?php echo $slider->getPrimaryKey(); ?>",
        next: ".jFlowNext_<?php echo $slider->getPrimaryKey(); ?>",
        button: '.jFlowButton',
        time: 5000,
        auto: true
    });
});
</script>
<?php endif; ?>