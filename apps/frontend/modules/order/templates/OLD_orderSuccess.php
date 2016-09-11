<h3 class="header h_menu header_left">Dodaj firmę</h3>  
<br /><h2 style="text-align: center;">Wybierz odpowiedni pakiet dla swojej firmy</h2><br />

<table class="packetTable" cellpadding="0" cellspacing="0">
    <tr>
        <th style="width: 218px;"></th>
        <?php /* <th class="packet_th1">Standard<br /><span>za darmo</span></th> */ ?>
        <th class="packet_th2">Premium 90 dni<br /><span>90 zł</span><br /><span class="packet_span">(+30 dni za darmo)</span></th>
        <th class="packet_th2">Premium 180 dni<br /><span>180 zł</span><br /><span class="packet_span">(+30 dni za darmo)</span></th>
        <th class="packet_th2">Premium 360 dni<br /><span>360 zł</span><br /><span class="packet_span">(+30 dni za darmo)</span></th>
    </tr>
    
    <tr>
        <td class="packet_td_1">Logo firmy</td>
        <?php /* <td class="packet_td_2"><img src="/images/yes.png" /></td> */ ?>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1_1">Lokalizacja / adres</td>
        <?php /* <td class="packet_td_2"><img src="/images/yes.png" /></td> */ ?>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1">Opis</td>
        <?php /* <td class="packet_td_2"><img src="/images/no.png" /></td> */ ?>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1_1">Telefon / email / <br /> www / gg / skype</td>
        <?php /* <td class="packet_td_2"><img src="/images/no.png" /></td> */ ?>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1">Darmowa promocja na stronie głównej</td>
        <?php /* <td class="packet_td_2"><img src="/images/no.png" /></td> */ ?>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1_1">Galeria zdjęć</td>
        <?php /* <td class="packet_td_2"><img src="/images/no.png" /></td> */ ?>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <th></th>
        <?php /* <th class="packet_td_bottom"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[0]->getPrimaryKey(); ?>"><img src="/images/order.png" /></a></th> */ ?>
        <th class="packet_td_bottom"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[1]->getPrimaryKey(); ?>"><img src="/images/order2.png" /></a></th>
        <th class="packet_td_bottom"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[2]->getPrimaryKey(); ?>"><img src="/images/order2.png" /></a></th>
        <th class="packet_td_bottom"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[3]->getPrimaryKey(); ?>"><img src="/images/order2.png" /></a></th>
    </tr>
</table>
<br /><br />