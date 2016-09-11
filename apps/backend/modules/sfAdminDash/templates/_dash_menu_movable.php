<?php if (count($categories)): ?>
  <?php $i = 300; ?>
    <?php foreach ($categories as $name => $category): ?>
      <?php if (!isset($column) || ($i % 3 == $column - 1)): ?>

        <?php $is_global_shown = false; ?>

        <?php foreach ($category['items'] as $item): ?>
          <?php $is_shown = true; ?>
          <?php foreach ($item['credentials'] as $credential): ?>
            <?php if (!sfAdminDash::hasPermission($credential, $sf_user)): ?>
              <?php $is_shown = false; ?>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php $is_global_shown = $is_shown ? true : $is_global_shown; ?>
        <?php endforeach; ?>

        <?php $is_category_shown = false; ?>
        <?php if (isset($category['credentials']) && isset($category['credentials'][0])): ?>
          <?php $is_category_shown = true; ?>
          <?php foreach ($category['credentials'][0] as $credential): ?>
            <?php if (!$sf_user->hasCredential($credential)): ?>
              <?php $is_category_shown = false; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>

        <?php $is_global_shown = $is_category_shown && $is_global_shown; ?>

        <?php if ($is_global_shown): ?>
          <div id="portlet_<?php echo $i; ?>" class="portlet">
            <div id="dash_menu_movable">
              <h2><?php echo __(isset($category['name']) ? __($category['name']) : __($name), null, 'sf_admin_dash'); ?></h2>
              <?php include_partial('dash_list', array('items' => $category['items'])); ?>
            </div>
          </div>
        <?php endif; ?>


      <?php endif; ?>
      <?php $i++; ?>
    <?php endforeach; ?>

<?php endif; ?>
