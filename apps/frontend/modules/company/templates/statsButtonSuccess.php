<div class="stats_popup">
    <a href="#" class="popup_close">zamknij <span>[x]</span></a>
    <span id="popup_company"><?php echo $object->getPrimaryKey(); ?></span>
<?php if(!$is_email): ?>
    
    <span class="popup_error">Podałeś błędny adres e-mail</span>
    
    <span class="popup_email_text">Wprowadź swój adres <strong>e-mail:</strong></span>
    <input type="text" value="" id="popup_email" />
    <input class="popup_button" type="button" value="" />
    <span class="popup_text">Aby wyświetlić dane kontaktowe firmy wpisz proszę swój adres e-mail i naciśnij przycisk ok. Adresy e-mail potrzebne są wyłącznie do generowania statystyk, nie będą udostępniane osobą trzecim.</span>

<?php else: ?>
    
    <h1>Dane kontaktowe</h1>
    
    <table>
        <tr>
            <td><strong>tel.:</strong> <?php echo $object->getPhone(); ?></td>
            <!--<td><strong>gg:</strong>-->
            
            <?php 
              /*$gg = $object->getGg(); 
              if($gg)
              {
                echo '<a href="gg:'.$gg.'">'.$gg.'</a>';
              }*/
            ?>
            
            <!--</td>-->
            <td><strong>www:</strong> 
              <?php if($object->getWWW()): ?>                
                <?php 
                  $www = "";
                  if(substr($object->getWWW(), 0, 7) != 'http://') 
                  {
                    $www = 'http://';
                  }
                  $www .=  $object->getWWW();
                ?>
                <a target="_blank" href="<?php echo $www; ?>"><?php echo $www; ?></a>
              <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td><strong>tel.:</strong> <?php echo $object->getMobile(); ?></td>
            <!--<td><strong>skype:</strong>-->
            <?php 
              /*$skype = $object->getSkype(); 
              if($skype)
              {
                echo '<a href="skype:'.$skype.'?call">'.$skype.'</a>';
              }*/
              
            ?>
            <!--</td>-->
            <td>
            <?php if($object->getPromoted()): ?>
				<strong>youtube:</strong>
				
				<?php 
				  $yt = $object->getYt(); 
				  if($yt)
				  {
					$yt = preg_replace( '#^\s*(?:https?://)?(?:www.)?youtube.com/user/(.*)/?#i', '\1', $yt );
					echo '<a target="_blank" href="http://youtube.com/user/'.$yt.'">'.$yt.'</a>';
				  }
				?>
            <?php endif; ?>
            </td>
        </tr>
        <tr>
          
            <td><strong>email:</strong> <a href="mailto:<?php echo $object->getEmailAddress(); ?>"><?php echo $object->getEmailAddress(); ?></a></td>
            <td>
            <?php if($object->getPromoted()): ?>
				<strong>facebook:</strong>
				<?php 
				  $fb = $object->getFb(); 
				  if($fb)
				  {
					$fb = preg_replace( '#^\s*(?:https?://)?(?:www.)?facebook.com/(.*)/?#i', '\1', $fb );
					echo '<a target="_blank" href="http://facebook.com/'.$fb.'">'.$fb.'</a>';
				  }
				?>
            <?php endif; ?>
            
            </td>
        </tr>
        <tr>
            <td><strong>fax:</strong> <?php echo $object->getFax(); ?></td>
            <td></td>
        </tr>    
    </table>
    
<?php endif; ?>  
    <img src="/images/loading.gif" class="loading" />
</div>

<script type="text/javascript">
    
    jQuery('.popup_close').click(function() {
       jQuery('#company_one_popup').html();
       jQuery('#company_one_popup').hide();
       return false;
   });
   
   jQuery('#popup_email').keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            sendEmail();
        } else {
            return true;
        }
    });
   
   jQuery('.popup_button').click(function() {            
       sendEmail();
   });
   
</script>   