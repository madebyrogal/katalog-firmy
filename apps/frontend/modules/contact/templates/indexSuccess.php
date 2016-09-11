<h3 class="header header_left">Kontakt</h3>
<div class="contact">
    <h2>Dane kontaktowe</h2>
    
    <div class="contact_box">
        <?php echo $contact->getAddress(ESC_RAW); ?>
    </div>
    
    <h2>Napisz do nas</h2>
    
    <div class="contact_box">    
        <?php include_partial('contact/form', array('form' => $form, 'contact' => $contact)); ?>
    </div>
    
    <br /><br />
</div>
