<?php
global $img_folder;
global $header_class;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" <?php if(is_post_type_archive('turnthepage') || is_singular('turnthepage')) {
			?> content="<?php the_field('issue_background_color');?>"<?php
		} elseif (is_post_type_archive('board') || is_singular('board')) {
			?> content="<?php the_field('board_color');?>"<?php
		}else { echo 'content="#55ccbb"';
		}?>>

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

		<link rel="canonical" href="https://studieverenigingid.nl/" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>" />
		<meta property="og:url" content="https://studieverenigingid.nl/" />
		<meta property="og:site_name" content="Study association i.d" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?>" />
		<meta name="twitter:site" content="@svidtweet" />
		<meta name="twitter:creator" content="@svidtweet" />
		<script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"https:\/\/studieverenigingid.nl\/","name":"Study association i.d","potentialAction":{"@type":"SearchAction","target":"https:\/\/studieverenigingid.nl\/?s={search_term_string}","query-input":"required name=search_term_string"}}</script>
		<script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"Organization","url":"https:\/\/studieverenigingid.nl\/","sameAs":["https:\/\/www.facebook.com\/studieverenigingi.d\/","https:\/\/www.instagram.com\/studieverenigingid\/","https:\/\/twitter.com\/svidtweet"],"@id":"#organization","name":"Study association i.d","logo":"https:\/\/studieverenigingid.nl\/wp-content\/uploads\/2017\/06\/Logo-Studievereniging-i.d-EN-Duotoon.png"}</script>

		<?php wp_enqueue_style('fontawesome',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('main',
			get_template_directory_uri() . '/static/css/main.css'); ?>

		<?php wp_enqueue_script( 'scripts',
			get_template_directory_uri() . '/static/js/main.js',
			array('jquery'), '0.1', true );
			wp_localize_script( 'scripts', 'wpjs_object',
			array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		?>

		<?php wp_head(); ?>

	</head>
	<body<?php if(is_home()) { echo ' class="home"'; } ?>>

		<header class="bies colorVibrant <?=$header_class?>"
			<?php if(is_post_type_archive('turnthepage') || is_singular('turnthepage')) {
			?> style="background-color:<?php the_field('issue_background_color');?>"<?php
			} elseif (is_post_type_archive('board') || is_singular('board')) {
			?> style="background-color:<?php the_field('board_color');?>"<?php } ?>
		>

			<a href="<?php echo get_site_url(); ?>">
				<picture>
					<source srcset="<?=$img_folder?>bies.svg" type="image/svg+xml">
					<img class="bies__image" alt="Study association i.d"
						srcset="<?=$img_folder?>bies.png 1x,
							<?=$img_folder?>bies@2x.png 2x"
						src="<?=$img_folder?>bies.png">
				</picture>
			</a>

			<div class="js-menu-toggle bies__menu-toggle">
				menu
			</div>

			<?php wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'container' => 'nav',
				'container_class' => 'primary-menu',
				'menu_class' => 'primary-menu__list' ) ); ?>

		</header>
