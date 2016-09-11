<td>
  <ul class="sf_admin_td_actions">
    <?php if ($sf_user->hasCredential(array(  0 => 'prices_allow',))): ?>
<?php echo $helper->linkToEdit($prices, array(  'credentials' =>   array(    0 => 'prices_allow',  ),  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
<?php endif; ?>
<?php if($prices->getIsDeletable()): ?>
<?php if ($sf_user->hasCredential(array(  0 => 'prices_allow',))): ?>
<?php echo $helper->linkToDelete($prices, array(  'credentials' =>   array(    0 => 'prices_allow',  ),  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
<?php endif; ?>
<?php endif; ?>

  </ul>
</td>
