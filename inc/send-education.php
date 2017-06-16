<?php

  global $response;

  /*
    Inputs possible (* if required):
		- *input
    - name
    - email
  */

	/**
	 * Send the email and return the success rate
	 *
	 * @param string $input, string $name, string $email
	 * @return bool
	 */
  function send_mail($input, $name, $email) {

		$options = get_option('id_settings');
    $receiver = $options['id_email_addresses_field'];
		$subject = 'Education input form website';

    $message = "<!DOCTYPE html>
        <html>
         <head>
          <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
          <title>Education input: $subject</title>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        </head>";
    $message .= "<body><i>Sent using the contact form at " . get_site_url() .
      "</i><br><br>" . esc_html($input);
    $message .= "</body>";
    $message .= "</html>";

    $message = wordwrap($message, 70);

		if($email !== '') {
			$sender = "$name <$email>";
		} else {
			$sender = "Anonymous <anonymous@svid.nl>";
		}

		$headers = "From: $sender\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    return wp_mail($receiver, $subject, $message, $headers);

  }



	/**
	 * Send a GET request to verify CAPTCHA challenge
	 *
	 * @return bool
	 */
	function captcha_verification() {

		$response = isset( $_POST['g-recaptcha-response'] ) ? esc_attr( $_POST['g-recaptcha-response'] ) : '';

		$remote_ip = $_SERVER["REMOTE_ADDR"];

		$options = get_option('id_settings');
		$secret = $options['id_recaptcha_secret_field'];

		// make a GET request to the Google reCAPTCHA Server
		$request = wp_remote_get(
			'https://www.google.com/recaptcha/api/siteverify?' .
			'response=' . $response .
			'&remoteip=' . $remote_ip .
			'&secret=' . $secret
		);

		// get the request response body
		$response_body = wp_remote_retrieve_body( $request );

		$result = json_decode( $response_body, true );

		return $result['success'];
	}





	if(isset($_POST['submit'])) {

    $reCaptchaResponse = captcha_verification();

    if ($reCaptchaResponse) {

			$input = $_POST['feedback'];
	    $name = $_POST['name'];
	    $email = $_POST['email'];

      /* VALIDATE INPUT */
      $all_valid = true; // If this value isn't changed to false, it will send. Else it will be reported to the user.

      if(!empty($input)) {
        $send_return = send_mail($input, $name, $email);
        if($send_return) {
           $response['success'] = true;
         } else {
           $response['success'] = false;
           $response['timestamp'] = date(DATE_ATOM);
           $response['error'] = 'Something went wrong on the server. Apologies for the inconvenience. Does this keep happening? Send an email to web@roomfordiscussion.com.';
         }
      } else {
        $response['success'] = false;
				$response['error'] = 'You have not entered any input, or something else went wrong. Please try again!';
      }

    } else {
      $response['success'] = false;
      $response['error'] = 'reCaptcha failed, it would appear you are a robot.';
    }

		wp_send_json($response);

  } else {

		wp_send_json(array( 'error' => 'no-submit' ));

	}
