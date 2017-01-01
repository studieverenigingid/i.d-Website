<?php /* Create a variable for the image folder, so you don’t have to PHP it
	every time, which would make your code significantly more ugly. */
	$img_folder = get_bloginfo('template_directory') . '/static/img/'; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#000000"><?php /* TODO:
		replace with realfavicongenerator.net snippet */ ?>

		<?php
			if ( ! function_exists( '_wp_render_title_tag' ) ) :
			function spi_render_title() {
		?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
			}
			add_action( 'wp_head', 'spi_render_title' );
			endif;
		?>

		<?php wp_enqueue_style('main',
			get_template_directory_uri() . '/static/css/main.css') ?>

		<?php wp_enqueue_script( 'scripts',
			get_template_directory_uri() . '/static/js/main.js',
			array('jquery'), '0.1', true ); ?>

		<?php wp_head(); ?>

	</head>
	<body<?php if(is_home()) { echo ' class="home"'; } ?>>

		<header class="bies">
			<picture>
				<source srcset="<?=$img_folder?>bies.svg" type="image/svg+xml">
				<img class="bies__image" alt="Study association i.d"
					srcset="<?=$img_folder?>bies.png 1x,
						<?=$img_folder?>bies@2x.png 2x"
					src="<?=$img_folder?>bies.png">
			</picture>
		</header>

		<?php wp_nav_menu( array( 'theme_location' => 'sidebar-menu', 'container' => 'nav', 'container_class' => 'menu', 'menu_class' => 'menu__list' ) ); ?>

	