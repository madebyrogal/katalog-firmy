<?php

class CheckListMetas extends CheckListTask 
{
    
    public function  __construct($task = false)
    {        
        $this->class_name = "CheckListMetas";
        if($task)
        {
            $this->object = $task;
        }
    }

    public function valid()
    {
//        $metas = MetasTable::getInstance()->find(1);
        $metas = MetasTable::getInstance()->getFirst();
        if ($metas) {
          $title = $metas->getTitle();
          if($title == 'Domyślny tytuł' || !isset($title))
          {
              return false;
          }
          else
          {
              $this->setDone();
              return true;
          }
        }
    }
    
}