<?php

/*-------------------------------------*\
	BOARD POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_board_post_type' );

function create_board_post_type() {
	$args = array(
		'description' => 'Board Post Type',
		'show_ui' => true,
		'menu_position' => 4,
		'exclude_from_search' => false,
		'labels' => array(
			'name'=> 'Boards',
			'singular_name' => 'Board',
			'add_new' => 'Add new board',
			'add_new_item' => 'Add new board',
			'edit' => 'Edit board',
			'edit_item' => 'Edit board',
			'new-item' => 'New board',
			'view' => 'View board',
			'view_item' => 'View board',
			'search_items' => 'Search boards',
			'not_found' => 'No boards found',
			'not_found_in_trash' => 'No boards found in the trash',
			'parent' => 'Parent board'
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon'   => 'dashicons-groups',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
	);
	register_post_type( 'board' , $args );
}

function board_activate() {
	flush_rewrite_rules();
}

function board_deactivate() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'board_activate' );
register_deactivation_hook( __FILE__, 'board_deactivate' );
