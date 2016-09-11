<?php include_partial('panel/menu', array('active' => 'payable', 'company' => $company)); ?>
<br /><br />
<table class="packetTable" cellpadding="0" cellspacing="0">
    <tr>
        <th style="width: 218px;"></th>
        <th class="packet_th1">Standard<br /><span>za darmo</span></th>
        <th class="packet_th2">Premium 90 dni<br /><span>90 zł</span><br /><span class="packet_span">(+30 dni za darmo)</span></th>
        <th class="packet_th2">Premium 180 dni<br /><span>180 zł</span><br /><span class="packet_span">(+30 dni za darmo)</span></th>
        <th class="packet_th2">Premium 360 dni<br /><span>360 zł</span><br /><span class="packet_span">(+30 dni za darmo)</span></th>
    </tr>
    
    <tr>
        <td class="packet_td_1">Logo firmy</td>
        <td class="packet_td_2"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1_1">Lokalizacja / adres</td>
        <td class="packet_td_2_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1">Opis</td>
        <td class="packet_td_2"><img src="/images/no.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1_1">Telefon / email / <br /> www / gg / skype</td>
        <td class="packet_td_2_1"><img src="/images/no.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1">Wyróżnienie wpisu</td>
        <td class="packet_td_2"><img src="/images/no.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1_1">Pierwszeństwo na liście</td>
        <td class="packet_td_2_1"><img src="/images/no.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1">Darmowa promocja na stronie głównej</td>
        <td class="packet_td_2"><img src="/images/no.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
        <td class="packet_td_3"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <td class="packet_td_1_1">Galeria zdjęć</td>
        <td class="packet_td_2_1"><img src="/images/no.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
        <td class="packet_td_3_1"><img src="/images/yes.png" /></td>
    </tr>
    <tr>
        <th></th>
        <th class="packet_td_bottom"></th>
        <th class="packet_td_bottom"><a href="<?php echo url_for('@add_to_premium') ?>?packet=<?php echo $packet[1]->getPrimaryKey() ?>"><img src="/images/order2.png" /></a></th>
        <th class="packet_td_bottom"><a href="<?php echo url_for('@add_to_premium') ?>?packet=<?php echo $packet[2]->getPrimaryKey() ?>"><img src="/images/order2.png" /></a></th>
        <th class="packet_td_bottom"><a href="<?php echo url_for('@add_to_premium') ?>?packet=<?php echo $packet[3]->getPrimaryKey() ?>"><img src="/images/order2.png" /></a></th>
    </tr>
</table>