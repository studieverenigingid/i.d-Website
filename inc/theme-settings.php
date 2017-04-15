<?php
	add_action( 'admin_menu', 'id_add_admin_menu' );
	add_action( 'admin_init', 'id_settings_init' );


	function id_add_admin_menu(  ) { 

		add_submenu_page( 'options-general.php', 'i.d-Website Settings', 'i.d-Website Settings', 'manage_options', 'i.d-website_settings', 'id_options_page' );

	}


	function id_settings_init(  ) { 

		register_setting( 'themePage', 'id_settings' );

		add_settings_section(
			'id_themePage_section', 
			__( 'Vimeo API settings', 'wordpress' ), 
			'id_settings_section_callback', 
			'themePage'
		);

		add_settings_field( 
			'id_vimeo_api_id_field', 
			__( 'Vimeo API ID', 'wordpress' ), 
			'id_vimeo_api_id_render', 
			'themePage', 
			'id_themePage_section' 
		);

		add_settings_field( 
			'id_vimeo_api_secret_field', 
			__( 'Vimeo API Secret', 'wordpress' ), 
			'id_vimeo_api_secret_render', 
			'themePage', 
			'id_themePage_section' 
		);
		
	}


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


	function id_settings_section_callback(  ) { 

		echo __( 'Input Vimeo API keys', 'wordpress' );

	}


	function id_options_page(  ) { 

		?>
		<form action='options.php' method='post'>

			<h2>i.d-Website Settings</h2>

			<?php
			settings_fields( 'themePage' );
			do_settings_sections( 'themePage' );
			submit_button();
			?>

		</form>
		<?php

	}
?>