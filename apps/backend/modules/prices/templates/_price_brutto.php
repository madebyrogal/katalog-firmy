<?php
    $price = new StgPrice($prices->getPriceBrutto());
    echo $price->asReal();
?>