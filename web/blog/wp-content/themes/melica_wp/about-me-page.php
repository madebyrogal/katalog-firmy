<?php
/*
 * Template Name: "About me" page
 */

get_header();
the_post();

// sidebar & classes
$show_sidebar   = melica_has_sidebar();
$layout_classes = melica_get_layout();
?>

	<section class="container nopadding-sm">

		<!-- title -->
		<h1 class="section-title"><?php the_title(); ?></h1>

		<!-- content -->
		<div class="row">

			<main class="<?php echo esc_attr($layout_classes[0]); ?>">
				<article <?php post_class(); ?>>

					<!-- text -->
					<div class="row profile-line">
						<div class="col-sm-6 image-col">
							<img class="img-responsive img-circle" src="<?php echo esc_attr(get_field( 'photo' )) ?>" alt=""/>
						</div>

						<div class="col-sm-6 text-col">
							<h3><?php echo esc_html(get_field( 'display_name' )) ?></h3>

							<p><?php echo wp_kses(
									get_field( 'profile_subline' ),
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
								); ?></p>

							<?php if ( have_rows( 'social_profiles' ) ): ?>
								<ul class="socials-list invert">

									<?php while ( have_rows( 'social_profiles' ) ): the_row(); ?>
										<li><a href="<?php echo esc_url( get_sub_field( 'profile_url' ) ) ?>">
												<i class="fa <?php echo esc_attr( get_sub_field( 'icon' ) ) ?>"></i>
											</a></li>
									<?php endwhile; ?>

								</ul>
							<?php endif; ?>
						</div>
					</div>

					<!-- Tab toggles -->
					<?php if ( have_rows( 'tabs' ) ): ?>
					<ul class="tab-toggles">
					<?php $ti = 0; while ( have_rows( 'tabs' ) ): the_row(); $ti ++; ?>
						<li <?php if ( $ti === 1 ) echo 'class="active"' ?>>
							<a href="#<?php echo melica_get_tabhash( get_sub_field( 'tab_title' ) ); ?>" data-toggle="slick-tab"><?php echo esc_html(get_sub_field( 'tab_title' )) ?></a>
						</li>
					<?php endwhile; ?>
					</ul>
					<?php endif; ?>

					<!-- Tab toggles -->
					<?php if ( have_rows( 'tabs' ) ): ?>
					<div class="tab-contents" data-slick-tabs>
					<?php while ( have_rows( 'tabs' ) ): the_row(); ?>
						<div id="<?php echo melica_get_tabhash( get_sub_field( 'tab_title' ) ); ?>">
							<?php echo do_shortcode(melica_content_filter(get_sub_field( 'tab_content', false ))) ?>
						</div>
					<?php endwhile; ?>
					</div>
					<?php endif; ?>

					<!-- page text -->
					<?php the_content(); ?>

					<!-- pagination -->
					<?php wp_link_pages(); ?>

					<!-- share button -->
					<div class="text-right">
						<div class="social-likes social-likes_single" data-url="<?php the_permalink() ?>" data-single-title="<?php echo __( 'Share', MELICA_LG ) ?>">
							<div class="facebook" title="<?php echo __( 'Share link on', MELICA_LG ) ?> Facebook">Facebook</div>
							<div class="twitter" title="<?php echo __( 'Share link on', MELICA_LG ) ?> Twitter">Twitter</div>
							<div class="plusone" title="<?php echo __( 'Share link on', MELICA_LG ) ?> Google+">Google+</div>
						</div>
					</div>
				</article>
			</main>

			<?php if ( $show_sidebar ) : ?>
				<aside class="<?php echo esc_attr($layout_classes[1]); ?>">
					<?php dynamic_sidebar( 'primary-sidebar' ) ?>
				</aside>
			<?php endif; ?>

		</div>

	</section>


<?php get_footer(); ?>