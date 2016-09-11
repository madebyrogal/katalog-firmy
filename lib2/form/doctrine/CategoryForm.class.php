<?php

/**
 * Category form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryForm extends BaseCategoryForm {

    public function configure() {
        unset(
            $this['lft'], 
            $this['rgt'], 
            $this['level'], 
            $this['meta_id'], 
            $this['slug'], 
            $this['created_at'], 
            $this['updated_at'], 
            $this['root_id'], 
            $this['company_list']
        );

        $this->widgetSchema['parent_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Category',
                    'order_by' => array('root_id, lft', ''),
                    'method' => 'getIndentedName'
                ));
        $this->validatorSchema['parent_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => false,
                    'model' => 'Category'
                ));
        $this->setDefault('parent_id', $this->object->getParentId());
        $this->widgetSchema->setLabel('parent_id', 'Kategoria nadrzędna');
        
        $metas = new MetasForm($this->getObject()->getMetas());    
        $this->embedForm('Metas', $metas);   
    }
    
  public function updateParentIdColumn($parentId)
  {
    $this->rootId = $parentId;
  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $node = $this->object->getNode();

    if ($this->rootId != $this->object->getRootId() || !$node->isValidNode())
    {
      if (empty($this->rootId))
      {
        //save as a root
        if ($node->isValidNode())
        {
          $node->makeRoot($this->object['id']);
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
