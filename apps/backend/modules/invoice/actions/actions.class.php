<?php

require_once dirname(__FILE__).'/../lib/invoiceGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/invoiceGeneratorHelper.class.php';

/**
 * invoice actions.
 *
 * @package    sell4
 * @subpackage invoice
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class invoiceActions extends autoInvoiceActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->redirect('@invoice');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->redirect('@invoice');
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->redirect('@invoice');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->redirect('@invoice');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->redirect('@invoice');
  }

  public function executeListShow(sfWebRequest $request)
  {            
      $invoice = $this->getRoute()->getObject();
      $pdf = new InvoicePDF($invoice, false);
      $pdf->sendToBrowser();
  }
}
