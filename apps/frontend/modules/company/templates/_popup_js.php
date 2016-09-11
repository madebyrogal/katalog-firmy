<script type="text/javascript">
   jQuery('.company_one_button').click(function(e) {  
       jQuery('#company_one_popup').css('top', (e.pageY - 200) + 'px');
       jQuery('#company_one_popup').css('left', (e.pageX - 24) + 'px');    
       jQuery('#company_one_popup').show();
       var id = jQuery(this).attr('id');
       id = id.split('_');
       id = id[1];
       popup(id);
       
       return false;
   });
   
   function popup(id)
   {       
       jQuery.ajax({
          type: "GET",
          url: "/stats_button/" + id,
          data: '',
          success: function(msg){
            
             jQuery('#company_one_popup').html(msg);
            
          }
        });
   }
      
   function validate(email) 
   {
       var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
       if(reg.test(email) == false) 
       {
          return false;
       }
       else
       {
           return true;
       }
   }

   function sendEmail() 
   {
       var email = jQuery('#popup_email').val();   
       var id = jQuery('#popup_company').text(); 
       jQuery('.loading').show();
       if(validate(email)) 
       {
           jQuery('.popup_error').hide();
           jQuery.ajax({
              type: "GET",
              url: "/frontend_dev_1.php/stats_button/" + id,
              data: 'email=' + email,
              success: function(msg){                        
                 jQuery('#company_one_popup').html(msg);            
                 jQuery('.loading').hide();
              }
           });
           
       }
       else
       {
           jQuery('.popup_error').show();           
           jQuery('.loading').hide();
       }
   }
</script>