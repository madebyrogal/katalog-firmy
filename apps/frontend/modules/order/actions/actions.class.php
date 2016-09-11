<?php

/**
 * order actions.
 *
 * @package    sell4
 * @subpackage order
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeOrder(sfWebRequest $request)
  {
      $this->packets = PricesTable::getInstance()->getDefaultPackets();
  }
  
  public function executeAddCompany(sfWebRequest $request)
  {            			
      $this->packet = $request->getGetParameter('packet');
			
			$this->forward404If(!PricesTable::getInstance()->find($this->packet));
      
      $this->form = new AddCompanyFrontendForm();
      $this->form->setPacket($this->packet);
  }

  public function executeAddOrder(sfWebRequest $request)
  {
      $form_parameters = $request->getPostParameters();
      $this->form = new AddCompanyFrontendForm();
      $this->form->bind($form_parameters);
      if($this->form->isValid())
      {
           //tworzenie profilu
          $profile = ProfileTable::getInstance()->addProfileFromParameters($form_parameters);
          //tworzenie firmy
          $company = CompanyTable::getInstance()->addCompanyFromParameters($form_parameters, $profile);
          //tworzenie zamowienia
          $order = OrderTable::getInstance()->addOrderFromParameters($form_parameters, $profile, $company);
          
          T::redirect('summary_order', $order);
          
      }
      else
      {
          $this->getUser()->setFlash('error', 'Nie wypełniłeś wszystkich pól');
          $this->setTemplate('addCompany');
      }
  }
  
  public function executeSummaryOrder(sfWebRequest $request)
  {
      $this->order = $this->getRoute()->getObject();
      $username = $this->order->getProfile()->getGuardUser()->getUsername();
      $this->text = Message::getMessageByKey('summary_order', array('username' => $username));
      
  }



}
