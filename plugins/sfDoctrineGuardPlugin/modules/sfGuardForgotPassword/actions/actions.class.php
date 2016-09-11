<?php

require_once dirname(__FILE__).'/../lib/BasesfGuardForgotPasswordActions.class.php';

/**
 * sfGuardForgotPassword actions.
 * 
 * @package    sfGuardForgotPasswordPlugin
 * @subpackage sfGuardForgotPassword
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
class sfGuardForgotPasswordActions extends BasesfGuardForgotPasswordActions
{

  public function executeIndex($request)
  {

    $this->form = new sfGuardRequestForgotPasswordForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->user = $this->form->user;
        $this->_deleteOldUserForgotPasswordRecords();

        $forgotPassword = new sfGuardForgotPassword();
        $forgotPassword->user_id = $this->form->user->id;
        $forgotPassword->unique_key = md5(rand() + time());
        $forgotPassword->expires_at = new Doctrine_Expression('NOW()');
        $forgotPassword->save();

        $to = $this->form->user->email_address;
        $title = 'Zapomniane hasło użytkownika '.$this->form->user->username;
        $content = $this->getPartial('sfGuardForgotPassword/send_request', array('user' => $this->form->user, 'forgot_password' => $forgotPassword));
        T::systemMail($to,$title,$content);

        $this->getUser()->setFlash('notice', 'Odbierz poczŧę email! Wkrótce powinieneś otrzymać wiadomość z instrukcjami.');
        $this->redirect('@user_login');
      } else {
        $this->getUser()->setFlash('error', 'Błędny adres email!');
      }
    }
  }

  public function executeChange($request)
  {
    $this->forgotPassword = $this->getRoute()->getObject();
    $this->user = $this->forgotPassword->User;
    $this->form = new sfGuardChangeUserPasswordForm($this->user);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();

        $this->_deleteOldUserForgotPasswordRecords();

        $to = $this->user->email_address;
        $title = 'Nowe hasło użytkownika '.$this->user->username;
        $content = $this->getPartial('sfGuardForgotPassword/new_password', array('user' => $this->user, 'password' => $request['sf_guard_user']['password']));
        T::systemMail($to,$title,$content);

        $this->getUser()->setFlash('notice', 'Hasło zostało zmienione!');
        $this->redirect('@user_login');
      }
    }
  }
  
  private function _deleteOldUserForgotPasswordRecords()
  {
    Doctrine_Core::getTable('sfGuardForgotPassword')
      ->createQuery('p')
      ->delete()
      ->where('p.user_id = ?', $this->user->id)
      ->execute();
  }
}
