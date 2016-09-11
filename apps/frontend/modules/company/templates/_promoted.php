<h3 class="header">Polecane firmy</h3>
<br />
<?php foreach($objects as $object): ?>

    <?php include_partial('company/company_one', array('object' => $object)); ?>

<?php endforeach; ?>

<?php include_partial('company/popup_js'); ?>