<?php

/**
 * Galleries filter form.
 *
 * @package    stgcms2
 * @subpackage filter
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GalleriesFormFilter extends BaseGalleriesFormFilter
{
  public function configure()
  {

      $this->widgetSchema['name']     = new sfWidgetFormFilterInput(array('with_empty' => false));
      $this->validatorSchema['name']  = new sfValidatorPass(array('required' => false));

  }

  public function addNameColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (is_array($values) && isset($values['text']) && '' != $values['text'])
    {
      $query->andWhere('t.name like ?', '%' . $values['text'] . '%');
    }
  }

  public function getFields()
  {
      return parent::getFields() + array('name' => 'Text');
  }
}
