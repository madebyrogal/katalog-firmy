<?php $route = 'sliders_switch_random'; ?>
<?php if($sliders->getRandom()): ?>
    <?php echo link_to('<img src="/sfDoctrinePlugin/images/tick.png" title="Domyślny" />', url_for($route, $sliders)); ?>
<?php else: ?>
    <?php echo link_to('<img src="/sfDoctrinePlugin/images/delete.png" title="Niedomyślny" />', url_for($route, $sliders)); ?>
<?php endif; ?>