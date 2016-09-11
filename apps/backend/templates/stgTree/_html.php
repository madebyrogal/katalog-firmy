<?php use_helper('I18N', 'Date') ?>
<div id="sf_admin_container">
  <div id="sf_admin_content">
    <div id="sf_admin_content_left">

      <p>Przeciągaj elementy, aby zmieniać strukturę drzewa.</p>

      <?php foreach($collections_array as $collection) : ?>
        <?php include('_html_tree.php'); ?>
      <?php endforeach; ?>

      <ul class="sf_admin_actions">
        <?php include_partial(sfContext::getInstance()->getModuleName().'/list_actions', array('helper' => $helper)) ?>
      </ul>

    </div>
    <div id="sf_admin_content_right">
      <div id="ajax_lang" style="display: none;"></div>
      <div id="ajax_box_loader" class="ajax_loader" style="display: none;"></div>
      <div id="ajax_box2"></div>
      <div id="ajax_box"></div>
    </div>
    <div style="clear: both"></div>
  </div>
</div>