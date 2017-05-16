<?php

/*-------------------------------------*\
	GROUP POST TYPE (boards & committees)
\*-------------------------------------*/

add_action( 'init', 'create_group_post_type' );

function create_group_post_type() {
	$args = array(
		'description' => 'Group Post Type',
		'show_ui' => true,
		'menu_position' => 4,
		'exclude_from_search' => false,
		'labels' => array(
			'name'=> 'Groups',
			'singular_name' => 'Group',
			'add_new' => 'Add new group',
			'add_new_item' => 'Add new group',
			'edit' => 'Edit group',
			'edit_item' => 'Edit group',
			'new-item' => 'New group',
			'view' => 'View group',
			'view_item' => 'View group',
			'search_items' => 'Search groups',
			'not_found' => 'No groups found',
			'not_found_in_trash' => 'No groups found in the trash',
			'parent' => 'Parent group'
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon'   => 'dashicons-groups',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
	);
	register_post_type( 'group' , $args );
}

function group_activate() {
	flush_rewrite_rules();
}

function group_deactivate() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'group_activate' );
register_deactivation_hook( __FILE__, 'group_deactivate' );
