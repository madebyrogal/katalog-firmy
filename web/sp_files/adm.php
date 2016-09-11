<?php

ob_start();

session_start();

if(!isset($_SESSION['login'])) {
	header("location:index.html");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SliderPakiet Hydra - Panel administracyjny</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="sp_panel.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script type="text/javascript" src="tiny_mce.js"></script>
</head>
<body>

<div id="top">
	
	
	<a href="logout.php"><img src="img/logout_ico.png" alt="" style="position: absolute; top: 28px; right:30px;" /></a>
	
	<div id="tabs">

    <ul id="menu">
        <li><a href="zawartosc.php" class="menu_1 current">Zawartość</a></li>
        <li><a href="informacje.php" class="menu_2">Informacje</a></li>
    </ul>
	
	</div>

	
</div>

<div id="main">

</div>

<div id="footer">

	<span class="left"><b>SliderPakiet Hydra</b></span>
	<span class="right">Projekt oraz realizacja: <b><a href="http://dobrawitryna.pl/" title="DobraWitryna">DOBRAWITRYNA.pl</a></b></span>

</div>

</body>
</html>