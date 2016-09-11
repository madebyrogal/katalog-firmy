<!-- ========= Footer ========= -->
<footer id="main-footer"><div class="container nopadding-sm animate sequence">

		<!-- socials -->
		<div><ul class="socials-list">
				<?php foreach(melica_socials() as $social): ?>
				<li><a href="<?php echo esc_url($social['url']) ?>">
						<i class="fa <?php echo esc_attr($social['class']) ?>"></i>
						<?php echo esc_attr($social['title']) ?>
					</a></li>
				<?php endforeach ?>
			</ul></div>

		<!-- bottom menu -->
		<nav><?php if(has_nav_menu( 'footer-menu' )):
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'container' => false,
					'menu_class' => 'bottom-menu'
				) );
			else:
				echo __( 'Define your footer menu in dashboard', MELICA_LG );
			endif ?></nav>

		<!-- copyright -->
		<div>
			&copy;
			<?php echo date('Y') ?>
			<?php echo esc_html(melica_opt('logo_text', get_bloginfo('name'))) ?>.
			<?php echo melica_opt('footer_text', null); ?>
		</div>

	</div></footer>


<?php if(melica_opt('custom_js', false)) : ?>
	<!-- custom js code -->
	<script type="text/javascript"><?php echo melica_opt('custom_js') ?></script>
<?php endif ?>

<?php wp_footer(); ?></body></html>