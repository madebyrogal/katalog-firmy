<div class="span-16 last">
    <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <a class="pager_first" id="pager_1" href="<?php echo $url ?>?page=1">
            <img src="/images/first.png" alt="|<" title="|<" />
        </a>

        <a class="pager_previous" id="pager_<?php echo $pager->getPreviousPage() ?>" href="<?php echo $url ?>?page=<?php echo $pager->getPreviousPage() ?>">
            <img src="/images/previous.png" alt="<<" title="<<" />
        </a>

            <?php foreach ($pager->getLinks() as $page): ?>
                <?php if ($page == $pager->getPage()): ?>
                    <strong class="page_active"><?php echo $page ?></strong>
                <?php else: ?>
                        <a class="page_link" id="pager_<?php echo $page; ?>" href="<?php echo $url ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
                <?php endif; ?>
            <?php endforeach; ?>

        <a class="pager_next" id="pager_<?php echo $pager->getNextPage() ?>" href="<?php echo $url ?>?page=<?php echo $pager->getNextPage() ?>">
             <img src="/images/next.png" alt=">>" title=">>" />
        </a>

        <a class="pager_last" id="pager_<?php echo $pager->getLastPage() ?>" href="<?php echo $url ?>?page=<?php echo $pager->getLastPage() ?>">
            <img src="/images/last.png" alt=">|" title=">|" />
        </a>
    </div>
    <?php endif; ?>

    <div class="pagination_desc">
        <?php /*echo format_number_choice(
        '
            [0]Brak noclegów
            [1]Jeden nocleg
            [2,4]%count% noclegi
            [5,+Inf]%count% noclegów',
        array('%count%' => '<strong>'.$pager->getNbResults().'</strong>'),$pager->getNbResults()
        )*/
        ?>
        
        <?php /*if ($pager->haveToPaginate()): ?>
        <?php echo $pager->getNbResults() ?> - strona <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
        <?php endif;*/ ?>
    </div>

</div>