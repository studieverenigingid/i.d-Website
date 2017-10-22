<?php
$response = array();

$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

// Update the password
$update = Lassie::updatePerson(array(
  'current_password' => $current_password,
  'password' => $new_password
));

// Check if the update was successful
if ($update->status == true) {
  $response['success'] = true;
  $response['message'] = esc_attr_x('You’ve updated your password!', 'Feedback message password change form', 'svid-theme-domain');
} else {
  $response['success'] = false;
  $response['message'] = esc_attr_x('Something went wrong :( Is current your password correct?', 'Feedback message password change form', 'svid-theme-domain') . $update->error;
}

wp_send_json($response);
