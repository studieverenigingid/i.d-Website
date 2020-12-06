<?php
$response = array();

if ( !isset( $_POST['_wpnonce'] )
	|| ! wp_verify_nonce( $_POST['_wpnonce'], 'send_ticket' ) ) {

	send_failure( __( 'Invalid nonce specified', 'svid-theme-domain' ), 403 );

}

// Get subscriptions for person
$lassie_event_id = $_POST['lassie_event_id'];
$LassieModelInstance = Lassie::getLassieApi();
$LassieEvent = Lassie\Model\EventModel::get_event_by_id($LassieModelInstance, [
  'id' => $lassie_event_id,
]);

$current_user = wp_get_current_user();
$receiver = $current_user->user_email;

$subject = "🎟 You bought a ticket for $LassieEvent->name";

$startDate = new DateTime($LassieEvent->start_date);
$startDate = $startDate->format('F jS, Y @ G:i');
$event_url = $_POST['event_url'];
$body = "Hey!<br><br>" .
  "You bought a ticket for $LassieEvent->name on $startDate.<br><br>" .
  "We can see this in our system, so there’s no separate ticket. But it might speed things up if you can <a href='$event_url'>show this page</a> when you arrive at the event.<br><br>" .
  "See you there!<br><br>" .
  "ID study association";

$sender = "ID study association <noreply@svid.nl>";

$send_return = send_mail($receiver, $subject, $body, $sender);

if($send_return) {
  $response['message'] = "Our system sent you an email, so you should find it in your inbox any moment now!";
  wp_send_json_success($response);
} else {
  send_failure( __( 'Our system couldn’t send the email. Weird, right? We’re afraid you have to contact us at svid@tudelft.nl', 'svid-theme-domain' ), 500 );
}
