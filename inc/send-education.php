<?php

  global $response;

  /*
    Inputs possible (* if required):
    - *subject
		- *input
    - name
    - email
  */

	/**
	 * Send the email and return the success rate
	 * @return bool
	 */
  function send_edu() {

    $input = $_POST['feedback'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_subject = $_POST['subject'];

		$options = get_option('id_settings');
    $receiver = $options['id_education_email_addresses_field'];

		$subject = "Education input: $user_subject";

    $body = "<i>Sent using the contact form at " . get_site_url() . "</i>";
    $body .= "<br><br>" . esc_html($input);

    if($email !== '' && !isset($_POST['anonymous'])) {
      $sender = "$name <$email>";
    } else {
      $sender = "Anonymous <anonymous@svid.nl>";
    }

    return send_mail($receiver, $subject, $body, $sender);

  }

  validate_form('send_edu');
