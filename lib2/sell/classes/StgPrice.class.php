<?php
require_once(dirname(__FILE__).'/../../vendor/symfony/lib/helper/NumberHelper.php');
/**
 * StgPrice class that defines behaviours of Prices used in shop
 *
 * @package StgPrice
 */
class StgPrice
{
  private $discountable_object = null;
  private $value = 0;
  private $is_promoted = false;
  private $rates_by_currency = array
  (
    'PLN' => 1,
    'GBP'  =>  4.5861,
    'EUR'  =>  3.9998
  );
  private $rates_by_country = array
  (
    'pl' => 1,
    'en'  =>  4.5861,
    'de'  =>  3.9998,
    'sk'  =>  3.9998,
    'fr'  =>  3.9998
  );
  private $culture = null;

  /**
   * StgPrice constructor
   *
   * @param <type> $value - price value
   * @param DiscountInterface $discountable_object Object implementing DiscountInterface
   * @param <type> $is_promoted Defines if price is promoted - if it is, there's no discount applied
   */
  public function StgPrice($value, DiscountInterface $discountable_object = null, $culture = null, $is_promoted = false)
  {
    $this->discountable_object = $discountable_object;  //XXX
    $this->culture = $culture;
    $this->is_promoted = $is_promoted;
    if(is_integer($value))
    {
      $this->value = $value;
    }
    if(is_string($value))
    {
      $value_as_string = explode('.',(string)$value);
      if(isset($value_as_string[1]))
      {
        $value = (double)$value;
      }
      else
      {
        $value = (int)$value;
        $this->value = (int)$value;
      }
    }
    if(is_double($value))
    {
      $value = round($value,2);
      $value_as_string = explode('.',(string)$value);
      if(isset($value_as_string[1]))
      {
        if(strlen($value_as_string[1]) ==1) //is_double casts type (double), so 12.20 => 12.2 - i MUST concat one zero (0) to 12.2, so the value is correct 1220 (and NOT 122!!!)
        {
          $value_as_string[1] = $value_as_string[1].'0';
        }
        $zeros = (int)'1'.str_repeat('0', strlen($value_as_string[1]));  //we need to get rid of double without loosing value (12.20X * 100 = 1220 base units, where 1X == 100 base units)
        $value = $value*$zeros;
        $this->value = (int)$value;
      }
      else
      {
        $value = (int)$value;
        $this->value = (int)$value;
      }      
    }
  }

  public function setIsPromoted($is_promoted)
  {
    $this->is_promoted = $is_promoted;
  }

  public function getIsPromoted()
  {
    return $this->is_promoted;
  }
  
  public function getCulture()
  {
    if($this->culture === null)
    {
      return 'pl';
    }
    else
    {
      return $this->culture;
    }
  }

  /**
   * Gets string representatnion of the class
   * 
   * @return String
   */
  public function __toString()
  {
    return (string)$this->asIs();
  }

  /**
   * Returns value multiplied by rate as StgPrice object
   *
   * @param <type> $rate rate
   * @return StgPrice 
   */
  public function getRated($rate = 1)
  {
      return new StgPrice(round($rate*$this->asIs()));
  }

  /**
   * Returns value as StgPrice rounded to provided round
   *
   * @param <type> $round round
   * @return StgPrice
   */
  public function getRounded($round = 0)
  {
    $value = new StgPrice($this->asIs());
    $v1_len = strlen($value->asIs());
    $value_real = explode('.',$value->asReal());
    $value2 = round($value->asReal(),$round);
    if($round <= strlen($value_real[1]))
    {
      $zeros = (int)'1'.str_repeat('0', $round);
      $value2 = $value2*$zeros;
      $v2_len = strlen($value2);
      $zeros = $v1_len - $v2_len;
    }
    if($zeros >= 0)
    {
      $zeros = (int)'1'.str_repeat('0', $zeros);
      $value2 = $value2*$zeros;
    }
    unset($vlaue);
    return new StgPrice($value2);
  }

  /**
   * Returns value formated as real (double).
   * For example 100 is 1.00, 1234 is 12.34 and so on..
   *
   * @return String Value as real
   */
  public function asReal($formated = true)
  {
      if($formated)
        return format_currency((string) self::asRealWithoutSymbol($this->asIs()), Currency::getSymbolForLanguage($this->getCulture()));
      else
        return (string) self::asRealWithoutSymbol($this->asIs());
  }

  public static function asRealWithoutSymbol($valueAsIs)
  {
      $value = ((double)$valueAsIs/100);
      $stats = explode('.',$value);
      if(isset($stats[1]))
      {
          $return = (strlen($stats[1])==1) ? $stats[0].'.'.$stats[1].'0' : $stats[0].'.'.$stats[1];
      }
      else
      {
          $return = $stats[0].'.00';
      }

      return $return;
//      return (string)$return;
  }

  /**
   * Returns value as is (without modification).
   * If object is_promoted or discount = 0, value is returned as is.
   * Else value is returned discounted
   *
   * @return Integer
   */
  public function asIs()
  {
    if(($this->getDiscount() == 0) || ($this->getIsPromoted() == true))
    {
      return $this->value;
    }
    else
    {
      $discount = ($this->value*$this->getDiscount())/100;
      return round(($this->value - $discount));
    }
  }

  /**
   * Returns amount of discount (values 0..100)
   *
   * @return Integer Discount amount
   */
  public function getDiscount()
  {
    if($this->discountable_object != null)
    {
      return $this->discountable_object->getDiscount();
    }
    else
    {
      return 0;
    }
  }

  /**
   * Calculates value to currency.
   * Rate is calculated from currency symbol.
   * 
   * For example: value is 1000 USD, currency is Unit and rate for Unit is 5 (5USD = 1Units), returned value is  1000/5 = 200Units
   *
   * @param String $currency Currency symbol
   * @return StgPrice
   */
  public function getInCurrency($currency)
  {
    $price = $this->asIs()/$this->getRateForCurrency($currency);
    return new StgPrice(round($price));
  }

  /**
   * Calculates value from currency.
   * Rate is calculated from currency symbol.
   *
   * For example: value is 10USD, currency is Units and rate for USD is 5 (1USD = 5Units), returned value is  10*5 = 50Units
   *
   * @param String $currency Currency symbol
   * @return StgPrice
   */
  public function getForCurrency($currency)
  {
    $price = $this->asIs()*$this->getRateForCurrency($currency);
    return new StgPrice(round($price));
  }

  /**
   * Calculates value to currency.
   * Rate is calculated from country.
   * 
   * For example: value is 1000 USD, currency is Unit and rate for Unit is 5 (5USD = 1Units), returned value is  1000/5 = 200Units
   *
   * @param <type> $country
   * @return StgPrice 
   */
  public function getInCountry($country)
  {
    $price = $this->asIs()/$this->getRateForCountry($country);
    return new StgPrice(round($price));
  }

  /**
   * Calculates value from currency.
   * Rate is calculated from country.
   *
   * For example: value is 10USD, currency is Units and rate for USD is 5 (1USD = 5Units), returned value is  10*5 = 50Units
   *
   * @param String $currency Currency symbol
   * @return StgPrice
   */
  public function getForCountry($country)
  {
    $price = $this->asIs()*$this->getRateForCountry($country);
    return new StgPrice(round($price));
  }

  /**
   * Returns currency rate for provided currency symbol
   *
   * @param <type> $currency
   * @return <type> 
   */
  public function getRateForCurrency($currency)
  {
    return $this->rates_by_currency[$currency];
  }

  /**
   * Returns currency rate for provided country.
   * 
   * @param <type> $country
   * @return <type>
   */
  public function getRateForCountry($country)
  {
    return $this->rates_by_country[$country];
  }
  

  /**
   * KWOTA SLOWNIE
   * http://forum.php.pl/lofiversion/index.php/t45776.html
   */
  public function d2w($digits)
  {
    $jednosci = Array('zero', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć');
    $dziesiatki = Array('', 'dziesięć', 'dwadzieścia', 'trzydzieści', 'czterdzieści', 'piećdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewiećdziesiąt');
    $setki = Array('', 'sto', 'dwieście', 'trzysta', 'czterysta', 'piećset', 'sześćset', 'siedemset', 'osiemset', 'dziewiećset');
    $nastki = Array('dziesieć', 'jedenaście', 'dwanaście', 'trzynaście', 'czternaście', 'piętnaście', 'szesnaście', 'siedemnaście', 'osiemnaście', 'dzięwietnaście');
    $tysiace = Array('tysiąc', 'tysiące', 'tysięcy');

    $digits = (string) $digits;
    $digits = strrev($digits);
    $i = strlen($digits);

    $string = '';

    if ($i > 5 && $digits[5] > 0)
      $string .= $setki[$digits[5]] . ' ';
    if ($i > 4 && $digits[4] > 1)
      $string .= $dziesiatki[$digits[4]] . ' ';
    elseif ($i > 3 && $digits[4] == 1)
      $string .= $nastki[$digits[3]] . ' ';
    if ($i > 3 && $digits[3] > 0 && $digits[4] != 1)
      $string .= $jednosci[$digits[3]] . ' ';

    $tmpStr = substr(strrev($digits), 0, -3);
    if (strlen($tmpStr) > 0)
    {
      $tmpInt = (int) $tmpStr;
      if ($tmpInt == 1)
        $string .= $tysiace[0] . ' ';
      elseif (( $tmpInt % 10 > 1 && $tmpInt % 10 < 5 ) && ( $tmpInt < 10 || $tmpInt > 20 ))
        $string .= $tysiace[1] . ' ';
      else
        $string .= $tysiace[2] . ' ';
    }

    if ($i > 2 && $digits[2] > 0)
      $string .= $setki[$digits[2]] . ' ';
    if ($i > 1 && $digits[1] > 1)
      $string .= $dziesiatki[$digits[1]] . ' ';
    elseif (isset($digits[1]) && ($i > 0 && $digits[1] == 1))
      $string .= $nastki[$digits[0]] . ' ';
    if ($digits[0] > 0 && $digits[1] != 1)
      $string .= $jednosci[$digits[0]] . ' ';
    if( !$string ) $string = $jednosci[0].' ';
    return $string;
  }

  public function asWords()
  {
    $kwota = (string)$this->asReal(false);
    $kwota = str_replace('.', ',', $kwota);
    $kwota = str_replace(' ', '', $kwota);
    $zl = array("złotych", "złoty", "złote");
    $gr = array("groszy", "grosz", "grosze");
    $kwotaArr = explode(',', $kwota);
    $ostZl = substr($kwotaArr[0], -1, 1);
    switch ($ostZl)
    {
      case "0":
        $zlote = $zl[0];
        break;
      case "1":
        $ost2Zl = substr($kwotaArr[0], -2, 2);
        if ($kwotaArr[0] == "1")
        {
          $zlote = $zl[1];
        }
        elseif ($ost2Zl == "01")
        {
          $zlote = $zl[0];
        }
        else
        {
          $zlote = $zl[0];
        }
        break;
      case "2":
        $ost2Zl = substr($kwotaArr[0], -2, 2);
        if ($ost2Zl == "12")
        {
          $zlote = $zl[0];
        }
        else
        {
          $zlote = $zl[2];
        }
        break;
      case "3":
        $ost2Zl = substr($kwotaArr[0], -2, 2);
        if ($ost2Zl == "13")
        {
          $zlote = $zl[0];
        }
        else
        {
          $zlote = $zl[2];
        }
        break;
      case "4":
        $ost2Zl = substr($kwotaArr[0], -2, 2);
        if ($ost2Zl == "14")
        {
          $zlote = $zl[0];
        }
        else
        {
          $zlote = $zl[2];
        }
        break;
      case "5":
        $zlote = $zl[0];
        break;
      case "6":
        $zlote = $zl[0];
        break;
      case "7":
        $zlote = $zl[0];
        break;
      case "8":
        $zlote = $zl[0];
        break;
      case "9":
        $zlote = $zl[0];
        break;
    }
    ############### PONIZEJ ||VVV|| GROSZE
    $grosze = $gr[0];
    $ostGr = substr($kwotaArr[1], -1, 1);
    switch ($ostGr)
    {
      case "0":
        $grosze = $gr[0];
        break;
      case "1":
        $ost2Gr = substr($kwotaArr[1], -2, 2);
        if ($kwotaArr[0] == "1")
        {
          $grosze = $gr[1];
        }
        elseif ($ost2Gr == "01")
        {
          $grosze = $gr[1];
        }
        else
        {
          $grosze = $gr[0];
        }
        break;
      case "2":
        $ost2Gr = substr($kwotaArr[1], -2, 2);
        if ($ost2Gr == "12")
        {
          $grosze = $gr[0];
        }
        else
        {
          $grosze = $gr[2];
        }
        break;
      case "3":
        $ost2Gr = substr($kwotaArr[1], -2, 2);
        if ($ost2Gr == "13")
        {
          $grosze = $gr[0];
        }
        else
        {
          $grosze = $gr[2];
        }
        break;
      case "4":
        $ost2Gr = substr($kwotaArr[1], -2, 2);
        if ($ost2Gr == "14")
        {
          $grosze = $gr[0];
        }
        else
        {
          $grosze = $gr[2];
        }
        break;
      case "5":
        $grosze = $gr[0];
        break;
      case "6":
        $grosze = $gr[0];
        break;
      case "7":
        $grosze = $gr[0];
        break;
      case "8":
        $grosze = $gr[0];
        break;
      case "9":
        $grosze = $gr[0];
        break;
    }
    return ( $this->d2w($kwotaArr[0]) . ' ' . $zlote . ' i ' . $this->d2w($kwotaArr[1]) . $grosze );
  }

  /**
   * END KWOTA SLOWNIE
   */
  
}

?>
