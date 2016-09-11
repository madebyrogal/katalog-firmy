<h3 class="header h_menu header_left">Dodaj firmę</h3>  

<div class="max_box">
    
    <form action="<?php echo url_for('add_order') ?>" id="formAddComapny" method="post">
        
        <h3>Podstawowe informacje</h3>
        <div class="box_form">
            <table>
                <?php //echo $form['profile_first_name']->renderError() ?>
                <?php echo $form['profile_first_name']->renderRow() ?>
                <?php //echo $form['profile_last_name']->renderError() ?>
                <?php echo $form['profile_last_name']->renderRow() ?>
                <?php //echo $form['profile_name']->renderError() ?>
              
                <?php //echo $form['name']->renderError() ?>
                <?php echo $form['name']->renderRow() ?>
                
                <?php //echo $form['nip']->renderError() ?>
                <?php echo $form['nip']->renderRow() ?>
                
                <?php //echo $form['city']->renderError() ?>
                <?php echo $form['city']->renderRow() ?>
                
                <?php //echo $form['state']->renderError() ?>
                <?php echo $form['state']->renderRow() ?>
                
                <?php //echo $form['post_code']->renderError() ?>
                <?php echo $form['post_code']->renderRow() ?>
                
                <?php //echo $form['street']->renderError() ?>
                <?php echo $form['street']->renderRow() ?>
                
                <?php //echo $form['phone']->renderError() ?>
                <?php echo $form['phone']->renderRow() ?>
                
                <?php //echo $form['mobile']->renderError() ?>
                <?php echo $form['mobile']->renderRow() ?>
                
                <?php //echo $form['fax']->renderError() ?>
                <?php echo $form['fax']->renderRow() ?>
                
                <?php //echo $form['email_address']->renderError() ?>
                <?php echo $form['email_address']->renderRow() ?>
                
                <?php //echo $form['gg']->renderError() ?>
                <?php //echo $form['gg']->renderRow() ?>
                
                <?php //echo $form['skype']->renderError() ?>
                <?php //echo $form['skype']->renderRow() ?>
                
                <?php echo $form['fb']->renderRow() ?>
                
                <?php echo $form['yt']->renderRow() ?>
                
                <?php //echo $form['www']->renderError() ?>
                <?php echo $form['www']->renderRow() ?>
                
            </table>
        </div>
        
        <h3>Dane fakturowe</h3>
        <div class="box_form">
            <input type="checkbox" name="check" checked="checked" value="" id="copyAddress" /><label for="copyAddress">Takie same dane jak dane firmy</label>
            <table class="invoiceData" style="display: none;"> 
            
                <?php echo $form['profile_name']->renderRow() ?>
                <?php //echo $form['profile_city']->renderError() ?>
                <?php echo $form['profile_city']->renderRow() ?>
                <?php //echo $form['profile_state']->renderError() ?>
                <?php echo $form['profile_state']->renderRow() ?>
                <?php //echo $form['profile_street']->renderError() ?>
                <?php echo $form['profile_street']->renderRow() ?>
                <?php //echo $form['profile_post_code']->renderError() ?>
                <?php echo $form['profile_post_code']->renderRow() ?>
                <?php //echo $form['profile_nip']->renderError() ?>
                <?php echo $form['profile_nip']->renderRow() ?>
                <?php //echo $form['profile_phone']->renderError() ?>
                <?php echo $form['profile_phone']->renderRow() ?>
                
                
            </table>
        </div>
        
        <h3><span class="star">* </span> Typ oferty</h3>
        <div class="box_form">
            <table>
                <?php //echo $form['types']->renderError() ?>
                <?php echo $form['types']->renderRow() ?>
            </table>
        </div>
        
        <h3><span class="star">* </span> Kategorie</h3>
        <div class="box_form">
            <table>
                <?php //echo $form['company_categories_list']->renderError() ?>
                <?php echo $form['company_categories_list']->renderRow() ?>
            </table>
            
            <div id="selectedCategory">
                
            </div>
            
            <a href="#" class="addCategory">dodaj kategorie</a>
        </div>
        
        
        
        <h3><span class="star">* </span> Konto w serwisie</h3>
        <div class="box_form">
            <table>
                <?php echo $form['email']->renderError() ?>
                <?php echo $form['email']->renderRow() ?>
                <?php //echo $form['password']->renderError() ?>
                <?php echo $form['password']->renderRow() ?>
                <?php //echo $form['password2']->renderError() ?>
                <?php echo $form['password2']->renderRow() ?>
            </table>    
        </div>
				<?php /*  usuniete po wywaleniu wpisu 'STAMDARD'
        <div style="<?php echo ($packet!=1) ? 'display: none;' : ''; ?>">        
            <h3>Wybierz pakiet</h3>
            <div class="box_form">
              
                <?php echo $form['packet']->renderError() ?>
                <table class="choosePacketForm" cellpadding="0" cellspacing="0">
                    <tr>
                        <th style="width: 300px;">Pakiet</th>
                        <th style="width: 200px;">Cena</th>
                        <th style="width: 100px;">Wybierz</th>
                    </tr>
                    <tr>
                        <td>STANDARD</td>
                        <td>za darmo</td>
                        <td rowspan="4"><?php echo $form['packet']->render() ?></td>
                    </tr>
                    <tr>
                        <td>PREMIUM 90</td>
                        <td>90 zł</td>                    
                    </tr>
                    <tr>
                        <td>PREMIUM 180</td>
                        <td>180 zł</td>                    
                    </tr>
                    <tr>
                        <td>PREMIUM 360</td>
                        <td>360 zł</td>                    
                    </tr>
                </table>


            </div>
        </div>				
				 */
				?>
        
        <div style="margin-top: 10px; margin-bottom: 10px;">  
          
          <?php echo $form['reg']->renderError(); ?>
          <?php echo $form['reg']->render(); ?>
          <?php echo $form['reg']->renderLabel(); ?>
          <span class="star">* </span>
        </div>
        <br />
        <?php echo $form->renderHiddenFields() ?>
        
        
        
        <span class="star">* - pola wymagane</span>
        
        <div style="text-align: center">
            <input type="submit" value="Dodaj firme" class="addCompanyButton" />
        </div>
        
        <?php //echo $form ?>
        
    </form>
    
</div>

<?php include_partial('default/addCategory'); ?>

<script type="text/javascript">
  var val = 'np. 500 123 456 lub 22 200 35 65';
  $('#phone').val(val);
  $('#phone').css('color', '#c9c9c9');
  
  $('#phone').focus(function() {
      if($(this).val() == val) {
          $(this).val("");
          $('#phone').css('color', '#1C385F');          
      }
  });
  jQuery('#phone').blur(function() {       
      if(jQuery(this).val() == "")
      {
          jQuery(this).val(val);
          $('#phone').css('color', '#c9c9c9');
      }       
  });
  
</script>  