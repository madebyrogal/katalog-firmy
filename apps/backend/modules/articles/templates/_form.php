<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@articles') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php echo $form[Lang::getDefaultLanguage()]['content']; ?>
<?php /*
    <?php foreach (Lang::getInstance()->getActiveAndNotDefault()->toArray() as $lang) : ?>
      <?php echo $form[$lang]['content']; ?>
    <?php endforeach; ?>
 */?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('articles/form_fieldset', array('articles' => $articles, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('articles/form_actions', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
<div class="clear"></div>
