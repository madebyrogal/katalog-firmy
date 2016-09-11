<?php

/**
 * contact actions.
 *
 * @package    sell4
 * @subpackage contact
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new EmailContactForm();
    $this->contact = Doctrine::getTable('Contact')->getFirst();
    
        if (! $this->contact->getHasCaptcha())
        {
          unset($this->form['captcha']);
        }

        if ($this->getRequest()->isMethod('post'))
        {
            $this->form->bind($request->getParameter('form'));
            if($this->form->isValid())
            {
                $this->form->save();
                $this->getUser()->setFlash('notice', 'Email został wysłany');
                $this->addContactQuery($request->getParameter('form'));
                $this->redirect('@contact');
            }
            
        }
  }
  
      public function addContactQuery($param)
    {
        $query = new ContactQueries();
        $query->setName($param['name']);
        $query->setEmail($param['email']);
        $query->setQuery($param['text']);

//        $query->setPhone($param['phone']);

        $query->save();
    }
}
