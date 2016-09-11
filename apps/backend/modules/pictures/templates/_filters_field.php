<?php include('_filters_settings.php'); ?>
<?php if ($field->isPartial()): ?>
  <?php include_partial($moduleName.'/'.$name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component($moduleName, $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
  <div class="filters_item <?php echo $class ?>">
    <div class="filters_item_label">
      <?php echo $form[$name]->renderLabel($label) ?>
    </div>
    <div class="filters_item_field">
      <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
    </div>
    <div class="filters_item_error">
      <?php echo $form[$name]->renderError() ?>
    </div>
    <?php if ($help || $help = $form[$name]->renderHelp()): ?>
      <div class="help"><?php echo __($help, array(), 'messages') ?></div>
    <?php endif; ?>
  </div>
<?php endif; ?>
