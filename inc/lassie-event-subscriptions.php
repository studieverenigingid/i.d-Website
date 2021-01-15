<?php

/*
   Shortcode: Lassie Event Subscriptions
   Lists the bought events/subscriptions for this user/member
*/

function event_subscriptions($atts) {

  // Get subscriptions for person
  $LassieModelInstance = Lassie::getLassieApi();
  $current_user = wp_get_current_user();
  $lassie_user_id = (int)$current_user->user_login;
  $LassiePersonSubscriptions = Lassie\Model\PersonModel::get_subscriptions_by_person_id($LassieModelInstance, [
    'person_id' => $lassie_user_id
  ]);
  // var_dump($LassiePersonSubscriptions);

  $event_archive_link = get_post_type_archive_link('event');

  $subscription_list = "<h2>🎟 Your event tickets & signups</h2>";

  // Are there event subscriptions in the list?
  if ($LassiePersonSubscriptions): // yes

    $subscription_list .= "<p><a href='$event_archive_link'>Find more events to join</a></p>";
    $subscription_list .= "<ul>";

    foreach ($LassiePersonSubscriptions as $subscription):

      $lassie_event_id = $subscription->event_id;
      $LassieEvent = Lassie\Model\EventModel::get_event_by_id($LassieModelInstance, [
        'id' => $lassie_event_id,
      ]);
      $startDate = new DateTime($LassieEvent->start_date);
      $startDateHumanReadable = $startDate->format('F jS, Y \a\t G:i');
      $subscription_list .= "<li>$LassieEvent->name ($startDateHumanReadable)</li>";

      // TODO: get a link from the event on the website

    endforeach;

    $subscription_list .= "</ul>";
  // Are there event subscriptions in the list?
  else: // no
    $subscription_list .= "<p>It looks like you haven’t bought any tickets or signed up for any of our events yet. Hope we’ll see you at one of our <a href='$event_archive_link'>events</a> soon!</p>";
  endif;

  return $subscription_list;

}



function register_subscriptions_shortcode() {
  add_shortcode('event-subscriptions', 'event_subscriptions');
}

add_action( 'init', 'register_subscriptions_shortcode');
