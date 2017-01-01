<?php

	register_nav_menus( array(
			'sidebar-menu' => 'Primary Menu'
	) );

	add_theme_support( 'post-thumbnails' );


	add_action('init', 'modify_jquery');

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
		return '...
		<a class="moretag" href="'. get_permalink($post->ID) . '">Lees verder</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	

	function add_class_to_excerpt( $excerpt ) {
    	return str_replace('<p', '<p class="news__item__excerpt"', $excerpt);
	}
	add_filter( "the_excerpt", "add_class_to_excerpt" );
	
?>
