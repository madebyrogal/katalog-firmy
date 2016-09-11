<?php if ( have_posts() ) :

	// start the loop.
	while ( have_posts() ) : the_post();

		get_template_part( 'content' );

		// end the loop.
	endwhile;


	// previous/next page navigation.
	if(!melica_is_masonry()):
		melica_pagination();
	endif;


// if no content, include the "No posts found" template.
else :
	get_template_part( 'not-found' );

endif;