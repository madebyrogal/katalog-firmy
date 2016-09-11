<br />
<div style="width: 400px; float: left;" class="login_box">
  <?php if (!$sf_user->isAuthenticated()) : ?>
    <form action="<?php echo url_for('@user_login'); ?>" method="post" class="content_form no-margin-left">
      <?php echo $form; ?>
      <a href="<?php echo url_for('@remind_password'); ?>">Nie pamiętasz hasła?</a>
      <input class="login_button" style="margin-bottom: 20px;" type="submit" value="" />
    </form>
  <?php endif; ?>
</div>

<div style="width: 260px; float: right">
    
    <div class="register_box">
        <h1>Nie masz konta?</h1>
        <a href="<?php echo url_for('@order'); ?>">Zarejestruj się!</a>
        <span>to potrwa tylko 2 min</span><br />
        <a href="<?php echo url_for('@order'); ?>"><img src="/images/big_button.png" /></a>
    </div>
    
</div>

<div style="clear: both"></div>