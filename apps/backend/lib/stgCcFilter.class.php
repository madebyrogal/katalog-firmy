<?php
class stgCcFilter extends sfFilter
{
  public function execute($filterChain)
  {
    $filterChain->execute($filterChain);



    // czyszczenie cache po kazdej akcji w backend, ktora konczy sie wyswietleniem komunikatu "notice"
    // lub gdy w urlu jest parametr "cc"
    $context = sfContext::getInstance();
    $params = $context->getRequest()->extractParameters(array('cc'));
    $user = $context->getUser();
    if ($user->hasFlash('notice') || isset($params['cc'])) {
      T::cc('frontend');
    }

  }
}
?>
