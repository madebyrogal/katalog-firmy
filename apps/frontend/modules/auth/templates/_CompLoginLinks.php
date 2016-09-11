<?php if (! $sf_user->isAuthenticated()) : ?>

  <a href="<?php echo url_for('@user_login'); ?>">Zaloguj się &raquo;</a>
  <a href="<?php echo url_for('@user_register'); ?>">Rejestracja &raquo;</a>

<?php else: ?>

  <a href="<?php echo url_for('@user_logout'); ?>">Wyloguj (<?php echo $sf_user->getUsername(); ?>)</a>
  <a href="<?php echo url_for('@user_account') ?>">Twoje konto &raquo;</a>
  
<?php endif; ?>