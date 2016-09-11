<?php
$object = $icon;
$dir_to_upload = 'icons';

$src = '/uploads/'.$dir_to_upload.'/max/'.$object->getFile();
$pic = '<img src="'.$src.'" title="'.$object->getTitle().'" />';

?>

<?php

echo link_to($pic, url_for('icon_edit',$object));

?>
