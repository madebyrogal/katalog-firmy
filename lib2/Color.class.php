<?php
class Color
{
  public static function success($string) {
    $string = self::bold($string);
    $string = self::green($string);
    return $string;
  }

  public static function error($string) {
    $string = self::bold($string);
    $string = self::red($string);
    return $string;
  }

  public static function green($string) {
    $string = "\033[32m".$string."\033[0m";
    return $string;
  }

  public static function red($string) {
    $string = "\033[31m".$string."\033[0m";
    return $string;
  }

  public static function bold($string) {
    $string = "\033[1m".$string."\033[0m";
    return $string;
  }

  public static function bool($bool, $string = null) {
    $string = $string ? $string : ($bool ? '[OK]' : '[BŁĄD]');
    $return = $bool ? self::success($string) : self:: error($string);
    return $return . PHP_EOL; // nowa linia
  }

}

