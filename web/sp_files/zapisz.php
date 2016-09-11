<?php

function get_string_between($string, $start, $end){
    $string = " ".$string;
     $ini = strpos($string,$start);
     if ($ini == 0) return "";
     $ini += strlen($start);    
     $len = strpos($string,$end,$ini) - $ini;
     return substr($string,$ini,$len);
}

function replace($filename,$text,$line) {
	$lines = file( $filename , FILE_IGNORE_NEW_LINES );
	$lines[$line] = $text;
	file_put_contents( $filename , implode( "\n", $lines ) );
}

$myFile = "../sp.js";
$lines = file($myFile);
$height = get_string_between($lines[5],"'","'");
$po_width = get_string_between($lines[6],"'","'");
$po_height = get_string_between($lines[7],"'","'");
$fb_status = get_string_between($lines[9],"'","'");
$tw_status = get_string_between($lines[10],"'","'");
$po_status = get_string_between($lines[11],"'","'");
$gp_status = get_string_between($lines[12],"'","'");
$gg_status = get_string_between($lines[13],"'","'");
$yt_status = get_string_between($lines[14],"'","'");
$all_status = get_string_between($lines[15],"'","'");
$nk_status = get_string_between($lines[16],"'","'");

$fb_url = get_string_between($lines[18],"'","'");
$tw_url = get_string_between($lines[19],"'","'");
$gp_url = get_string_between($lines[20],"'","'");
$po_value = get_string_between($lines[21],"'","'");
$gg_url = get_string_between($lines[22],"'","'");
$yt_url = get_string_between($lines[23],"'","'");
$all_url = get_string_between($lines[24],"'","'");
$nk_url = get_string_between($lines[25],"'","'");

$myFile2 = "check.php";
$lines2 = file($myFile2);
$user = get_string_between($lines2[7],"'","'");
$pass = get_string_between($lines2[8],"'","'");
$email = get_string_between($lines2[9],"'","'");

/* Form data */

$new_height = $_POST['height'];
$new_fb_status = $_POST['fb_status'];
$new_tw_status = $_POST['tw_status'];
$new_gp_status = $_POST['gp_status'];
$new_gg_status = $_POST['gg_status'];
$new_po_status = $_POST['po_status'];
$new_yt_status = $_POST['yt_status'];
$new_all_status = $_POST['all_status'];
$new_nk_status = $_POST['nk_status'];

$new_fb_url = $_POST['fb_url'];
$new_tw_url = $_POST['tw_url'];
$new_gp_url = $_POST['gp_url'];
$new_gg_url = $_POST['gg_url'];
$new_yt_url = $_POST['yt_url'];
$new_all_url = $_POST['all_url'];
$new_nk_url = $_POST['nk_url'];
	
$new_po_width = $_POST['po_width'];
$new_po_height = $_POST['po_height'];
$new_po_value = $_POST['po_value'];
$new_po_value = str_replace(array("\r\n", "\n"), "", $new_po_value);
$new_po_value = stripslashes($new_po_value);
	
$new_user = $_POST['user'];
$new_pass = $_POST['pass'];
$new_email = $_POST['email'];

/* Saving */
	
replace($myFile,"var height = '$new_height';","5");
replace($myFile,"var po_width = '$new_po_width';","6");
replace($myFile,"var po_height = '$new_po_height';","7");

replace($myFile,"var fb_status = '$new_fb_status';","9");
replace($myFile,"var tw_status = '$new_tw_status';","10");
replace($myFile,"var po_status = '$new_po_status';","11");
replace($myFile,"var gp_status = '$new_gp_status';","12");
replace($myFile,"var gg_status = '$new_gg_status';","13");
replace($myFile,"var yt_status = '$new_yt_status';","14");
replace($myFile,"var all_status = '$new_all_status';","15");
replace($myFile,"var nk_status = '$new_nk_status';","16");

replace($myFile,"var fb_url = '$new_fb_url';","18");
replace($myFile,"var tw_url = '$new_tw_url';","19");
replace($myFile,"var gp_url = '$new_gp_url';","20");
replace($myFile,"var po_value = '$new_po_value';","21");
replace($myFile,"var gg_url = '$new_gg_url';","22");
replace($myFile,"var yt_url = '$new_yt_url';","23");
replace($myFile,"var all_url = '$new_all_url';","24");
replace($myFile,"var nk_url = '$new_nk_url';","25");
	
replace($myFile2,"\$true_login = '$new_user';","7");
replace($myFile2,"\$true_pass = '$new_pass';","8");
replace($myFile2,"\$email = '$new_email';","9");
	
?>