<?php echo form_tag('@contact') ?>
<table cellspacing="0" cellpadding="0" border="0" class="sendEmails">
    <tr>
        <td>
            <span class="label_forms" 
                  <?php if ($form['name']->hasError())
                    echo 'style="color: red"' ?>>Imię i nazwisko:</span><br />
                  <?php echo $form['name']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <span class="label_forms"  <?php if ($form['email']->hasError())
                      echo 'style="color: red"' ?>>Adres e-mail:</span><br />
                  <?php echo $form['email']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <span class="label_forms"  <?php if ($form['text']->hasError())
                      echo 'style="color: red"' ?>>Treść zapytania:</span><br />
                  <?php echo $form['text']; ?>
        </td>

    </tr>
    <?php if ($contact->getHasCaptcha()) : ?>
        <tr>
            <td class="form_captcha">
                <span class="label_forms"  <?php if ($form['captcha']->hasError())
        echo 'style="color: red"' ?>>Przepisz tekst:</span><br />
    <?php echo $form['captcha']; ?>
            </td>
        </tr>
<?php endif ?>
    <tr>
        <td style="position: relative;">

            <?php if ($sf_user->hasFlash('notice')): ?>
                <h4 class="noticesend"><?php echo $sf_user->getFlash('notice') ?></h4>
<?php endif; ?>

            <input type="submit" value="" class="send" />
        </td>
    </tr>
</table>
</form>