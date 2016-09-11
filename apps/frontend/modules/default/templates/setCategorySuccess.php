<?php $tree = sfOutputEscaperArrayDecorator::unescape($tree); ?>
<?php foreach($tree as $id => $one): ?>
    <span><?php echo $one; ?><a class="delete_category_<?php echo $id; ?>" onclick="deleteCategory(this); return false;" href="#">X</a><br /></span>
<?php endforeach; ?>
