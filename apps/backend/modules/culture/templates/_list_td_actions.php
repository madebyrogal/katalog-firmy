<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($culture, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>

    <?php if ($culture->isDeletable()) : ?>
      <?php echo $helper->linkToDelete($culture, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <?php endif; ?>

    <?php if ($culture->isActive()) : ?>
      <?php if ($culture->canDeactivate()) : ?>
        <img style="position: relative; top: 4px;" src="/sfDoctrinePlugin/images/error.png" />
        <a class="backend_custom_object_link" href="culture/<?php echo $culture->getPrimaryKey();?>/deactivate">Deaktywuj</a>
      <?php endif; ?>
    <?php else: ?>
      <img style="position: relative; top: 4px;" src="/sfDoctrinePlugin/images/new.png" />
      <a class="backend_custom_object_link" href="culture/<?php echo $culture->getPrimaryKey();?>/activate">Aktywuj</a>
    <?php endif; ?>

    <?php if (!$culture->isDefault()) : ?>
      <img style="position: relative; top: 4px;" src="/sfDoctrinePlugin/images/tick.png" />
      <a class="backend_custom_object_link" href="culture/<?php echo $culture->getPrimaryKey();?>/makeDefault">Ustaw jako domyślną</a>
    <?php endif; ?>

    <?php if ($culture->canMoveUp()) : ?>
      <img style="position: relative; top: 4px;" src="/sfDoctrinePlugin/images/desc.png" />
      <a class="backend_custom_object_link" href="culture/<?php echo $culture->getPrimaryKey();?>/moveUp">Do góry</a>
    <?php endif; ?>

    <?php if ($culture->canMoveDown()) : ?>
      <img style="position: relative; top: 4px;" src="/sfDoctrinePlugin/images/asc.png" />
      <a class="backend_custom_object_link" href="culture/<?php echo $culture->getPrimaryKey();?>/moveDown">Na dół</a>
    <?php endif; ?>
  </ul>
</td>
