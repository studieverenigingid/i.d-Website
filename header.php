<?php
global $img_folder;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="<?php theme_color(true); ?>">

		<link rel="apple-touch-icon" sizes="180x180"
			href="/apple-touch-icon.png?v=<?php echo $theme_info->version; ?>">
		<link rel="icon" type="image/png" sizes="32x32"
			href="/favicon-32x32.png?v=<?php echo $theme_info->version; ?>">
		<link rel="icon" type="image/png" sizes="16x16"
			href="/favicon-16x16.png?v=<?php echo $theme_info->version; ?>">
		<link rel="manifest" href="/manifest.json">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#f6b632">

		<?php $theme_info = wp_get_theme(); ?>

		<?php
		wp_enqueue_style('muli',
			'https://fonts.googleapis.com/css2?family=Muli:wght@300;800&display=swap');
		wp_enqueue_style('main',
			get_template_directory_uri() . '/static/css/main.css',
			array(), $theme_info->version ); ?>

		<script src="https://kit.fontawesome.com/82730669d1.js"
			async crossorigin="anonymous"></script>

		<?php wp_enqueue_script( 'scripts',
			get_template_directory_uri() . '/static/js/main.js',
			array('jquery'), $theme_info->version, true );
		?>

		<meta name="ajaxurl" content="<?php echo admin_url( 'admin-ajax.php' ); ?>">

		<?php wp_head(); ?>

	</head>
	<body<?php if(is_home()) { echo ' class="home"'; } ?>
		style="--theme-color: <?php theme_color(true); ?>;">

		<a href="#site-content" class="skip">
			<?php echo esc_attr_x('Skip to content', 'Accessibility skip to content element', 'svid-theme-domain');?>
		</a>

		<header class="bies">

			<?php
			$wpml_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
			?>

			<a href="<?php echo $wpml_home_url; ?>">
				<picture class="bies__picture">
					<source srcset="<?=$img_folder?>logo-mark.svg" type="image/svg+xml">
					<img class="bies__image" alt="ID"
						srcset="<?=$img_folder?>logo-mark.png 1x,
							<?=$img_folder?>logo-mark@2x.png 2x"
						src="<?=$img_folder?>logo-mark.png">
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
