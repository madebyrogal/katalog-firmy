<?php

function flashes_li() {
  $sf_user = sfContext::getInstance()->getUser();
  
  if ($sf_user->hasFlash('notice')) {
    echo '<li class="notice">';
    echo __($sf_user->getFlash('notice'), array(), 'sf_admin');
    echo '</li>';
  }

  if ($sf_user->hasFlash('error')) {
    echo '<li class="error">';
    echo __($sf_user->getFlash('error'), array(), 'sf_admin');
    echo '</li>';
  }
}