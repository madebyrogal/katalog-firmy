<?php
/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Theme setup
 */
define( 'WPH_IGNORE_HEALTH_CHECKER', false );
define( 'MELICA_LG', 'melica_textdomain' );
define( 'MELICA_ASSETS_DIR', get_template_directory_uri() . '/public' );


/**
 * Run theme health checker
 */
require_once 'admin/health_check.php';
if ( defined( 'WPH_STOP_LOADING' ) && WPH_STOP_LOADING ) { return; }



if ( ! isset( $content_width ) ) $content_width = 960;
add_action( 'after_setup_theme', 'melica_setup_theme' );

function melica_setup_theme() {
	// load translations
	load_theme_textdomain( MELICA_LG, get_template_directory() . '/languages/' );

	// enable features
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'image', 'quote', 'status', 'link', 'gallery', 'video', 'audio' ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// add thumb sizes
	add_image_size('melica_article_img', 690, 470, false);
	add_image_size('melica_article_thumb', 400, 250, true);

	// jetpack integration
	add_theme_support( 'featured-content', array(
		'filter'     => 'melica_get_featured_posts',
		'max_posts'  => 10,
		'post_types' => array( 'post' )
	) );

	// register menus
	$locations = array(
		'primary-menu' => __( 'Primary Menu', MELICA_LG ),
		'footer-menu'  => __( 'Footer Menu', MELICA_LG )
	);
	register_nav_menus( $locations );
}


/**
 * Sidebar
 */
add_action( 'widgets_init', 'melica_widgets_init' );
function melica_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', MELICA_LG ),
		'id'            => 'primary-sidebar',
		'description'   => __( 'Main sidebar. Shown on all pages(except pages where is disabled).', MELICA_LG ),
		'before_widget' => '<section id="%1$s" class="widget box with-header %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="title"><span>',
		'after_title'   => '</span></h1>',
	) );
}


/**
 * Load required files
 */
require_once 'admin/framework/bootstrap.php';
require_once 'admin/tgm/settings.php';
require_once 'admin/data_sources.php';
require_once 'admin/custom_functions.php';
require_once 'admin/enqueue_scripts.php';
require_once 'admin/installer/oneclick_install.php';
require_once 'wp-less-compilator/wp-less.php';

// load widgets
require_once 'admin/widgets/socials.php';
require_once 'admin/widgets/mailchimp.php';
require_once 'admin/widgets/popular_posts.php';
require_once 'admin/widgets/about_me.php';
require_once 'admin/widgets/wphunters-insta-wdgt/wphunters-insta-wdgt.php';

// load shortcodes
require_once 'admin/shortcodes/core.php';

/**
 * Include & equip ACF plugin
 */
if ( ! class_exists( 'acf' ) && !get_option('wp_is_demosite') ) { define( 'ACF_LITE', true ); }

add_filter('acf/settings/dir', 'melica_set_acf_dir');
function melica_set_acf_dir() {
	return get_template_directory_uri() . '/admin/plugins/advanced-custom-fields-pro/';
}

require_once 'admin/plugins/advanced-custom-fields-pro/acf.php';
require_once 'admin/plugins/acf-google-font-selector-field/acf-google_font_selector.php';
require_once 'admin/plugins/advanced-custom-fields-font-awesome/acf-font-awesome.php';
require_once 'admin/acf_fields.php';


/**
 * Init options page
 */
$theme_options = new VP_Option( array(
	'is_dev_mode'           => false,
	'option_key'            => 'melica_options',
	'page_slug'             => 'melica_options',
	'template'              => get_template_directory() . '/admin/options.php',
	'menu_page'             => 'themes.php',
	'use_auto_group_naming' => true,
	'use_util_menu'         => true,
	'minimum_role'          => 'edit_theme_options',
	'layout'                => 'fixed',
	'page_title'            => __( 'Theme Options', MELICA_LG ),
	'menu_label'            => __( 'Theme Options', MELICA_LG ),
) );


/**
 * Work with styles
 */
add_filter( 'less_vars', 'melica_less_vars', 10, 2 );
function melica_less_vars( $vars ) {

	// general
	$vars['assetsdir'] = '~"' . MELICA_ASSETS_DIR . '"';

	// fonts
	$default_fonts                  = '"Helvetica Neue", Helvetica, Arial, sans-serif';
	$vars['font-family-sans-serif'] = '"' . melica_opt( 'primary_font_face', 'Raleway' ) . '", ' . $default_fonts;
	$vars['font-weight-base']       = melica_opt( 'primary_font_weight', 'normal' );

	$vars['secondary-font-family'] = melica_opt( 'secondary_font_face', 'Playfair Display' ) . ', '
	                                 . $vars['font-family-sans-serif'];

	// colors
	$vars['brand-primary']     = melica_opt( 'primary_color', '#c59b69' );
	$vars['text-color']        = melica_opt( 'main_text_color', '#000000' );
	$vars['headings-color']    = melica_opt( 'headings_color', 'inherit' );
	$vars['footer-bg']         = melica_opt( 'footer_bg', '#1a171b' );
	$vars['footer-text-color'] = melica_opt( 'footer_text_color', '#f3f3f3' );

	return $vars;
}

add_action( 'wp_enqueue_scripts', 'melica_embed_styles' );
function melica_embed_styles() {

	// fonts are included via standard VafPress method:
	// http://vafpress.com/documentation/vafpress-framework/usage-sample/google-web-fonts.html

	VP_Site_GoogleWebFont::instance()->add(
		melica_opt( 'primary_font_face' ),
		array('normal', '300', '400', '400italic', '500', '600')
	);

	VP_Site_GoogleWebFont::instance()->add(
		melica_opt( 'secondary_font_face' ),
		array('normal', '300', '400', '700')
	);

	VP_Site_GoogleWebFont::instance()->register_and_enqueue();

	// less files will automatically converted to CSS
	if ( ! is_admin() ) {
		wp_enqueue_style( 'twbs', MELICA_ASSETS_DIR . '/less/bootstrap.less' );
		wp_enqueue_style( 'font-awesome', MELICA_ASSETS_DIR . '/font-awesome.css' );
		wp_enqueue_style( 'style-main', MELICA_ASSETS_DIR . '/less/style.less' );

		wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css' );
	}
}


/**
 * Contact From 7 shortcodes
 */
add_filter( 'wpcf7_form_elements', 'melica_wpcf7_form_elements' );
function melica_wpcf7_form_elements( $form ) {
	$form = do_shortcode( $form );

	return $form;
}


/**
 * Set default values for ACF fields
 */
add_filter('acf/load_field', 'melica_process_field');
function melica_process_field($field) {

	switch($field['name']) {

		case 'use_masonry_grid':
			$field['default_value'] = intval(melica_opt('use_masonry_grid', 0));
			break;

		case 'masonry_columns':
			$field['default_value'] = intval(melica_opt('masonry_columns', 3));
			break;
	}

	return $field;

}


/**
 * Display UL-styled pagination for use in theme
 */
function melica_pagination() {
	global $wp_query, $paged;

	$pages = paginate_links( array(
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $wp_query->max_num_pages,
		'prev_next' => false,
		'type'      => 'array'
	) );

	if ( is_array( $pages ) ) {
		echo '<nav class="col-xs-12 box pagination-box"><ul class="pagination">';

		// previous posts link
		if( !is_single() && $paged > 1 ) {
			echo '<li><a href="' . previous_posts( false ) . '">' . __( 'Poprzedni', MELICA_LG ) . '</a></li>';
		} else {
			echo '<li class="inactive"><a href="#">' . __( 'Poprzedni', MELICA_LG ) . '</a></li>';
		}

		// page numbers
		foreach ( $pages as $page ) {
			echo "<li>$page</li>";
		}

		// next posts link
		if ( !is_single() && ( intval($paged) + 1 <= $wp_query->max_num_pages ) ) {
			echo '<li><a href="' . next_posts( $wp_query->max_num_pages, false ) . '">' . __( 'Następny', MELICA_LG ) . '</a></li>';
		} else {
			echo '<li class="inactive"><a href="#">' . __( 'Następny', MELICA_LG ) . '</a></li>';
		}

		echo '</ul></nav>';
	}
}