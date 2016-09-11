<?php
    $price = new StgPrice($order->getValueBrutto());
    echo '<strong>'.$price->asReal().'<strong>';
?>