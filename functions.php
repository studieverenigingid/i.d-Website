<?php

	include( 'vacancy-post-type.php' );

	register_nav_menus( array(
			'primary-menu' => 'Primary Menu'
	) );


	add_action( 'after_setup_theme', 'custom_theme_setup' );
	add_action( 'init', 'modify_jquery' );


	function custom_theme_setup() {
		add_theme_support( 'post-thumbnails' ); // Allow posts to have thumbnails
		add_theme_support( 'html5' ); // Make the search form input type="search"
		add_theme_support( 'title-tag' ); // Fix the document title tag
	}


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

	// Replaces the excerpt "Read More" text by a link
	function new_excerpt_more($more) {
		global $post;
		$more_text = esc_attr_x('Read on', 'Read more link at (news) excerpt');
		$more_link = '...<br><a class="moretag" href="%s">%s</a>';
		$more_link = sprintf($more_link, get_permalink($post->ID), $more_text);
		return $more_link;
	}
	add_filter('excerpt_more', 'new_excerpt_more');


	function add_class_to_excerpt( $excerpt ) {
			return str_replace('<p', '<p class="news-item__excerpt"', $excerpt);
	}
	add_filter( "the_excerpt", "add_class_to_excerpt" );

?>
