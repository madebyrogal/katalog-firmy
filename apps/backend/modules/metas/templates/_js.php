<script type="text/javascript">
jQuery('document').ready(function () {
  jQuery('#metas_<?php echo Lang::getDefaultLanguage(); ?>_generate').closest('tr').find('label').show();


<?php foreach(Lang::createLangStrings('LANG', array('sf_admin_form_field_LANG')) as $class) : ?>
  class_name = '<?php echo $class; ?>';
  lang = class_name.replace('sf_admin_form_field_', '');
  jQuery('.' + class_name).before('<div style="margin: 10px; font-weight: bold;">' + lang.toUpperCase() + '</div>');
<?php endforeach; ?>
})
</script>