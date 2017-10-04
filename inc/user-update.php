<?php
$response = array();

$phone = $_POST['phone'];
$address_street = $_POST['address_street'];
$address_number = $_POST['address_number'];
$address_zip = $_POST['address_zip'];
$address_city = $_POST['address_city'];
$address_country = $_POST['address_country'];

// Update the 'first_name'-field of the logged in person
$update = Lassie::updatePerson(array(
  'phone' => $phone,
  'address_street' => $address_street,
  'address_number' => $address_number,
  'address_zip' => $address_zip,
  'address_city' => $address_city,
  'address_country' => $address_country
));

// Check if the update was successful
if ($update->status == true) {
  $response['success'] = true;
  $response['message'] = esc_attr_x('You’ve updated your information!', 'Feedback message user page form', 'svid-theme-domain');
} else {
  $response['success'] = false;
  $response['message'] = esc_attr_x('Something went wrong :( The error: ', 'Feedback message user page form', 'svid-theme-domain') . $update->error;
}

wp_send_json($response);
