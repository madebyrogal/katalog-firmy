<?php
    $period = $prices->getPeriod();
    if($period == 0)
    {
        echo 'nie dotyczy';
    }
    else
    {
        echo $period. ' dni';
    }
?>