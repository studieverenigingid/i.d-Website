<?php

/*-------------------------------------*\
	EVENT POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_event_post_type' );

function create_event_post_type() {
	$args = array(
		'description' => 'Event Post Type',
		'show_ui' => true,
		'menu_position' => 4,
		'exclude_from_search' => false,
		'labels' => array(
			'name'=> 'Events',
			'singular_name' => 'Event',
			'add_new' => 'Add new event',
			'add_new_item' => 'Add new event',
			'edit' => 'Edit event',
			'edit_item' => 'Edit event',
			'new-item' => 'New event',
			'view' => 'View event',
			'view_item' => 'View event',
			'search_items' => 'Search events',
			'not_found' => 'No events found',
			'not_found_in_trash' => 'No events found in the trash',
			'parent' => 'Parent event'
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon'   => 'dashicons-schedule',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
	);
	register_post_type( 'event' , $args );
}

function event_activate() {
	flush_rewrite_rules();
}

function event_deactivate() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'event_activate' );
register_deactivation_hook( __FILE__, 'event_deactivate' );

function order_events_by_start_date( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'event' ) ) {
		$query->set( 'meta_key', 'start_datetime' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'DESC' );
	}
}
add_action( 'pre_get_posts', 'order_events_by_start_date' );
