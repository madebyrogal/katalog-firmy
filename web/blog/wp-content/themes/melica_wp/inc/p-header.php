<?php if ( has_post_thumbnail() ) : ?>
	<?php if ( is_single() ): ?>
		<header>
			<?php the_post_thumbnail( 'large' ); ?>
		</header>
	<?php else: ?>
		<header><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'melica_article_img' ); ?>
			</a></header>
	<?php endif; ?>
<?php endif; ?>