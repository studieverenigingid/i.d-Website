<?php

  global $response;

  /*
    Inputs possible (* if required):
		- *input
  */


	/**
	 * Send the email and return the success rate
	 * @return bool
	 */
  function send_anon() {

    $input = $_POST['feedback'];

    $current_user = wp_get_current_user();
    $current_name = $current_user->display_name;
    $current_email = $current_user->user_email;

		$options = get_option('id_settings');
    $receiver = $options['id_anonymous_email_addresses_field'];

		$subject = 'Anonymous input form website';

    $body = "<i>Sent using the feedback form at " . get_site_url() . "</i>" .
      "<br><br>" . esc_html($input) .
      "<br><br>By: " . esc_html($current_name);

		$sender = "$current_name <$current_email>";

    return send_mail($receiver, $subject, $body, $sender);

  }

  validate_form('send_anon');
