<?php
    $object = $themes;
//    $route = 'orders_orders_switch_active';
    $route = 'themes_themes_switch_active';

?>
<?php if($object->getIsActive()): ?>
    <?php echo link_to('<img src="/backend/images/show.png" title="Nie wyświetlaj" />',url_for($route,$object)); ?>
<?php else: ?>
    <?php echo link_to('<img src="/backend/images/hide.png" title="Wyświetl" />',url_for($route,$object)); ?>
<?php endif; ?>
