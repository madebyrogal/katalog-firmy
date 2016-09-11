<?php if ($sf_user->hasFlash('notice')): ?>
<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
  <p>
    <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
    <?php echo $sf_user->getFlash('notice') ?>
  </p>
</div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
<div class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
  <p>
    <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
    <?php echo $sf_user->getFlash('error') ?>
  </p>
</div>
<?php endif; ?>