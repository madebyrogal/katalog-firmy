<td>
  <ul class="sf_admin_td_actions">
    <?php if ($sf_user->hasCredential(array(  0 => 'sf_guard_user_allow',))): ?>
    <?php if ($sf_guard_user->isEditable()): ?>
<?php echo $helper->linkToEdit($sf_guard_user, array(  'credentials' =>   array(    0 => 'sf_guard_user_allow',  ),  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
<?php endif; ?>
<?php endif; ?>

    <?php if ($sf_user->hasCredential(array(  0 => 'sf_guard_user_allow',))): ?>
    <?php if ($sf_guard_user->isDeletable()): ?>
<?php echo $helper->linkToDelete($sf_guard_user, array(  'credentials' =>   array(    0 => 'sf_guard_user_allow',  ),  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
<?php endif; ?>
<?php endif; ?>

  </ul>
</td>
