<div id="search_content">

    <?php if(count($objects) > 0): ?>
        <?php foreach($objects as $object): ?>

            <?php include_partial('company/company_one', array('object' => $object)); ?>

        <?php endforeach; ?>
    <?php else: ?>
    brak wyników
    <?php endif; ?>

    <div id="search_background"></div>

</div>