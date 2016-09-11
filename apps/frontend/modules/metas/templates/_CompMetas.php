<?php
    /*
    echo '<pre>';
    print_r($metas);
    echo '</pre>';
     */
?>

<?php if(!empty($metas['title'])): ?><title><?php echo $metas['title']; ?></title><?php endif; ?>
<?php if(!empty($metas['description'])): ?><meta name="description" content="<?php echo $metas['description']; ?>" /><?php endif; ?>
<?php if(!empty($metas['keywords'])): ?><meta name="keywords" content="<?php echo $metas['keywords']; ?>" /><?php endif; ?>
<?php if(!empty($metas['copyright'])): ?><meta name="copyright" content="<?php echo $metas['copyright']; ?>" /><?php endif; ?>
<?php if(!empty($metas['author'])): ?><meta name="author" content="<?php echo $metas['author']; ?>" /><?php endif; ?>
<?php if(!empty($metas['email'])): ?><meta name="email" content="<?php echo $metas['email']; ?>" /><?php endif; ?>
<?php if(!empty($metas['distribution'])): ?><meta name="Distribution" content="<?php echo $metas['distribution']; ?>" /><?php endif; ?>
<?php if(!empty($metas['rating'])): ?><meta name="Rating" content="<?php echo $metas['rating']; ?>" /><?php endif; ?>
<?php if(!empty($metas['robots'])): ?><meta name="Robots" content="<?php echo $metas['robots']; ?>" /><?php endif; ?>
<?php if(!empty($metas['revisitafter'])): ?><meta name="Revisit-after" content="<?php echo $metas['revisitafter']; ?>" /><?php endif; ?>
<?php if(!empty($metas['expires'])): ?><meta name="expires" content="<?php echo $metas['expires']; ?>" /><?php endif; ?>
