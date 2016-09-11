<?php
  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
?>
<?php use_javascript('google_jsapi.js'); ?>
  
<div id="sf_admin_container">
  
<style type="text/css">
.column { width: 33%; float: left; padding-bottom: 100px; }
.portlet { margin: 0 1em 1em 0; }
.portlet-header { margin: 0.3em; padding-bottom: 4px; padding-left: 0.2em; cursor: pointer; }
.portlet-header .ui-icon { float: right; }
.portlet-content { padding: 0.4em; }
.ui-sortable-placeholder { border: 1px dotted black; visibility: visible !important; height: 50px !important; }
.ui-sortable-placeholder * { visibility: hidden; }
#dash_menu_accordion h2 { padding-left: 20px;}
.ui-widget-content {background: none; color: inherit;}
</style>
<?php include_partial('portal'); ?>
    <div id="column_1" class="column">      
      <?php include_partial('dash_menu_movable',array('items'=>$items,'categories'=>$categories, 'column' => 1 )); ?>
    </div>

    <div id="column_2" class="column">
      <?php include_partial('dash_menu_movable',array('items'=>$items,'categories'=>$categories, 'column' => 2 )); ?>      
    </div>
      <div id="column_3" class="column">
        <?php include_partial('dash_menu_movable',array('items'=>$items,'categories'=>$categories, 'column' => 3 )); ?>    
      </div>
    <div style="clear: left;"></div>
</div>