<?php
$object = $user_logos;
$route = 'user_logos_user_logos_edit';
$dir_to_upload = 'user_logos';

/**/
$src = '/uploads/'.$dir_to_upload.'/min/'.$object->getFile();
$pic = '<img src="'.$src.'" title="'.$object->getTitle().'" />';
?>

<?php
    if($object->getFile() != '')
    {
        echo link_to($pic,url_for('user_logos_user_logos_switch_active',$object));
    }
    else
    {
        echo link_to($object->getTitle(),url_for('user_logos_user_logos_switch_active',$object));
    }
?>




<?php
//    $src = '/uploads/user_logos/min/'.$user_logos->getFile();
//    $pic = '<img src="'.$src.'" title="'.$user_logos->getTitle().'" />';
//    if($user_logos->getFile() != '')
//    {
//        echo link_to($pic,url_for('user_logos_user_logos_edit',$user_logos));
//    }
//    else
//    {
//        echo link_to($user_logos->getTitle(),url_for('user_logos_user_logos_edit',$user_logos));
//    }
?>
