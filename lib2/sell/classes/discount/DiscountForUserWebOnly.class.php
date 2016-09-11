<?php
class DiscountForUserWebOnly implements DiscountInterface
{
    public function getName()
    {
        return get_class($this);
    }

    public function getTranslatedName()
    {
      return 'Z Shopera';
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
        if (!$myUser->isAuthenticated()) {
          return 0;
        }
        $guardUser = $myUser->getGuardUser();
      }

      //zwracam wartosc rabatu
      $discount_web_only = (float) $guardUser->Profile->getDiscountWebOnly();
      return $discount_web_only ? $discount_web_only : 0;
    }
}

?>
