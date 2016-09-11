<div class="contents <?php melica_animate_class() ?>">
	<i class="fa fa-quote-left"></i>

	<blockquote>
		<?php
		echo wp_kses(
			get_field( 'quote_text' ),
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
		); ?>

		<small><?php echo esc_html(get_field( 'quote_author' )); ?></small>
	</blockquote>
</div>