<?php get_header(); ?>

<!-- ========= Content ========= -->
<section class="content">
    <h1 class="hvr-buzz"><?php _e('Oopss! 404', MELICA_LG) ?></h1>
    <p><?php _e('The page you are looking for has not been found', MELICA_LG); ?></p>

	<?php if(trim(melica_opt('404_text'))): ?>
		<p><?php
			echo wp_kses(
				melica_opt('404_text', null),
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
			)
			?></p>
	<?php endif ?>
</section>

<?php get_footer(); ?>