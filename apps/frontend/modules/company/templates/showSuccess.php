<h3 class="header header_left">Wizytówka firmy</h3>
<div class="company_show">
    
    <h1><?php echo $object->getName(); ?></h1>
    
    <div class="company_left" style="height: 350px;">
        <h2>Informacje</h2>
        
        <div class="company_one">

            <a href="<?php echo url_for('company', $object); ?>">
                <?php $gallery = $object->getGalleries(); ?>
                <?php $pic = $gallery->getDefaultPicture(); ?>
                <?php if($pic): ?>
                    <img class="comapny_one_logo" src="/uploads/thumbnails/logo/<?php echo $pic->getFile(); ?>" />
                <?php else: ?>
                    <img class="comapny_one_logo" src="/images/img.png" />
                <?php endif; ?>
            </a>
            <div class="company_one_address">
                <span class="company_one_name"><a href="<?php echo url_for('company', $object); ?>"><?php echo $object->getName(); ?></a></span>
                ul. <?php echo $object->getStreet(); ?><br />
                <?php echo $object->getPostCode(); ?> <?php echo $object->getCity(); ?><br />
                woj. <?php echo $object->getState(); ?>
            </div>
            <?php //if($object->getPromoted()): ?>
                <a href="" class="company_one_button" id="companyId_<?php echo $object->getPrimaryKey(); ?>"></a>
            <?php //endif; ?>
                    
        </div>
        <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(url_for('company', $object, true)); ?>&amp;send=false&amp;layout=standard&amp;width=378&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:378px; height:35px;" allowTransparency="true"></iframe>
        
        <span class="company_one_owns_head">Oferta dla:</span>
        <?php  $types = $object->getType(); ?>
        <?php foreach($types as $type): ?>
            <img style="margin: 5px;" src="/images/type<?php echo $type->getId(); ?>.png" />
        <?php endforeach; ?>
        
    </div>        
    
    <div class="company_right"  style="height: 350px;">
        <h2>Lokalizacja</h2>
        <div style="width: 99%; height: 300px; border: 1px solid #728291" id="map"></div>        
    </div>
    
    <div style="clear: both"></div>
    
    <?php if($object->getPromoted()): ?>
        <?php if($object->getDescription()): ?>
        <h2>Opis</h2>
        <div class="description">
            <?php echo $object->getDescription(ESC_RAW); ?>
        </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="company_left">
            <?php /*if($object->getDescription()): ?>
            <h2>Opis</h2>
            <div class="description">
                <?php //echo $object->getDescription(ESC_RAW); ?>
            </div>
            <?php endif;*/ ?>
        </div>
        <!-- <div class="company_right">
            <h2>Formularz kontaktowy</h2>
            <form action="" method="post" class="statsForm">
                <table>
                <?php echo $form; ?>                
                </table>
                <input type="submit" value="" class="send" />
            </form>
        </div> -->
    <?php endif; ?>
        
    <div style="clear: both"></div>
    
    <h2>Kategorie</h2>
    
    <?php include_partial('company/categories', array('categories' => $object->getCategories())); ?>
    
    <?php if($object->getPromoted()): ?>
      <?php include_partial('company/gallery', array('gallery' => $object->getGalleries())); ?>
    <?php endif; ?>
    
</div>

<?php include_partial('company/popup_js'); ?>

<script type="text/javascript">
var geocoder;
var map;
var address = '<?php echo $localisation ?>';
function initialize() {
    var myOptions = {
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map"), myOptions);
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

initialize();
</script>