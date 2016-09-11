<?php
$pictures = $form->getObject()->getPictures();
?>
<?php include_partial('pictures/pictures_list',array('pictures'=>$pictures,'delete_from'=>'galleries_deletepicture'));
