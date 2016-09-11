<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo melica_html_class() ?>">
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php if ( melica_opt( 'favicon', false ) ): ?>
		<link rel="shortcut icon" href="<?php echo esc_url( melica_opt( 'favicon' ) ) ?>">
	<?php endif ?>
	<meta name="keywords" content="<?php echo esc_attr( melica_opt( 'seo_keywords' ) ) ?>">
	<meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ) ?>">
	<meta name="author" content="<?php echo esc_attr( get_the_author() ) ?>">
	<!--[if lt IE 9]><script src="https://cdn.jsdelivr.net/g/html5shiv@3.7,respond@1.4"></script><![endif]-->

	<?php if(melica_opt('enable_reveals', false)): ?>
	<!-- Important CSS for animations -->
	<style> [data-sr] { visibility : hidden; } </style>
	<?php endif; ?>

	<!-- Custom CSS -->
	<?php if ( melica_opt( 'custom_css', false ) ) : ?>
		<style><?php echo melica_opt( 'custom_css' ) ?></style>
	<?php endif ?>

	<?php wp_head() ?>
	
</head>

<body <?php body_class() ?>>

<!-- ========= Header ========= -->
<header id="header" class="big-grid">
	<div class="container">

		<!-- logo -->
		<a href="<?php echo home_url() ?>" class="header-brand <?php if(melica_opt('header_mode') == 'inverted') echo 'inverted'; ?>">
			<?php if ( melica_opt( 'image_as_logo' ) ): ?>
				<img class="image-bg" src="<?php echo melica_opt( 'image_logo' ) ?>"/>
				<h1><?php echo esc_html( get_bloginfo( 'name' ) ) ?></h1>
			<?php else: ?>
				<h1><?php echo melica_opt( 'logo_text', get_bloginfo( 'name' ) ) ?></h1>
			<?php endif ?>
		</a>

		<!-- menu -->
		<nav><?php if ( has_nav_menu( 'primary-menu' ) ):
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'container'      => false
				) );
			else:
				echo '<ul class="menu"><li><a href="#">' . __( 'Define your primary menu in dashboard', MELICA_LG ) . '</a></li></ul>';
			endif ?></nav>


		<!-- search form -->
		<form role="search" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr( __( 'Wyszukaj...', MELICA_LG ) ); ?>"/>
		</form>


		<!-- toggle buttons -->
		<div class="toggle-buttons">
			<a class="fa fa-search" id="search-btn" href="#"></a>
			<a class="fa fa-bars" id="menu-btn" href="#"></a>
		</div>
	</div>

	<!-- shadow element -->
	<div class="shadow"></div>
</header>