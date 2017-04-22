<?php
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_vacancy-post-type',
			'title' => 'Vacancy post type',
			'fields' => array (
				array (
					'key' => 'field_58b581aba3f51',
					'label' => 'Start date',
					'name' => 'dates_%_start_date',
					'type' => 'date_picker',
					'instructions' => 'Set date to start promotion of vacancy on front page',
					'date_format' => 'yymmdd',
					'display_format' => 'dd/mm/yy',
					'first_day' => 1,
				),
				array (
					'key' => 'field_58b581e8a3f52',
					'label' => 'End date',
					'name' => 'dates_%_end_date',
					'type' => 'date_picker',
					'instructions' => 'Set date to end promotion of vacancy on front page',
					'date_format' => 'yymmdd',
					'display_format' => 'dd/mm/yy',
					'first_day' => 1,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'vacancy',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'side',
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));

		register_field_group(array (
		'id' => 'acf_vacancy',
		'title' => 'Vacancy',
		'fields' => array (
			array (
				'key' => 'field_58d0e4e2ece31',
				'label' => 'Vacancy attachment',
				'name' => 'vacancy_attachment',
				'type' => 'file',
				'instructions' => 'Include a pdf or description for the vacancy',
				'save_format' => 'object',
				'library' => 'all',
			),
			array (
				'key' => 'field_58fb756ca23dc',
				'label' => 'Company',
				'name' => 'company',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_58fb7c869c3ed',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'instructions' => 'The city/country/etc. where the job is located.',
				'default_value' => '',
				'placeholder' => 'Anywhere',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'vacancy',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
		));
	}
?>
