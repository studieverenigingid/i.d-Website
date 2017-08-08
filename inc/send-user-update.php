<?php
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $addres_street = $_POST["addres_street"];
  $addres_number = $_POST["addres_number"];
  $zipcode = $_POST["zipcode"];
  $country = $_POST["country"];

  // Update the 'first_name'-field of the logged in person
  $update = Lassie::updatePerson(array(
    'first_name' => 'nilla'
  ));

  $response = "bonjour";

  // Check if the update was successful
  if($update->status == true){
      $response = "User info updated!";
  } else{
      $response = "Something went wrong. Error: ".$update->error;
  };

  wp_send_json($response);
?>
