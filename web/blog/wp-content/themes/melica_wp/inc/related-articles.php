<?php
	$related_posts = melica_get_related();
	if(!$related_posts || !isset($related_posts) || empty($related_posts)) return;
?>

<section class="box with-header">
	<h1 class="title"><span><?php _e('Możesz również lubić', MELICA_LG) ?></span></h1>

	<div class="post-list-row">
		<div class="post-list regular smart-slider vertical">

			<?php foreach($related_posts as $post): setup_postdata($post);
				$post_id = get_the_ID();

				$post_image = MELICA_ASSETS_DIR . '/images/widget-placeholder.png';
				if(has_post_thumbnail()) {
					$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'melica_article_thumb' );
				}
				$post_image = (is_array($post_image)) ? esc_attr($post_image[0]) : $post_image;

				// fallback
				if(!$post_image) {
					$post_image = MELICA_ASSETS_DIR . '/images/widget-placeholder.png';
				}
			?>
			<article>
				<!-- image -->
				<div class="main-image">
					<img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
				</div>

				<!-- post info -->
				<div class="post-info">
					<h1 class="title"><?php the_title() ?></h1>
					<time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j F Y') ?></time>
				</div>

				<!-- link -->
				<a class="link" href="<?php the_permalink() ?>"><?php _e('Czytaj więcej', MELICA_LG) ?></a>
			</article>

			<?php endforeach; wp_reset_postdata(); ?>
		</div>
	</div>
</section>