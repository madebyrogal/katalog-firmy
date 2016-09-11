<?php include_partial('panel/menu', array('active' => 'invoices', 'company' => $company)); ?>

<div class="panel_box">

<table class="panel_table" style="width: 900px;" cellpadding="0" cellspacing="0">
    <?php if($invoices): ?>
        <tr>
            <th>Faktura</th>
            <th>Pobierz</th>
        </tr>
        <?php foreach($invoices as $invoice): ?>
        <tr>
            <td>Nr <?php echo $invoice->getNumber() ?></td>
            <td><a href="<?php echo url_for('download_invoice', $invoice); ?>" title="Pobierz"><img src="/images/pdf.png" /></a></td>
        </tr>        
        <?php endforeach; ?>
    <?php else: ?>
    <tr>
        <td>
            <h2 style="text-align: center">Aktualnie brak faktur do pobrania</h2>
        </td>
    </tr>
    <?php endif; ?>
</table>

</div>