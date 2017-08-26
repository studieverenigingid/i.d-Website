<?php
$response = array();

$phone = $_POST['phone'];
$addres_street = $_POST['addres_street'];
$addres_number = $_POST['addres_number'];
$zipcode = $_POST['zipcode'];
$country = $_POST['country'];

// Update the 'first_name'-field of the logged in person
$update = Lassie::updatePerson(array(
  'phone' => $phone,
  'address_street' => $address_street,
  'address_number' => $address_number,
  'zipcode' => $zipcode,
  'country' => $country
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