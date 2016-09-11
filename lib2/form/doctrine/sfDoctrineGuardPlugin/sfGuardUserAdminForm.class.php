<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
    /**
     * @see sfForm
     */
    public function configure()
    {

      $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

      $this->setWidget(
        'groups_list', new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'table_method' => 'queryChoosableByAdmin'))
      );

      $this->setValidator(
        'groups_list', new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false, 'query' => Doctrine::getTable('sfGuardGroup')->queryChoosableByAdmin()))
      );

      $this->validatorSchema->setPostValidator(
        new sfValidatorAnd(array(
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address'))),
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username'))),
        ))
      );

      $password_required = $this->getObject()->isNew();
      $this->setValidator('password', new sfValidatorString(array('min_length' => 3, 'required' => $password_required, 'trim' => true, 'max_length' => 128),
                        array('min_length' => 'Hasło musi zawierać co najmniej %min_length% znaki.')));
      $this->setValidator('password_again', new sfValidatorString(array('min_length' => 3, 'required' => $password_required, 'trim' => true, 'max_length' => 128)));

      unset (
        $this['is_super_admin']
      );

      if ($this->getObject()->getUsername() == 'admin') {
        unset (
          $this['username'] //nie można zmienić username admina
        );
      }
      if(!$this->isNew())
      {
        $profile_form = new ProfileForm($this->getObject()->getProfile());
        $this->embedForm('Profile', $profile_form);
      }

    }

//
    protected function doSave($con = null)
    {
      $values = $this->getValues();
      $guardUserValues = array(
          'email_address' => $values['email_address'],
          'username' => $values['username'],
          'is_active' => $values['is_active']
      );

      if ($this->getObject()->getUsername() == 'admin') {
        unset (
          $guardUserValues['username'] //nie można zmienić username admina
        );
      }

      if ($values['password']) {
        $guardUserValues['password'] = $values['password'];
      }

      $user = ($this->getObject()->isNew()) ? new sfGuardUser() : $this->getObject();


      $user->setArray($guardUserValues);
      $user->save();
      
      $profile = $user->getProfile();
      $profile->setArray($values['Profile']);

      $profile->save();



      // grupy
      $groups = new Doctrine_Collection('sfGuardGroup');
      foreach ($values['groups_list'] as $group_id) {
        if ($group = Doctrine::getTable('sfGuardGroup')->find($group_id)) {
          $groups->add($group);
          if (!$user->hasGroup($group->getName())) {
            $user->addGroupByName($group->getName());
          }
        }
      }
      $user->save();
      $user->unlinkAllUnlinkableGroupsExcept($groups);

      $this->saveEmbeddedForms($con);

      $this->object = $user;
    }
}
