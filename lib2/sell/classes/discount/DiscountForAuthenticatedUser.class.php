<?php
class DiscountForAuthenticatedUser implements DiscountInterface
{
    public function getName()
    {
        return get_class($this);
    }

    public function getTranslatedName()
    {
      return 'Dla zalogowanego użytkownika';
    }

    // true - jeśli rabat jest zależny jedynie od użytkownika, a nie od produktu czy innych czynników
    public function isConstantUserDiscount()
    {
      return true;
    }

    public function getDiscount($guardUser = null)
    {
      // jeśli bierzemy rabat dla konkretnego usera
      // LUB jesli bierzemy rabat dla zalogowanego usera
      if ($guardUser || sfContext::getInstance()->getUser()->isAuthenticated()){
        //zwracam z super configa ustawiony rabat dla zalogowanych userow
        return stgConfig::get('discount_for_authenticated_user');
      }
      else
      {
          return 0;
      }
    }
}

?>
