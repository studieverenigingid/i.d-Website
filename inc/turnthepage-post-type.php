<?php

/*-------------------------------------*\
	TURN THE PAGE POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_turnthepage_post_type' );

function create_turnthepage_post_type() {
	$args = array(
		'description' => 'Turn The Page Post Type',
		'show_ui' => true,
		'menu_position' => 5,
		'exclude_from_search' => false,
		'labels' => array(
			'name'=> 'Turn The Page',
			'singular_name' => 'Issue',
			'add_new' => 'Add new issue',
			'add_new_item' => 'Add new issue',
			'edit' => 'Edit issue',
			'edit_item' => 'Edit issue',
			'new-item' => 'New issue',
			'view' => 'View issue',
			'view_item' => 'View issue',
			'search_items' => 'Search Turn The Page issues',
			'not_found' => 'No Turn The Page issues found',
			'not_found_in_trash' => 'No Turn The Page issues found in the trash',
			'parent' => 'Parent issue'
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon'   => 'dashicons-media-document',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title'
			),
		'taxonomies' => array( 'category', 'tags' )
	);
	register_post_type( 'turnthepage' , $args );
}

function turnthepage_activate() {
	flush_rewrite_rules();
}

function turnthepage_deactivate() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'turnthepage_activate' );
register_deactivation_hook( __FILE__, 'turnthepage_deactivate' );
