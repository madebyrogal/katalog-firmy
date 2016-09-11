<div id="sf_admin_container">
<h1>Statystyki</h1>
<h3 style="text-align: center"><?php echo $object->getName(); ?></h3>

<div style="width: 500px; min-width: 500; max-width: 500px; margin: 0 auto; font-size: 15px; line-height: 22px;">
<?php if(count($stats) > 0): ?>
    
    <table>
        <tr>
            <th style="border-bottom: 1px solid #000;">Data</th>
            <th style="border-bottom: 1px solid #000;">Liczba osób zainteresowanych danymi kontaktowymi</th>
        </tr>

    <?php foreach($stats as $one): ?>
        <tr>
            <td><?php echo T::getMonth(date('m', strtotime($one['date']))).' '.date('Y', strtotime($one['date'])); ?></td>
            <td><?php echo $one['count']; ?></td>        
        </tr>
    <?php endforeach; ?>    
    </table>    
<?php else: ?>
    <p style="text-align: center">
        brak statystyk
    </p>
<?php endif; ?>
</div>

</div>