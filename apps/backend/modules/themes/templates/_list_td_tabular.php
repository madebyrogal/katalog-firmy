<?php
    $object = $themes;
    $route = 'themes_themes_switch_active';
?>

<td class="sf_admin_text sf_admin_list_td_description">
  <a onmousemove="disImage('<?php echo $themes->getName(); ?>')" onmouseout="hideImage()" href="<?php echo url_for($route,$object) ?>"><?php echo $themes->getDescription() ?></a>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_active">
  <?php echo get_partial('is_active', array('type' => 'list', 'themes' => $themes)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_author">
  <?php echo $themes->getAuthor() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_version">
  <?php echo $themes->getVersion() ?>
</td>
