<?php if($form->getObject()->getFile()): ?>
<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_cv">
    <div>
      <label for="applications_file">Plik</label>
      <div class="content">

          <a href="/uploads/files/<?php echo $form->getObject()->getFile(); ?>">Pobierz plik</a>

      </div>
    </div>
</div>
<?php endif; ?>