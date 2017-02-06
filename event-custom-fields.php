<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_event-specific-data',
		'title' => 'Event specific data',
		'fields' => array (
			array (
				'key' => 'field_5898a7eeaf837',
				'label' => 'Start date and time',
				'name' => 'start_datetime',
				'type' => 'text',
				'instructions' => 'This should look something like this 2009-11-13T10:39:35Z',
				'default_value' => '',
				'placeholder' => 'YYYY-MM-DDTHH:MM:SSZ',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 20,
			),
			array (
				'key' => 'field_5898a8b0af838',
				'label' => 'End date and time',
				'name' => 'end_datetime',
				'type' => 'text',
				'instructions' => 'This should look something like this 2009-11-13T10:39:35Z',
				'default_value' => '',
				'placeholder' => 'YYYY-MM-DDTHH:MM:SSZ',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 20,
			),
			array (
				'key' => 'field_5898a8ceaf839',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'google_map',
				'center_lat' => '52.001935',
				'center_lng' => '4.3683591',
				'zoom' => 14,
				'height' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
			),
		),
		'menu_order' => 0,
	));
}
