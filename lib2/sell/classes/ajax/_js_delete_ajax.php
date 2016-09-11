<script type="text/javascript">

  jQuery(function() {
    var link = jQuery('#link_delete_<?php echo $object_id; ?>');
    var delete_url = link.attr('href');
    var confirm_text = link.attr('onClick').replace( "return confirm('", "" ).replace( "');", "" )

    link.attr('onClick', '');
    link.click(function(){
      if (confirm(confirm_text))
        {
          jQuery(this).load(
            delete_url, null, function(){
              jQuery(this).closest('table').closest('tr').remove();
            }
          );
        }
      return false;
    });
  });
</script>