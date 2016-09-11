<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Run checker only for admins to prevent breaking of working website
 */
if ( current_user_can( 'switch_themes' ) ) {
	wph_theme_health_checker();
}


/**
 * Theme Health Checker main function
 */
function wph_theme_health_checker() {

	// if ignore mode activated
	if ( defined( 'WPH_IGNORE_HEALTH_CHECKER' ) && WPH_IGNORE_HEALTH_CHECKER ) {
		return;
	}

	// define variables
	$errors               = array();
	$min_php_version      = '5.3.0';
	$min_php_settings     = array( 'memory_limit' => '128M', 'max_execution_time' => 60 );
	$directories_to_check = array( '/wp-content', '/wp-content/uploads', '/wp-content/uploads/wp-less-cache' );

	// compare php version
	$error_message = wp_kses_post( __( 'You need to upgrade your PHP version. Required <b>at least %s</b>, your current: <b>%s</b>', MELICA_LG ) );
	if ( version_compare( phpversion(), $min_php_version, '<' ) ) {
		$errors[] = sprintf( $error_message, $min_php_version, phpversion() );
	}

	// check folder rights
	$error_message = wp_kses_post( __( 'Set 0777 permissions to <b>%s</b> folder.', MELICA_LG ) );
	foreach ( $directories_to_check as $dir ) {
		if ( is_dir( ABSPATH . $dir ) && ( ! is_readable( ABSPATH . $dir ) || ! is_writable( ABSPATH . $dir ) ) ) {
			$errors[] = sprintf( $error_message, $dir );
		}
	}

	// check php settings
	$error_message = wp_kses_post( __( 'PHP setting <b>%s</b> must have at least <b>%s</b> value. Your current: <b>%s</b>.', MELICA_LG ) );
	foreach ( $min_php_settings as $setting => $min_value ) {
		$current_value   = wph_return_bytes( ini_get( $setting ) );
		$min_value_bytes = wph_return_bytes( $min_value );

		if ( $current_value != 0 && $current_value < $min_value_bytes ) {
			$errors[] = sprintf( $error_message, $setting, $min_value, ini_get( $setting ) );
		}
	}

	// pass check to an output function
	wph_display_theme_health_notification( $errors );
}


/**
 * Notification display function
 * @param $errors
 */
function wph_display_theme_health_notification( $errors ) {

	// simple check for empty array
	if ( ! is_array( $errors ) || empty( $errors ) ) {
		return;
	}

	// define abort loading variable
	define( 'WPH_STOP_LOADING', true );

	// firstly, generate markup
	$markup = '<div class="notice notice-error"><p>';
	$markup .= esc_attr__( 'WPHunters Health Checker have detected next problems:', MELICA_LG );
	$markup .= '</p><ul class="ul-square">';

	foreach ( $errors as $err ) {
		$markup .= '<li>' . $err . '</li>';
	}

	$markup .= '</ul><p>';
	$markup .= wp_kses_post( __( 'To use theme please fix these issues. <i>This message visible only for site administrators.</i>', MELICA_LG ) );
	$markup .= '</p></div>';

	// make proper output
	if ( is_admin() ) {
		$nag_function = create_function( null, 'echo ' . var_export( $markup, true ) . ';' );
		add_action( 'admin_notices', $nag_function );
	} else {
		wp_die( $markup );
	}
}


/**
 * Helper that converts shorthand memory notation value to bytes
 *
 * @param $val
 * @return int|string
 */
function wph_return_bytes( $val ) {
	if ( is_numeric( $val ) ) { return $val; }

	$val  = trim( $val );
	$last = strtolower( $val[ strlen( $val ) - 1 ] );

	switch ( $last ) {
		case 'g':
			$val *= 1024;
			break;

		case 'm':
			$val *= 1024;
			break;

		case 'k':
			$val *= 1024;
			break;
	}

	return $val;
}