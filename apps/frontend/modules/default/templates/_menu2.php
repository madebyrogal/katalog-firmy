<a id="menu_anchor2"></a>
<?php $active = isset($active) ? $active : $sf_request->getPathInfo(); ?>

<div class="<?php echo $class ?>">
  <?php echo $sf_data->getRaw('tree'); ?>
  <div style="clear: both;"></div>
</div>
