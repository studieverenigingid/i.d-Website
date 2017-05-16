<?php

/*-------------------------------------*\
	COMMITTEE POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_committee_post_type' );

function create_committee_post_type() {
	$args = array(
		'description' => 'Committee Post Type',
		'show_ui' => true,
		'menu_position' => 4,
		'exclude_from_search' => false,
		'labels' => array(
			'name'=> 'Committees',
			'singular_name' => 'Committee',
			'add_new' => 'Add new committee',
			'add_new_item' => 'Add new committee',
			'edit' => 'Edit committee',
			'edit_item' => 'Edit committee',
			'new-item' => 'New committee',
			'view' => 'View committee',
			'view_item' => 'View committee',
			'search_items' => 'Search committees',
			'not_found' => 'No committees found',
			'not_found_in_trash' => 'No committees found in the trash',
			'parent' => 'Parent committee'
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon'   => 'dashicons-groups',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
	);
	register_post_type( 'committee' , $args );
}

function committee_activate() {
	flush_rewrite_rules();
}

function committee_deactivate() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'committee_activate' );
register_deactivation_hook( __FILE__, 'committee_deactivate' );

register_taxonomy( 'committee-name', array('committee'), array(
	'hierarchical' => true,
	'labels' => array(
		'name' => 'Committee names',
		'singular_name' => 'Committee name',
		'search_items' =>  'Search committee names',
		'all_items' => 'All committee names',
		'edit_item' => 'Change committee name',
		'update_item' => 'Update committee name',
		'add_new_item' => 'Add new committee name',
		'new_item_name' => 'New interview committee name'
	),
	'show_ui' => true,
));
