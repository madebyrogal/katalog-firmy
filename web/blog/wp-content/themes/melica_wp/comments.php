<?php

if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
if ( post_password_required() ) {
	return;
}

function melica_comments( $comment, $args, $depth ) {

	if(in_array($comment->comment_type, array('pingback', 'trackback'))) return;
	?>

	<article <?php comment_class('row'); ?> id="comment-<?php comment_ID(); ?>">
		<!-- author photo -->
		<div class="avatar-col hidden-xs col-sm-2">
			<?php echo get_avatar( $comment, 100 ) ?>
		</div>

		<!-- comment text & info -->
		<div class="comment-col col-sm-10">
			<header>
				<div class="name"><?php echo esc_html(get_comment_author( $comment )) ?></div>
				<time datetime="<?php comment_time('Y-m-d h:i') ?>"><?php comment_time('F m, Y \a\t g:i A') ?></time>
			</header>

			<div class="text"><?php comment_text() ?></div>

			<footer>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( __( 'Edit', MELICA_LG ), ' ' ); ?>

				<?php if($comment->comment_approved == '0') : ?><div class="text-muted"><?php echo __('Your comment is awaiting moderation.', MELICA_LG) ?></div><?php endif ?>
			</footer>
		</div>
	</article>
<?php }

?>

<section class="box with-header comments-section" id="comments">
	<h1 class="title"><span><?php melica_comment_count() ?></span></h1>
	<?php if ( have_comments() ) : ?>
		<!-- Comments flow -->
		<div class="flow animate sequence">
			<?php
			wp_list_comments( array(
				'max_depth' => 3,
				'callback'  => 'melica_comments'
			) );
			?>
		</div>

		<div class="pager">
			<span class="previous"><?php previous_comments_link(__('&laquo; Newer', MELICA_LG)) ?></span>
			<span class="next"><?php next_comments_link(__('Older &raquo;', MELICA_LG)) ?></span>
		</div>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p style="text-align: center; margin: 50px 0;"><?php echo __( 'Komentarze są wyłączone', MELICA_LG ); ?></p>
	<?php endif; ?>

	<?php

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'fields' => apply_filters(
			'comment_form_default_fields', array(
				'author' => '<div class="row"><div class="form-group col-xs-6">'.
				            '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' placeholder="' . __('Your name', MELICA_LG) . '" />'.
				            '</div>',

				'email'  => '<div class="form-group col-xs-6">' .
				            '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' placeholder="' . __('Email', MELICA_LG) . '" />'  .
				            '</div></div>',
			)
		),
		'comment_field' => '<div class="form-group">'.
		                   '<textarea id="comment" class="form-control" name="comment" rows="5" aria-required="true" required placeholder="' .  __('Type your message here', MELICA_LG) . '"></textarea>' .
		                   '</div>',

		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'class_submit'         => 'btn btn-primary btn-long form-submit',

		'title_reply_to'       => __( 'Leave a reply to %s', MELICA_LG ),
		'cancel_reply_link'    => __( 'Cancel', MELICA_LG ),
		'title_reply'          => __( 'Leave a reply', MELICA_LG )
	);
	comment_form($args); ?>

</section>