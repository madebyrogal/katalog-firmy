<?php

function get_string_between($string, $start, $end){
    $string = " ".$string;
     $ini = strpos($string,$start);
     if ($ini == 0) return "";
     $ini += strlen($start);    
     $len = strpos($string,$end,$ini) - $ini;
     return substr($string,$ini,$len);
}

$myFile = "check.php";
$lines = file($myFile);

$email = get_string_between($lines[9],"'","'");
$url = $_SERVER['SERVER_NAME'];

echo '<input id="email" name="email" value="'.$email.'" type="hidden" />';
echo '<input id="url" name="url" value="'.$url.'" type="hidden" />';

?>

<link rel="stylesheet" type="text/css" href="sp_panel.css" />
<script type="text/javascript" src="user_info.js"></script>

<span style="display: block; text-align: center;padding: 20px 0px;">

<img src="img/sp_logo.png" alt="" /><br /><br />

wersja 4.5.0</span>

<div id="info_result">


</div>

<b>Dziękujemy za korzystanie z naszych produktów!</b> Dokładamy wszelkich starań by rozwiązania wprowadzane w kolejnych wersjach wychodziły naprzeciw Państwa oczekiwaniam oraz byłby łatwe i proste w użyciu.<br /><br />Wszystkie aktualne informacje znajdą Państwo na naszej stronie <a href="http://sliderpakiet.pl/">http://sliderpakiet.pl/</a>.