<script type="text/javascript">
  jQuery(document).ready( function () {
    hide_default_language_label();

    jQuery('div.stgHelpClass').parent().find('br').remove();
    //jQuery('div.stgHelpClass').before('<div class="help_tick"">&nbsp;</div>');

  });

  /* dla wersji jezykowych (ukrycie labela Pl (lub innego głównego języka) */
  function hide_default_language_label() {
    jQuery('.sf_admin_form_field_<?php echo Lang::getInstance()->getDefaultLanguage(); ?> label:first').hide();
  };



</script>