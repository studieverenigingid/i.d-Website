<?php
$response = array();

if ( !isset( $_POST['_wpnonce'] )
	|| ! wp_verify_nonce( $_POST['_wpnonce'], 'buy_ticket' ) ) {

	send_failure( __( 'Invalid nonce specified', 'svid-theme-domain' ), 403 );

}

$lassie_event_id = $_POST['lassie_event_id'];

$current_user = wp_get_current_user();
$lassie_user_id = (int)$current_user->user_login;

$LassieInstance = new Lassie2\Instance(
	get_option('lassie_url') . '/api/v2',
	get_user_meta(get_current_user_id(), 'api-key', true),
	get_user_meta(get_current_user_id(), 'api-secret', true),
  true
);
//var_dump($LassieInstance->validate());

// TODO: Error handling invalid instance

$LassieResponse = Lassie2\Person\Event::pay($LassieInstance, [
  'activity_id' => $lassie_event_id,
  'mollie_redirect_url' => 'https://demo.lassie.cloud/',
]);

// TODO: Error handling transaction

var_dump($LassieResponse->transactions->mollie_transaction);

// TODO: return mollie transaction URL for redirect

// print_r($event_subscription);
//
// $response['event'] = $event_subscription;
// $response['message'] = sprintf("you signed up user %s for event %s", $lassie_user_id, $lassie_event_id);
// $response['user_id'] = $lassie_user_id;
// $response['lassie_event_id'] = $lassie_event_id;
//
// wp_send_json_success($response);
