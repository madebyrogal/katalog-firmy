<?php
  // Tablica id pól formularza, które mają być zamienione na TinyMCE
  $fields_ids_array = Lang::createLangStrings('LANG',
                                          array(
                                            'articles_LANG_content',
                                            'contact_LANG_address',
                                            'art_categories_LANG_description',                                            
                                          ),
                                          true
                                        );  
  $fields_ids_array[] = 'message_content';
  $fields_ids_array[] = 'company_description';

?>

<script type="text/javascript">

function apply_tinymce() {
  <?php foreach ($fields_ids_array as $field_id) : ?>
    tinyMCE.execCommand('mceAddControl',true, '<?php echo $field_id; ?>');
  <?php endforeach; ?>
}

function disapply_tinymce() {
  <?php foreach ($fields_ids_array as $field_id) : ?>
    if (tinyMCE.getInstanceById('<?php echo $field_id; ?>'))
    {
      tinyMCE.execCommand('mceFocus', false, '<?php echo $field_id; ?>');
      tinyMCE.execCommand('mceRemoveControl', false, '<?php echo $field_id; ?>');
      jQuery('#<?php echo $field_id; ?>').hide();
      jQuery('#<?php echo $field_id; ?>').after('<p>Trwa zapisywanie...</p>');
    }
  <?php endforeach; ?>
}

tinyMCE.init({
  mode:                              "exact",
  elements:                          "<?php echo implode(',', $fields_ids_array); ?>",
  theme:                             "advanced",
  width:                             "550px",
  height:                            "350px",
  theme_advanced_toolbar_location:   "top",
  theme_advanced_toolbar_align:      "left",
  theme_advanced_statusbar_location: "bottom",
  theme_advanced_resizing:           true
  ,
        relative_urls : false,
              language : "pl",
                theme_advanced_disable: "anchor, cleanup,help",
                plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,
                spellchecker_languages : "+Polski=pl,Angielski=en",
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "pastetext,pasteword,|,bullist,numlist,|,sub,sup,|,charmap,iespell,|,link,unlink,anchor,image,|,preview,fullscreen,code",
                theme_advanced_buttons3 : "tablecontrols"
});

</script>