<?php

/**
 * Message form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MessageForm extends BaseMessageForm
{
  public function configure()
  {
      $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

      unset($this['message']);
      unset($this['description']);
      unset($this['created_at']);
      unset($this['updated_at']);      
  }
}
