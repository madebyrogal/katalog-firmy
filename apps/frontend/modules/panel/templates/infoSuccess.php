<?php include_partial('panel/menu', array('active' => 'info', 'company' => $company)); ?>

<div class="panel_box">

<form action="<?php echo url_for('@panel') ?>" method="post">
    
    <h3>Podstawowe informacje o firmie</h3>
    <div class="box_form">
        <table>
            <tr>
                <td style="width: 200px; vertical-align: top;">
                    
                    <?php $gallery = $company->getGalleries(); ?>
                    <?php $pic = $gallery->getDefaultPicture(); ?>
                    <?php if($pic): ?>
                        <img src="/uploads/thumbnails/logo/<?php echo $pic->getFile(); ?>" />
                    <?php else: ?>
                        <img src="/images/img.png" />
                    <?php endif; ?>
                    
                    <br /><br />
                    <a href="<?php echo url_for('@panel_gallery') ?>"><img src="/images/add_logo.png" /></a>
                    
                </td>
                <td>
                    
                    <table>
                        <?php echo $form['name']->renderError(); ?>
                        <?php echo $form['name']->renderRow(); ?>
                        <?php echo $form['city']->renderError(); ?>
                        <?php echo $form['city']->renderRow(); ?>
                        <?php echo $form['post_code']->renderError(); ?>
                        <?php echo $form['post_code']->renderRow(); ?>
                        <?php echo $form['street']->renderError(); ?>
                        <?php echo $form['street']->renderRow(); ?>
                        <?php echo $form['state']->renderError(); ?>
                        <?php echo $form['state']->renderRow(); ?>
                        <?php echo $form['nip']->renderError(); ?>
                        <?php echo $form['nip']->renderRow(); ?>
                        <?php echo $form['phone']->renderError(); ?>
                        <?php echo $form['phone']->renderRow(); ?>
                        <?php echo $form['mobile']->renderError(); ?>
                        <?php echo $form['mobile']->renderRow(); ?>
                        <?php echo $form['fax']->renderError(); ?>
                        <?php echo $form['fax']->renderRow(); ?>
                        <?php echo $form['www']->renderError(); ?>
                        <?php echo $form['www']->renderRow(); ?>
                        <?php echo $form['email_address']->renderError(); ?>
                        <?php echo $form['email_address']->renderRow(); ?>
                        <?php #echo $form['gg']->renderError(); ?>
                        <?php #echo $form['gg']->renderRow(); ?>
                        <?php #echo $form['skype']->renderError(); ?>
                        <?php #echo $form['skype']->renderRow(); ?>
                        <?php echo $form['fb']->renderError(); ?>
                        <?php echo $form['fb']->renderRow(); ?>
                        <?php echo $form['yt']->renderError(); ?>
                        <?php echo $form['yt']->renderRow(); ?>
                    </table>
                    
                    
                </td>
            </tr>
        </table>
        
        <input type="submit" class="saveFormButton" value="" />
    </div>
    
    <?php if($company->getPromoted()): ?>
    <h3>Opis</h3>
    <div class="box_form">
        <table>
            <?php echo $form['description']->renderError(); ?>
            <?php echo $form['description']->renderRow(); ?>
        </table>
        <input type="submit" class="saveFormButton" value="" />
    </div>
    <?php endif; ?>
    
    
    <h3>Kategorie</h3>
    <div class="box_form">
        <table>
            <?php echo $form['categories_list']->renderError(); ?>
            <?php echo $form['categories_list']->renderRow(); ?>
            
            
            
        </table>
        <div id="selectedCategory">
                
        </div>

        <a href="#" class="addCategory">dodaj kategorie</a>
        <input type="submit" class="saveFormButton" value="" />
    </div>
    
    <h3>Typ oferty</h3>
    <div class="box_form">
        <table>
            <?php echo $form['type_list']->renderError(); ?>
            <?php echo $form['type_list']->renderRow(); ?>            
        </table>
        <input type="submit" class="saveFormButton" value="" />
    </div>
    

    <?php //echo $form; ?>

    <?php echo $form->renderHiddenFields() ?>
</form>
    
</div>    

<?php include_partial('default/addCategory'); ?>