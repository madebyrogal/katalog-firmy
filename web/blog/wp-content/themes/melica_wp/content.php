<?php
// if page is fullwidth - make header awesome :)
if ( is_single() && ! melica_has_sidebar() ): ?>
	<div class="box-bg container"><?php get_template_part( 'inc/p-header', melica_get_pf_template() ) ?></div>
	<div class="box-bg-helper"><?php get_template_part( 'inc/p-header', melica_get_pf_template() ) ?></div>
<?php endif; ?>

<article <?php post_class(); ?>>

	<?php if ( !is_single() || melica_has_sidebar() ):
		get_template_part( 'inc/p-header', melica_get_pf_template() );
	endif; ?>

	<!-- meta info (title, category, author, etc..) -->
	<div class="meta">
		<div class="category"><?php echo get_the_category_list( ', ' ); ?></div>

		<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
				<?php if(is_sticky()): ?><i class="fa fa-star sticky-badge" title="<?php _e('This post is sticky.', MELICA_LG); ?>"></i><?php endif; ?>
				<?php the_title() ?>
			</a></h2>

		<div class="subline">
			<time datetime="<?php the_time( 'Y-m-d' ) ?>"><?php the_time( 'F j, Y' ) ?></time>
			<span><?php printf(
					__( 'By <a href="%s">%s</a>', MELICA_LG ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				) ?></span>
		</div>
	</div>

	<!-- article text -->
	<?php get_template_part( 'inc/p-content', get_post_format() ); ?>

	<!-- article subline -->
	<?php if ( is_single() ): ?>
		<!-- pagination -->
		<?php wp_link_pages(); ?>
	<?php else: ?>
		<!-- read more -->
		<div class="text-center read-more">
			<a class="btn btn-primary small" href="<?php the_permalink() ?>"><?php _e( 'Czytaj więcej', MELICA_LG ) ?></a>
		</div>
	<?php endif; ?>

	<!-- article footer -->
	<footer class="two-col">

		<?php if ( is_single() ): ?>
			<!-- display tags list -->
			<div class="tagcloud"><?php the_tags( '', ' ' ); ?></div>
		<?php else: ?>
			<!-- display comment count -->
			<div><a class="text-muted text-uppercase small" href="<?php comments_link() ?>">
					<?php melica_comment_count(); ?>
				</a></div>
		<?php endif; ?>

		<div>
			<div class="social-likes social-likes_single" data-url="<?php the_permalink() ?>" data-single-title="<?php echo __( 'Udostępnij', MELICA_LG ) ?>">
				<div class="facebook" title="<?php echo __( 'Share link on', MELICA_LG ) ?> Facebook">Facebook</div>
				<div class="twitter" title="<?php echo __( 'Share link on', MELICA_LG ) ?> Twitter">Twitter</div>
				<div class="plusone" title="<?php echo __( 'Share link on', MELICA_LG ) ?> Google+">Google+</div>
			</div>
		</div>
	</footer>
</article>


<?php
// Author bio
if ( is_single() && get_the_author_meta( 'description' ) ) :
	get_template_part( 'inc/author-bio' );
endif;
?>

<?php
// Posts switcher
if ( is_single() && ! is_page() ) :
	get_template_part( 'inc/adjacent-posts' );
endif;
?>

<?php
// Related articles
if ( is_single() && ! is_page() ) :
	get_template_part( 'inc/related-articles' );
endif;
?>


<?php
// Comments
comments_template();
?>