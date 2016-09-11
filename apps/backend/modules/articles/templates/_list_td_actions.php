<td>
  <ul class="sf_admin_td_actions">
    <?php if($articles->getIsEditable()): ?>
      <?php if ($sf_user->hasCredential(array(  0 => 'articles_allow',))): ?>
        <?php echo $helper->linkToEdit($articles, array(  'credentials' =>   array(    0 => 'articles_allow',  ),  'label' => 'Edytuj',  'params' =>   array(  ),  'class_suffix' => 'edit',)) ?>
      <?php endif; ?>
    <?php endif; ?>

    <?php if($articles->getIsDeletable()): ?>
      <?php if ($sf_user->hasCredential(array(  0 => 'articles_allow',))): ?>
        <?php echo $helper->linkToDelete($articles, array(  'credentials' =>   array(    0 => 'articles_allow',  ),  'label' => 'Usuń',  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',)) ?>
      <?php endif; ?>
    <?php endif; ?>

  </ul>
</td>
