<?php

interface PayableInterface
{
    /*
     * przekazuje do płatności informacje o uzyktowniku (dane do przelewó)
     */
    public function setUserParamFrom($order);
    public function getlinkToPayable();

    /*
     * Zwraca tablice z wynikiem werytikacji tranzakcji w formie:
     * $tab['result'] = 0 albo 1: 0 - bląd; 1 - wszystko OK
     * $tab['notice'] = komunikat tekstowy
     */
    public function verifyTransaction();
    
}

