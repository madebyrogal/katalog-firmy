<h3 class="header h_menu header_left">Dodaj firmę</h3>  
<br /><h2 style="text-align: center;">Wybierz odpowiedni pakiet dla swojej firmy</h2>

<table style="width: 930px; min-width: 930px; max-width: 930px; margin: 0 auto; text-align: center;">
    <tr>
    	<td style="padding: 20px;"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[0]->getPrimaryKey(); ?>"><img src="/images/cennik_03.png"</a></td>
        <td style="padding: 20px;"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[1]->getPrimaryKey(); ?>"><img src="/images/cennik_05.png"</a></td>
        <td style="padding: 20px;"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[2]->getPrimaryKey(); ?>"><img src="/images/cennik_07.png"</a></td>
        <td style="padding: 20px;"><a href="<?php echo url_for('add_company') ?>?packet=<?php echo $packets[3]->getPrimaryKey(); ?>"><img src="/images/cennik_09.png"</a></td>
    </tr>
</table>    