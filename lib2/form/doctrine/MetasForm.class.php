<?php

/**
 * Metas form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MetasForm extends BaseMetasForm
{

  public function configure()
  {
    unset(
          $this['is_default']
          );

//    $langs = Lang::getInstance()->getAll()->toArray();
    $langs = Lang::getInstance()->getNotDeleted()->toArray();
    $this->widgetSchema->setLabel(false);
    $this->embedI18n($langs);

    foreach($langs as $lang)
    {
        $this->widgetSchema[$lang]->setLabel(false);
    }

  }

}
