<?php

class CheckListTask implements CheckListInterface
{
    public $object = false;

    public $class_name = "";

    public function getObject()
    {
        if($this->object == false)
        {
            $this->object = CheckListTable::getInstance()->findOneByClassName($this->class_name);
        }

        return $this->object;
    }

    public function getName()
    {
        return $this->getObject()->getName();
    }

    public function getUrl()
    {
        return '';
    }

    public function getDescription()
    {
        return $this->getObject()->getDescription();
    }

    public function getIsDone()
    {
        if($this->getObject()->getIsDone())
        {
            return true;
        }
        else
        {
            return $this->valid();
        }

    }

    public function setDone()
    {
        $this->getObject()->setIsDone(true)->save();
    }

    public function valid() {}

}