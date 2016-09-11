<?php
    $object = $articles;
//    $route = 'articles_articles_switch_public';
    $route = sfContext::getInstance()->getModuleName().'_articles_switch_public';
?>
<?php if($object->getIsPublic()): ?>
    <?php echo link_to('<img src="/backend/images/show.png" title="Widoczny" />',url_for($route,$object)); ?>
<?php else: ?>
    <?php echo link_to('<img src="/backend/images/hide.png" title="Niewidoczny" />',url_for($route,$object)); ?>
<?php endif; ?>