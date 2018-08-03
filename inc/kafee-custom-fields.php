<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_5959f8595f16d',
	'title' => 'ID Kafee Page',
	'fields' => array (
		array (
			'key' => 'field_5959f87c1dc2f',
			'label' => 'Content Blocks',
			'name' => 'kafee_content_blocks',
			'type' => 'repeater',
			'instructions' => 'Add a custom info block to the Kafee Page',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => '',
			'sub_fields' => array (
				array (
					'key' => 'field_5959f984884b6',
					'label' => 'Content Title',
					'name' => 'kafee_content_title',
					'type' => 'text',
					'instructions' => 'Title for your custom content block.',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array (
					'key' => 'field_5959f9a4884b7',
					'label' => 'Content Info',
					'name' => 'kafee_content_info',
					'type' => 'wysiwyg',
					'instructions' => 'Content for your custom content block.',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 1,
					'delay' => 0,
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-kafee.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
?>
