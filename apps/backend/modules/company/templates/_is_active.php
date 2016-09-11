<?php if($company->getIsActive()): ?>
    <img alt="Checked" title="Checked" src="/sfDoctrinePlugin/images/tick.png" />
<?php else: ?>
    <img src="/sfDoctrinePlugin/images/delete.png" />
<?php endif; ?>