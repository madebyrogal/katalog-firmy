<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
  <?php if ('NONE' != $fieldset): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
  <?php endif; ?>

  <?php foreach ($fields as $name => $field): ?>
    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
<?php /*
 */?>
<?php if ($name == Lang::getDefaultLanguage()) : ?>
    <?php //echo 'nic'; ?>
<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_pl">
  <div>
    <label for="articles_pl" style="display: none; ">Pl</label>
    <div class="content">
    <table>
      <tbody>
        <tr>
          <th><label for="articles_pl_title">Tytuł</label></th>
          <td><?php echo $form[$name]['title']; ?></td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</div>
    <?php //echo $form[$name]['content']; ?>
<?php //elseif (in_array($name, Lang::getInstance()->getActiveAndNotDefault()->toArray())): ?>
    <?php //echo 'nic'; ?>
    <?php //echo $form[$name]['content']; ?>
<?php else: ?>
    <?php include_partial('articles/form_field', array(
      'name'       => $name,
      'attributes' => $field->getConfig('attributes', array()),
      'label'      => $field->getConfig('label'),
      'help'       => $field->getConfig('help'),
      'form'       => $form,
      'field'      => $field,
      'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
    )) ?>
<?php /*
<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_pl">
  <div>
    <label for="articles_pl" style="display: none; ">Pl</label>
    <div class="content">
    <table>
      <tbody>
        <tr>
          <th><label for="articles_pl_title">Tytuł</label></th>
          <td><input type="text" name="articles[pl][title]" value="O nas" id="articles_pl_title"></td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</div>
 */?>
<?php endif; ?>
  <?php endforeach; ?>
</fieldset>
