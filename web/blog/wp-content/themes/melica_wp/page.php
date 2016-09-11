<?php
get_header();
the_post();

// sidebar & classes
$show_sidebar   = melica_has_sidebar();
$layout_classes = melica_get_layout();

// title
$content     = get_the_content();
$inner_title = false;
if ( has_shortcode( $content, 'header' ) ) {
	$inner_title = true;
}
$content = do_shortcode( $content );


// $GLOBALS['melica_pheader'] contains a HTML output from [header] shortcode
// that is can be used in pages
if ( ! isset( $GLOBALS['melica_pheader'] ) ) {
	$GLOBALS['melica_pheader'] = '';
}
?>

<section class="container nopadding-sm">

	<!-- title -->
	<?php if ( !$inner_title ): ?>
		<h1 class="section-title"><?php the_title(); ?></h1>
	<?php endif; ?>

	<!-- content -->
	<div class="row">

		<main class="<?php echo esc_attr($layout_classes[0]); ?>">
			<?php
			// if page is fullwidth - make header awesome :)
			if ( ! melica_has_sidebar() ): ?>
				<div class="box-bg container"><?php echo  ($GLOBALS['melica_pheader']); ?></div>
				<div class="box-bg-helper"><?php echo  ($GLOBALS['melica_pheader']); ?></div>
			<?php endif; ?>

			<article <?php post_class(); ?>>

				<!-- page header -->
				<?php if ( melica_has_sidebar() ) {
					echo  ($GLOBALS['melica_pheader']);
				} ?>

				<!-- title -->
				<?php if ( $inner_title ): ?>
					<h1 class="section-title"><?php the_title(); ?></h1>
				<?php endif; ?>

				<!-- page text -->
				<?php the_content(); ?>

				<!-- pagination -->
				<?php wp_link_pages(); ?>

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