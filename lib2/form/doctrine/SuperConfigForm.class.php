<?php

/**
 * SuperConfig form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SuperConfigForm extends BaseSuperConfigForm
{

  public function configure()
  {
    $this->widgetSchema['scope'] = new sfWidgetFormChoice
                    (
                    array
                        (
                        'choices' => SuperConfig::getScopeChoices()
                    )
    );

    unset(
      $this['is_enabled_for_users']
      );
  }

}
