<?php

class CheckListHomepage extends CheckListTask
{

    public function __construct($task = false)
    {
        $this->class_name = "CheckListHomepage";
        if($task)
        {
            $this->object = $task;
        }
    }

    public function valid()
    {
        $homepage = HomepageTable::getInstance()->getFirst();

        if($homepage->getRoute() == 'articles_show' && $homepage->getModel() == 'Articles' && $homepage->getObject() == '2')
        {
            return false;
        }

        $this->setDone();
        return true;

    }

}