<?php use_helper('I18N', 'Date') ?>
<?php include_partial($this->getModuleName().'/assets') ?>


<div id="sf_admin_container" class="article_edit_containter">
  <h1><?php echo __('Edycja: %%title%%', array('%%title%%' => $articles->getTitle()), 'messages') ?></h1>

  <?php include_partial($this->getModuleName().'/flashes') ?>


  <?php include_partial($this->getModuleName().'/articles_version', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration, 'version_edit' => $version_id)) ?>


  <div id="sf_admin_header">
    <?php include_partial($this->getModuleName().'/form_header', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial($this->getModuleName().'/form', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial($this->getModuleName().'/form_footer', array('articles' => $articles, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
