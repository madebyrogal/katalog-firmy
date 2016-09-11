<?php
    $price = new StgPrice($order->getValueNetto());
    echo $price->asReal();
?>