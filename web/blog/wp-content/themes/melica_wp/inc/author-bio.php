<section class="box author-info"><div class="row">

	<!-- avatar -->
	<div class="avatar-col hidden-xs col-sm-3" data-mh="box-authorinfo">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 150 ); ?>
	</div>

	<!-- text -->
	<div class="col-sm-9" data-mh="box-authorinfo">
		<h1 class="name"><?php echo get_the_author(); ?></h1>
		<p data-sr="enter top"><?php the_author_meta( 'description' ); ?></p>

		<?php
		$acf_usr = 'user_' . get_the_author_meta( 'ID' );
		if ( have_rows( 'author_socials', $acf_usr ) ): ?>
			<ul class="socials-list invert">

				<?php while ( have_rows( 'author_socials', $acf_usr ) ): the_row(); ?>
					<li><a href="<?php echo esc_url( get_sub_field( 'profile_url' ) ) ?>">
							<i class="fa <?php echo esc_attr( get_sub_field( 'icon' ) ) ?>"></i>
						</a></li>
				<?php endwhile; ?>

			</ul>
		<?php endif; ?>
	</div>

</div></section>