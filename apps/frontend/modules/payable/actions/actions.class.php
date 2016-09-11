<?php

/**
 * payable actions.
 *
 * @package    sell4
 * @subpackage payable
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class payableActions extends sfActions
{

  public function executePayable(sfWebRequest $request)
  {
      $params = $request->getPostParameters();
      
      if($params['tr_status'])
      {
          $order = OrderTable::getInstance()->findOneByUid($params['tr_crc']);
          $order->setIsPaid(true);
          $order->save();
          
          echo 'TRUE';
          exit;
      }
      else
      {
          echo 'ERROR';
          exit;
      }
  }
  
  public function executePayableTrue(sfWebRequest $request)
  {
    $this->text = Message::getMessageByKey('payable_success');
  }
  
  public function executePayableFalse(sfWebRequest $request)
  {
    $this->text = Message::getMessageByKey('payable_error');
  }
}
