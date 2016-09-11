<?php

/**
 * ArtCategories form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArtCategoriesForm extends BaseArtCategoriesForm
{

  protected $rootId = null;

  public function configure()
  {

    $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

    unset(
        $this['is_deletable'],
        $this['is_editable'],
        $this['tree_key'],
        $this['record_key'],
        $this['root_id'],
        $this['lft'],
        $this['rgt'],
        $this['level'],
        $this['gallery_id'],
        $this['meta_id']
    );
    
    $this->embedI18n(Lang::getInstance()->getNotDeleted()->toArray());

    $this->widgetSchema['name'] = new sfWidgetFormInputText(array('label' => 'Nazwa kategorii'));

    $metas = new MetasForm($this->getObject()->getMetas());    
    $this->embedForm('Metas', $metas);    

  }

  public function createWidgetParentId($tree_key = null)
  {
    $art_categories = Doctrine_Core::getTable('ArtCategories')->getIndentedChoices($tree_key);

    $this->widgetSchema['parent_id']  = new sfWidgetFormChoice(array(
      'choices' => $art_categories ,//ArtCategoriesTable::getInstance()->getIndentedChoices()
    ));
    $this->validatorSchema['parent_id'] = new sfValidatorChoice(array(
      'choices' => array_keys($art_categories),
    ));
    $this->setDefault('parent_id', $this->object->getRootId());
  }

  public function updateParentIdColumn($parentId)
  {
    $this->rootId = $parentId;
    // further action is handled in the save() method
  }

  protected function doSave($con = null)
  {
    $values = $this->getValues();
    $isset_parent_id = isset($values['parent_id']);

    parent::doSave($con);
    $metas = $this->embeddedForms['Metas']->getObject();
    $metas->generateMetas($this->object);

    $node = $this->object->getNode();

    if ($isset_parent_id) {
      if ($this->rootId != $this->object->getRootId() || !$node->isValidNode())
      {
        if (empty($this->rootId))
        {
          //save as a root
          if ($node->isValidNode())
          {
            $node->makeRoot($this->object['artcategory_id']);
            $this->object->save($con);
          }
          else
          {
            $this->object->getTable()->getTree()->createRoot($this->object); //calls $this->object->save internally
          }
        }
        else
        {
          //form validation ensures an existing ID for $this->parentId
          $parent = $this->object->getTable()->find($this->rootId);
          $method = ($node->isValidNode() ? 'move' : 'insert') . 'AsFirstChildOf';
          $node->$method($parent); //calls $this->object->save internally
        }
      }
    }
  }

}
