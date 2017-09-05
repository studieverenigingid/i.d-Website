<?php

	include( 'inc/event-post-type.php' );
	include( 'inc/event-custom-fields.php' );

	include( 'inc/vacancy-post-type.php' );
	include( 'inc/vacancy-custom-fields.php' );

	include( 'inc/committee-post-type.php' );
	include( 'inc/board-post-type.php' );
	include( 'inc/board-custom-fields.php' );

	include( 'inc/turnthepage-post-type.php' );
	include( 'inc/turnthepage-custom-fields.php' );

	include( 'inc/education-custom-fields.php' );

	include( 'inc/contact-custom-fields.php' );

	include( 'inc/kafee-custom-fields.php' );

	include( 'inc/theme-settings.php');

	include( 'inc/walkers.php' );

	include( 'inc/custom-menu-functions.php');

	include( 'inc/custom-language-switcher.php' );

	register_nav_menus( array(
		'primary-menu' => 'Primary Menu',
		'sitemap' => 'Footer Sitemap'
	) );


	add_action( 'after_setup_theme', 'custom_theme_setup' );
	add_action( 'init', 'modify_jquery' );
	add_action( 'wp_ajax_nopriv_social_feed_ajax_request', 'social_feed_ajax_request' );
	add_action( 'wp_ajax_social_feed_ajax_request', 'social_feed_ajax_request' );
	add_action( 'wp_ajax_nopriv_education_input', 'education_input' );
	add_action( 'wp_ajax_education_input', 'education_input' );
	add_action( 'wp_ajax_user_update', 'user_update');
	add_action( 'set_current_user', 'cc_hide_admin_bar' );
	if(!is_user_logged_in()){
	 add_action('init','custom_login_page');
	}
	add_action( 'wp_login_failed', 'login_failed' );
	add_action( 'wp_logout', 'logout_page' );


	function custom_theme_setup() {
		add_theme_support( 'post-thumbnails' ); // Allow posts to have thumbnails
		add_theme_support( 'html5' ); // Make the search form input type="search"
		add_theme_support( 'title-tag' ); // Fix the document title tag
	}

	/* Add thumbnail size */
	add_image_size( 'thumb--vacancy', 860, 500, array( 'center', 'center' ) );
	add_image_size( 'thumb--news', 500, 350, array( 'center', 'center' ) );

	/* Replace Wordpress’s version of jQuery with Google API version, since most
		 browsers will have it in their cache. */
	function modify_jquery() {
		if (!is_admin()) {
			wp_deregister_script('jquery');
			wp_register_script('jquery',
				'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
				false, '3.1.1', true);
			wp_enqueue_script('jquery');
		}
	}

	// Echo page color (used in theme-color meta and header)
	function theme_color($default){
		if(is_post_type_archive('turnthepage') || is_singular('turnthepage')) {
			echo the_field('issue_background_color');
		} elseif (is_post_type_archive('board') || is_singular('board')) {
			echo the_field('board_color');
		} elseif (is_page_template('page-kafee.php')) {
			echo "#6dadb6";
		} elseif (is_page_template('education-page.php')) {
			echo "#F18918";
		} elseif ($default){
			echo "#55ccbb";
		}
	}

	// Replaces the excerpt "Read More" text by a link
	function new_excerpt_more($more) {
		global $post;
		$more_text = esc_attr_x('Read on', 'Read more link at (news) excerpt', 'svid-theme-domain');
		$more_link = '... <a class="moretag" href="%s">%s</a>';
		$more_link = sprintf($more_link, get_permalink($post->ID), $more_text);
		return $more_link;
	}
	add_filter('excerpt_more', 'new_excerpt_more');


	function add_class_to_excerpt( $excerpt ) {
			return str_replace('<p', '<p class="news-item__excerpt"', $excerpt);
	}
	add_filter( "the_excerpt", "add_class_to_excerpt" );

	function social_feed_ajax_request() {
	// do what you want with the variables passed through here
		include 'inc/social-feed.php';
		wp_die();
	}

	function user_update() {
		include 'inc/user-update.php';
		wp_die();
	}

	function education_input() {
		include 'inc/send-education.php';
		wp_die();
	}

	function cc_hide_admin_bar() {
	  if (!current_user_can('edit_posts')) {
	    show_admin_bar(false);
	  }
	}

	/* Create a variable for the image folder, so you don’t have to PHP it every time, which would make your code significantly more ugly. */
	$img_folder = get_bloginfo('template_directory') . '/static/img/';

	/* Change max upload size for every installation where this theme is
		 installed */
	@ini_set( 'upload_max_size' , '64M' );
	@ini_set( 'post_max_size', '64M');
	@ini_set( 'max_execution_time', '300' );



?>
