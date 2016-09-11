<?php
    $price = new StgPrice($prices->getPriceNetto());
    echo $price->asReal();
?>