<?php $route = 'sliders_switch_default'; ?>
<?php if($sliders->getIsDefault()): ?>
     <img src="/sfDoctrinePlugin/images/tick.png" title="Domyślny" />
<?php else: ?>
    <?php echo link_to('<img src="/sfDoctrinePlugin/images/delete.png" title="Niedomyślny" />', url_for($route, $sliders)); ?>
<?php endif; ?>