<?php

// Get Event ID from the event custom field
$lassie_event_id = get_field('lassie_event_id');
// Do we want to get a Lassie event?
if ($lassie_event_id):



// Define function to give user feedback
function notification($message, $status = 'failed') {
  echo "<p class='notification notification--$status'>$message</p>";
}



// Prepare Lassie Model Instance, then get event data
$LassieModelInstance = new Lassie2\Instance(
	get_option('lassie_url') . '/api/v2',
	get_option('lassie_api_model_key'),
	get_option('lassie_api_model_secret'),
  false
);
$LassieEvent = Lassie2\Model\EventModel::get_event_by_id($LassieModelInstance, [
  'id' => $lassie_event_id,
]);
// var_dump($LassieEvent);
// TODO: Handle no-ticket situation as a sign up (without payment)



// Get event subscriptions if logged in
if (is_user_logged_in()) {
  $lassie_user_id = (int)$current_user->user_login;
  $LassieEventSubscriptions = Lassie2\Model\PersonModel::get_events_by_person_id($LassieModelInstance, [
    'person_id' => $lassie_user_id
  ]);
  $user_has_tickets = ($LassieEventSubscriptions->$lassie_event_id) ? true : false;
  // var_dump($LassieEventSubscriptions);

  $LassiePersonSubscriptions = Lassie2\Model\PersonModel::get_subscriptions_by_person_id($LassieModelInstance, [
    'person_id' => $lassie_user_id
  ]);
  $subscriptionId = $LassieEventSubscriptions->$lassie_event_id->persons_events_id;
  $eventSubscription = $LassiePersonSubscriptions->$subscriptionId;
  // var_dump($eventSubscription);

  // TODO: get transaction to retrieve status
  // $LassieTransaction = Lassie2\Model\TransactionModel::get_latest_payments_by_person_id($LassieModelInstance, [
  //   'person_id' => $lassie_user_id,
  //   'limit' => 10
  // ]);
  // $LassieTransaction = Lassie2\Transaction::getTransaction($LassieModelInstance, [
  //   'transaction_id' => $eventSubscription->transaction_id
  // ]);
  // $LassieTransaction = Lassie2\Model\TransactionModel::get_transaction_by_id($LassieModelInstance, [
  //   'transaction_id' => $eventSubscription->transaction_id
  // ]);

  // $LassiePersonInstance = new Lassie2\Instance(
  // 	get_option('lassie_url') . '/api/v2',
  // 	get_user_meta(get_current_user_id(), 'api-key', true),
  // 	get_user_meta(get_current_user_id(), 'api-secret', true),
  //   true
  // );
  //
  // // Check we can actually call the API, disappoint the user if not
  // if(!$LassiePersonInstance->validate())
  // 	send_failure( __( 'Our system couldn’t find you properly. Weird, right? We’re afraid you have to contact us at svid@tudelft.nl', 'svid-theme-domain' ), 403 );
  //
  // // Send call to Lassie to sign up for the event and create a payment instance
  // $LassieTransaction = Lassie2\Person::payments($LassiePersonInstance, [
  //   'selection' => 'subscriptions'
  // ]);
  //
  // var_dump($LassieTransaction);
}
?>



<div class="tickets">

  <h3 class="tickets__title">
    <?php echo __('Tickets', 'ID ticket title', 'svid-theme-domain'); ?>
  </h3>



<?php
// Did we return from Mollie?
if ($_GET['return_from'] == 'mollie'): // yes
  if ($user_has_tickets):
    // transaction_id get_transaction_by_id
    notification( "<strong>Yeah!</strong> Thanks for buying your ticket to $LassieEvent->name!",
      'success' );
      // TODO: catch failed transactions
  else:
    notification( "<strong>The payment didn’t come through.</strong> Well this is shitty, either you didn’t pay or our system screwed up considerably. In case it’s the latter, please contact us at svid@tudelft.nl and we’ll try to sort it out.",
      'failed' );
  endif;
  // TODO: check if suscription succeeded for non-members
endif; // Did we return from Mollie?



// Does the API call work?
if ($LassieEvent->status === false): // no
  notification( "<strong>We want you to be able to buy tickets, but we couldn’t get the right info from our system.</strong>
    Could you pass this on to us?<br>
    <code>$LassieEvent->error, $LassieEvent->status_code</code>",
    'failed' );



// Does the API call work?
else: // yes
  // Does the Lassie event exist?
  if ($LassieEvent->id !== $lassie_event_id): // no
    notification( "<strong>We want you to be able to buy tickets, but we couldn’t get the right info from our system.</strong>
      Maybe our website editor has to make sure the Lassie event ID is correct 👀",
      'failed' );



  // Does the Lassie event exist?
  else: // yes ?>


    <?php if (!$user_has_tickets) echo "$LassieEvent->name for €$LassieEvent->fee"; ?>


  <?php
    $today = new DateTime('');
    $endDate = new DateTime($LassieEvent->end_date);
    // Has the event already ended?
    if ($today > $endDate): // yes
      // Did the user have tickets?
      if (is_user_logged_in() && $user_has_tickets): // yes
        notification( "The event has ended, so you can’t buy tickets anymore. But it looks like you had a ticket, so thanks for visiting! 🎉",
          'info' );
      else: // no
        notification( "The event has ended, so you can’t buy tickets anymore.",
          'info' );
      endif;



    // Has the event already ended?
    else: // no

      // Did the subscriptions already open?
      $openDate = new DateTime($LassieEvent->open_date);
      if ($today < $openDate): // no

        // Turn the open datetime into something we can read
        $openTimeHumanReadable = $openDate->format('G:i');
        $openDateHumanReadable = $openDate->format('F jS, Y @ G:i');

        // Check how far away that open datetime is and base the message on the
        // difference for more helpful messages
        $timeDiff = $openDate->diff($today);
        $whoCanBuy = ($LassieEvent->member_only) ? 'ID members' : 'You';
        switch ($timeDiff) {
          case $timeDiff->d < 1 &&
            $today->format('j') == $openDate->format('j'):
              notification( "$whoCanBuy can buy tickets from $openTimeHumanReadable, today.",
                'info');
            break;
          case (int)$today->format('j') + 1 == (int)$openDate->format('j'):
            notification( "$whoCanBuy can buy tickets from $openTimeHumanReadable, tomorrow.",
              'info');
            break;
          default:
            notification( "$whoCanBuy can buy tickets from $openDateHumanReadable.",
              'info' );
            break;
        }



      // Did the subscriptions already open?
      else: // yes

        // Are there tickets left?
        $subscriptions = explode('/', $LassieEvent->subscriptions);
        $ticketsLeft = $subscriptions[1] - $subscriptions[0];
        if ($ticketsLeft < 1): // no
          notification( "Damn, we already sold out; sorry about that. 😞",
            'failed' );



        // Are there tickets left?
        else: // yes

          // If the event is members only, is the user logged in (and thus member)?
          if ($LassieEvent->member_only &&
              !is_user_logged_in()): // no
              notification( "Since this event is members only, you need to log in to buy tickets.<br><a href='" . wp_login_url( get_permalink() ) . "' class='button'>Login</a>",
                'info' );



          // If the event is members only, is the user logged in (and thus member)?
          else: // yes

            // Did the user already buy a ticket?
            if ($user_has_tickets): // yes
              // Display ticket
              $buyingMoment = new DateTime($eventSubscription->create_timestamp); ?>
              <div class="ticket">
                <h4 class="ticket__title">Your ticket for <?php echo $LassieEvent->name; ?></h4>
                <p class="ticket__message">We can see this in our system, so there’s no separate ticket. But it might speed things up if you can show this page when you arrive at the event. See you there!</p>
                <p class="ticket__bought-at">Bought on <?php echo $buyingMoment->format('F jS, Y \a\t G:i'); ?></p>
              </div>


            <?php // Did the user already buy a ticket?
            else: // no
              // Wow, we can actually start selling those sweet tickets ?>
              <form class="tickets" method="post" id="buy_tickets_form"
                action="<?=esc_url( admin_url('admin-post.php') ) ?>">

                <?php // TODO: add fields for non-member purchases ?>

                <input type="hidden" name="lassie_event_id"
                  value="<?php echo $lassie_event_id; ?>">

                <input type="hidden" name="event_url"
                  value="<?php the_permalink(); ?>">

                <input type="hidden" name="action" value="buy_ticket">

                <?php wp_nonce_field( $action = 'buy_ticket' ); ?>

                <button class="button" type="submit">
                  <?php echo __('Get your ticket', 'ID ticket link text', 'svid-theme-domain'); ?>
                </button>

              </form><?php

              echo "There are $ticketsLeft tickets left (or maybe even less if the ticket sale is going 🔥).";

            endif; // Did the user already buy a ticket?

          endif; // If the event is members only, is the user logged in (and thus member)?

        endif; // Are there tickets left?

      endif; // Did the subscriptions already open?

    endif; // Has the event already ended?

  endif; // Does the Lassie event exist?

endif; // Does the API call work? ?>

</div>

<?php
endif; // Do we want to get a Lassie event?
