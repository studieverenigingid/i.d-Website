<?php
	add_action( 'admin_menu', 'id_add_admin_menu' );
	add_action( 'admin_init', 'id_settings_init' );


	function id_add_admin_menu(  ) {

		add_submenu_page( 'options-general.php', 'ID Website Settings', 'ID Website Settings', 'manage_options', 'ID-website_settings', 'id_options_page' );

	}


	function id_settings_init(  ) {

		// Registering Vimeo section and fields

		register_setting( 'id_settings_group', 'id_settings' );

		add_settings_section(
			'id_vimeoSettings_section',
			__( 'Vimeo API settings', 'wordpress' ),
			'id_vimeoSettings_section_callback',
			'ID-website_settings'
		);

		add_settings_field(
			'id_vimeo_api_id_field',
			__( 'Vimeo API ID', 'wordpress' ),
			'id_vimeo_api_id_render',
			'ID-website_settings',
			'id_vimeoSettings_section'
		);

		add_settings_field(
			'id_vimeo_api_secret_field',
			__( 'Vimeo API Secret', 'wordpress' ),
			'id_vimeo_api_secret_render',
			'ID-website_settings',
			'id_vimeoSettings_section'
		);



		// Registering Flickr section and fields

		add_settings_section(
			'id_flickrSettings_section',
			__( 'Flickr API settings', 'wordpress' ),
			'id_flickrSettings_section_callback',
			'ID-website_settings'
		);

		add_settings_field(
			'id_flickr_api_key_field',
			__( 'Flickr API Key', 'wordpress' ),
			'id_flickr_api_key_render',
			'ID-website_settings',
			'id_flickrSettings_section'
		);

		// Registering education input section and fields

		add_settings_section(
			'id_educationInputSettings_section',
			__( 'Education input receivers', 'wordpress' ),
			'id_educationInputSettings_section_callback',
			'ID-website_settings'
		);

		add_settings_field(
			'id_education_email_addresses_field',
			__( 'Education input receiver email addresses', 'wordpress' ),
			'id_education_input_email_addresses_render',
			'ID-website_settings',
			'id_educationInputSettings_section'
		);

		add_settings_field(
			'id_anonymous_email_addresses_field',
			__( 'Anonymous input receiver email addresses', 'wordpress' ),
			'id_anonymous_input_email_addresses_render',
			'ID-website_settings',
			'id_educationInputSettings_section'
		);

	}

	// Vimeo form rendering

	function id_vimeo_api_id_render(  ) {

		$options = get_option( 'id_settings' );
		?>
		<input type='text' name='id_settings[id_vimeo_api_id_field]' value='<?php echo $options['id_vimeo_api_id_field']; ?>'>
		<?php

	}


	function id_vimeo_api_secret_render(  ) {

		$options = get_option( 'id_settings' );
		?>
		<input type='text' name='id_settings[id_vimeo_api_secret_field]' value='<?php echo $options['id_vimeo_api_secret_field']; ?>'>
		<?php

	}


	function id_vimeoSettings_section_callback(  ) {

		echo __( 'Input Vimeo API keys', 'wordpress' );

	}

	// Flickr form rendering

	function id_flickr_api_key_render(  ) {

		$options = get_option( 'id_settings' );
		?>
		<input type='text' name='id_settings[id_flickr_api_key_field]' value='<?php echo $options['id_flickr_api_key_field']; ?>'>
		<?php

	}

	function id_flickrSettings_section_callback(  ) {

		echo __( 'Input Flickr API keys & settings', 'wordpress' );

	}

	// Education input form rendering

	function id_education_input_email_addresses_render(  ) {

		$options = get_option( 'id_settings' );
		?>
		<input type='email' name='id_settings[id_education_email_addresses_field]' value='<?php echo $options['id_education_email_addresses_field']; ?>'>
		<?php

	}

	function id_anonymous_input_email_addresses_render(  ) {

		$options = get_option( 'id_settings' );
		?>
		<input type='email' name='id_settings[id_anonymous_email_addresses_field]' value='<?php echo $options['id_anonymous_email_addresses_field']; ?>'>
		<?php

	}

	// Education input section callback

	function id_educationInputSettings_section_callback(  ) {

		echo __( 'Register the email addresses the education and anonymous input should be sent to from the form. Enter multiple email addresses separated with a comma.', 'wordpress' );

	}

	// ID Website settings page

	function id_options_page() {

		?>
		<form action='options.php' method='post'>

			<h2>ID Website Settings</h2>

			<?php
			submit_button();

			settings_fields( 'id_settings_group' );
			do_settings_sections( 'ID-website_settings' );

			submit_button();
			?>

		</form>
		<?php

	}

?>
