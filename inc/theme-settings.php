<?php
	add_action( 'admin_menu', 'id_add_admin_menu' );
	add_action( 'admin_init', 'id_settings_init' );


	function id_add_admin_menu(  ) {

		add_submenu_page( 'options-general.php', 'i.d-Website Settings', 'i.d-Website Settings', 'manage_options', 'i.d-website_settings', 'id_options_page' );

	}


	function id_settings_init(  ) {

		// Registering Vimeo section and fields

		register_setting( 'vimeoSettings', 'id_settings' );

		add_settings_section(
			'id_vimeoSettings_section',
			__( 'Vimeo API settings', 'wordpress' ),
			'id_vimeoSettings_section_callback',
			'vimeoSettings'
		);

		add_settings_field(
			'id_vimeo_api_id_field',
			__( 'Vimeo API ID', 'wordpress' ),
			'id_vimeo_api_id_render',
			'vimeoSettings',
			'id_vimeoSettings_section'
		);

		add_settings_field(
			'id_vimeo_api_secret_field',
			__( 'Vimeo API Secret', 'wordpress' ),
			'id_vimeo_api_secret_render',
			'vimeoSettings',
			'id_vimeoSettings_section'
		);

		// Registering Instagram section and fields

		register_setting( 'instagramSettings', 'id_settings' );

		add_settings_section(
			'id_instagramSettings_section',
			__( 'Instagram API settings', 'wordpress' ),
			'id_instagramSettings_section_callback',
			'instagramSettings'
		);

		add_settings_field(
			'id_instagram_client_id_field',
			__( 'Instagram client ID', 'wordpress' ),
			'id_instagram_client_id_render',
			'instagramSettings',
			'id_instagramSettings_section'
		);

		add_settings_field(
			'id_instagram_client_secret_field',
			__( 'Instagram client secret', 'wordpress' ),
			'id_instagram_client_secret_render',
			'instagramSettings',
			'id_instagramSettings_section'
		);

		add_settings_field(
			'id_instagram_access_token_field',
			__( 'Instagram access token', 'wordpress' ),
			'id_instagram_access_token_render',
			'instagramSettings',
			'id_instagramSettings_section'
		);

		register_setting( 'flickrSettings', 'id_settings' );

		add_settings_section(
			'id_flickrSettings_section',
			__( 'Flickr API settings', 'wordpress' ),
			'id_flickrSettings_section_callback',
			'flickrSettings'
		);

		add_settings_field(
			'id_flickr_api_key_field',
			__( 'Flickr API Key', 'wordpress' ),
			'id_flickr_api_key_render',
			'flickrSettings',
			'id_flickrSettings_section'
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

	// Instagram form rendering

	function id_instagram_client_id_render(  ) {

		$options = get_option( 'id_settings' );
		?>
		<input type='text' name='id_settings[id_instagram_client_id_field]' value='<?php echo $options['id_instagram_client_id_field']; ?>'>
		<?php

	}

	function id_instagram_client_secret_render(  ) {

		$options = get_option( 'id_settings' );
		?>
		<input type='text' name='id_settings[id_instagram_client_secret_field]' value='<?php echo $options['id_instagram_client_secret_field']; ?>'>
		<?php

	}

	function id_instagram_access_token_render(  ) {

		$options = get_option( 'id_settings' );

		if (!empty($options['id_instagram_client_id_field']) && !empty($options['id_instagram_client_secret_field'])){
			if (!empty($options['id_instagram_access_token_field'])){
				?>
					<input type='text' name='id_settings[id_instagram_access_token_field]' value='<?php echo $options['id_instagram_access_token_field']; ?>'>
				<?php
			}
			elseif (!empty($_GET['code'])) {
				?>
					<input type='text' name='id_settings[id_instagram_access_token_field]' value='<?php get_instagram_access_token(); ?>'>
				<?php
			} else {
				echo '<a class="button-primary" href="https://api.instagram.com/oauth/authorize/?client_id='.$options[id_instagram_client_id_field].'&redirect_uri='.admin_url( 'options-general.php?page=i.d-website_settings').'&response_type=code">Log in with Instagram</a>';
			}
		} else {
			?> <p>Fill in your instagram client ID and Secret first</p> <?php
		}

	}

	// Instagram section callback

	function id_instagramSettings_section_callback(  ) {
		$options = get_option( 'id_settings' );

		echo __( 'Enter your Instagram Client ID, then log in to your Instagram account to get your access token', 'wordpress' );

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

	// i.d-Website settings page

	function id_options_page() {

		?>
		<form action='options.php' method='post'>

			<h2>i.d-Website Settings</h2>

			<?php
			settings_fields( 'vimeoSettings' );
			do_settings_sections( 'vimeoSettings' );

			settings_fields( 'instagramSettings' );
			do_settings_sections( 'instagramSettings' );

			settings_fields( 'flickrSettings' );
			do_settings_sections( 'flickrSettings' );
			submit_button();
			?>

		</form>
		<?php

	}

	// function to retrieve an access token for Instagram

	function get_instagram_access_token(){
		$options = get_option('id_settings');
		$code = $_GET['code'];
		$url = 'https://api.instagram.com/oauth/access_token';
		$access_token_settings = array(	'client_id' => $options['id_instagram_client_id_field'],
										'client_secret' => $options['id_instagram_client_secret_field'],
										'grant_type' => 'authorization_code',
										'redirect_uri' => admin_url( 'options-general.php?page=i.d-website_settings'),
										'code' => $code
									 );

		$curl = curl_init( $url );
		curl_setopt( $curl, CURLOPT_POST, true);
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $access_token_settings);
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($curl);
		curl_close($curl);

		$results = json_decode($result, true);
		echo $results['access_token'];
	}
?>