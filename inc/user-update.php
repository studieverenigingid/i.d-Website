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
  $response['message'] = 'User info updated!';
} else {
  $response['success'] = false;
  $response['message'] = 'Something went wrong. Error: '.$update->error;
}

wp_send_json($response);
