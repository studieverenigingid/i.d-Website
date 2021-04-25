<?php



/**
 * Sends the appropriate failure notification for an AJAX or direct request.
 *
 * @param string $error_message The message we’ll give to the user
 * @param int $status_code The HTTP status associated with that error
 * @return void
 */
function send_failure($error_message, $status_code) {
	if (wp_doing_ajax()) {

		$response = array(
			'message' => $error_message,
		);
		wp_send_json_error($response, $status_code);

	} else {

		wp_die(
			$error_message,
			__( 'Error', 'svid-theme-domain' ),
			array(
				'response' 	=> $status_code,
				'back_link' => true,
			)
		);

	}
}





/**
 * Send the email and return the success rate
 *
 * @param string $message
 * @param string $name
 * @param string $email
 * @return bool
 */
function send_mail($receiver, $subject, $body, $sender, $attachments = []) {

	$message = "<!DOCTYPE html>
			<html>
			 <head>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
				<title>$subject</title>
				<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			</head><body>";
	$message .= $body;
	$message .= "</body>";
	$message .= "</html>";

	$message = wordwrap($message, 70);

	$headers = "From: $sender\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";



	return wp_mail($receiver, $subject, $message, $headers, $attachments);

}





/**
 * Validate the form
 *
 * @param string $message
 * @param string $name
 * @param string $email
 * @return bool
 */
function validate_form($callback) {
	if (isset($_POST['submit'])) {

		if (empty($_POST['special'])) {

			if(!empty($_POST['feedback'])) {

				$send_return = call_user_func($callback);

				if($send_return) {
					if($callback == 'send_decl') {
						$response['data']['message'] = 'Eyoo, you just declared something, you topper, you! 😎💰';
					}
					$response['success'] = true;
				} else {
					$response['success'] = false;
					$response['timestamp'] = date(DATE_ATOM);
					$response['error'] = 'Something went wrong on the server. Apologies for the inconvenience. If this keeps happening, please contact us at svid@tudelft.nl.';
				}
			} else {
				$response['success'] = false;
				$response['error'] = 'You have not entered any input, or something else went wrong. Please try again! If this keeps happening, please contact us at svid@tudelft.nl.';
			}
		} else {
			$response['success'] = false;
			$response['error'] = 'It would appear you are a robot. If this keeps happening, please contact us at svid@tudelft.nl.';
		}

		wp_send_json($response);

	} else {

		send_failure( 'We miss a submit button in the original form. Please contact us at svid@tudelft.nl', 403 );

	}
}
