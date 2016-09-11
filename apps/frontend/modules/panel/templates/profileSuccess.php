<?php include_partial('panel/menu', array('active' => 'profile', 'company' => $company)); ?>

<div class="panel_box">

<form action="<?php echo url_for('@panel_profile') ?>" method="post">
    
    <h3>Podstawowe informacje (dane do faktury)</h3>
    <div class="box_form">
        <table>
            <?php echo $form['Profile']['name']->renderError(); ?>
            <?php echo $form['Profile']['name']->renderRow(); ?>
            
            <?php echo $form['Profile']['nip']->renderError(); ?>
            <?php echo $form['Profile']['nip']->renderRow(); ?>
            
            <?php echo $form['first_name']->renderError(); ?>
            <?php echo $form['first_name']->renderRow(); ?>
            
            <?php echo $form['last_name']->renderError(); ?>
            <?php echo $form['last_name']->renderRow(); ?>
            
            <?php echo $form['Profile']['city']->renderError(); ?>
            <?php echo $form['Profile']['city']->renderRow(); ?>
            
            <?php echo $form['Profile']['state']->renderError(); ?>
            <?php echo $form['Profile']['state']->renderRow(); ?>
                        
            <?php echo $form['Profile']['street']->renderError(); ?>
            <?php echo $form['Profile']['street']->renderRow(); ?>
            
            <?php echo $form['Profile']['post_code']->renderError(); ?>
            <?php echo $form['Profile']['post_code']->renderRow(); ?>
            
            <?php echo $form['Profile']['post_code']->renderError(); ?>
            <?php echo $form['Profile']['phone']->renderRow(); ?>            
        </table>
        <input type="submit" class="saveFormButton" value="" />
    </div>
    <h3>Zmień hasło</h3>
    <div class="box_form">
        <table>
            
            <?php echo $form['password']->renderError(); ?>
            <?php echo $form['password']->renderRow(); ?>
            <?php echo $form['password_again']->renderError(); ?>
            <?php echo $form['password_again']->renderRow(); ?>
            
        </table>
        <input type="submit" class="saveFormButton" value="" />
    </div>
    <h3>Adres e-mail</h3>
    <div class="box_form">
        <table>
          
            <?php echo $form['email_address']->renderError(); ?>
            <?php echo $form['email_address']->renderRow(); ?>            
                
        </table>
        <input type="submit" class="saveFormButton" value="" />
    </div>
    <?php echo $form->renderHiddenFields() ?>
        
</form>
    
    <h3>Usuń firme z katalogu</h3>
    <div class="box_form" style="text-align: center;">
        
        <a href="<?php echo url_for('@panel_delete'); ?>" onclick="if (confirm('Na pewno chcesz usunąć?')) {} else return false;" class="deleteCompany">Potwierdzam chęć usunięcia firmy z katalogu</a>
        <div class="deleteCompanyText">
            Usunięty za pomocą powyższego przycisku wpis nie będzie mógł być przywrócony. 
            Usunięcie konta musi być potwierdzone przez administratora portalu (czas oczekiwania na decyzje ok 48h).
        </div>
        
    </div>
    
</div>    