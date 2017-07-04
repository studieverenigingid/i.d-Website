<?php
	if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_591976944ef18',
	'title' => 'Contact Page',
	'fields' => array (
		array (
			'key' => 'field_591976ed53a7a',
			'label' => 'Contact Page Block',
			'name' => 'contact_page_block',
			'type' => 'repeater',
			'instructions' => 'These sections will be shown on the contact page',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_5919772153a7b',
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => 'Add Contact Block',
			'sub_fields' => array (
				array (
					'key' => 'field_5919772153a7b',
					'label' => 'Contact Block Title',
					'name' => 'contact_block_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
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
					'key' => 'field_5919773653a7c',
					'label' => 'Contact Block Content',
					'name' => 'contact_block_content',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
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
				'value' => 'page-contact.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'excerpt',
		1 => 'discussion',
		2 => 'comments',
		3 => 'categories',
		4 => 'tags',
	),
	'active' => 1,
	'description' => '',
));

endif;
?>
