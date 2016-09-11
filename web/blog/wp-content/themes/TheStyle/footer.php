		</div> <!-- end #container2 -->
	</div> <!-- end #container -->		
	
	<div id="footer">
		<div id="footer-wrapper">
			<div id="footer-content">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?> 
				<?php endif; ?>
			</div> <!-- end #footer-content -->
			<p id="copyright"><?php esc_html_e('','allf'); ?><?php esc_html_e('Copyright © ALLF','katalog-firmy.net'); ?> <a href="http://katalog-firmy.net/">katalog-firmy.net</a></p>
		</div> <!-- end #footer-wrapper -->
	</div> <!-- end #footer -->		
				
	<?php get_template_part('includes/scripts'); ?>

	<?php wp_footer(); ?>	
</body>
</html>