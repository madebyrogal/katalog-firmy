<?php

/**
 * panel actions.
 *
 * @package    sell4
 * @subpackage panel
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class panelActions extends sfActions {

    public function executeInfo(sfWebRequest $request) {
        $this->company = $this->getUser()->getComapny();
        $this->forward404Unless($this->company);
        $this->form = new CompanyFrontendForm($this->company);
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($request->getParameter('company'));
            if ($this->form->isValid()) {
                $this->form->save();
                $this->getUser()->setFlash('notice', 'Informacje został zapisane');
            }
        }
    }

    public function executeGallery(sfWebRequest $request) {
        $this->company = $this->getUser()->getComapny();
        $this->forward404Unless($this->company);
        
        $galleries = $this->company->getGalleries();
        $default = $galleries->getDefaultPicture();
        if($default) {
          $this->form = new PicturesFrontendForm($default);
          $this->galleries = new PicturesFrontendForm();
          $this->galleries->setGallery($galleries);
        }
        else {
          $this->form = new PicturesFrontendForm();
          $this->galleries = false;
        }
        $this->form->setGallery($galleries);

        if ($this->getRequest()->isMethod('post')) {
            $this->processForm($request, $this->form);
        }
        //$galleries->removeDefaultPictureForce();
        
    }
    
    public function executePictures(sfWebRequest $request) {
      $this->company = $this->getUser()->getComapny();
      $this->galleries = new PicturesFrontendForm();
      $this->galleries->setGallery($this->company->getGalleries());
      if ($request->isMethod('post')) {
        $this->processForm($request, $this->galleries);
      }
      $this->redirect('@panel_gallery');
    }
    
    public function executeDeleteLogo(sfWebRequest $request) {
      $this->company = $this->getUser()->getComapny();
      $this->forward404Unless($this->company);
        
      $galleries = $this->company->getGalleries();
      $default = $galleries->getDefaultPicture();
      $default->delete();
      $galleries->removeDefaultPictureForce();
      
      $this->redirect('@panel_gallery');
    }

    public function executeInvoices(sfWebRequest $request) {
        $this->company = $this->getUser()->getComapny();
        $this->forward404Unless($this->company);
        $this->invoices = $this->getUser()->getInvoices();
    }

    public function executePayable(sfWebRequest $request) {
        $this->company = $this->getUser()->getComapny();
        $this->last = $this->company->getLastOrder();
        $this->forward404Unless($this->company);

        $packets = PricesTable::getInstance()->getPackets();
        $this->packet_name = $packets[$this->company->getPacket()];
        
        $this->packet = PricesTable::getInstance()->find(2);
        
    }

    public function executeProfile(sfWebRequest $request) {
        $this->company = $this->getUser()->getComapny();
        $this->profile = $this->getUser()->getProfile();
        $this->form = new UserFrontendForm($this->getUser()->getGuardUser());
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($request->getParameter('sf_guard_user'));
            if ($this->form->isValid()) {
                $this->form->save();
                $this->getUser()->setFlash('notice', 'Profil został zapisany');
            }
        }
    }

    public function executeDownload(sfWebRequest $request) {
        $invoice = $this->getRoute()->getObject();
        if ($this->getUser()->validateInvoice($invoice)) {
            $pdf = new InvoicePDF($invoice, true);
            $pdf->sendToBrowser();
        } else {
            //blad pobierania faktury - brak dostepu
        }
    }
    
    public function executeAddRenew(sfWebRequest $request) 
    {
        $this->company = $this->getUser()->getComapny();
        
        $this->packet = PricesTable::getInstance()->find($request->getParameter('packet'));
        if($this->packet)
        {
          $params = array();
          $params['packet'] = $this->packet->getPrimaryKey();
          OrderTable::getInstance()->addNewOrder($params, $this->getUser()->getGuardUser()->getProfile(), $this->company);
          $this->getUser()->setFlash('notice', 'Pakiet przedłużony, musisz go jeszcze opłacić');
        }
        $this->redirect('@panel_payable');
    }
    
    public function executeAddToPremium(sfWebRequest $request) 
    {
        $this->company = $this->getUser()->getComapny();
        $this->packet = PricesTable::getInstance()->find((int)$request->getParameter('packet'));
        if($this->packet)
        {
          $params = array();
          $params['packet'] = $this->packet->getPrimaryKey();
          OrderTable::getInstance()->addToPremiumOrder($params, $this->getUser()->getGuardUser()->getProfile(), $this->company);
          $this->getUser()->setFlash('notice', 'Przeszedłeś do pakietu PREMIUM, musisz go jeszcze opłacić');
        }
        $this->redirect('@panel_payable');
    }

    public function executeRenew(sfWebRequest $request) 
    {
        $this->company = $this->getUser()->getComapny();
        $this->packets = PricesTable::getInstance()->getDefaultPackets();
    }
    
    public function executePremium(sfWebRequest $request) 
    {
        $this->company = $this->getUser()->getComapny();
        if($this->company->getPacket() == 1)
        {
          $this->redirect('/panel');
        }
        $this->packet = PricesTable::getInstance()->find(2);
    }

    public function executeDelete(sfWebRequest $request) {

        $this->company = $this->getUser()->getComapny();

        $email = sfGuardUserTable::getInstance()->findOneByUsername('admin')->getEmailAddress();
        $message = Message::getMessageByKey('delete_company', array('name' => $this->company->getName('name')));
        T::systemMail($email, $message->getName(), $message->getContent());

        $this->getUser()->setFlash('notice', 'Chęć usunięcia firmy z katalogu została zgłoszona do administratora');
        $this->redirect('@panel_profile');
        
    }


    protected function processForm(sfWebRequest $request, sfForm $form) {
        $pic = $request->getFiles($form->getName());
        if (!$form->getObject()->isNew() && ($pic['file']['size'] > 0)) {
            $picture = $request->getParameter('pictures');
            $form->getObject()->removePictures();
        }

        if (!$form->getObject()->isNew() && ($pic['file']['size'] <= 0)) {
            $form->getObject()->setGenerateThumbnails(false);
        }

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
            $pictures = $form->save();

            //XXX Miniaturki
            if ($pictures) {
                $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $pictures)));

                if ($request->hasParameter('_save_and_add')) {
                    $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');
                    $this->redirect('@panel_gallery');
                } else {
                    $this->getUser()->setFlash('notice', $notice);
                    $this->redirect('@panel_gallery');
                }
            } else {
                $this->getUser()->setFlash('error', 'Nie można dodać obrazka');
                $this->redirect('@panel_gallery');
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
        
    }
    
    public function executeDeletePicture(sfWebRequest $request) {
        $this->company = $this->getUser()->getComapny();
        $picture = $this->getRoute()->getObject();
        
        if($picture->getGalleries()->getPrimaryKey() == $this->company->getGalleries()->getPrimaryKey())
        {
            $picture->delete();
            $this->getUser()->setFlash('notice', 'Obrazek został usunięty');
        }
        else
        {
            $this->getUser()->setFlash('error', 'Nie można usunąć obrazka');                
        }
        
        $this->redirect('@panel_gallery');
    }
    
    public function executePrices(sfWebRequest $request)
    {
        $this->company = $this->getUser()->getComapny();
        $this->forward404Unless($this->company);
        
        $this->packet = PricesTable::getInstance()->getDefaultPackets();
    }

}
