<h3 class="header header_left">Płatności</h3>


<h2><?php echo $text->getName(); ?></h2>

<div>
    <?php echo $text->getContent(ESC_RAW); ?>
</div>

<div style="text-align: center;">
    <a href="<?php echo url_for('@panel'); ?>" class="button">Panel klienta</a>
</div>