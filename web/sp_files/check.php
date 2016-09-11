<?php

ob_start();

$login=$_POST['login'];
$pass=$_POST['pass'];

$true_login = 'admin';
$true_pass = 'allf88';
$email = 'admin@allf.pl';

if($login == $true_login && $pass == $true_pass){

session_start();

$_SESSION['login'] = $login;
$_SESSION['pass'] = $pass;

header("location:adm.php");
}
else {
echo "<div style='width: 100px; position: absolute;top:45%;left:45%;'>Zle dane</center>";
header("refresh:2;url=adm.php");
}

ob_end_flush();

?>