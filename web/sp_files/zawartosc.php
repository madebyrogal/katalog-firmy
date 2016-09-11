<?php

ob_start();

function get_string_between($string, $start, $end){
    $string = " ".$string;
     $ini = strpos($string,$start);
     if ($ini == 0) return "";
     $ini += strlen($start);    
     $len = strpos($string,$end,$ini) - $ini;
     return substr($string,$ini,$len);
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

ob_end_flush();

?>

<script type="text/javascript" src="zaw_menu.js"></script>
<script type="text/javascript" src="jquery.livevalidation.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#form').liveValidation();
});

tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
		elements : "po_value",
        plugins : "",
		height: "200px",
		width: "100%",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,|,bullist,numlist,|,link,unlink,anchor,image,cleanup,|,cut,copy,paste,pastetext,|,code",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,
		
		force_br_newlines : false,
        force_p_newlines : false,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",
	
});
	
</script>

<span class="text">Tutaj skonfigurujesz wszystkie zainstalowane zakładki.</span>
<span class="komunikat"></span>

<br /><br />

<div id="form">

<form method="post" id="forms" onsubmit="return false">

<div class="zaw_menu">

	<ul id="zaw_tabs">
	
		<li><a href="#ustawienia" class="current">Ustawienia</a></li>
		<li><a href="#facebook">Facebook</a></li>
		<li><a href="#twitter">Twitter</a></li>
		<li><a href="#googleplus">Google Plus</a></li>
		<li><a href="#gg">GaduGadu</a></li>
		<li><a href="#polecamy">Polecamy</a></li>
		<li><a href="#allegro">Allegro</a></li>
		<li><a href="#youtube">YouTube</a></li>
		<li><a href="#nk">NaszaKlasa</a></li>
		
	</ul>

</div>

<div class="zaw_main">

	<div id="ustawienia" class="tab_content" style="display: none;">
	
		Witaj <b><?php echo $user; ?>!</b> Dostosuj skrypt do własnych preferencji.<br /><br /><br />
		
		<div class="input_name">Wysokość zakładek</div>
		<div class="input_value" style="margin-bottom: 20px;"><input id="height" name="height" value="<?php echo $height; ?>" style="width: 40px;" /></div>
		
		<div class="input_name">Użytkownik</div>
		<div class="input_value" style="margin-bottom: 20px;"><input id="user" name="name" value="<?php echo $user; ?>" style="width: 110px;" /></div>
		
		<div class="input_name">Hasło</div>
		<div class="input_value" style="margin-bottom: 40px;"><input id="pass" name="pass" value="<?php echo $pass; ?>" style="width: 110px;" /></div>
		
		<br />Jeżeli chcesz być na bieżąco, <b>podaj swój e-mail</b>, na który dokonałeś zakupu!<br /><br /><br />
		
		<div class="input_name">E-mail</div>
		<div class="input_value" style="margin-bottom: 20px;"><input id="email" name="email" value="<?php echo $email; ?>" style="width: 110px;" /></div>
		
		<span class="polityka">Podanie adresu jest równoznaczne z akceptacją naszej <a href="http://sliderpakiet.pl/polityka-prywatnosci/" target="_blank">polityki prywatności</a>.</span>
	
	</div>

    <div id="facebook" class="tab_content" style="display: none;">
	
	<b>Pamiętaj!</b> Profil, który chcesz użyć musi być publiczny. Więcej informacji znajdziesz w pomocy.<br /><br /><br />
	
	<div class="input_name">Aktualny stan</div>
	<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='fb_status' name='fb_status'>";
			
			if($fb_status == "fb_on") {
			
				echo "<option value='fb_on' selected>Włączona</option>";
				echo "<option value='fb_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='fb_on'>Włączona</option>";
				echo "<option value='fb_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
	</div>		
			
	<div class="input_name">Adres profilu</div>
	<div class="input_value"><input id="fb_url" name="url" value="<?php echo $fb_url; ?>" style="width: 350px;" /></div>
	
    </div>
    <div id="twitter" class="tab_content" style="display: none;">
        
	<b>Pamiętaj!</b> Jeżeli chcesz wyłączyć tą zakładkę, po prostu ją wyłącz.<br /><br /><br />
	
	<div class="input_name">Aktualny stan</div>
	<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='tw_status' name='tw_status'>";
			
			if($tw_status == "tw_on") {
			
				echo "<option value='tw_on' selected>Włączona</option>";
				echo "<option value='tw_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='tw_on'>Włączona</option>";
				echo "<option value='tw_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
	</div>		
			
	<div class="input_name">Nazwa profilu</div>
	<div class="input_value"><input id="tw_url" name="num_id" value="<?php echo $tw_url; ?>" style="width: 80px;" /></div>
		
    </div>
    <div id="googleplus" class="tab_content" style="display: none;">
		
	<b>Pamiętaj!</b> Podaj poniżej sam numer id profilu!<br /><br /><br />
	
	<div class="input_name">Aktualny stan</div>
	<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='gp_status' name='gp_status'>";
			
			if($gp_status == "gp_on") {
			
				echo "<option value='gp_on' selected>Włączona</option>";
				echo "<option value='gp_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='gp_on'>Włączona</option>";
				echo "<option value='gp_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
	</div>	
			
	<div class="input_name">Adres profilu</div>
	<div class="input_value"><input id="gp_url" name="num_id" value="<?php echo $gp_url; ?>" style="width: 200px;" /></div>
		
    </div>
	
	<div id="gg" class="tab_content" style="display: none;">

		<br />
	
		<div class="input_name">Aktualny stan</div>
		<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='gg_status' name='gg_status'>";
			
			if($gg_status == "gg_on") {
			
				echo "<option value='gg_on' selected>Włączona</option>";
				echo "<option value='gg_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='gg_on'>Włączona</option>";
				echo "<option value='gg_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
		</div>	
			
		<div class="input_name">Numer ID</div>
		<div class="input_value"><input id="gg_url" name="num_id" value="<?php echo $gg_url; ?>"  style="width: 350px;" /></div>
	
	</div>
	
	<div id="polecamy" class="tab_content" style="display: none;">

		<br />
	
		<div class="input_name">Aktualny stan</div>
		<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='po_status' name='po_status'>";
			
			if($po_status == "po_on") {
			
				echo "<option value='po_on' selected>Włączona</option>";
				echo "<option value='po_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='po_on'>Włączona</option>";
				echo "<option value='po_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
		</div>	
			
		<div class="input_name">Szerokość</div>
		<div class="input_value" style="margin-bottom: 20px; width: 70px;"><input id="po_width" name="po_width" value="<?php echo $po_width; ?>"  style="width: 50px;" /></div>
		
		<div class="input_name" style="width: 130px;">Wysokość</div>
		<div class="input_value" style="margin-bottom: 0px;width: 100px;"><input id="po_height" name="po_height" value="<?php echo $po_height; ?>"  style="width: 50px;" /></div>
		
		<div class="input_textarea"><br /><textarea id="po_value" name="po_value" rows="11" cols="60"><?php echo $po_value; ?></textarea></div>
	
	</div>
	
	<div id="allegro" class="tab_content" style="display: none;">

		<br />
	
		<div class="input_name">Aktualny stan</div>
		<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='all_status' name='all_status'>";
			
			if($all_status == "all_on") {
			
				echo "<option value='all_on' selected>Włączona</option>";
				echo "<option value='all_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='all_on'>Włączona</option>";
				echo "<option value='all_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
		</div>	
			
		<div class="input_name">Numer ID</div>
		<div class="input_value"><input id="all_url" name="num_id" value="<?php echo $all_url; ?>" style="width: 350px;" /></div>
	
	</div>
	
	<div id="youtube" class="tab_content" style="display: none;">

		<br />
	
		<div class="input_name">Aktualny stan</div>
		<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='yt_status' name='yt_status'>";
			
			if($yt_status == "yt_on") {
			
				echo "<option value='yt_on' selected>Włączona</option>";
				echo "<option value='yt_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='yt_on'>Włączona</option>";
				echo "<option value='yt_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
		</div>	
			
		<div class="input_name">Nazwa usera</div>
		<div class="input_value"><input id="yt_url" name="num_id" value="<?php echo $yt_url; ?>" style="width: 100px;" /></div>
	
	</div>
	
	<div id="nk" class="tab_content" style="display: none;">

		<br />
	
		<div class="input_name">Aktualny stan</div>
		<div class="input_value">
		
		<?php
			
			echo "<select style='width: 120px;' id='nk_status' name='nk_status'>";
			
			if($nk_status == "nk_on") {
			
				echo "<option value='nk_on' selected>Włączona</option>";
				echo "<option value='nk_off'>Wyłączona</option>";
			
			} else {
				
				echo "<option value='nk_on'>Włączona</option>";
				echo "<option value='nk_off' selected>Wyłączona</option>";
			
			}
			
			echo "</select>";
			
			echo "<br /><br />";
			
			?>
		</div>	
			
		<div class="input_name">Numer ID grupy</div>
		<div class="input_value"><input id="nk_url" name="num_id" value="<?php echo $nk_url; ?>" style="width: 100px;" /></div>
	
	</div>

</div>

<span class="zaw_default">

<input type="submit" name="Default" id="Default" value="" />

</span>

<span class="zaw_submit">

<input type="submit" name="Submit" id="Submit" value="" />

</span>

</form>
</div>