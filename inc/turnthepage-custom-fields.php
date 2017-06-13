<?php
  if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array (
  	'key' => 'group_5929ddcd5f868',
  	'title' => 'Turn The Page',
  	'fields' => array (
  		array (
  			'key' => 'field_5929dddc24312',
  			'label' => 'Issuu Preview Embed',
  			'name' => 'issuu_preview_embed',
  			'type' => 'textarea',
  			'instructions' => 'Set the PREVIEW embed code for the Turn The Page Issue',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'maxlength' => '',
  			'rows' => 2,
  			'new_lines' => '',
  		),
  		array (
  			'key' => 'field_5929de2524313',
  			'label' => 'Issuu Full Version Embed',
  			'name' => 'issuu_full_embed',
  			'type' => 'textarea',
  			'instructions' => 'Set the FULL VERSION embed code for the Turn The Page Issue',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'maxlength' => '',
  			'rows' => 2,
  			'new_lines' => '',
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'turnthepage',
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

  acf_add_local_field_group(array (
  	'key' => 'group_5929e6b5be4e1',
  	'title' => 'Turn The Page Side',
  	'fields' => array (
  		array (
  			'key' => 'field_5929e317f4175',
  			'label' => 'Issue Number',
  			'name' => 'issue_number',
  			'type' => 'number',
  			'instructions' => 'Which Issue is this?',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 60,
  			'placeholder' => 60,
  			'prepend' => '',
  			'append' => '',
  			'min' => 1,
  			'max' => '',
  			'step' => 1,
  		),
  		array (
  			'key' => 'field_5929e7f03b5f1',
  			'label' => 'Issue Background Color',
  			'name' => 'issue_background_color',
  			'type' => 'color_picker',
  			'instructions' => 'Set the background color for this issue',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '#ef686c',
  		),
  	),
  	'location' => array (
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

  endif;
?>
