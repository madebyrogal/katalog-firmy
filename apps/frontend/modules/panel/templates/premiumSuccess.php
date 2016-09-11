<?php include_partial('panel/menu', array('active' => 'payable', 'company' => $company)); ?>

<div class="panel_box">
    <h3>Przejście do pakietu PREMIUM:</h3>
     
     Kwota: <?php
        $price = new StgPrice($packet->getPriceBrutto());
        echo $price->asReal();
     ?>
     <br /><br />
     Pakiet PREMIUM będzie ważny do: 
     <?php
        $rent_to = time();
        
        $new = $rent_to + (60*60*24*$packet->getPeriod());
        echo date('Y-m-d', $new);
     ?>
     <br /><br />
     
     <a class="payable_button" href="<?php echo url_for('@add_to_premium', $company); ?>">Przejdź do PREMIUM</a>
</div>