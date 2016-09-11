<?php

ob_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sliderpakiet.pl - Aktualizacje</title>
<meta name="robots" content="noindex,nofollow" />
<style type="text/css">

a { text-decoration: none; color: #1b6698; }
a:hover { color: #a5a5a5; }

.text {
	width: 400px;
	height: 100px;
	margin: 50px auto;
	text-align:center;
	font-size: 12px;
	font-family: verdana;
}

</style>
</head>

<body>

<?php

$sp_link = "<img src='http://akt.sliderpakiet.pl/img/akt_off.png' style='padding-right: 5px;' alt='' /> <b>Dostępna jest nowa wersja! <a href='http://akt.sliderpakiet.pl/' target='_blank'>Pobierz ją</a></b>.";
$sp_brak = "<img src='http://akt.sliderpakiet.pl/img/akt_on.png' style='padding-right: 5px;' alt='' /> <b>Posiadasz aktualną wersję, brak aktualizacji</b>.";

if(isset($_GET["ver"])) {

	$ver = $_GET["ver"];
	
	if($ver == "U2xpZGVyUGFraWV0UGx1czQ1NQ==" || $ver == "U2xpZGVyUGFraWV0Tm9ybWFsNDUy") {
	
		echo $sp_brak;
		
	} else {
	
		echo $sp_link;
	
	}
	
} else {

	echo "<div class='text'><b>Nie posiadasz dostępu</b></div>";
	header("refresh:2;url=http://sliderpakiet.pl/");
	
}

ob_end_flush();

?>

</body>
</html>