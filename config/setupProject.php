<?php
//  stgConfig::add(array('subiekt_pictures_path' => 'http://cafesilesia.efektywneprojekty.pl/uploads/subiekt'));
//  stgConfig::add(array('subiekt_pictures_path_is_absolute' => 'on'));

  if ($options['env'] == 'prod') {
    stgConfig::add(array('subiekt_pictures_path' => 'subiekt'));
    stgConfig::add(array('subiekt_pictures_path_is_absolute' => 'off'));
  }
  else {
    stgConfig::add(array('subiekt_pictures_path' => 'http://sell.stg.pl/uploads/subiekt'));
    stgConfig::add(array('subiekt_pictures_path_is_absolute' => 'on'));
  }

//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'applications_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'jobs_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'catalog_flag_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'articles_catalog_product_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'art_categories_catalog_category_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'sliders_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'slider_banners_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'themes_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'user_logos_allow');
//  Doctrine::getTable('sfGuardGroupPermission')->unsetPermission('Administratorzy', 'user_banners_allow');
//
//  //ustawienia do platnosci.pl
//  stgConfig::add(array('payable_platnosci_pos_id' => '85273'));
//  stgConfig::add(array('payable_platnosci_pos_auth_key' => 'CKPDPYB'));
//  stgConfig::add(array('payable_platnosci_key1' => '70147444611954236b71fc83ba3ad538'));
//  stgConfig::add(array('payable_platnosci_key2' => '929417f05f065e3d4d90f4b2a2962c2e'));
//
////  //usutawienia do wysylania maili
////  stgConfig::add(array('systemmail_type' => 'sendmail'));
//
//  //obsluga ups_world_ship
//  stgConfig::add(array('ups_worldship' => 'on'));
//
//  stgConfig::add(array('payable_paypal_email' => 'sklep@cafesilesia.pl'));

//  // Wysyłanie maili przez sendmail
//  if ($options['env'] == 'prod') {
//    stgConfig::add(array('systemmail_type' => 'sendmail'));
//  }

?>