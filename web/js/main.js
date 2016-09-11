jQuery(document).ready(function()  {
 
    var facebook_open = false;
 
    $('#facebook_wrap').hover(
        function() {
            if(animation) {
              return false;
            }
            if(!facebook_open)
            {
                animation = true;
                $('#facebook').animate({"left": "325px"}, { 'duration': 'slow', queue: false});
                $('#facebook_content').animate({"left": "0px"}, { 'duration': 'slow', queue: false});
                facebook_open = true;                
            }
        },
        function() {         
            $('#facebook').animate({"left": "0px"}, { 'duration': 'slow', queue: false});
            $('#facebook_content').animate({"left": "-325px"}, {'duration': 'slow', queue: false, complete: function() { animation = false }});
            facebook_open = false;
        });
   
   jQuery('.menu_top li a:first').css('color', '#fff');
   jQuery('.category_choose').each(function() {
       jQuery(this).children('span:first').remove();
   })
   
   var name_key = 'Imię i nazwisko';
   var phone_key = 'Numer telefonu';
   var email_key = 'Adres e-mail';
   var text_key = 'Treść wiadomości...';
   
   jQuery('.statsForm #form_name').focus(function() {
      if(jQuery(this).val() == name_key) {
          jQuery(this).val("");
      }
   });
   jQuery('.statsForm #form_name').blur(function() {
       
      if(jQuery(this).val() == "")
      {
          jQuery(this).val(name_key);
      }       
   });
   
   jQuery('.statsForm #form_phone').focus(function() {
      if(jQuery(this).val() == phone_key) {
          jQuery(this).val("");
      }
   });
   jQuery('.statsForm #form_phone').blur(function() {
       
      if(jQuery(this).val() == "")
      {
          jQuery(this).val(phone_key);
      }       
   });
   
   jQuery('.statsForm #form_email').focus(function() {
      if(jQuery(this).val() == email_key) {
          jQuery(this).val("");
      }
   });
   jQuery('.statsForm #form_email').blur(function() {
       
      if(jQuery(this).val() == "")
      {
          jQuery(this).val(email_key);
      }       
   });

   jQuery('.statsForm #form_text').focus(function() {
      if(jQuery(this).val() == text_key) {
          jQuery(this).val("");
      }
   });
   jQuery('.statsForm #form_text').blur(function() {
       
      if(jQuery(this).val() == "")
      {
          jQuery(this).val(text_key);
      }       
   });  
   
   var check = jQuery.cookie("check");

   if(check == '0')
   {
      jQuery('.invoiceData').show();
      jQuery('#copyAddress').attr('checked', false);
   }
   else
   {
      jQuery('.invoiceData').hide();
      
      jQuery('#copyAddress').attr('checked', 'checked');
   }
   
   jQuery('#copyAddress').change(function() {
        
      jQuery('.invoiceData').toggle();
      if(jQuery(this).attr('checked') == 'checked')
      {
          jQuery.cookie("check", '1');
//          jQuery('#profile_name').val(jQuery('#name').val());
//          jQuery('#profile_nip').val(jQuery('#nip').val());
//          jQuery('#profile_city').val(jQuery('#city').val());
//          jQuery('#profile_state').val(jQuery('#state').val());
//          jQuery('#profile_post_code').val(jQuery('#post_code').val());
//          jQuery('#profile_street').val(jQuery('#street').val());
      }
      else
      {
          jQuery.cookie("check", '0');
//          jQuery('#profile_name').val("");
//          jQuery('#profile_nip').val("");
//          jQuery('#profile_city').val("");
//          jQuery('#profile_state').val("");
//          jQuery('#profile_post_code').val("");
//          jQuery('#profile_street').val("");
      }
   });
   
   jQuery('#formAddComapny').submit(function() {
       if(jQuery('#copyAddress').attr('checked') == 'checked')
       {
          jQuery('#profile_name').val(jQuery('#name').val());
          jQuery('#profile_nip').val(jQuery('#nip').val());
          jQuery('#profile_city').val(jQuery('#city').val());
          jQuery('#profile_state').val(jQuery('#state').val());
          jQuery('#profile_post_code').val(jQuery('#post_code').val());
          jQuery('#profile_street').val(jQuery('#street').val());
          jQuery('#profile_phone').val(jQuery('#phone').val());
       }           
           
       return true;
   });
    
});
