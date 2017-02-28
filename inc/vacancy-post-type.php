<?php

/*-------------------------------------*\
	VACANCY POST TYPE
\*-------------------------------------*/

add_action( 'init', 'create_vacancy_post_type' );

function create_vacancy_post_type() {
	$args = array(
		'description' => 'Vacancy Post Type',
		'show_ui' => true,
		'menu_position' => 5,
		'exclude_from_search' => false,
		'labels' => array(
			'name'=> 'Vacancies',
			'singular_name' => 'Vacancy',
			'add_new' => 'Add new vacancy',
			'add_new_item' => 'Add new vacancy',
			'edit' => 'Edit vacancy',
			'edit_item' => 'Edit vacancy',
			'new-item' => 'New vacancy',
			'view' => 'View vacancy',
			'view_item' => 'View vacancy',
			'search_items' => 'Search vacancies',
			'not_found' => 'No vacancies found',
			'not_found_in_trash' => 'No vacancies found in the trash',
			'parent' => 'Parent vacancy'
		),
		'public' => true,
		'has_archive' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' 
			),
		'taxonomies' => array( 'category' )
	);
	register_post_type( 'vacancy' , $args );
}

function vacancy_activate() {
	flush_rewrite_rules();
}

function vacancy_deactivate() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'vacancy_activate' );
register_deactivation_hook( __FILE__, 'vacancy_deactivate' );
