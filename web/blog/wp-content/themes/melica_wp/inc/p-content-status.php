<?php
$status_text = wp_kses(
	get_field( 'status_text' ),
	array(
		'a'      => array(
			'href'  => array(),
			'title' => array()
		),
		'p'      => array(),
		'br'     => array(),
		'em'     => array(),
		'b'      => array(),
		'i'      => array(),
		'strong' => array()
	)
);
?>

<div class="contents <?php melica_animate_class() ?> <?php if(strpos(get_field( 'status_icon' ), 'twitter') !== FALSE) echo 'is-twitter'; ?>">
	<i class="fa <?php echo esc_attr(get_field( 'status_icon' )) ?>"></i>

	<?php if ( get_field( 'link' ) ): ?>
		<a href="<?php echo esc_url(get_field( 'link' )) ?>" target="_blank"><?php echo $status_text; ?></a>
	<?php else: ?>
		<?php echo $status_text; ?>
	<?php endif; ?>
</div>