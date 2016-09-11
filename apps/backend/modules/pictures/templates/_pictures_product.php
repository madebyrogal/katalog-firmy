<div id="main_picture" style="text-align: center;">
  
        <a class="picture" href="<?php echo '/uploads/pictures/'.$collection[0]->getFile(); ?>" title="<?php echo $collection[0]->getTitle(); ?>">
          <img src="/uploads/thumbnails/max/<?php echo $collection[0]->getFile(); ?>" />
        </a>
  
</div>
<?php if(count($collection) > 1): ?>
<div id="galleries_wrapper">
  <a href="#picture_one-0" id="left_pictures" class="left_hide"></a>
  <div id="pictures_gallery_product">
    <?php $i = 0; ?>
    <?php foreach($collection as $picture):?>
      <div id="picture_one-<?php echo $i; ?>" class="one_picture_product">
        <img src="<?php echo '/uploads/thumbnails/min/'.$picture->getFile(); ?>" title="<?php echo $picture->getTitle(); ?>" alt="<?php echo $picture->getTitle(); ?>" />
      </div>
      <?php $i++; ?>
    <?php endforeach ?>
  </div>
  <a href="#picture_one-3" id="right_pictures" class="right_<?php if(count($collection) > 3) echo 'show'; else echo 'hide'; ?>"></a>
</div>
<?php endif; ?>



<script type="text/javascript">
  jQuery('.one_picture_product').click(function() {
    min_name = 'min';
    max_name = 'max';
    var path  = jQuery(this).children('img').attr('src');
    path = path.replace(min_name + '/', max_name + '/');
    jQuery('#main_picture a').children('img').attr('src', path);

    path = path.replace('thumbnails/' + max_name + '/', 'pictures/');
    var title =  jQuery(this).children('img').attr('title');
    jQuery('#main_picture a').attr('href', path);
    jQuery('#main_picture a').attr('title', title);
  });


  jQuery('#right_pictures, #left_pictures').click(function() {
    show_and_hide_pictures(jQuery(this).attr('href')); return false;
  });
  show_and_hide_pictures('#picture_one-0');

  function show_and_hide_pictures(pic) {
    var pics_count = 3;
    var img = jQuery('.one_picture_product');
    var iCnt = jQuery(img).length;

    if(iCnt > pics_count)
    {
      var tab = pic.split("-");
      var l = parseInt(tab[1]) - pics_count;
      var r = parseInt(tab[1]) + pics_count;

      var shown_first = parseInt(tab[1]);
      var shown_last = parseInt(tab[1]) + pics_count - 1;
      img.each(function(i) {
        if (i < shown_first || i > shown_last) {
          jQuery(this).hide();
        }
        else {
          jQuery(this).show();
        }
      });
      
      var left = '#picture_one-' + l
      var right = '#picture_one-' + r;
      if(l >= 0) {
        jQuery('#left_pictures').attr('href', left);
        jQuery('#left_pictures').addClass('left_show');
        jQuery('#left_pictures').removeClass('left_hide');
      }
      else {
        jQuery('#left_pictures').removeClass('left_show');
        jQuery('#left_pictures').addClass('left_hide');
      }
      if(r < iCnt) {
        jQuery('#right_pictures').attr('href', right);
        jQuery('#right_pictures').addClass('right_show');
        jQuery('#right_pictures').removeClass('right_hide');
      }
      else {
        jQuery('#right_pictures').removeClass('right_show');
        jQuery('#right_pictures').addClass('right_hide');
      }
    }
  }

</script>