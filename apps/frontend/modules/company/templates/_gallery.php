<?php $pictures = $gallery->getPicturesWithoutDefault(); ?>

<?php if($gallery->getDefaultPicture() && count($pictures) > 0): ?>
<br />
<h2>Galeria</h2>
<!-- galleria : start -->
<div id="slider_gallery">
    <div id="controller" class="hidden">

        <?php $i = 0; ?>
        <?php foreach($pictures as $picture): ?>
            <?php if(($i++ % 3) == 0): ?>
                <span class="jFlowControl"></span>
            <?php endif; ?>
       <?php endforeach; ?>
    </div>

    <a class="sliderbutton_left jFlowPrev"></a>

    <a class="sliderbutton_right jFlowNext"></a>


    <div id="slider_content">
        
             
      
             <?php                 
                $cnt = count($pictures);
                $divs = ceil($cnt / 3);                
             ?>
      
                <?php for($j = 0; $j < $divs; $j++): ?>
                  <div>
                    <?php $i = 0; ?>
                    <?php $start = $j * 3; ?>
                    <?php $stop = $start + 2; ?>
                    <?php foreach($pictures as $picture): ?>                
                      <?php if($i >= $start && $i <= $stop): ?>
                        <a class="picture" href="/uploads/pictures/<?php echo $picture->getFile(); ?>"><img style="width: 200px; height: 150px;" src="/uploads/thumbnails/mid/<?php echo $picture->getFile(); ?>" /></a>                        
                      <?php endif; ?>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                  </div>
                <?php endfor; ?>
                
             ?>
             
             <?php /*foreach($pictures as $picture): ?>                
                <?php if($i % 3 == 0): ?>
                <div>                    
                <?php endif; ?>
                <?php $i++; ?>
                    <a class="picture" href="/uploads/pictures/<?php echo $picture->getFile(); ?>"><img style="width: 200px; height: 150px;" src="/uploads/thumbnails/mid/<?php echo $picture->getFile(); ?>" /></a>
                <?php if($i == 3 ||($i % 6) == 0 || ($i) == (count($picture) -2)): ?>
                </div>                
                <?php endif; ?>
                                
             <?php endforeach;*/ ?>
             
    </div>
    
    
</div>
<!-- galleria : stop -->
<div style="clear: both;"></div>
<script type="text/javascript">
$(function() {
    $("div#controller").jFlow({
        controller: ".jFlowControl",
        slideWrapper : "#jFlowSlide",
        slides: "#slider_content",
        width: "610px",
        height: "150px",
        prev: ".jFlowPrev",
        next: ".jFlowNext",
        button: '.jFlowButton',
        time: 5000,
        auto: false
    });
});
</script>
<?php endif; ?>