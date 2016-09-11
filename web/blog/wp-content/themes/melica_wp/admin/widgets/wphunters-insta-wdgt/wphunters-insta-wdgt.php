<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}


// load modules
require_once 'instagram-api.php';

/**
 * Cut str to limit
 *
 * @param        $str
 * @param        $limit
 * @param string $end
 *
 * @return string
 */
function wph_insta_cut_str( $str, $limit, $end = '..' ) {

	// get length of string
	if ( function_exists( 'mb_strlen' ) ) {
		$strlen = mb_strlen( $str, 'UTF-8' );
	} else {
		$strlen = strlen( $str );
	}

	if ( $strlen <= $limit ) {
		return $str;
	}

	return substr( $str, 0, $limit ) . $end;
}

// define class for widget
class WPH_Widget_Instagram extends WP_Widget {

	function __construct() {
		parent::__construct(
			// base ID of your widget
			'wph_instagram',
			// widget name will appear in UI
			__( 'Instagram widget', MELICA_LG ),
			// widget description
			array( 'description' => __( 'Displays latest photos from user\'s profile.', MELICA_LG ) )
		);
	}

	// enable widget settings
	public function form( $instance ) { echo '<p></p>'; }

	// widget front-end
	public function widget( $args, $instance ) {
		$title        = apply_filters( 'widget_title', get_field( 'title', 'widget_' . $this->id ) );
		$user_id      = get_field( 'instagram_user_id', 'widget_' . $this->id );
		$access_token = get_field( 'instagram_access_token', 'widget_' . $this->id );
		$photos_limit = get_field( 'photos_limit', 'widget_' . $this->id );

		// set defaults
		if ( ! $title ) {
			$title = 'Instagram';
		}

		if ( ! is_numeric( $photos_limit ) || $photos_limit < 0 ) {
			$photos_limit = 6;
		}

		// before and after widget arguments are defined by themes
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

		// run logic
		try {
			$instagram = new MetzWeb\Instagram\Instagram( '' );
			$instagram->setAccessToken( $access_token );
			$cache_key = 'wph_instagram_' . md5( serialize( $args ) . $access_token . $user_id . $photos_limit );

			// load data from cache
			if ( false === ( $photos = get_transient( $cache_key ) ) ) {
				$photos = $instagram->getUserMedia( $user_id, $photos_limit )->data;
				set_transient( $cache_key, $photos, HOUR_IN_SECONDS );
			}

		} catch ( Exception $e ) { // show errors
			echo '<b>Error!</b>' . $e->getMessage();
			echo $args['after_widget'];
			return;
		}

		// second check
		if(!is_array($photos) || empty($photos)) {
			echo '<b>Error!</b> No photos here!';
			echo $args['after_widget'];
			return;
		}

		// run output
		echo '<ul class="instagram-feed small-padding block-grid-xs-3">';
		foreach ( $photos as $photo ) {
			$photo_url = esc_attr( $photo->link );
			$thumb     = esc_url( $photo->images->thumbnail->url );
			$caption   = '';
			if ( $photo->caption ) {
				$caption = esc_attr( wph_insta_cut_str( $photo->caption->text, 150 ) );
			}

			echo '<li class="item">';
			echo '<a href="' . $photo_url . '"><img src="' . $thumb . '" alt="' . $caption . '" /></a>';
			echo '</li>';
		}

		echo '</ul>';
		echo $args['after_widget'];
	}
}


// register widget
add_action( 'widgets_init', 'wph_load_insta_widget' );
function wph_load_insta_widget() {
	if ( ! class_exists( 'MetzWeb\Instagram\Instagram' ) || ! function_exists( 'get_field' ) ) {
		return;
	}

	register_widget( 'WPH_Widget_Instagram' );
	require_once 'custom-fields.php';
}