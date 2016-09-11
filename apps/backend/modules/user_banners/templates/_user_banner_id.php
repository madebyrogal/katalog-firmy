<?php
$object = $user_banners;
$route = 'user_banners_user_banners_edit';
$dir_to_upload = 'user_banners';

/**/
if(substr($object->getFile(), -4) == '.swf')
{
    $flash = '<object type="application/x-shockwave-flash" data="/uploads/user_banners/'.$object->getFile().'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,19,0" width="950" height="150" >
                <param name="movie" value="/uploads/user_banners/'.$object->getFile().'" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
                <embed src="/uploads/user_banners/'.$object->getFile().'" bgcolor="transparent" wmode="transparent" quality="high" width="950" height="150" name="'.$object->getFile().'" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
              </object>';
}
else
{
    $src = '/uploads/'.$dir_to_upload.'/min/'.$object->getFile();
    $pic = '<img src="'.$src.'" title="'.$object->getTitle().'" />';
}


?>

<?php
    if($object->getFile() != '')
    {
        if(substr($object->getFile(), -4) == '.swf')
        {
            echo $flash;
        }
        else
        {
            echo link_to($pic, url_for('user_banners_user_banners_switch_active',$object));
        }
    }
    else
    {
        echo link_to($object->getTitle(), url_for('user_banners_user_banners_switch_active',$object));
    }
?>
