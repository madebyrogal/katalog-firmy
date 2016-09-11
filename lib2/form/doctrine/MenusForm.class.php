<?php

/**
 * Menus form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MenusForm extends BaseMenusForm
{

    public $rootId = null;
    public $Model = 'Menus';
    private $targets = array
            (
            '_self' => 'tym samym oknie',
            '_new' => 'nowym oknie'
    );

    public function  __construct($object = null, $options = array(), $CSRFSecret = null)
    {

        parent::__construct($object, $options, $CSRFSecret);
//        if(!$this->isNew())
//        {
//            $this->setDefault('model', $this->getDefaultModelOption());
//        }
    }

    public function toList($objects)
    {
        $return = array();
        foreach ($objects as $object)
        {
            $return[$object->getPrimaryKey()] = $object;
        }
        return $return;
    }

    public function cssClassesToList($items)
    {
        $return = array();
        foreach ($items as $key => $item)
        {
            $return[$key] = $item['label'];
        }
        return $return;
    }

    public function configure()
    {

        $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

        unset(
                $this['root_id'],
                $this['lft'],
                $this['rgt'],
                $this['level'],
                $this['model'],
                $this['route'],
                $this['object']
        );

        $this->widgetSchema['cssclass'] = new sfWidgetFormInputHidden();

        $menus_options = array();
        $menus_options[''] = 'Wybierz';

        $routing = $this->getRoutingOptions();
        foreach($routing as $key => $route)
        {
            $menus_options[$key] = $route['label'];
        }

        $this->widgetSchema['model'] = new sfWidgetFormChoice(array(
                        'choices' => $menus_options,
                        'expanded' => false
        ));
        $this->validatorSchema['model'] = new sfValidatorString(array('required' => true, 'min_length' => 4, 'max_length' => 250));

//        $this->setDefault('model', ''); // domyślną wybrana wartosc w menu - "wybierz"
        $tmp = explode(':', $this->getObject()->getModel());
        $this->getObject()->set('model', end($tmp));

        $this->widgetSchema['ArtCategories'] = new sfWidgetFormChoice(array(
                        'label' => 'Kategoria tekstów',
//                        'choices' => $this->toList(Doctrine::getTable('ArtCategories')->findAll()),
                        'choices' => Doctrine::getTable('ArtCategories')->getIndentedChoices('ARTICLES_TREE', true),
                        'expanded' => false
        ));
        $this->validatorSchema['ArtCategories'] = new sfValidatorInteger(array('required' => false));
        $this->setDefault('ArtCategories', $this->getObject()->getObject());

        $this->widgetSchema['Articles'] = new sfWidgetFormChoice(array(
                        'label' => 'Tekst',
//                        'choices' => $this->toList(Doctrine::getTable('Articles')->findAll()),
                        'choices' => $this->toList(Doctrine::getTable('Articles')->findAllByTreeKey('ARTICLES_TREE')),
                        'expanded' => false
        ));
        $this->validatorSchema['Articles'] = new sfValidatorInteger(array('required' => false));
        $this->setDefault('Articles', $this->getObject()->getObject());

        $this->widgetSchema['Galleries'] = new sfWidgetFormChoice(array(
                        'label' => 'Galeria',
                        'choices' => $this->toList(Doctrine::getTable('Galleries')->getOnpageGalleries()),
                        'expanded' => false
        ));
        $this->validatorSchema['Galleries'] = new sfValidatorInteger(array('required' => false));
        $this->setDefault('Galleries', $this->getObject()->getObject());
//
        $this->widgetSchema['url'] = new sfWidgetFormInputText();

        $this->widgetSchema['target'] = new sfWidgetFormChoice(array(
                        'choices' => $this->getTargets(),
                        'expanded' => false
        ));

        $this->widgetSchema['is_active'] = new sfWidgetFormInputCheckbox(array('label' => 'Czy aktywna?'));


        //Tajemniczy STUFF, który Pawel robi, zeby miec drzewko kategorii :)
        $this->widgetSchema['parent_id'] = new sfWidgetFormDoctrineChoice(array(
                        'model' => $this->Model,
                        'table_method' => 'fetchByCultureNotDeleted',
                        'order_by' => array('root_id, lft', ''),
                        'method' => 'getIndentedName'
        ));
        $this->validatorSchema['parent_id'] = new sfValidatorDoctrineChoice(array(
                        'required' => false,
                        'model' => $this->Model
        ));
        $this->setDefault('parent_id',$this->object->getRootId());
        $this->widgetSchema->setLabel('parent_id', 'Child of');

    }

    public function updateParentIdColumn($parentId)
    {
        $this->rootId = $parentId;
    }

    public function getRoutingOptions($routes = true)
    {
        $options = sfConfig::get('mod_menus_routing_map_options');
        $return = array();
        foreach ($options as $key => $option)
        {
            foreach ($option as $k => $o)
            {
              if (!isset($o['credential']) || sfContext::getInstance()->getUser()->hasCredential($o['credential'])) {
                $arr = array();
                $arr['route'] = $o['route'];
                $arr['model'] = $o['model'];
                $arr['label'] = $o['label'];
                if (isset($o['real_model'])) {
                  $arr['real_model'] = $o['real_model'];
                }
                $return[$k] = $arr;
//                $return[$k] = array('route' => $o['route'],'model' => $o['model'], 'label' => $o['label']);
              }
            }
        }
        return $return;
    }

    protected function doSave($con = null)
    {
        $routingMap = $this->getRoutingOptions();
        $values = $this->getValues();

        $_model = $routingMap[$values['model']]['model'];
        $_route = $routingMap[$values['model']]['route'];
        $_object = isset($values[$_model]) ? $values[$_model] : 0;

        $this->getObject()->setRoute($_route);
        $this->getObject()->setObject($_object);

        //$this->getObject()->setObject((isset($values[$values['model']])) ? $values[$values['model']] : 0);  //Jesli jest pole nazwane tak jak wybrany model, to zapisz jego wartosc, w przeciwnym wypadku wpisz 0
        //$this->getObject()->setRoute((isset($values[$values['model']])) ? $routingMap[$values['model']] : 'false'); //to samo co wyzej, ale dla routingu

        parent::doSave($con);
if (isset($routingMap[$values['model']]['real_model'])) {
  $_model = $routingMap[$values['model']]['real_model'] . ':' . $_model;
}

        $this->getObject()->setModel($_model);
        $this->object->save($con);

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

    public function getTargets()
    {
        return $this->targets;
    }

    public function getDefaultModelOption()
    {
        $maps = $this->getRoutingOptions();
        foreach($maps as $key => $map)
        {
            //echo $map['model'].' - '.$map['route']. '('.$this->object->getModel().' - '.$this->object->getRoute().') - '.$key ;
            //echo '<br />';
            if($this->object->getModel() == $map['model'] && $this->object->getRoute() == $map['route'])
            {
                return $key;
            }
        }
        return false;
    }

}
