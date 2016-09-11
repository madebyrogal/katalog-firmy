<ul class="menu_category">
<?php foreach($tree as $node): ?><li><a class="<?php echo ($node->isCurentUrl()) ? 'active' : ''; ?>" href="<?php echo url_for('category', $node); ?>"><span><?php echo $node->getName(); ?></span></a></li><?php endforeach; ?>
</ul>    