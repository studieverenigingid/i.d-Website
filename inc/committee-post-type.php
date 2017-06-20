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
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title', 'excerpt' )
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

register_taxonomy( 'committee-group', array('committee'), array(
	'hierarchical' => true,
	'labels' => array(
		'name' => 'Committee groups',
		'singular_name' => 'Committee group',
		'search_items' =>  'Search committee groups',
		'all_items' => 'All committee groups',
		'edit_item' => 'Change committee group',
		'update_item' => 'Update committee group',
		'add_new_item' => 'Add new committee group',
		'new_item_name' => 'New committee group'
	),
	'show_ui' => true,
));

function set_posts_per_page_for_committees( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'committee' ) ) {
		$query->set( 'posts_per_page', '-1' );
	}
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_committees' );
