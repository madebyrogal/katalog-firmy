<?php

// if slider is not needed - exit from this file
if(get_field('slider_enabled') !== TRUE || $paged > 1) return;

// setup slider class
$slider_class = 'header-nomargin';
if(get_field('fullscreen_slider') !== TRUE) {
	$slider_class .= ' narrow-slider';
}

// posts list
if(get_field('has_custom_items') !== TRUE) {
	$slider_posts = get_posts( array( 'posts_per_page' => 5, 'tag' => 'featured', 'post_type' => 'post' ) );

	// display error if there is no posts found
	if(empty($slider_posts)): ?>
		<section class="alert alert-danger text-center header-nomargin" style="margin: 22px">
			<?php _e('SLIDER: Posts with tag "featured" not found.', MELICA_LG); ?>
		</section>
	<?php return; endif;
} else {
	$slider_posts = get_field('custom_items');
}
?>

<!-- ========= Big Slider ========= -->
<section id="slider-container" class="<?php echo $slider_class ?>">

	<?php foreach($slider_posts as $post):
		setup_postdata($post);

		// setup image
		$post_image = MELICA_ASSETS_DIR . '/images/slider-placeholder.png';
		if(has_post_thumbnail()) {
			$post_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		}
		$post_image = esc_attr($post_image);
	?>
	<div>
		<div class="image-bg" style="background-image: url('<?php echo esc_attr($post_image) ?>');"></div>

		<div class="caption">
			<div class="post-categories"><?php echo get_the_category_list(', '); ?></div>
			<h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
		</div>
	</div>
	<?php endforeach; wp_reset_postdata(); ?>

</section>