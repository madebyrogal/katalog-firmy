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
 * Custom filter for remove unused BR & P tags
 */
add_filter( 'the_content', 'melica_content_filter' );
function melica_content_filter( $content ) {
	global $shortcode_tags;

	$melica_tags = array();
	foreach($shortcode_tags as $tag => $func) {
		if(!is_string($func)) continue;
		if(strpos($func, 'melica_') === 0) $melica_tags[] = $tag;
	}

	// array of custom shortcodes requiring the fix
	$block = join( '|', $melica_tags );

	// opening tag
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

	// closing tag
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

	return $rep;
}


$melica_sc_cache = array();


/**
 * Retrieve shortcode template
 *
 * @param $filename
 *
 * @return bool
 */
function load_sc_template( $filename ) {
	global $melica_sc_cache;

	if ( isset( $melica_sc_cache[ $filename ] ) ) {
		return $melica_sc_cache[ $filename ];
	}

	$read_file                  = dirname( __FILE__ ) . '/templates/' . basename( $filename );
	$melica_sc_cache[ $filename ] = file_get_contents( $read_file );

	return $melica_sc_cache[ $filename ];
}

/**
 * Render shortcode template
 *
 * @param $tpl
 * @param $vars
 *
 * @return mixed
 */
function render_sc_template( $tpl, $vars ) {
	return str_replace( array_keys( $vars ), array_values( $vars ), $tpl );
}


/**
 *
 */
add_shortcode( 'header', 'melica_page_header' );
function melica_page_header( $atts, $content = null ) {
	if ( ! is_page() ) {
		return '';
	}

	$out = '<header>' . do_shortcode( $content ) . '</header>';
	$GLOBALS['melica_pheader'] = $out;

	return '';
}


/**
 * Grid row
 */
add_shortcode( 'row', 'melica_grid_row' );
function melica_grid_row( $atts, $content = null ) {
	return '<div class="row">' . do_shortcode( $content ) . '</div>';
}


/**
 * Grid column
 */
add_shortcode( 'column', 'melica_grid_column' );
function melica_grid_column( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'col'    => '12',
				'offset' => '0',
				'is_fg'  => false
			),
			$atts )
	);

	$tpl  = load_sc_template( 'grid_column.tpl' );
	$vars = array(
		'{col}'     => $col,
		'{offset}'  => $offset,
		'{classes}' => ($is_fg) ? 'form-group' : '',
		'{content}' => do_shortcode( $content ),
	);

	return render_sc_template( $tpl, $vars );
}


/**
 * Alerts
 */
add_shortcode( 'alert', 'melica_alert' );
function melica_alert($atts, $content = null) {

	// attributes
	extract( shortcode_atts(
			array(
				'status'  => 'success',
				'classes' => '',
			),
			$atts )
	);

	// load data
	$tpl  = load_sc_template( 'alert.tpl' );
	$vars = array(
		'{classes}' => $classes,
		'{text}'    => do_shortcode( $content ),
		'{status}'  => $status
	);

	return render_sc_template( $tpl, $vars );
}


/**
 * Button
 */
add_shortcode( 'button', 'melica_button' );
function melica_button( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'href'    => '#',
				'classes' => 'btn-default',
				'text'    => 'Button'
			),
			$atts )
	);

	// load data
	$tpl  = load_sc_template( 'button.tpl' );
	$vars = array(
		'{classes}' => $classes,
		'{text}'    => $text,
		'{href}'    => $href
	);

	return render_sc_template( $tpl, $vars );
}


/**
 * Blockquote
 */
add_shortcode( 'blockquote', 'melica_blockquote' );
function melica_blockquote( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'author' => 'noname',
			),
			$atts )
	);

	// autop
	$content = do_shortcode($content);
	if(strpos($content, '</p>') === FALSE) {
		$content = "<p>{$content}</p>";
	}

	$tpl = load_sc_template('blockquote.tpl');
	$vars = array(
		'{author}' => $author,
		'{text}'   => $content
	);

	return render_sc_template($tpl, $vars);
}

/**
 * Map
 */
add_shortcode( 'map', 'melica_map' );
function melica_map( $atts, $content = null ) {

	// attributes
	extract( shortcode_atts(
			array(
				'lat' => '',
				'long' => '',
				'height' => 400
			),
			$atts )
	);

	$tpl = load_sc_template('map.tpl');
	$vars = array(
		'{lat}'    => $lat,
		'{long}'   => $long,
		'{height}' => (int) $height,
		'{text}'   => do_shortcode( $content )
	);

	return render_sc_template($tpl, $vars);
}