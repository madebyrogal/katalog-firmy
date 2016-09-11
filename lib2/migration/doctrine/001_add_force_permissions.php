<?php

class AddForcePermissions extends Doctrine_Migration_Base
{

  public function isDone()
  {
    return false; //zawsze wykonuj tą migrację
  }

  public function up()
  {
    if (!$this->isDone()) {

      $admin_permission_names = array(
          
          'cultures',
          'culture_allow',
          'currency_allow',          
          'contact_queries_allow',
          'contact_allow',
          'art_categories_allow',
          'articles_allow',
          'galleries_allow',
          'pictures_allow',
          'comments_allow',
          'files_allow',
          'user_banners_allow',
          'user_logos_allow',
          'sliders_allow',
          'slider_banners_allow',
          'themes_allow',
          'menus_allow',
          'metas_allow',
          'home_page_allow',                    
          'sf_guard_user_allow',          
          'sf_guard_group_allow',
          'sf_guard_permission',
          'articles_catalog_product_allow',
          'art_categories_catalog_category_allow',
          'icons_allow',
          
          'message_allow',
          'prices_allow',
          'order_allow',
          'status_allow',
          'profile_allow',                            
          'category_allow',
          'company_allow',
          'invoice_allow'
      );

      $adminGroup = sfGuardGroupTable::getInstance()->findOneByName('Administratorzy');
      $adminPermissions = $adminGroup->getPermissions();
      foreach ($adminPermissions as $permission) {
        $permission->delete();
      }

      foreach ($admin_permission_names as $permission_name) {
        try {
          $permission = new sfGuardPermission();
          $permission->setName($permission_name);
          $permission->setDescription($permission_name);
          $permission->save();
        } catch (Exception $exc) {
          //NIC, widocznie ten permission już istnieje
        }
      }

        $adminPermissions = sfGuardPermissionTable::getInstance()->findByNames($admin_permission_names);
        foreach ($adminPermissions as $permission) {
          try {
            $tmp = new sfGuardGroupPermission();
            $tmp->setGroup($adminGroup);
            $tmp->setPermission($permission);
            $tmp->save();
            unset($tmp);
          } catch (Exception $exc) {
            //NIC, widocznie ten permission już istnieje
          }
        }
       
        
        $users = sfGuardUserTable::getInstance()->findAll();
        foreach($users as $user)
        {
            if($user->getUsername() != 'guest')
            {
                $user->setIsActive(true);
                $user->save();
            }
        }
        
    }
  }

  public function down()
  {
      //nic (nie mozna cofnac)
  }
}
