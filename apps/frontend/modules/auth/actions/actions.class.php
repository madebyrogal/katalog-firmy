<?php

/**
 * auth actions.
 *
 * @package    stgcms2
 * @subpackage auth
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */



class authActions extends myActions
{
  private $signin_redirect_route = 'user_account';

  public function executeLogin(sfWebRequest $request) {
    $this->redirectIf($this->getUser()->isAuthenticated(), $this->signin_redirect_route);
    $this->form = new LoginForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();
        $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $this->getUser()->getReferer($request->getReferer()));

        return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
      }
      else {
        $this->getUser()->setFlash('notice', FlashMessages::get('signin_error'));
      }
    }
    else
    {
      if ($request->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      $this->getUser()->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
    }
  }

  public function executeLogout(sfWebRequest $request) {
    $this->getUser()->signout();

    $this->getUser()->setFlash('notice', FlashMessages::get('logout'));
    $this->redirect('user_login');
  }

  public function executeRegister(sfWebRequest $request) {
    $this->forward404If($this->getUser()->isAuthenticated());
    $this->form = new RegisterForm();
  }

  public function executeCreate(sfWebRequest $request) {
    $this->forward404If($this->getUser()->isAuthenticated());
    $this->form = new RegisterForm();

    $this->form->bind($request->getParameter($this->form->getName()));
    if ($this->form->isValid())
    {
      try {
        $user = $this->form->doSave();

        if($user->getIsActive()) {
          $this->getUser()->signin($user);
          $this->getUser()->setFlash('notice', FlashMessages::get('registration_success_and_signed_in'));
          return $this->redirect($this->signin_redirect_route);
        }
        else {
          $url = T::getSiteNameUrl().T::url_for('user_activate', $user->getProfile());
          T::systemMail($user->getEmailAddress(), 'Aktywuj konto', 'Link aktywujący: <a href="'.$url.'"><strong>'.$url.'</strong></a>');

          $this->getUser()->setFlash('notice', FlashMessages::get('registration_success_and_mail_sent'));
          return $this->redirect('user_login');
        }
      }
      catch (Doctrine_Validator_Exception $e) {
        $this->getUser()->setFlash('error', FlashMessages::get('form_message_error'));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', FlashMessages::get('form_message_invalid'));
    }

    $this->setTemplate('register');
  }

  public function executeActivate(sfWebRequest $request)
  {
    $this->forward404Unless($profile = $this->getRoute()->getObject());
    $this->forward404If($profile->getGuardUser()->getIsActive()); //Żeby link nie służył do automatycznego logowania.

    $profile->getGuardUser()->setIsActive(true)->save();
    
    $this->getUser()->signin($profile->getGuardUser());
    $this->getUser()->setFlash('notice', FlashMessages::get('activation_success_and_signed_in'));
    return $this->redirect($this->signin_redirect_route);
  }



}
