<h3 class="header h_menu header_left">Podsumowanie</h3>  

<div class="max_box">
    <div class="box_form">
        <h2><?php echo $text->getName(); ?></h2>
        
        <div>
            <?php echo $text->getContent(ESC_RAW); ?>
        </div>
    </div>
    <div style="text-align: center;">
        <a href="<?php echo url_for('@panel'); ?>" class="button">Panel klienta</a>
    </div>
</div>
