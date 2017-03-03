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
	}
?>