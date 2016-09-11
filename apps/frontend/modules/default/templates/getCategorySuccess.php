<div id="lastCategory"><?php if($last): ?><?php echo $id; ?><?php else: ?>0<?php endif; ?></div>    
<div id="treeCategory"><?php echo $sf_data->getRaw('tree'); ?></div>

<select name="addCategories[]" multiple="multiple" id="addCategories">
    <?php foreach($categories as $category): ?>
        <option <?php echo ($category->getPrimaryKey() == $ids[0]) ? 'selected="selected"' : ''; ?> value="<?php echo $category->getPrimaryKey(); ?>"><?php echo $category->getName(); ?></option>
    <?php endforeach; ?>
</select>
<?php if(count($categories2) > 0): ?>
<select name="addCategories2[]" multiple="multiple" id="addCategories2">
  <?php foreach($categories2 as $category): ?>
        <option <?php echo ($category->getPrimaryKey() == $ids[1]) ? 'selected="selected"' : ''; ?> value="<?php echo $category->getPrimaryKey(); ?>"><?php echo $category->getName(); ?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>

<?php if(count($categories3) > 0): ?>
<select name="addCategories3[]" multiple="multiple" id="addCategories3">
  <?php foreach($categories3 as $category): ?>
        <option <?php echo ($category->getPrimaryKey() == $ids[2]) ? 'selected="selected"' : ''; ?> value="<?php echo $category->getPrimaryKey(); ?>"><?php echo $category->getName(); ?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>

<script type="text/javascript">
    
    var last = jQuery('#lastCategory').text();
    if(last > '0')
    {
        if(!jQuery("#company_categories_list option[value='" + last +"']").attr('selected'))
        {
            jQuery("#company_categories_list option[value='" + last +"']").attr('selected', 'selected');
            var category = '<span>' + jQuery('#treeCategory').html() + ' <a class="delete_category_' + last + '" onclick="deleteCategory(this); return false;" href="#">X</a><br /></span>';
            jQuery('#selectedCategory').append(category);
        }
        jQuery('#addCategoryBox').dialog( "close" );
    }
    else
    {            
        jQuery('#addCategories').change(function() {      
            var id = getVal('#addCategories');
            id += ',' + 0;
            id += ',' + 0;            
            getCategory(id);          
        });
        jQuery('#addCategories2').change(function() {      
            var id =  getVal('#addCategories');    
            id += ',' + getVal('#addCategories2');           
            id += ',' + 0;
            getCategory(id);          
        });
        jQuery('#addCategories3').change(function() {      
            var id =  getVal('#addCategories');    
            id += ',' + getVal('#addCategories2');
            id += ',' + getVal('#addCategories3');   
            getCategory(id);          
        });
        
        function getVal(id)
        {
           var val = jQuery(id).val();
           if(val == 'undefined' || val == 'null' || !val)
           {
              val = 0;
           }

           return val;
        }
    
    }
    
</script>    