<?php
class SettingsForm extends sfForm
{
    public $fields;
    public $object;
    public $scope = false;
    public $is_defaults = array();

    public function  __construct(SettingsInterface $fields, $object)
    {
        $this->fields = $fields->getValues();
        $this->scope = $fields->getScope().$object->getPrimaryKey();
        $this->object = $object;

        parent::__construct();
    }

    public function configure()
    {
        $this->disableCSRFProtection();
        $this->widgetSchema->setNameFormat('settings[%s]');

        foreach($this->fields as $field)
        {
            $this->widgetSchema[$this->generateKeyName($field['key'])] = $this->getTypeOfWidget($field['type']);
            $this->widgetSchema[$this->generateKeyName($field['key'])]->setLabel($field['label']);
            
            $currentValue = SuperConfig::getSettingValue($this->generateKeyName($field['key']));
            
            if(isset($currentValue))
            {
                $this->widgetSchema[$this->generateKeyName($field['key'])]->setDefault($this->getFormatedValue($currentValue));
                $this->is_defaults[$this->generateKeyName($field['key'])] = true;
            }
            else
            {
                $this->is_defaults[$this->generateKeyName($field['key'])] = false;
            }

        }

    }

    private function getTypeOfWidget($type)
    {
        $widget = false;
        switch($type)
        {
            case 'string' : 
                $widget = 'sfWidgetFormInput';
                break;
            case 'bool' : 
                $widget = 'sfWidgetFormInputCheckbox';
                break;
            default :
                $widget = 'sfWidgetFormInput';
        }
        return new $widget;
    }

    private function generateKeyName($key)
    {
        return $key.'_'.$this->object->getPrimaryKey();
    }

    public function getDefaults()
    {
        return $this->is_defaults;
    }

    private function getFormatedValue($value)
    {
        switch($value)
        {
            case 'on':
                $return = true;
                break;
            case 'true':
                $return = true;
                break;
            case 'false':
                $return = false;
                break;
            case 'off':
                $return = false;
                break;
            default:
                $return = $value;
                break;
        }
        return $return;
    }


    public function save($values)
    {
        foreach($this->is_defaults as $key => $is_default)
        {            
            if(isset($values[$key]))
            {
                if(!empty($values[$key]))
                {
                    stgConfig::add(array($key => $values[$key]), $this->scope);
                }
            }
            elseif($is_default)
            {
                stgConfig::add(array($key => 'off'), $this->scope);
            }
        }
    }

}