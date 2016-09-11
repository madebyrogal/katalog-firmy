<?php use_helper('I18N', 'Date') ?>
<?php include_partial('articles/assets') ?>

<div id="sf_admin_container" class="article_edit_containter">
  <h1><?php echo __('Dodaj nowy tekst', array(), 'messages') ?></h1>

  <?php include_partial('articles/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('articles/form_header', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('articles/form', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('articles/form_footer', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>