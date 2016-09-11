<?php
class DiscountForFirstOrder implements DiscountInterface
{
    public function getName()
    {
        return get_class($this);
    }

    public function getTranslatedName()
    {
      return 'Za pierwsze zamówienie';
    }

    // true - jeśli rabat jest zależny jedynie od użytkownika, a nie od produktu czy innych czynników
    public function isConstantUserDiscount()
    {
      return false;
    }

    public function getDiscount($guardUser = null)
    {
        //jesli jestem zalogowny
        if(sfContext::getInstance()->getUser()->isAuthenticated())
        {
            //sprawdzam czy mam juz jakies zamowienia
            $orders_count = sfContext::getInstance()->getUser()->getOrders()->count();
            //zwracam z super configa ustawiony rabat na pierwsze zamowienie
            return ($orders_count >= 1) ? 0 : stgConfig::get('discount_for_first_order');;
        }
        else
        {
            return 0;
        }
    }
}

?>
