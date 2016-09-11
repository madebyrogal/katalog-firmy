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

return array(
	'title' => __( 'Melica Theme Options', MELICA_LG ),
	'logo'  => get_template_directory_uri() . '/public/images/logo_admin.png',
	'menus' => array(

		// general page
		array(
			'title'    => __( 'General', MELICA_LG ),
			'name'     => 'menu_general',
			'icon'     => 'font-awesome:fa-home',
			'controls' => array(

				// logo text & logo image toggle
				array(
					'type'        => 'section',
					'title'       => __( 'Logo', MELICA_LG ),
					'description' => __( 'Used in header', MELICA_LG ),
					'fields'      => array(
						array(
							'type'        => 'textbox',
							'name'        => 'logo_text',
							'label'       => __( 'Logo Text', MELICA_LG ),
							'description' => __( 'Leave empty for default site name', MELICA_LG ),
							'default'     => 'Melica',
							'dependency'  => array(
								'field'    => 'image_as_logo',
								'function' => 'vp_dep_boolean_not',
							),
						),
						array(
							'type'    => 'toggle',
							'name'    => 'image_as_logo',
							'label'   => __( 'Use image as logo?', MELICA_LG ),
							'default' => '0',
						),
						// image logo upload
						array(
							'type'        => 'upload',
							'name'        => 'image_logo',
							'label'       => __( 'Upload', MELICA_LG ),
							'description' => __( 'Recommended size is about 100x30', MELICA_LG ),
							'dependency'  => array(
								'field'    => 'image_as_logo',
								'function' => 'vp_dep_boolean',
							),
						),
					),
				),

				// favicon section
				array(
					'type'   => 'section',
					'title'  => __( 'Favicon', MELICA_LG ),
					'fields' => array(
						// Favicon
						array(
							'type'        => 'upload',
							'name'        => 'favicon',
							'label'       => __( 'Favicon', MELICA_LG ),
							'description' => __( 'Recommended size 16x16', MELICA_LG )
						),
					),
				),

				// SEO keywords
				array(
					'type'        => 'section',
					'title'       => __( 'SEO', MELICA_LG ),
					'description' => __( 'Search Engine Optimisation', MELICA_LG ),
					'fields'      => array(
						// Favicon
						array(
							'type'        => 'textarea',
							'name'        => 'seo_keywords',
							'label'       => __( 'SEO keywords', MELICA_LG ),
							'description' => __( 'Separating by commas.', MELICA_LG ),
							'default'     => 'melica, wordpress theme, html5 theme, responsive, bootstrap'
						),
					),
				),

				// custom css/js
				array(
					'type'   => 'section',
					'title'  => __( 'Custom code', MELICA_LG ),
					'fields' => array(
						array(
							'type'        => 'codeeditor',
							'name'        => 'custom_css',
							'label'       => __( 'Custom CSS', MELICA_LG ),
							'description' => __( 'Write your custom css here.', MELICA_LG ),
							'theme'       => 'github',
							'mode'        => 'css',
						),
						array(
							'type'        => 'codeeditor',
							'name'        => 'custom_js',
							'label'       => __( 'Custom JS', MELICA_LG ),
							'description' => __( 'Write your custom js here.', MELICA_LG ),
							'theme'       => 'twilight',
							'mode'        => 'javascript',
						),
					),
				),
			),
		),

		// layout
		array(
			'title'    => __( 'Layout options', MELICA_LG ),
			'name'     => 'layout',
			'icon'     => 'font-awesome:fa-cogs',
			'controls' => array(

				// common settings
				array(
					'type'   => 'section',
					'title'  => __( 'Common', MELICA_LG ),
					'fields' => array(

						array(
							'type'        => 'toggle',
							'name'        => 'enable_reveals',
							'label'       => __( 'Enable reveal animations', MELICA_LG ),
							'description' => __( 'Reveal elements as they enter the viewport.', MELICA_LG ),
							'default'     => '1',
						),

					),
				),

				// masonry grid settings
				array(
					'type'   => 'section',
					'title'  => __( 'Masonry grid', MELICA_LG ),
					'fields' => array(

						array(
							'type'        => 'toggle',
							'name'        => 'use_masonry_grid',
							'label'       => __( 'Use grid layout', MELICA_LG ),
							'description' => __( 'Sidebar will be hidden on index and archive pages. Posts will be displayed in columns.', MELICA_LG ),
							'default'     => '0',
						),

						array(
							'type'       => 'slider',
							'name'       => 'masonry_columns',
							'label'      => __( 'Columns', MELICA_LG ),
							'min'        => '1',
							'max'        => '3',
							'default'    => '3',

							'dependency' => array(
								'field'    => 'use_masonry_grid',
								'function' => 'vp_dep_boolean',
							),
						),
					),
				),

				// sidebar settings
				array(
					'type'   => 'section',
					'title'  => __( 'Sidebar', MELICA_LG ),
					'fields' => array(

						array(
							'type'        => 'select',
							'name'        => 'sidebar_position',
							'label'       => __( 'Select sidebar position', MELICA_LG ),
							'items'       => array(
								array(
									'value' => 'right',
									'label' => __( 'Right side', MELICA_LG ),
								),
								array(
									'value' => 'left',
									'label' => __( 'Left side', MELICA_LG ),
								),
							),
							'default'    => array(
								'{{last}}'
							),
							'validation' => 'required'
						),

						array(
							'type'        => 'toggle',
							'name'        => 'sidebar_on_archives',
							'label'       => __( 'Show sidebar on archives and home page', MELICA_LG ),
							'default'     => '1',
						),
						array(
							'type'        => 'toggle',
							'name'        => 'sidebar_on_pages',
							'label'       => __( 'Show sidebar on pages', MELICA_LG ),
							'default'     => '0',
						),
						array(
							'type'       => 'toggle',
							'name'       => 'sidebar_on_posts',
							'label'      => __( 'Show sidebar on posts', MELICA_LG ),
							'default'    => '1',

							'dependency' => array(
								'field'    => 'use_masonry_grid',
								'function' => 'vp_dep_boolean_invert',
							),
						),
					),
				),

				// footer text
				array(
					'type'   => 'section',
					'title'  => __( 'Footer', MELICA_LG ),
					'fields' => array(
						array(
							'type'        => 'textarea',
							'name'        => 'footer_text',
							'label'       => __( 'Copyright text', MELICA_LG ),
							'default'     => '<a href="http://wphunters.com/">Design by WPHunters</a>'
						),
					),
				),

			),
		),

		// colors
		array(
			'title'    => __( 'Colors', MELICA_LG ),
			'name'     => 'menu_colors',
			'icon'     => 'font-awesome:fa-paint-brush',
			'controls' => array(

				// notebox
				array(
					'type'        => 'notebox',
					'name'        => 'notebox_colors_1',
					'label'       => __( 'Note!', MELICA_LG ),
					'description' => __( 'To apply default color just leave field empty.', MELICA_LG ),
					'status'      => 'normal',
				),

				// main settings
				array(
					'type'   => 'section',
					'title'  => __( 'Main', MELICA_LG ),
					'fields' => array(

						// primary color
						array(
							'type'    => 'color',
							'name'    => 'primary_color',
							'label'   => __( 'Primary Color', MELICA_LG ),
							'format'  => 'hex',
							'default' => '#c59b69'
						),

						// body text color
						array(
							'type'    => 'color',
							'name'    => 'main_text_color',
							'label'   => __( 'Body Text Color', MELICA_LG ),
							'format'  => 'hex',
							'default' => '#000000'
						),

						// headings color
						array(
							'type'    => 'color',
							'name'    => 'headings_color',
							'label'   => __( 'Headings Color', MELICA_LG ),
							'format'  => 'hex',
						),
					),
				),

				// header settings
				array(
					'type'   => 'section',
					'title'  => __( 'Header', MELICA_LG ),
					'fields' => array(

						// header mode
						array(
							'type'       => 'select',
							'name'       => 'header_mode',
							'label'      => __( 'Select header mode', MELICA_LG ),
							'items'      => array(
								array(
									'value' => 'default',
									'label' => __( 'Default (white)', MELICA_LG ),
								),
								array(
									'value' => 'inverted',
									'label' => __( 'Inverted (black, semi-transparent)', MELICA_LG ),
								),
							),
							'default'    => array(
								'default'
							),
							'validation' => 'required'
						),
					),
				),

				// footer settings
				array(
					'type'   => 'section',
					'title'  => __( 'Footer', MELICA_LG ),
					'fields' => array(

						// background color
						array(
							'type'   => 'color',
							'name'   => 'footer_bg',
							'label'  => __( 'Footer Background', MELICA_LG ),
							'format' => 'hex'
						),

						// text color
						array(
							'type'   => 'color',
							'name'   => 'footer_text_color',
							'label'  => __( 'Footer Text Color', MELICA_LG ),
							'format' => 'hex'
						),
					),
				),
			),
		),

		// typography options
		array(
			'title'    => __( 'Typography', MELICA_LG ),
			'name'     => 'menu_typography',
			'icon'     => 'font-awesome:fa-font',
			'controls' => array(

				// body font
				array(
					'type'   => 'section',
					'title'  => __( 'Primary', MELICA_LG ),
					'fields' => array(
						array(
							'type'    => 'select',
							'name'    => 'primary_font_face',
							'label'   => __( 'Primary Font Face', MELICA_LG ),
							'items'   => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'vp_get_gwf_family',
									),
								),
							),
							'default' => 'Raleway'
						),

						array(
							'type'    => 'radiobutton',
							'name'    => 'primary_font_weight',
							'label'   => __( 'Primary Font Weight', MELICA_LG ),
							'items'   => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field'  => 'primary_font_face',
										'value'  => 'vp_get_gwf_weight',
									),
								),
							),
							'default' => 'normal'
						),
					)
				),

				// heading font
				array(
					'type'   => 'section',
					'title'  => __( 'Secondary', MELICA_LG ),
					'fields' => array(
						array(
							'type'    => 'select',
							'name'    => 'secondary_font_face',
							'label'   => __( 'Headings Font Face', MELICA_LG ),
							'items'   => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'vp_get_gwf_family',
									),
								),
							),
							'default' => 'Playfair Display'
						),
					)
				)
			),
		),

		// social options
		array(
			'title'    => __( 'Socials', MELICA_LG ),
			'name'     => 'menu_socials',
			'icon'     => 'font-awesome:fa-share-alt',
			'controls' => array(

				// notebox
				array(
					'type'        => 'notebox',
					'name'        => 'notebox_socials_1',
					'label'       => __( 'Note!', MELICA_LG ),
					'description' => __( 'If some social network is not required - leave field empty.', MELICA_LG ),
					'status'      => 'normal'
				),

				array(
					'type'   => 'section',
					'title'  => __( 'Social profiles', MELICA_LG ),
					'fields' => array(

						array(
							'type'    => 'textbox',
							'name'    => 'facebook_url',
							'label'   => __( 'Facebook URL', MELICA_LG ),
							'default' => '#'
						),
						array(
							'type'    => 'textbox',
							'name'    => 'twitter_url',
							'label'   => __( 'Twitter URL', MELICA_LG ),
							'default' => '#'
						),
						array(
							'type'    => 'textbox',
							'name'    => 'dribbble_url',
							'label'   => __( 'Dribbble URL', MELICA_LG ),
							'default' => '#'
						),
						array(
							'type'    => 'textbox',
							'name'    => 'google_url',
							'label'   => __( 'Google URL', MELICA_LG ),
							'default' => '#'
						),
						array(
							'type'    => 'textbox',
							'name'    => 'linkedin_url',
							'label'   => __( 'LinkedIn URL', MELICA_LG ),
							'default' => '#'
						),
						array(
							'type'    => 'textbox',
							'name'    => 'pinterest_url',
							'label'   => __( 'Pinterest URL', MELICA_LG ),
							'default' => '#'
						),
						array(
							'type'    => 'textbox',
							'name'    => 'instagram_url',
							'label'   => __( 'Instagram URL', MELICA_LG ),
							'default' => '#'
						),
					)
				),
			),
		),

		// 404 page text
		array(
			'title'    => __( '404 Page', MELICA_LG ),
			'name'     => 'menu_404text',
			'icon'     => 'font-awesome:fa-warning',
			'controls' => array(

				array(
					'type'        => 'notebox',
					'name'        => '404_notebox',
					'label'       => __( 'Tip', MELICA_LG ),
					'description' => __( 'Here you can edit text that will be shown on 404 page', MELICA_LG ),
					'status'      => 'normal'
				),

				array(
					'type'   => 'section',
					'title'  => __( 'Text', MELICA_LG ),
					'fields' => array(
						array(
							'type'                       => 'wpeditor',
							'name'                       => '404_text',
							'use_external_plugins'       => '1',
							'disabled_externals_plugins' => '',
							'disabled_internals_plugins' => '',
						),
					),
				),
			),
		),

	)
);