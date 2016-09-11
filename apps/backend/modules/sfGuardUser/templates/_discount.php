<?php $discount = $sf_guard_user->getConstantUserDiscount(); ?>
<?php $value = $discount->getDiscount($sf_guard_user); ?>
<?php echo $value.' %'; ?>
<?php echo $value ? ' - '. $discount->getTranslatedName() : ''; ?>