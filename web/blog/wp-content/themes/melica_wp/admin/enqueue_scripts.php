<?php
/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

// no direct file access
! defined( 'ABSPATH' ) AND exit;

/**
 * Load required JavaScripts
 */
add_action( 'wp_enqueue_scripts', 'melica_enqueue_scripts' );
function melica_enqueue_scripts() {
	wp_enqueue_script( 'js-modernizr', MELICA_ASSETS_DIR . '/js/vendor/modernizr.custom.js' );
	wp_enqueue_script( 'js-google-maps', 'https://maps.google.com/maps/api/js?sensor=false', array( 'jquery' ), '', false );

	// lazy method :)
	$scripts = array(
		'/js/assets/jq.social-likes.js',
		'/js/assets/jq.cookies.js',
		'/js/assets/jq.matchHeight.js',
		'/js/assets/jq.photoset-grid.js',
		'/js/assets/jq.preloader.js',
		'/js/assets/jq.slick.js',
		'/js/assets/jq.tinynav.js',
		'/js/assets/jq.magnific-popup.js',
		'/js/assets/masonry.js',
		'/js/assets/scrollReveal.js',
		'/js/assets/smoothScroll.js',
		'/js/assets/fastclick.js',
		'/js/assets/instansive.js',
		'/js/main.js',
	);

	if(get_option('wp_is_demosite')) {
		array_unshift($scripts, '/js/demo.js');
	}

	foreach ( $scripts as $script ) {
		$handle  = basename( $script, '.js' );
		$handle  = str_replace( 'jq.', '', $handle );
		$handle  = 'js-' . strtolower( $handle );
		$js_path = MELICA_ASSETS_DIR . $script;

		if ( file_exists( get_stylesheet_directory() . $script ) ) {
			$js_path = get_stylesheet_directory_uri() . $script;
		}

		wp_enqueue_script( $handle, $js_path, array( 'jquery' ), '', true );
	}

	// child theme
	if ( file_exists( get_stylesheet_directory() . '/js/scripts.js' ) ) {
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '', true );
	}
}