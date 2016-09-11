<?php include_partial('panel/menu', array('active' => 'payable', 'company' => $company)); ?>

<div class="panel_box">
    <div class="box_form payable_box">

    <?php /* <h3>Aktualny pakiet:</h3>    
    <span class="name_packet"><?php echo $packet_name; ?></span> */ ?>
    
<?php /* jestem w pakiecie premium */  ?>
<?php if($company->getPacket() == 1): ?>
    <h3>Termin ważności pakietu: 
    <?php if($company->getIsPaid()): ?>
        <?php echo format_date($company->getRentTo(), 'D'); ?>
    <?php else: ?>
        nie opłacono!
    <?php endif; ?>
    </h3>

    <?php if($company->getIsPaid()): ?>
        <h3>Pozostało <?php echo $company->getDaysLeft() ?> dni</h3>
    <?php endif; ?>
        
        
    <?php if($last->getIsPaid()): ?>    
        <a class="payable_button" href="<?php echo url_for('panel_renew') ?>">Przedłuż pakiet</a>
    <?php else: ?>
        <?php /* mam nieoplacony pakiet */  ?>
				Masz nie opłacony pakiet
        <?php echo $company->showButtonPayable(ESC_RAW); ?>    
    <?php endif; ?>
<?php endif; ?>
        
<?php /*if($company->getPacket() == 2): --> nie ma juz przejscia do premium?>        
        <br />
        <a class="payable_button" href="<?php echo url_for('@panel_prices') ?>">Przejdź do PREMIUM</a>
<?php endif;*/ ?>        
    </div>
</div>    