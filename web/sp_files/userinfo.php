<style type="text/css">

#info_results {
	width: 740px;
	border: 0px #000 solid;
	position: absolute;
	top: 10px;
	font-size: 12px;
	font-family: tahoma;
	text-align: center;
	font-style:italic;
	color: #3c3c3c;
}

#info_results img {
	padding: 0px 5px 0px 0px;
	display: inline;
}

a { text-decoration: none; color: #1b6698; }
a:hover { color: #a5a5a5; }

</style>

<?php

ob_start();

$sp_link = "<b>Dostępna jest nowa wersja!</b> <a href='http://akt.sliderpakiet.pl/' target='_blank'>Pobierz ją</a>.";
$sp_brak = "Skrypt <b>SliderPakiet</b> jest aktualny.";

require_once "config.php";

$mail = $_GET['email'];
$ver = $_GET['ver'];
$url = $_GET['url'];
$data = date("Y-m-d");
		
$wer = base64_decode($ver);

$result = preg_split('/([0-9]+)|([a-z]+)/si', $wer, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

$nazwa = $result[0];
$wer = $result[1];
		
sleep(1);

echo '<div id="info_results">';
		
$wynik = dbquery("SELECT * FROM ".$db_prefix."klienci WHERE email='$mail'");

	if(mysql_num_rows($wynik) > 0) {
	
	$wynika = dbquery("SELECT * FROM ".$db_prefix."wersja WHERE nazwa='$nazwa' AND numer='$wer'");
	
		if(mysql_num_rows($wynika) > 0) {
	
			echo $sp_brak;
		
		} else {
	
			echo $sp_link;
	
		}
		
		$wynikb = dbquery("SELECT * FROM ".$db_prefix."logi WHERE url='$url'");

		if(mysql_num_rows($wynikb) > 0) {
		
				
		} else {
		
			if($url == "localhost") {
			
			} else {
			
				$wynikd = dbquery("INSERT INTO ".$db_prefix."logi ( klient, url, wersja, data ) VALUES ( '$mail', '$url', '$nazwa', '$data' ) ");
			
			}
			
		}
		
	} else {
		
		echo "Niestety nie ma w bazie podanego adresu <b>$mail</b>.";
			
	}
		
echo "</div>";
		
ob_end_flush();

?>