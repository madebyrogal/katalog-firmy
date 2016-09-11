<script type="text/javascript">

  jQuery(function()
  {
    var link = jQuery('#link_add');
    var add_url = '<?php echo $url; ?>';

    link.attr('onClick', '');
    link.click(function()
    {
      new_value = jQuery.trim( link.prev('input').val() );
      if (new_value.length != 0)
      {
        jQuery.post(add_url + new_value, null, function(data)
        {
            
          jQuery('.sf_admin_form_field_PropertyValues table:first').prepend(data);
          
          new_delete_link = jQuery('.link_delete:first');
          new_delete_link.click(function()
          {
            if (confirm('<?php echo $delete_confirm; ?>'))
            {
              jQuery(this).load(jQuery(this).attr('href'), null, function()
              {
                jQuery(this).closest('table').closest('tr').remove();
              });
            }
            return false; // żeby nie podążać za linkiem z <a href...
          });
        });
      }
    });
  });
</script>