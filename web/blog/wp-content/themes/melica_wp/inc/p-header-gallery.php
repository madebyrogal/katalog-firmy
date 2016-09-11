<?php $images = get_field('images'); if(!$images) return; ?>

<header class="slick with-arrows" data-slider>
	<?php foreach( $images as $image ):
		$image = (isset($image['sizes']['melica_article_img'])) ? $image['sizes']['melica_article_img'] : $image['url'];
	?>
	<div><img src="<?php echo esc_url($image); ?>" alt=""/></div>
	<?php endforeach; ?>
</header>