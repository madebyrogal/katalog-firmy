<?php
/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

class melica_popular_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// base ID of your widget
			'melica_popular_posts',

			// widget name will appear in UI
			__('Popular posts', MELICA_LG),

			// widget description
			array( 'description' => __( 'Displays list of popular blog posts.', MELICA_LG ) )
		);
	}

	// enable widget settings
	public function form( $instance ) { echo '<p></p>'; }

	// widget front-end
	public function widget( $args, $instance ) {
		$title      = apply_filters( 'widget_title', get_field( 'title', 'widget_' . $this->id ) );
		$post_count = get_field( 'items_count', 'widget_' . $this->id );
		$animations = get_field( 'enable_animation', 'widget_' . $this->id );

		// set defaults
		if(!$title) {
			$title = 'Popular posts';
		}

		if(!$post_count) {
			$post_count = 3;
		}

		// setup class list
		$classlist = 'post-list width-bg';
		if($animations) $classlist .= ' smart-slider';

		// get posts
		$query = new WP_Query( array(
			'post_type'              => 'post',
			'order'                  => 'DESC',
			'orderby'                => 'comment_count',
			'cache_results'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => true,
			'posts_per_page'         => ( $animations ) ? $post_count * 2 + 1 : $post_count,
			'meta_query'             => array( array( 'key' => '_thumbnail_id' ) )
		) );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

		// run code & draw output
		echo "<div class=\"{$classlist}\">";
		while($query->have_posts()): $query->the_post(); $post_id = get_the_ID();

		// setup image
		$post_image = MELICA_ASSETS_DIR . '/images/widget-placeholder.png';
		if(has_post_thumbnail()) {
			$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'melica_article_thumb' );
		}
		$post_image = (is_array($post_image)) ? esc_attr($post_image[0]) : $post_image;

		// fallback
		if(!$post_image) {
			$post_image = MELICA_ASSETS_DIR . '/images/widget-placeholder.png';
		}

		?>

		<article>
			<!-- image -->
			<div class="main-image">
				<img src="<?php echo esc_url($post_image) ?>" alt=""/>
			</div>

			<!-- post info -->
			<div class="post-info">
				<h1 class="title"><?php the_title() ?></h1>
				<time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j F Y') ?></time>
			</div>

			<!-- link -->
			<a class="link" href="<?php the_permalink() ?>"><?php _e('Read more', MELICA_LG) ?></a>
		</article>

		<?php endwhile; wp_reset_query();
		echo '</div>';
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', 'melica_load_popular_widget' );
function melica_load_popular_widget() {
	register_widget( 'melica_popular_widget' );
}