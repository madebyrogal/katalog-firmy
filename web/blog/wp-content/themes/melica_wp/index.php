<?php

// header
get_header();


// sidebar & classes
$show_sidebar   = melica_has_sidebar();
$layout_classes = melica_get_layout();
if(is_single() || is_page()) {
	$layout_classes[0] .= ' animate-paragraphs';
}

$masonry_grid = '';
if ( melica_is_masonry() ) {
	$masonry_grid = 'data-masonry="' . esc_attr(melica_get_masonry_cols()) . '"';
}


// title
if(is_category()) { // category page title
	$page_title = single_cat_title( '', false );

} else if(is_archive()) { // archive page title(tags, authors, and more)
	$page_title = melica_custom_archive_title(get_the_archive_title());

} else if(is_search()) { // search page
	$page_title = melica_custom_archive_title(
		__( 'Wyniki wyszukiwania dla: ', MELICA_LG ) . esc_html( get_search_query() )
	);

} else if(is_page() && !is_front_page() && !is_home()) { // for static pages
	$page_title = single_post_title( '', false );

} else if(melica_is_masonry()) {
	$page_title = __('Ostatnie posty', MELICA_LG);

} else { // all other pages
	$page_title = null;
}

?>

<section class="container nopadding-sm">
		<h3 style="margin: 0px !important;padding: 0px !important;font-size: 0px !important;">&nbsp;</h3>
	<!-- title -->
	<?php if($page_title || melica_is_masonry()): ?>
		<h1 class="section-title"><?php echo $page_title; ?></h1>
	<?php endif; ?>

	<!-- content -->
	<div class="row">

		<main class="<?php echo esc_attr($layout_classes[0]); ?>" <?php echo $masonry_grid; ?>>
			<?php get_template_part('loop'); ?>
		</main>

		<?php
		// display masonry pagination
		if(melica_is_masonry()) {
			melica_pagination();
		} ?>

		<?php if($show_sidebar) : ?>
		<aside class="<?php echo esc_attr($layout_classes[1]); ?>">
			<?php dynamic_sidebar('primary-sidebar') ?>
		</aside>
		<?php endif; ?>

	</div>

</section>

<?php get_footer(); ?>