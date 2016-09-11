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
 * Retrieve theme option
 *
 * @param      $index
 * @param null $default
 * @param bool $escape
 *
 * @return null|string|void
 */
function melica_opt( $index, $default = null, $escape = false ) {
	$out = do_shortcode(vp_option( 'melica_options.' . $index, $default ));

	return ( $escape ) ? esc_attr( $out ) : $out;
}


/**
 * Converter object => array
 *
 * @param $d
 *
 * @return array
 */
function melica_object_to_array( $d ) {
	if ( is_object( $d ) ) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars( $d );
	}

	if ( is_array( $d ) ) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map( __FUNCTION__, $d );
	} else {
		// Return array
		return $d;
	}
}


/**
 * Get list of socials
 *
 * @return array
 */
function melica_socials() {
	$socials = array( 'facebook', 'twitter', 'dribbble', 'google', 'linkedin', 'pinterest', 'instagram' );

	$out = array();
	foreach ( $socials as $network ) {
		$network_url = melica_opt( $network . '_url' );
		$class       = $network;

		// class switch
		switch ( $network ) {
			case 'google':
				$class = 'google-plus';
				break;

		}

		// if network url is not available
		if ( ! $network_url ) {
			continue;
		}

		$out[] = array( 'title' => ucfirst( $network ), 'url' => $network_url, 'class' => 'fa-' . $class );
	}

	return $out;
}


/**
 * Trim text by words with char limit
 *
 * @param     $text
 * @param int $len
 *
 * @return string
 */
function melica_trim_text( $text, $len = 150 ) {
	$word_count = $len;
	$text       = strip_tags( $text, '<br><p>' );
	$text       = preg_replace( array( '/\\[.*\\]/sU', '/\s+/' ), array('', ' '), $text );

	while ( true ) {
		$text = wp_trim_words( $text, $word_count );
		if ( strlen( $text ) <= $len ) {
			break;
		}
		$word_count --;
	}

	// fix bad ending problem
	$bad_ending     = '.' . __( '&hellip;', MELICA_LG );
	$bad_ending_len = strlen( $bad_ending );
	if ( strpos( $text, $bad_ending ) == strlen( $text ) - $bad_ending_len ) {
		$text = substr( $text, 0, - $bad_ending_len ) . __( '&hellip;', MELICA_LG );
	}

	return $text;
}

add_action('wp_nav_menu_objects', 'melica_process_menu');
function melica_process_menu($objects) {
	foreach($objects as $item) {
		if(!isset($item->classes)) continue;

		if(in_array('menu-item-has-children', $item->classes)) {

			if(@$item->menu_item_parent == '0') $class = 'fa-angle-down';
			else $class = 'fa-angle-right';

			$item->title .= "<i class=\"fa {$class}\"></i>";
		}
	}

	return $objects;
}


/**
 * Classes for HTML element
 *
 * @return string
 */
function melica_html_class() {
	$melica_classes = array('no-js');
	if(melica_is_masonry()) {
		$melica_classes[] = 'big-grid';
	}

	if(!melica_opt('enable_reveals', false)) {
		$melica_classes[] = 'no-sr-animations';
	}

	if(is_404()) {
		$melica_classes[] = 'error-page disable-sticky-footer';
	}

	$classes = apply_filters( 'html_class', $melica_classes );

	return join(' ', $classes);
}


/**
 * Remove "customize" page from menu
 */
add_action( 'admin_menu', 'melica_remove_customize_page' );
function melica_remove_customize_page() {
	global $submenu;
	unset( $submenu['themes.php'][6] );
}


/**
 * Mute second part of string
 *
 * @param $title
 *
 * @return string
 */
function melica_custom_archive_title($title) {

	$title_arr = array_map('trim', explode(':', $title, 2));

	if(sizeof($title_arr) == 2) {
		$title_arr[1] = ' <span class="text-muted">' . $title_arr[1] . '</span>';
		$title = join(':', $title_arr);
	}

	return $title;
}


/**
 * Check sidebar settings for current page
 *
 * @return bool
 */
function melica_has_sidebar() {
	$sidebar_is_active = is_active_sidebar('primary-sidebar');

	if(is_single()) {

		$cfields = get_post_custom(get_the_ID());
		if(!isset($cfields['hide_sidebar_onthispage'])) {
			$option = melica_opt( 'sidebar_on_posts', false );
		} else {
			$option = false;
		}

	} else if(is_page() && !is_front_page() && !is_home()) {
		$option = melica_opt('sidebar_on_pages', false);
	} else {
		$option = melica_opt('sidebar_on_archives', false);
	}

	return $sidebar_is_active && $option && !melica_is_masonry();
}


/**
 * Returns CSS classes for layout
 */
function melica_get_layout() {
	$show_sidebar = melica_has_sidebar();
	$layout_classes = array('col-sm-8 ' . melica_animate_class(), 'sidebar col-sm-4 ');

	if(!$show_sidebar) {
		$layout_classes[0] = 'col-xs-12 ';
	}

	if($show_sidebar && melica_opt('sidebar_position', 'right') === 'left') {
		$layout_classes[0] .= 'col-sm-push-4';
		$layout_classes[1] .= 'col-sm-pull-8';
	}

	return $layout_classes;
}


/**
 * Custom post classes
 */
add_filter( 'post_class', 'melica_add_post_class' );
function melica_add_post_class($classes) {

	if(!is_single() && !is_page()) $classes[] = 'short-story';
	if(!is_page()) $classes[] = 'post-entry';
	$classes[] = 'box';

	return $classes;
}


/**
 * Echo pluralised comment count
 */
function melica_comment_count() {
	if(!comments_open()) {
		_e('Komentowanie wyłączone', MELICA_LG);
	} else {
		printf( _n( '1 comment', '%s comments', get_comments_number(), MELICA_LG ), get_comments_number() );
	}
}


/**
 * Remove width/height of featured image
 */
add_filter( 'post_thumbnail_html', 'melica_remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'melica_remove_width_attribute', 10 );
add_filter( 'the_content', 'melica_remove_width_attribute', 10 );

function melica_remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );

	return $html;
}


/**
 * Return the list of related posts
 *
 * @param int $count
 *
 * @return array|bool
 */
function melica_get_related( $count = 5 ) {
	$post_id = get_the_ID();
	$tags    = wp_get_post_tags( $post_id );

	if ( ! $tags ) {
		return false;
	}

	$posts_arr = array();
	foreach ( $tags as $individual_tag ) {
		$tag_id = $individual_tag->term_id;
		$args = array(
			'tag_id'              => $tag_id,
			'post__not_in'        => array( $post_id ),
			'posts_per_page'      => $count,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'meta_query'          => array( array( 'key' => '_thumbnail_id' ) )
		);

		$posts_q = new wp_query( $args );
		foreach ( $posts_q->get_posts() as $post ) {
			$posts_arr[] = $post;
		}
	}

	if ( sizeof( $posts_arr ) >= $count ) {
		$posts_arr = array_unique($posts_arr, SORT_REGULAR);
		shuffle( $posts_arr );

		return array_slice( $posts_arr, 0, $count );
	}

	return false;
}


/**
 * Return post format template
 *
 * @return mixed|string
 */
function melica_get_pf_template() {
	$post_format = get_post_format(get_the_ID());
	$tpl = $post_format;

	if($post_format == 'video' || $post_format == 'audio') {
		$tpl = 'oembed';
	}

	return $tpl;
}


/**
 * Return animation class.
 *
 * @return string
 */
function melica_animate_class() {
	if(!is_single() && !is_page()) {
		return 'animate ';
	}

	return '';
}


/**
 * Calculate and return hash based on tab title
 *
 * @param $title
 *
 * @return string
 */
function melica_get_tabhash($title) {
	return 'tab-' . substr(md5($title), 0, 5);
}

/**
 * Check for masonry grid on this page
 *
 * @return bool|mixed|null|void
 */
function melica_is_masonry() {

	if(isset($GLOBALS['melica_homepage_id'])) {
		$masonry = get_field('use_masonry_grid', $GLOBALS['melica_homepage_id']);
	} else {
		$masonry = false;
	}

	return $masonry;
}

function melica_get_masonry_cols() {
	if(isset($GLOBALS['melica_homepage_id'])) {
		$cols = get_field('masonry_columns', $GLOBALS['melica_homepage_id']);
	} else {
		$cols = 3;
	}

	return $cols;
}