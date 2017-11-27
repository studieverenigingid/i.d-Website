<?php

/**
 * We can create Lassie accounts for members without one using the API. This
 * file treats the post request (direct or AJAX’ed) from the account creation
 * page.
 */

// Build the URL we’ll redirect the user back to
$page_slug = ($_POST['language'] === 'nl') ? 'nl/maak_account' : 'create_account';
$back_link = site_url($page_slug);

// Enter the default values if everything goes alright
$success_status = true;
$error_message = '';

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
			'error' => $error_message,
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



// Verify the nonce; if it fails we stop the excecution.
if ( !isset( $_POST['_wpnonce'] )
	|| ! wp_verify_nonce( $_POST['_wpnonce'], 'user_create_account' ) ) {

	send_failure( __( 'Invalid nonce specified', 'svid-theme-domain' ), 403 );

}

// Verify the entered email address
if ( !is_email( $_POST['user_email'] ) ) {
	$error_message .= __( ' The entered email address doesn’t seem to be valid.', 'svid-theme-domain' );
	$success_status = false;
}

// Verify the entered password
if ( strlen($_POST['user_password']) < 8 ) {
	$error_message .= __( ' Your password should be more than 8 characters.', 'svid-theme-domain' );
	$success_status = false;
}

if (!captcha_verification()) {
	$error_message .= __( ' reCaptcha failed, it would appear you are a robot.', 'svid-theme-domain' );
	$success_status = false;
}



// If some verification failed, send the failure...
if (!$success_status) {
	send_failure($error_message, 422);
}



/**
* Create the account.
* @param $username string  The username (email)
* @param $password string  The password (plaintext)
* @return $result_arr array|bool
*/
function createAccount($username, $password) {
	$result_arr = Lassie::getPersonAuthApi()->post('person_create_login', array(
		'username' => $username,
		'password' => $password
	));

	return $result_arr;
}



// Create the account
$create = createAccount($_POST['user_email'], $_POST['user_password']);



// Create failure if the Lassie method wasn’t successful
if (!$create->status === true) {
  $success_status = false;
  $error_message = esc_attr_x('Something went wrong! The error: ', 'Feedback message password change form', 'svid-theme-domain') . $create->error;
}



// If some verification failed, send the failure...
if (!$success_status) {
	send_failure($error_message, 422);
}



// ...else, send the success through either JSON or a redirect
if (wp_doing_ajax()) {

	// Construct message with url
	$success_message = __( 'Your account creation was successful! You should have received an email with a link to activate your account. After activation you can login <a href="%s">here</a>.', 'svid-theme-domain' );
	$success_message = sprintf(
		$success_message,
		esc_url( site_url('login') )
	);

	// Put the message in the response and send it
	$response = array(
		'message' => $success_message,
	);
	wp_send_json_success($response);

} else {
	wp_redirect( $back_link.'?account_created='.$success_status );
	exit;
}
