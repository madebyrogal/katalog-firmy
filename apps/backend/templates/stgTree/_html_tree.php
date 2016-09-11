<?php unset($previous_level); ?>
<?php echo '<h1>'.$collection['root']->__toString().'</h1>'; ?>
<?php echo count($collection['collection']) ? '<ol class="sortable" id="stg_list_'.$collection['root']->getPrimaryKey().'">' : ''; ?>
<?php foreach($collection['collection'] as $object) : ?>

  <?php if (isset($previous_level) && $previous_level > $object->getLevel()) : ?>
    <?php echo str_repeat('</ol></li>', $previous_level - $object->getLevel()); ?>
  <?php endif; ?>

  <li id="list_<?php echo $object->getPrimaryKey(); ?>">
    <div class="node_box">
      <div class="move_area" title="Przeciągnij"></div>
      <div class="node_menu">
        <?php if (!$object->getTable()->hasColumn('is_editable') || $object->get('is_editable')): ?>
          <a href="" class="ajax_edit_link">Edytuj</a>
        <?php endif; ?>
        <?php if (!$object->getTable()->hasColumn('is_deletable') || $object->get('is_deletable')): ?>
          <?php echo link_to('Usuń', $helper->getUrlForAction('delete'), $object, array('class' => 'ajax_delete_link', 'method' => 'delete', 'confirm' => 'Czy na pewno chcesz usunąć element?')); ?>
        <?php endif; ?>
      </div>
      <span class="node_icon">
        <?php $objectClass = get_class(sfOutputEscaperIteratorDecorator::unescape($object)); ?>
        <?php if ($objectClass == 'Files'): ?>
          <img src="/images/<?php echo $object->isFile() ? 'file.png' : 'folder.png' ?>" />
        <?php endif; ?>
      </span>
      <span class="node_name_<?php echo $object->getPrimaryKey(); ?>"><?php echo $object->getName(); ?></span>
    </div>

    <?php if ($object->hasChildren()) : ?>
      <ol class="children">
    <?php else: ?>
      </li>
    <?php endif; ?>

  <?php $previous_level = $object->getLevel(); ?>

<?php endforeach; ?>

<?php if (isset($previous_level) && $previous_level > 1) : ?>
  <?php echo str_repeat('</ol></li>', $previous_level - 1); ?>
<?php endif; ?>

<?php echo count($collection['collection']) ? '</ol>' : ''; ?>