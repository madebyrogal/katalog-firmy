<?php

class CheckListLogos extends CheckListTask
{

    public function __construct($task = false)
    {
        $this->class_name = "CheckListLogos";
        if($task)
        {
            $this->object = $task;
        }
    }

    public function valid()
    {
        $count = UserLogosTable::getInstance()->count();
        if($count == 0)
        {
            return false;
        }

        $this->setDone();
        return true;

    }

}