<div class="company_one comapny_one_promoted">

    <a href="<?php echo url_for('company', $object); ?>">
        <?php $gallery = $object->getGalleries(); ?>
        <?php $pic = $gallery->getDefaultPicture(); ?>
        <?php if($pic): ?>
            <img class="comapny_one_logo" src="/uploads/thumbnails/logo/<?php echo $pic->getFile(); ?>" alt="Logo firmy <?php echo $object->getName(); ?>" />
        <?php else: ?>
            <img class="comapny_one_logo" src="/images/img.png" alt="Brak loga" />
        <?php endif; ?>
    </a>
    <div class="company_one_address">
        <span class="company_one_name"><a href="<?php echo url_for('company', $object); ?>"><?php echo $object->getName(); ?></a></span>
        ul. <?php echo $object->getStreet(); ?><br />
        <?php echo $object->getPostCode(); ?> <?php echo $object->getCity(); ?>, woj. <?php echo $object->getState(); ?>
    </div>
    <?php /*if($object->getPromoted()): -- wszystkie sa promocyjne */ ?>
		<a href="" class="company_one_button" id="companyId_<?php echo $object->getPrimaryKey(); ?>"></a>        
    <?php /* endif; */ ?>
    <a href="<?php echo url_for('company', $object); ?>" class="company_one_more">więcej &raquo;</a>

    <div class="company_one_owns">
        <span class="company_one_owns_head">Oferta dla:</span>
        <?php  $types = $object->getType(); ?>
        <?php $i = 0; ?>
        <?php foreach($types as $type): ?>
            <img src="/images/type<?php echo $type->getId(); ?>.png" alt="<?php echo $type->getName(); ?>" />
            <?php if(++$i == 1): ?>
                <hr />
            <?php  endif; ?>
        <?php endforeach; ?>
    </div>

</div>

<hr class="company_one_hr" />