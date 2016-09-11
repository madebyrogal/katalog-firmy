<?php

// get adjacent posts
$prevPost = get_adjacent_post( false, '', true, 'category' );
$nextPost = get_adjacent_post( false, '', false, 'category' );

// get links to posts
$prevPostLink = ( $prevPost instanceof WP_Post ) ? get_permalink( $prevPost ) : false;
$nextPostLink = ( $nextPost instanceof WP_Post ) ? get_permalink( $nextPost ) : false;

// get post titles
$prevTitle = ( $prevPostLink ) ?
	wp_kses_post( get_the_title( $prevPost ) ) :
	esc_html__( 'This is an oldest item', MELICA_LG );

$nextTitle = ( $nextPostLink ) ?
	wp_kses_post( get_the_title( $nextPost ) ) :
	esc_html__( 'This is a newest item', MELICA_LG );
?>


<section class="box post-switcher">

	<!-- Previous post link -->
	<a href="<?php echo esc_attr( $prevPostLink ); ?>" class="prev-post <?php if ( ! $prevPostLink ) echo 'disabled'; ?>">
		<div class="button-dir"><?php esc_html_e( 'Poprzedni post', MELICA_LG ); ?></div>
		<div class="post-title"><?php echo $prevTitle; ?></div>
	</a>


	<!-- Next post link -->
	<a href="<?php echo esc_attr( $nextPostLink ); ?>" class="next-post <?php if ( ! $nextPostLink ) echo 'disabled'; ?>">
		<div class="button-dir"><?php esc_html_e( 'Następny post', MELICA_LG ); ?></div>
		<div class="post-title"><?php echo $nextTitle; ?></div>
	</a>

</section>