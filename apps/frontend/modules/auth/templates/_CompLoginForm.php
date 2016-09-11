<?php if (! $sf_user->isAuthenticated()) : ?>

  <?php include_partial('auth/login_form', array('form' => $form)); ?>
  <a href="<?php echo url_for('@user_register'); ?>">Rejestracja</a>

<?php else: ?>

  <a href="<?php echo url_for('@user_logout'); ?>">Wyloguj (<?php echo $sf_user->getUsername(); ?>)</a>
  
<?php endif; ?>