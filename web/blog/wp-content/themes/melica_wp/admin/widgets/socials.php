<?php

/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

class melica_socials_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// base ID of your widget
			'melica_socials',

			// widget name will appear in UI
			__( 'Social networks widget', MELICA_LG ),

			// widget description
			array( 'description' => __( 'Displays list of social network buttons.', MELICA_LG ) )
		);
	}

	// enable widget settings
	public function form( $instance ) { echo '<p></p>'; }

	// widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', get_field( 'title', 'widget_' . $this->id ) );

		// set defaults
		if(!$title) {
			$title = 'Follow us';
		}

		// before and after widget arguments are defined by themes
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

		// display warn
		if(!have_rows('socials', 'widget_' . $this->id )) {
			echo __('Define your socials in widget settings', MELICA_LG);
			echo $args['after_widget'];
			return;
		}

		// run code & draw output
		echo '<ul class="socials-list invert text-center">';
		while ( have_rows('socials', 'widget_' . $this->id) ) : the_row(); ?>

			<li><a href="<?php echo esc_url( get_sub_field('url') ) ?>">
				<i class="fa <?php echo esc_attr( get_sub_field('icon') ) ?>"></i>
			</a></li>

		<?php endwhile;
		echo '</ul>';
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', 'melica_load_soc_widget' );
function melica_load_soc_widget() {
	register_widget( 'melica_socials_widget' );
}