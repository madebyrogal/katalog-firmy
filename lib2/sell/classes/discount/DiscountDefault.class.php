<?php
class DiscountDefault implements DiscountInterface
{

    public function getName()
    {
        return get_class($this);
    }

    public function getTranslatedName()
    {
      return 'Domyślny';
    }

    // true - jeśli rabat jest zależny jedynie od użytkownika, a nie od produktu czy innych czynników
    public function isConstantUserDiscount()
    {
      return false;
    }

    //zawsze bedzie tutaj 0 - to jest taki hak bo mechanizm do obliczania cen produktu zawsze przyjmuje w parametrze obiekt rabatu - wiec musi byc rabat na 0% zeby wszystko dzialalo
    public function getDiscount($guardUser = null)
    {
        return 0;
    }
}

?>
