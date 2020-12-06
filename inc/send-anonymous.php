<?php

  global $response;

  /*
    Inputs possible (* if required):
		- *input
    - about
    - relation
  */


	/**
	 * Send the email and return the success rate
	 * @return bool
	 */
  function send_anon() {

    $input = $_POST['feedback'];
    $about = $_POST['about'];
    $relation = $_POST['relation'];


		$options = get_option('id_settings');
    $receiver = $options['id_anonymous_email_addresses_field'];

		$subject = 'Anonymous input form website';

    $body = "<i>Sent using the contact form at " . get_site_url() . "</i>" .
      "<br><br>" . esc_html($input) .
      "<br><br>About: " . esc_html($about) .
      "<br><br>Relation: " . esc_html($relation);

		$sender = "Anonymous <anonymous@svid.nl>";



    return send_mail($receiver, $subject, $body, $sender);

  }

  validate_form('send_anon');
