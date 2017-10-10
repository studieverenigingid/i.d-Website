<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_59dce45192a76',
	'title' => 'Page colour',
	'fields' => array (
		array (
			'key' => 'field_59dce45adeb6c',
			'label' => 'Page colour',
			'name' => 'page_color',
			'type' => 'color_picker',
			'value' => NULL,
			'instructions' => 'Pick the colour for the background of the header of the page.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'event',
			),
		),
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'vacancy',
			),
		),
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'board',
			),
		),
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'turnthepage',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

add_action( 'save_post', 'event_image_color' );

function event_image_color($post_id) {

	$post_type = get_post_type($post_id);

	// If this isn't an event, don't update it.
	if ( 'event' != $post_type ) return;

	// If the page color is custom set, don’t update it.
	if ( '' != get_field('page_color') ) return;

	// If there is no post thumbnail, we can’t extract color; don’t update it.
	if ( !has_post_thumbnail() ) return;

	$thumbnail_url = get_the_post_thumbnail_url($post_id, 'thumb');

	include_once('colors.inc.php');

	$get_colors = new GetMostCommonColors();

	$colors = $get_colors->Get_Color(
		$thumbnail_url, // image url
		10, 1, 1, 30 // 6 colors, reduce brightness, reduce gradients, delta of 24
	);

	end($colors);
	$new_color = '#' . key($colors);

	update_field('page_color', $new_color, $post_id);

}

endif;
