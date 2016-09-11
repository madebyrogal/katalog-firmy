<div id="addCategoryBox" title="Wybierz kategorię">
	
</div>

<script type="text/javascript">
    
    setCategoryOnStart();
    
    jQuery('.addCategory').click(function() {
        
       var selected = jQuery("#company_categories_list option:selected");
       if(selected.length >= 10)
       {
            alert('Nie możesz wybrać wiecej kategorii');
            return false;
       }
        
       $( "#addCategoryBox" ).dialog({
                height: 500,
                width: 700,
                modal: true
        });
        getCategory(0);
        return false;
    });
    
    function getCategory(id)
    {
        jQuery.ajax({
          type: "GET",
          url: "/get_category",
          data: 'id=' + id,
          success: function(msg){
             
             jQuery('#addCategoryBox').html(msg);
            
          }
        });
    }
    
    function deleteCategory(obj) {
        var id = jQuery(obj).attr('class');
        id = id.split('delete_category_');
        id = id[1];
        jQuery("#company_categories_list option[value='" + id +"']").attr('selected', false);
        jQuery(obj).parent('span').remove();
    };
    
    function setCategoryOnStart()
    {
        var selected = jQuery("#company_categories_list option:selected");
        var ids = "";
        if(selected.length > 0)
        {
            jQuery(selected).each(function() {
               ids += jQuery(this).val() + ',';
            });
            
            jQuery.ajax({
              type: "GET",
              url: "/set_category",
              data: 'ids=' + ids,
              success: function(msg){
                 jQuery('#selectedCategory').html(msg);
              }
            });            
        }
            
    }

</script>