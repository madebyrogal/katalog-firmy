<?php include_partial('panel/menu', array('active' => 'gallery', 'company' => $company)); ?>
<?php $gallery = $company->getGalleries(); ?>
<div class="panel_box">
    <h3>Dodaj logo</h3>
    <div class="box_form" style="text-align: center">
        <form action="<?php echo url_for('@panel_gallery') ?>" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td style="width: 200px; vertical-align: top;">

                        
                        <?php $pic = $gallery->getDefaultPicture(); ?>
                        <?php if($pic): ?>
                            <img src="/uploads/thumbnails/logo/<?php echo $pic->getFile(); ?>" /><br />
                            <a href="<?php echo url_for('@panel_delete_logo'); ?>">usuń logo</a>
                        <?php else: ?>
                            <img src="/images/img.png" />
                        <?php endif; ?>

                        

                    </td>
                    <td>
                         <table>
                            <?php echo $form; ?>
                         </table>
                    </td>
                </tr>
            </table>
            <input type="submit" class="saveFormButton2" value="" />
        </form>        
    </div>
    
    <?php if($galleries && $pic && $company->getPromoted()): ?>
    
    <h3>Dodaj zdjęcia</h3>
    <form action="<?php echo url_for('@panel_gallery_pictures') ?>" method="post" enctype="multipart/form-data">
    <div class="box_form">        
      <table>
        <?php echo $galleries; ?>
     </table>
      <input type="submit" class="saveFormButton" value="" />
    </div>
    </form>
    
    <h3>Lista zdjęć</h3>
    <div class="box_form">        
        <?php include_partial('panel/pictures_list', array('gallery' => $gallery)); ?>
    </div>
    
    <?php endif; ?>
</div>