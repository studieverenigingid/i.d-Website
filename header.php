<?php
global $img_folder;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<?php $theme_info = wp_get_theme(); ?>
		<?php $theme_color = theme_color(true); ?>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="<?php echo $theme_color; ?>">

		<link rel="apple-touch-icon" sizes="180x180"
			href="/apple-touch-icon.png?v=<?php echo $theme_info->version; ?>">
		<link rel="icon" type="image/png" sizes="32x32"
			href="/favicon-32x32.png?v=<?php echo $theme_info->version; ?>">
		<link rel="icon" type="image/png" sizes="16x16"
			href="/favicon-16x16.png?v=<?php echo $theme_info->version; ?>">
		<link rel="manifest" href="/manifest.json">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#f6b632">

		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/mulish-v1-latin-300.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/mulish-v1-latin-300.woff" as="font" type="font/woff" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/mulish-v1-latin-300.ttf" as="font" type="font/ttf" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/mulish-v1-latin-800.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/mulish-v1-latin-800.woff" as="font" type="font/woff" crossorigin>
		<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/static/fonts/mulish-v1-latin-800.ttf" as="font" type="font/ttf" crossorigin>

		<?php wp_enqueue_style('main',
			get_template_directory_uri() . '/static/css/main.css',
			array(), $theme_info->version ); ?>

		<?php wp_enqueue_style('fa',
			get_template_directory_uri() . '/static/fonts/fontawesome/css/fontawesome.min.css',
			[], false ); ?>
		<?php wp_enqueue_style('fa-brands',
			get_template_directory_uri() . '/static/fonts/fontawesome/css/brands.min.css',
			['fa'], false ); ?>
		<?php wp_enqueue_style('fa-solid',
			get_template_directory_uri() . '/static/fonts/fontawesome/css/solid.min.css',
			['fa'], false ); ?>

		<?php wp_enqueue_script( 'scripts',
			get_template_directory_uri() . '/static/js/main.js',
			array('jquery'), $theme_info->version, true );
		?>

		<meta name="ajaxurl" content="<?php echo admin_url( 'admin-ajax.php' ); ?>">

		<?php wp_head(); ?>

	</head>
	<body<?php if(is_home()) { echo ' class="home"'; } ?>
		style="--theme-color: <?php echo $theme_color; ?>; --text-color: <?php echo get_contrast_color($theme_color); ?>">

		<a href="#site-content" class="skip">
			<?php echo esc_attr_x('Skip to content', 'Accessibility skip to content element', 'svid-theme-domain');?>
		</a>

		<header class="bies">

			<?php
			$wpml_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
			?>

			<a href="<?php echo $wpml_home_url; ?>">
				<picture class="bies__picture">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="bies__image">
						<defs><style>.cls-1{fill:#fafafa;}</style></defs><title>logo-mark</title><g id="Layer_2" data-name="Layer 2"><g id="Logo_white" data-name="Logo white"><path class="cls-1" d="M69.76,31a8.78,8.78,0,0,0-3.17-2.68,9,9,0,0,0-4.06-.88h-5V52.36h5a8.55,8.55,0,0,0,3.66-.77,9.94,9.94,0,0,0,3.12-2.33h0c2.14-2.29,3.18-5.36,3.18-9.37a13.93,13.93,0,0,0-2.71-8.84Z"/><path class="cls-1" d="M0,0V100L100,70V0ZM32.5,72.5h-10v-45h10Zm45-17.08v0A17.63,17.63,0,0,1,63.07,62.5H47.5v-45H63.07a17.59,17.59,0,0,1,14.4,7.06A24.12,24.12,0,0,1,82.5,40,24.54,24.54,0,0,1,77.53,55.42Z"/></g></g></svg>
				</picture>
			</a>

			<nav class="primary-menu">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'container' => false,
					'menu_class' => 'primary-menu__list',
				 	'walker' => new Walker_Primary() ) ); ?>
			</nav>

		</header>

		<div class="js-menu-toggle menu-toggle">
			menu
		</div>
