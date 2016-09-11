<?php

class myActions extends sfActions
{
  
 /**
  * Wykonywane dla wszystkich akcji
  */
  public function  preExecute() {

//    $this->generateTitle();

  }

 /**
  * Domyślna akcja executeShow
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->object = $this->getRoute()->getObject();
    $this->forward404Unless($this->object->isActive());

//    $this->addToTitle($this->object);
  }


  public function generatePager($model, $results_per_page, $query)
  {
    $pager = new sfDoctrinePager($model, $results_per_page);
    $pager->setQuery($query);
    $pager->setPage($this->request->getParameter('page', 1));
    $pager->init();

    return $pager;
  }

  public function addToTitle($string, $separator = ' :: '){
      $title = $this->getResponse()->getTitle();
      
//      $title .= ($title == '') ? '' : $separator;
//      $title .= $string;
      $title = $string . (($title == '') ? '' : $separator) . $title;
      
      $this->getResponse()->setTitle($title);
  }

//  public function generateTitle() {
//    $this->addToTitle(stgConfig::get('page_title'));
//
//    try {
//      $try_object_title = true;
//      // pobieram routing
//      $route = sfContext::getInstance()->getRequest()->getAttribute('sf_route');
//      // jeśli routing ma obiekt
//      if ($route instanceof sfObjectRoute) {
//        $object = $route->getObject();
//        // jeśli obiekt istnieje
//        if ($object) {
//          // jeśli obiekt ma relację z metatagami
//          if ($object->hasRelation('Metas')) {
//            $meta = $object->get('Metas');
//            // jeśli obiekt ma metatagi
//            if ($meta) {
//              $title = $meta->getTitle();
//
//              // podepnij tytuł z metatagów
//              if ($title && $title != '') {
//                $this->addToTitle($title);
//                $try_object_title = false;
//              }
//            }
//          }
//          if ($try_object_title) {
//            // podepnij tytuł jako __toString z obiektu
//            $this->addToTitle($object->__toString());
//          }
//        }
//      }
//    } catch (Exception $exc) {
//      // NIC
//    }
//  }

}
