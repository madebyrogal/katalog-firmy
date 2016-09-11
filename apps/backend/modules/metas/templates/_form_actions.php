<?php include_partial('js'); ?>

<ul class="sf_admin_actions">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
  <?php if ($sf_user->hasCredential('metas')): ?>
<?php echo $helper->linkToSave($form->getObject(), array(  'credentials' => 'metas',  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
<?php endif; ?>

<?php else: ?>
  <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
  <?php if ($sf_user->hasCredential('metas')): ?>
<?php echo $helper->linkToSave($form->getObject(), array(  'credentials' => 'metas',  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
<?php endif; ?>

<?php endif; ?>
</ul>
