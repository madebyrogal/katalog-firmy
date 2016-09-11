<?php

/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

class melica_about_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// base ID of your widget
			'melica_about_me',

			// widget name will appear in UI
			__( '"About me" widget', MELICA_LG ),

			// widget description
			array( 'description' => __( 'Displays "About me" block.', MELICA_LG ) )
		);
	}

	// enable widget settings
	public function form( $instance ) { echo '<p></p>'; }

	// widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', get_field( 'title', 'widget_' . $this->id ) );
		$photo = get_field( 'photo', 'widget_' . $this->id );
		$text = get_field( 'text', 'widget_' . $this->id );

		$add_button = get_field( 'add_button', 'widget_' . $this->id );
		$page_url = get_field( 'about_page', 'widget_' . $this->id );
		$button_text = get_field( 'button_text', 'widget_' . $this->id );

		// set defaults
		if(!$title) {
			$title = 'About me';
		}

		// before and after widget arguments are defined by themes
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

		// run code & draw output
		if($photo) {
			echo '<p class="text-center"><img class="img-circle" src="' . esc_url($photo) . '" alt="" /></p>';
		}

		if ($text) {
			echo wp_kses(
				$text,
				array(
					'a'      => array(
						'href'  => array(),
						'title' => array()
					),
					'h1'     => array(),
					'h2'     => array(),
					'h3'     => array(),
					'h4'     => array(),
					'h5'     => array(),
					'h6'     => array(),
					'p'      => array(),
					'br'     => array(),
					'em'     => array(),
					'b'      => array(),
					'i'      => array(),
					'strong' => array()
				)
			);
		}

		if($add_button && $page_url && $button_text) {
			echo '<p class="text-center"><a class="btn btn-primary" href="' . esc_url($page_url) . '">' . esc_html($button_text) . '</a></p>';
		}

		if(!$photo && !$text && !$add_button && !$page_url && !$button_text) {
			echo __('Please, setup this widget in the dashboard.', MELICA_LG);
		}

		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', 'melica_load_about_widget' );
function melica_load_about_widget() {
	register_widget( 'melica_about_widget' );
}