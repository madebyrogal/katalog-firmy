<?php if ($showFlashes) : ?>
  <div class="<?php echo $class ?>">
    <?php echo __($sf_user->getFlash($class), array(), 'sf_admin'); ?>
  </div>
<?php endif; ?>