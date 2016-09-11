<?php 
    $user = sfContext::getInstance()->getUser();
    $type1 = $user->getAttribute('search_type1');
    $type2 = $user->getAttribute('search_type2');
    
    
?>

<div id="types_box">
    <span>Typy ofert</span>
    <input type="checkbox" <?php echo ($type1 == '1') ? 'checked="checked"' : ""; ?> name="search_type" id="search_type" /><label for="search_type">osoby indywidualne</label>
    <input type="checkbox" <?php echo ($type2 == '1') ? 'checked="checked"' : ""; ?> name="search_type2" id="search_type2" /><label for="search_type2">firmy</label>
</div>
<div class="types_box2"></div>