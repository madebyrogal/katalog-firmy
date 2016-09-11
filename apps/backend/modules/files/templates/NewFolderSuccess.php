<?php use_helper('I18N', 'Date') ?>
<?php include_partial('files/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Dodaj nowy katalog', array(), 'messages') ?></h1>

  <?php include_partial('files/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('files/form_header', array('files' => $files, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php use_stylesheets_for_form($form) ?>
    <?php use_javascripts_for_form($form) ?>

    <div class="sf_admin_form">
      <?php echo form_tag_for($form, '@files') ?>
        <?php echo $form->renderHiddenFields(false) ?>

        <?php if ($form->hasGlobalErrors()): ?>
          <?php echo $form->renderGlobalErrors() ?>
        <?php endif; ?>

        <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
          <?php include_partial('files/form_fieldset', array('files' => $files, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
        <?php endforeach; ?>

        <?php include_partial('files/form_actions', array('files' => $files, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </form>
    </div>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('files/form_footer', array('files' => $files, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>