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
$LassieModelInstance = Lassie::getLassieApi();
$LassieEvent = Lassie\Model\EventModel::get_event_by_id($LassieModelInstance, [
  'id' => $lassie_event_id,
]);
// var_dump($LassieEvent);
// TODO: Handle no-ticket situation as a sign up (without payment)



$user_has_tickets = false;
if (is_user_logged_in()) {
  // Get event subscriptions for person
  $lassie_user_id = (int)$current_user->user_login;
  $LassieEventSubscriptions = Lassie\Model\PersonModel::get_events_by_person_id($LassieModelInstance, [
    'person_id' => $lassie_user_id
  ]);
  $user_has_subscription = (bool)$LassieEventSubscriptions->$lassie_event_id;
  // var_dump($LassieEventSubscriptions);

  // Get subscriptions for person
  $LassiePersonSubscriptions = Lassie\Model\PersonModel::get_subscriptions_by_person_id($LassieModelInstance, [
    'person_id' => $lassie_user_id
  ]);
  $subscriptionId = $LassieEventSubscriptions->$lassie_event_id->persons_events_id;
  $eventSubscription = $LassiePersonSubscriptions->$subscriptionId;
  // var_dump($eventSubscription);

  // Get transaction to retrieve status based on event subscription
  $LassieTransaction = Lassie\Model\TransactionModel::get_transaction_by_id($LassieModelInstance, [
    'transaction_id' => $eventSubscription->transaction_id,
    'module_name' => 'finance'
  ]);
  $user_has_paid = $LassieTransaction->active === "1";
  $user_has_tickets = $user_has_subscription && $user_has_paid;
  $transaction_info = $LassieTransaction->extra_info;
  // var_dump($LassieTransaction);
}
?>



<div class="tickets" id="tickets">

  <h2 class="tickets__title">
    <?php echo __("Tickets: €$LassieEvent->fee", 'ID ticket title', 'svid-theme-domain'); ?>
  </h2>



<?php
// Did we return from Mollie?
if ($_GET['return_from'] == 'mollie'): // yes
  // Did the user buy tickets?
  if ($user_has_tickets): // yes
    notification( "<strong>Yeah!</strong> Thanks for buying your ticket to $LassieEvent->name!",
      'success notification--float' );
  // Did the user buy tickets?
  else: // no
    notification( "<strong>Payment didn’t come through.</strong> Well this is shitty, either you didn’t pay or our system screwed up (it says: <code>$transaction_info</code>). If you did complete the transaction, please contact us at svid@tudelft.nl with this message and we’ll try to sort it out.",
      'failed notification--float' );
  endif; // Did the user buy tickets?
// Did we return from Mollie?
elseif($user_has_subscription && !$user_has_paid): // no, but the user has an unpaid subscription
  notification( "It looks like you tried to buy a ticket recently, but the payment didn’t come through. (The system says: <code>$transaction_info</code>). If you did complete the transaction, please contact us at svid@tudelft.nl with this message and we’ll try to sort it out.",
    'info' );
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
        switch ($timeDiff) {
          case $timeDiff->d < 1 &&
            $today->format('j') == $openDate->format('j'):
              notification( "You can buy tickets from $openTimeHumanReadable, today.",
                'info');
            break;
          case (int)$today->format('j') + 1 == (int)$openDate->format('j'):
            notification( "You can buy tickets from $openTimeHumanReadable, tomorrow.",
              'info');
            break;
          default:
            notification( "You can buy tickets from $openDateHumanReadable.",
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

          // Is the user logged in (and thus member)?
          if (!is_user_logged_in()): // no
              notification( "You need to log in to buy tickets.<br><a href='" . wp_login_url( get_permalink() ) . "' class='button'>Login</a>",
                'info' );



          // Is the user logged in (and thus member)?
          else: // yes

            // Did the user already buy a ticket?
            if ($user_has_tickets): // yes
              // Display ticket
              $buyingMoment = new DateTime($eventSubscription->create_timestamp); ?>
              <div class="ticket">
                <h3 class="ticket__title">🎟&ensp;Your ticket for <?php echo $LassieEvent->name; ?>&ensp;🎟</h3>
                <p class="ticket__message">We can see this in our system, so there’s no separate ticket. But it might speed things up if you can show this page when you arrive at the event. See you there!</p>
                <p class="ticket__bought-at">Bought on <?php echo $buyingMoment->format('F jS, Y \a\t G:i'); ?></p>
                <form method="post" id="send_tickets_form"
                  action="<?=esc_url( admin_url('admin-post.php') ) ?>">

                  <input type="hidden" name="lassie_event_id"
                    value="<?php echo $lassie_event_id; ?>">

                  <input type="hidden" name="event_url"
                    value="<?php the_permalink(); ?>">

                  <input type="hidden" name="action" value="send_ticket">

                  <?php wp_nonce_field( $action = 'send_ticket' ); ?>

                  <button class="button tickets__buy" type="submit">
                    <?php echo __('Email me a copy', 'ID ticket link text', 'svid-theme-domain'); ?>
                  </button>

                </form>
              </div>


            <?php // Did the user already buy a ticket?
            else: // no
              // Wow, we can actually start selling those sweet tickets ?>
              <form method="post" id="buy_tickets_form"
                action="<?=esc_url( admin_url('admin-post.php') ) ?>">

                <input type="hidden" name="lassie_event_id"
                  value="<?php echo $lassie_event_id; ?>">

                <input type="hidden" name="event_url"
                  value="<?php the_permalink(); ?>">

                <label for="notes" class="login__label login__label--white-bg">
                  Notes for the organisers</label>
                <textarea name="notes" id="notes" cols="30" rows="2"
                  placeholder="Could you send my goodiebag to address..."
                  class="login__input login__input--white-bg"></textarea>

                <input type="hidden" name="action" value="buy_ticket">

                <?php wp_nonce_field( $action = 'buy_ticket' ); ?>

                <button class="button tickets__buy" type="submit">
                  <?php echo __('Get your ticket', 'ID ticket link text', 'svid-theme-domain'); ?>
                </button>

              </form><?php

              echo "<p class='tickets__status'>There are $ticketsLeft tickets left (or maybe even less if the ticket sale is going 🔥).</p>";

            endif; // Did the user already buy a ticket?

          endif; // Is the user logged in (and thus member)?

        endif; // Are there tickets left?

      endif; // Did the subscriptions already open?

    endif; // Has the event already ended?

  endif; // Does the Lassie event exist?

endif; // Does the API call work? ?>

</div>

<?php
endif; // Do we want to get a Lassie event?
