<?php

/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

class melica_mailchimp_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// base ID of your widget
			'melica_mailchimp',

			// widget name will appear in UI
			__( 'Mailchimp subscription form', MELICA_LG ),

			// widget description
			array( 'description' => __( 'Displays mailchimp subscription form.', MELICA_LG ) )
		);
	}

	// enable widget settings
	public function form( $instance ) { echo '<p></p>'; }

	// widget front-end
	public function widget( $args, $instance ) {
		$title     = apply_filters( 'widget_title', get_field( 'title', 'widget_' . $this->id ) );
		$open_text = get_field( 'opening_text', 'widget_' . $this->id );
		$form_url  = get_field( 'signup_form_url', 'widget_' . $this->id );

		// set defaults
		if(!$title) {
			$title = 'Subscribe';
		}

		// before and after widget arguments are defined by themes
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];


		// run code & draw output
		?>

		<?php if ( $open_text ): ?>
			<p class="xlarge text-center text-italic"><?php echo $open_text; ?></p>
		<?php endif; ?>

		<form class="form" action="<?php echo esc_url( $form_url ) ?>" method="post" target="_blank">
			<div class="form-group">
				<input type="text" name="NAME" class="form-control" placeholder="<?php _e( 'Name', MELICA_LG ) ?>" required/>
			</div>

			<div class="form-group">
				<input type="email" name="EMAIL" class="form-control" placeholder="<?php _e( 'Email', MELICA_LG ) ?>" required/>
			</div>

			<div class="form-group text-center">
				<button class="btn btn-primary"><?php _e( 'Subscribe', MELICA_LG ) ?></button>
			</div>
		</form>
		<?php echo $args['after_widget'];
	}
}

add_action( 'widgets_init', 'melica_load_mailchimp_widget' );
function melica_load_mailchimp_widget() {
	register_widget( 'melica_mailchimp_widget' );
}