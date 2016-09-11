<?php
class DiscountForUser implements DiscountInterface
{
    public function getName()
    {
        return get_class($this);
    }

    public function getTranslatedName()
    {
      return 'Dla kontrahenta';
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
          $guardUser = $myUser->getGuardUser();
          $tariff = $myUser->getTariff();
        }
        else {
          $tariff = $guardUser->getTariff();
        }
      
        if(!$tariff)
        {
            return 0;
        }
        $discount_users = DiscountTable::getInstance()->getProfileDiscount($tariff, $guardUser);
        $value = 0;
        if(count($discount_users) > 0) //teoretycznie jesli jest promocja to zawsze powinna być tylko jedna ale w razie czego robimy foreachem
        {
            //dla kazdej promocji
            foreach($discount_users as $discount_user)
            {
                //sprawdzam czy wartosc rabatu jest wieksza od poprzedniej
                $value = ($discount_user->getDiscountValue() > $value) ? $discount_user->getDiscountValue() : $value;
            }
        }
        //zwracam wartosc rabatu
        return $value;        
    }
}

?>
