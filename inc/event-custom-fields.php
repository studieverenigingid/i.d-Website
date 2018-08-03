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
				'type' => 'date_time_picker',
				'instructions' => 'This should look something like this 2009-11-13T10:39:35Z',
				'default_value' => '',
				'placeholder' => 'YYYY-MM-DDTHH:MM:SSZ',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'display_format' => 'd-m-Y H:i',
				'return_format' => 'd-m-Y H:i',
				'maxlength' => 20,
			),
			array (
				'key' => 'field_5898a8b0af838',
				'label' => 'End date and time',
				'name' => 'end_datetime',
				'type' => 'date_time_picker',
				'instructions' => 'This should look something like this 2009-11-13T10:39:35Z',
				'default_value' => '',
				'placeholder' => 'YYYY-MM-DDTHH:MM:SSZ',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'display_format' => 'd-m-Y H:i',
				'return_format' => 'd-m-Y H:i',
				'maxlength' => 20,
			),
			array (
				'key' => 'field_5898a8ceaf839',
				'label' => 'Location coordinates',
				'name' => 'location_coordinates',
				'type' => 'google_map',
				'center_lat' => '52.001935',
				'center_lng' => '4.3683591',
				'zoom' => 14,
				'height' => '',
			),
			array (
				'key' => 'field_58ac3082524a2',
				'label' => 'Location name',
				'name' => 'location_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'ID Kafee',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_58ac2175c6259',
				'label' => 'Facebook url',
				'name' => 'facebook_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://www.facebook.com/events/299769637065455/',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_58ac21cfc625a',
				'label' => 'Ticket url',
				'name' => 'ticket_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://id.tudelft.nl/tickets/for/iof/',
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
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
			),
		),
		'menu_order' => 0,
	));
}



// Event files (requires ACF Pro)

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_590849a5a0993',
	'title' => 'Event files',
	'fields' => array (
		array (
			'key' => 'field_590849aac66df',
			'label' => 'File list',
			'name' => 'file_list',
			'type' => 'repeater',
			'instructions' => '',
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
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array (
				array (
					'key' => 'field_590849c9c66e0',
					'label' => 'Name',
					'name' => 'file_name',
					'type' => 'text',
					'instructions' => 'Displayed name of the file.',
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
					'key' => 'field_590849d8c66e1',
					'label' => 'File',
					'name' => 'file',
					'type' => 'file',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'library' => 'all',
					'min_size' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'event',
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





// Protect these files
function event_file_upload_prefilter( $errors, $file, $field ) {

  // only allow admin
  if( !current_user_can('manage_options') ) {
    // this returns value to the wp uploader UI
    // if you remove the ! you can see the returned values
    $errors[] = 'test prefilter';
    $errors[] = print_r($_FILES,true);
    $errors[] = $_FILES['async-upload']['name'] ;

  }
  //this filter changes directory just for item being uploaded
  add_filter('upload_dir', 'event_files_upload_dir');

  // return
  return $errors;

}
add_filter(
	'acf/upload_prefilter/name=file',
	'event_file_upload_prefilter'
);

function event_files_upload_dir( $param ) {
  $mydir = '/event_files';

  $param['path'] = $param['basedir'] . $mydir;
  $param['url'] = $param['baseurl'] . $mydir;

	return $param;
}

endif;
