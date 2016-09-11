<header class="nohover oembed">
	<?php if ( get_post_format() == 'audio' ): ?>
		<?php echo melica_remove_width_attribute( get_field( 'oembed', get_the_ID() ) ); ?>

	<?php else: ?>
		<div class="embed-responsive embed-responsive-16by9">
			<?php echo melica_remove_width_attribute( get_field( 'oembed', get_the_ID() ) ); ?>
		</div>

	<?php endif; ?>
</header>