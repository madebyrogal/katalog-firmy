<?php
class DiscountOnTurnover implements DiscountInterface
{
  public function getName()
  {
    return get_class($this);
  }

  public function getTranslatedName()
  {
    return 'Od obrotu';
  }

  // true - jeśli rabat jest zależny jedynie od użytkownika, a nie od produktu czy innych czynników
  public function isConstantUserDiscount()
  {
    return true;
  }

  public function getDiscount($guardUser = null)
  {
    if (!$guardUser){
      $myUser = sfContext::getInstance()->getUser();
      $allow = $myUser->isAuthenticated();
      $guardUser = $myUser->getGuardUser();
      $users_turnover = $myUser->getTurnover();
    }
    else {
      $allow = true;
      $users_turnover = $guardUser->getTurnover();
    }
    
    //czy zalogowany
    if($allow)
    {
      $return = 0;

      if($users_turnover !== false) //gdy mam juz jakis obrot
      {
        //pobieram wszystkie progi rabatowe
        $discounts_on_turnover = DiscountOnTurnoverValuesTable::getInstance()->findAll();
        foreach($discounts_on_turnover as $discount_on_turnover)
        {
          //sprawdzam czy mieszcze sie w progu rabatowym
          if($users_turnover['brutto'] >= (int)$discount_on_turnover->getMinTurnover())
          {
            //ustalam rabat z progu
            $return = (int)$discount_on_turnover->getDiscount();
          }
        }
      }
      return $return;
    }
    else
    {
      return 0;
    }
  }

}

?>
