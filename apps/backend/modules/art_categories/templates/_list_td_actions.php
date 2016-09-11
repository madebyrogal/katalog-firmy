<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_addpage">
      <?php echo link_to(__('Dodaj tekst', array(), 'messages'), 'art_categories/ListAddPage?artcategory_id='.$art_categories->getPrimaryKey(), array()) ?>
    </li>
	<?php if($art_categories->getLevel() > 0): ?>  
    <?php if($art_categories->getIsEditable()): ?>
      <?php echo $helper->linkToEdit($art_categories, array(  'label' => 'Edytuj',  'params' =>   array(  ),  'class_suffix' => 'edit',)) ?>
    <?php endif; ?>
    <?php if($art_categories->getIsDeletable()): ?>
      <?php echo $helper->linkToDelete($art_categories, array(  'label' => 'Usuń',  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',)) ?>
    <?php endif; ?>
	<?php endif; ?>
  </ul>
</td>
