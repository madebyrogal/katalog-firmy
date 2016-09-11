<?php

use_helper('I18N');

include_partial('pictures/picture', array(
    'picture' => $picture, 
    'helper' => $helper, 
    'delete_from' => 'galleries_deletepicture'
    )
);

?>
