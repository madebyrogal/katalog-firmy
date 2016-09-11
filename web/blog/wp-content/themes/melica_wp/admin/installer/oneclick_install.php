<?php
/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Import demo data
 */
add_action( 'wp_ajax_import_demo_action', 'melica_oneclick_demoajax' );
function melica_oneclick_demoajax() {
	global $wpdb;

	if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
		define( 'WP_LOAD_IMPORTERS', true );
	}

	if ( ! class_exists( 'WP_Import' ) ) {
		$class_wp_importer = dirname( __FILE__ ) . '/inc/wordpress-importer.php';
		if ( file_exists( $class_wp_importer ) ) {
			require $class_wp_importer;
		}
	}

	if ( class_exists( 'WP_Import' ) ) {
		$import_filepath = get_template_directory() . '/demo-data/import.xml'; // get the xml file from directory

		// import data
		$wp_import                    = new WP_Import();
		$wp_import->fetch_attachments = true;
		$wp_import->import( $import_filepath );
	}


	// setup menus
	$locations = get_registered_nav_menus();
	foreach ( $locations as $locationId => $menuValue ) {
		switch ( $locationId ) {
			case 'primary-menu':
				$menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
				break;

			case 'footer-menu':
				$menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
				break;
		}

		if ( isset( $menu ) ) {
			$locations[ $locationId ] = $menu->term_id;
		}
	}
	set_theme_mod( 'nav_menu_locations', $locations );


	// setup sidebars
	$wie_file = dirname( __FILE__ ) . '/inc/widgets_import.php';
	if ( file_exists( $wie_file ) ) {
		require $wie_file;

		$temp_dir = wp_upload_dir();
		$newname  = $temp_dir['path'] . '/widgets_import.wie';

		copy( get_template_directory() . '/demo-data/widgets.wie', $newname );
		$result = wie_process_import_file( $newname );

		if ( is_wp_error( $result ) ) {
			echo '<p><b>Error!</b><br/>' . $result->get_error_message() . '</p>';
		} else {
			echo '<p>Widgets imported successfully.</p>';
		}
	}

	die(); // this is required to return a proper result
}


/**
 * Tune WP
 */
add_action( 'wp_ajax_tunewp_action', 'melica_oneclick_tune' );
function melica_oneclick_tune() {
	global $wpdb, $wp_rewrite;

	// set permalink structure
	$wp_rewrite->set_permalink_structure( '/%postname%/' );

	// set homepage
	$homepage = get_page_by_title( 'Index page' );
	if ( $homepage !== null ) {
		update_option( 'page_on_front', $homepage->ID );
		update_option( 'show_on_front', 'page' );
	}

	// Set the blog page
	//$blog   = get_page_by_title( 'Blog' );
	//update_option( 'page_for_posts', $blog->ID );

	die( '<b>Done!</b> Your WordPress installation successfully tuned to use Melica theme.' );
}


/**
 * Register custom admin page
 */
add_action( 'admin_menu', 'melica_oneclick_menu', 11 );
function melica_oneclick_menu() {
	add_submenu_page(
		'themes.php',                                    // parent page
		__( 'Theme Installation Wizard', MELICA_LG ),    // page title
		__( 'Installation Wizard', MELICA_LG ),          // menu title
		'import',                                        // capability
		'melica_oneclick',                               // menu slug
		'melica_oneclick_page'                           // callback function
	);
}

function melica_oneclick_page() {
	global $title;

	$this_dir = get_template_directory_uri() . '/admin/installer';
	$file     = plugin_dir_path( __FILE__ ) . 'view.php';
	if ( file_exists( $file ) ) {
		require $file;
	}
}