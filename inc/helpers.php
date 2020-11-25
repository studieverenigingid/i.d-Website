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
