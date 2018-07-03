<?php
global $img_folder;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="<?php theme_color(true); ?>">

		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#55ccbb">

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

		<?php $theme_info = wp_get_theme(); ?>

		<?php wp_enqueue_style('muli',
		'https://fonts.googleapis.com/css?family=Muli:300,800');
		wp_enqueue_style('main',
			get_template_directory_uri() . '/static/css/main.css',
			array(), $theme_info->version ); ?>

		<?php wp_enqueue_style('fontawesome',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('main',
			get_template_directory_uri() . '/static/css/main.css',
			array(), $theme_info->version ); ?>

		<?php wp_enqueue_script( 'scripts',
			get_template_directory_uri() . '/static/js/main.js',
			array('jquery'), $theme_info->version, true );
			wp_localize_script( 'scripts', 'wpjs_object',
			array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		?>

		<?php wp_head(); ?>

	</head>
	<body<?php if(is_home()) { echo ' class="home"'; } ?>>

		<header class="bies" style="background:<?php theme_color(false);?>">

			<?php
			$wpml_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
			?>

			<a href="<?php echo $wpml_home_url; ?>">
				<picture>
					<source srcset="<?=$img_folder?>bies-<?=constant('ICL_LANGUAGE_CODE')?>.svg" type="image/svg+xml">
					<img class="bies__image" alt="Study association i.d"
						srcset="<?=$img_folder?>bies-<?=constant('ICL_LANGUAGE_CODE')?>.png 1x,
							<?=$img_folder?>bies-<?=constant('ICL_LANGUAGE_CODE')?>@2x.png 2x"
						src="<?=$img_folder?>bies-<?=constant('ICL_LANGUAGE_CODE')?>.png">
				</picture>
			</a>

			<nav class="primary-menu">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'container' => false,
					'menu_class' => 'primary-menu__list' ) ); ?>

					<?php custom_language_switcher(); ?>
			</nav>

		</header>

		<div class="js-menu-toggle menu-toggle">
			menu
		</div>
