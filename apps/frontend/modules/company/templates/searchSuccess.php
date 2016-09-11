<?php 
  if($object)
  {
    $obj = $object->getNode()->getParent();
    if($obj && $obj->getPrimaryKey() != '1')
    {
      $url = url_for('category', $obj);
    }
    else
    {
      $url = false;
    }
  }
  else
  {
    $url = false;
  }      
?>
<?php if(!$is_ajax): ?>
    <div class="go_back">
      <?php if($url): ?><a href="<?php echo $url; ?>">&laquo; Powrót</a><?php endif; ?>
    </div>
    <?php include_partial('company/subCategories', array('objects' => $categories)); ?>

    <?php include_partial('company/types'); ?>    
    <?php include_partial('company/filters'); ?>
    
    <div id="search_content">
<?php endif; ?>

    <?php $objects = $pager->getResults(); ?>
        
    <?php if(isset($pager)): ?>
        <?php include_partial('company/pager',array('url'=>url_for('@search'),'pager'=>$pager)); ?>
    <?php endif; ?>
        
    <?php if(count($objects) > 0): ?>
        <?php foreach($objects as $object): ?>

            <?php include_partial('company/company_one', array('object' => $object)); ?>

        <?php endforeach; ?>
    <?php else: ?>
        <h2 style="text-align: center;">brak wyników</h2>
    <?php endif; ?>

    <?php if(isset($pager)): ?>
        <?php include_partial('company/pager',array('url'=>url_for('@search'),'pager'=>$pager)); ?>
    <?php endif; ?>

    <div id="search_background"></div>

    <div id="default_name"></div>
    <div id="default_place"></div>
    
<?php if(!$is_ajax): ?>
    </div>
<?php endif; ?>
    


<script type="text/javascript">
jQuery(document).ready(function()  {

    jQuery('#default_name').text(jQuery('#search_name').val());
    jQuery('#default_place').text(jQuery('#search_place').val());

    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();

   jQuery('#formSearch').submit(function() {
       searchContent("/search");
       return false;
   });

   jQuery('#search_name').keyup(function() {
       jQuery('#filter_name').val(jQuery('#search_name').val()); 
       delay(function(){
           if(jQuery('#search_name').val() != jQuery('#default_name').text()) {                
                searchContent("");
           }
       }, 500 );
   });

   jQuery('#search_place').keyup(function() {
       jQuery('#filter_place').val(jQuery('#search_place').val());
       delay(function(){
           if(jQuery('#search_place').val() != jQuery('#default_place').text()) {                
                searchContent("");
           }
       }, 500 );
   });
   
   jQuery('#filter_name').keyup(function() {
     jQuery('#search_name').val(jQuery('#filter_name').val());
     delay(function(){
           if(jQuery('#search_name').val() != jQuery('#default_name').text()) {                
                searchContent("");
           }
     }, 500 );
   });
   
   jQuery('#filter_place').keyup(function() {
     jQuery('#search_place').val(jQuery('#filter_place').val());
     delay(function(){
           if(jQuery('#search_place').val() != jQuery('#default_place').text()) {                
                searchContent("");
           }
     }, 500 );
   });
   
    jQuery('#types_box input').change(function() {
        searchContent("");
    });

   function setSearchContent(content)
   {
        jQuery('#search_content').html(content);
   }

   var req = null;

   function searchContent(page)
   {
       backgroundDisplay(true);

       var name = jQuery('#search_name').val();
       var place = jQuery('#search_place').val();
       
       if(jQuery('#search_type:checked').val())
       {
            var type1 = 1;
       }
       else
       {
           var type1 = 0;
       }
       
       if(jQuery('#search_type2:checked').val())
       {
            var type2 = 1;
       }
       else
       {
           var type2 = 0;
       }

       if(name == "Czego szukasz?") name = "";
       if(place == "Gdzie?") place = "";
       if(page > 0)
           page = 'page=' + page + '&';
       else
           page = 'page=1&';

       if (req != null) req.abort();

       req = jQuery.ajax({
          type: "GET",
          url: "<?php echo $url ?>",
          data: page + 'name=' + name + '&place=' + place + '&type1=' + type1 + '&type2=' + type2,
          success: function(msg){
            setSearchContent(msg);
            backgroundDisplay(false);
            default_name = name;
            default_place = place;
            jQuery('#default_name').text(name);
            jQuery('#default_place').text(place);
            window.scrollTo(0,0)
          }
        });
   }

   function backgroundDisplay(show)
   {
      if(show == true)
      {
          var h = jQuery('#search_content').css('height');
          jQuery('#search_background').css('height', h);
          jQuery('#search_background').show();
      }
      else
      {
          jQuery('#search_background').hide();
      }
   }

   jQuery('.pagination a').click(function() {
       var page = jQuery(this).attr('id');
       page = page.split('_');
       searchContent(page[1]);
       return false;
   });

});
</script>
    

<?php include_partial('company/popup_js'); ?>
