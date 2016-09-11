<ul class="sf_admin_actions">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToList(array(  'label' => 'Anuluj',  'params' =>   array(  ),  'class_suffix' => 'list',)) ?>
  <?php /*
  <?php if ($sf_user->hasCredential('articles_allow')): ?>
    <?php echo $helper->linkToSave($form->getObject(), array(  'credentials' => 'articles_allow',  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Zapisz wersję',)) ?>
  <?php endif; ?>
  */ ?>

  <?php if ($sf_user->hasCredential('articles_allow')): ?>
    <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'credentials' => 'articles_allow',  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
  <?php endif; ?>

<?php else: ?>
  <?php if ($sf_user->hasCredential(array(  0 => 'articles_allow',))): ?>
    <?php echo $helper->linkToDelete($form->getObject(), array(  'credentials' =>   array(    0 => 'articles_allow',  ),  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  <?php endif; ?>

  <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save',  'label' => 'Zapisz wersję',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array(  ),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
<?php endif; ?>

    <li class="sf_admin_action_publish">
        <input type="submit" name="_publish" value="Zapisz i publikuj">
    </li>
</ul>
