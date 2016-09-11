<h3 class="header h_menu header_left">Panel Klienta</h3> 

<ul class="panel_menu">
    <li><a class="<?php echo ($active == 'info') ? 'active' : ""; ?>" href="<?php echo url_for('@panel') ?>">Informacje</a></li>
    <li><a class="<?php echo ($active == 'gallery') ? 'active' : ""; ?>" href="<?php echo url_for('@panel_gallery') ?>">Logo / zdjęcia</a></li>
    <?php if($company->getPacket() == 1): ?>
        <li><a class="<?php echo ($active == 'invoices') ? 'active' : ""; ?>" href="<?php echo url_for('@panel_invoices') ?>">Faktury</a></li>
        <li><a class="<?php echo ($active == 'payable') ? 'active' : ""; ?>" href="<?php echo url_for('@panel_payable') ?>">Płatności</a></li>
    <?php else: ?>
        <li><a class="<?php echo ($active == 'payable') ? 'active' : ""; ?>" href="<?php echo url_for('@panel_payable') ?>">przejdź do PREMIUM</a></li>
    <?php endif; ?>
    <li><a class="<?php echo ($active == 'profile') ? 'active' : ""; ?>" href="<?php echo url_for('@panel_profile') ?>">Twój profil</a></li>
    <li><a class="logout" href="<?php echo url_for('@user_logout') ?>">Wyloguj</a></li>
</ul>