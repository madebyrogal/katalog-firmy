<?php include_partial('accordion_js'); ?>
<div id="dash_menu_accordion">
  <?php if (count($items)): ?>
    <?php include_partial('dash_list', array('items' => $items)); ?>
  <?php endif; ?>
  <?php if (count($categories)): ?>
    <?php foreach ($categories as $name => $category): ?>
      <?php if (sfAdminDash::hasPermission($category, $sf_user)): ?>
        <h2><?php echo __(isset($category['name']) ? __($category['name']) : __($name), null, 'sf_admin_dash'); ?></h2>
        <?php include_partial('dash_list', array('items' => $category['items'])); ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php elseif (!count($items)): ?>
    <?php echo __('sfAdminDashPlugin is not configured.  Please see the %documentation_link%.', array('%documentation_link%'=>link_to(__('documentation', null, 'sf_admin_dash'), 'http://www.symfony-project.org/plugins/sfAdminDashPlugin?tab=plugin_readme', array('title' => __('documentation', null, 'sf_admin_dash')))), 'sf_admin_dash'); ?>
  <?php endif; ?>
</div>