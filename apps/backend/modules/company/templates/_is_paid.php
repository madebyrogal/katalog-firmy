<?php if($company->getPacket() == 2): ?>
    nie dotyczy
<?php else: ?>
    <?php if($company->getIsPaid()): ?>
        <img alt="Checked" title="Checked" src="/sfDoctrinePlugin/images/tick.png" />
    <?php else: ?>
        <img src="/sfDoctrinePlugin/images/delete.png" />
    <?php endif; ?>
<?php endif; ?>