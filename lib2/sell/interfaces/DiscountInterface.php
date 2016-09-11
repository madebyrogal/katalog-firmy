<?php
interface DiscountInterface
{
    public function getName();

    public function getTranslatedName();

    public function getDiscount($guardUser = null);

//    public static function isConstantUserDiscount();
    public function isConstantUserDiscount();
}

?>
