<?php

class CheckListMenus extends CheckListTask
{

    public function __construct($task = false)
    {
        $this->class_name = "CheckListMenus";
        if($task)
        {
            $this->object = $task;
        }
    }

    public function valid()
    {
        $m2 = MenusTable::getInstance()->find(2);
        $m3 = MenusTable::getInstance()->find(3);
        $m4 = MenusTable::getInstance()->find(4);


        if(!empty($m2) && !empty($m3) && !empty($m4))
        {
            if($m4->getName() == 'Strona główna' && $m3->getName() == 'Zastosowanie' && $m2->getName() == 'Kontakt')
            {
                return false;
            }
        }
        
        $this->setDone();
        return true;

    }

}