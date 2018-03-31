<?php

/*-------------------------------------*\
	COMMITTEE POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_hon_mem_post_type' );

function create_hon_mem_post_type() {
	$args = array(
		'description' => 'Honorary member Post Type',
		'show_ui' => true,
		'menu_position' => 4,
		'exclude_from_search' => false,
		'labels' => array(
			'name'=> 'Honorary members',
			'singular_name' => 'Honorary member',
			'add_new' => 'Add new honorary member',
			'add_new_item' => 'Add new honorary member',
			'edit' => 'Edit honorary member',
			'edit_item' => 'Edit honorary member',
			'new-item' => 'New honorary member',
			'view' => 'View honorary member',
			'view_item' => 'View honorary member',
			'search_items' => 'Search honorary members',
			'not_found' => 'No honorary members found',
			'not_found_in_trash' => 'No honorary members found in the trash',
			'parent' => 'Parent honorary member'
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon'   => 'dashicons-groups',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title', 'excerpt' )
	);
	register_post_type( 'honorary_member' , $args );
}

function hon_mem_activate() {
	flush_rewrite_rules();
}

function hon_mem_deactivate() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'hon_mem_activate' );
register_deactivation_hook( __FILE__, 'hon_mem_deactivate' );

function set_posts_per_page_for_hon_mems( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'honorary_member' ) ) {
		$query->set( 'posts_per_page', '-1' );
	}
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_hon_mems' );
