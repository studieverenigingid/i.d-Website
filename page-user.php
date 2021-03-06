<?php

/**
 * Template Name: User Profile Page
 */
if (!is_user_logged_in()) {
  login_first_redirect();
} else {
	get_header();
?>
  <?php
    $personInstance = Lassie::getPersonApi();
    $person = Lassie\Person::getInformation($personInstance);
    $first_name = $person->first_name;
    $last_name = $person->last_name;
    $student_number = $person->external_id;
    $email_primary = $person->email_primary;
    $birthdate = date('F jS, Y',strtotime($person->birthdate));
    $age = date_diff(date_create($person->birthdate), date_create('now'))->y;
    $phone = $person->phone_mobile;
    $address_street = $person->address_street;
    $address_number = $person->address_number;
    $address_zip = $person->address_zip;
    $address_city = $person->address_city;
    $address_country = $person->address_country;
  ?>


  <div class="news-item__meta--large user user__back">
    <?php if ( is_page() && $post->post_parent ): ?>
      <a href="<?php echo get_permalink($post->post_parent); ?>"
        class="news-item__category user__back-link">
        ⬉ to <?php echo get_the_title($post->post_parent); ?>
      </a>
    <?php endif; ?>
  </div>

	<main id="site-content" class="user">
    <form action="#" class="user__top user__info">
      <div class="user__info__column user__info__column--left">
        <label for="first_name" class="user__info__label"><?php echo esc_attr_x('First name', 'User page first name label', 'svid-theme-domain');?></label>
        <div name="first_name" class="user__info__input user__info__input--name" readonly><?=$first_name?></div>

        <label for="last_name" class="user__info__label"><?php echo esc_attr_x('Last name', 'User page last name label', 'svid-theme-domain');?></label>
        <div name="last_name" class="user__info__input user__info__input--name" readonly><?=$last_name?></div>

        <label for="student_number" class="user__info__label"><?php echo esc_attr_x('Student number', 'User page student number label', 'svid-theme-domain');?></label>
        <div name="student_number" class="user__info__input" readonly><?=$student_number?></div>

        <label for="email" class="user__info__label"><?php echo esc_attr_x('E-Mail address', 'User page E-Mail label', 'svid-theme-domain');?></label>
        <div name="email_primary" class="user__info__input" readonly><?=$email_primary?></div>

        <label for="birthdate" class="user__info__label"><?php echo esc_attr_x('Birthdate', 'User page birthdate label', 'svid-theme-domain');?></label>
        <div name="birthdate" class="user__info__input" readonly><?=$birthdate?> (<?=$age?> years old)</div>

        <p class="user__extra-edit">
          <?php echo sprintf(
  				    __('Do you want to change any of the information above? Please <a href="%s">send our secretary an e-mail</a>.', 'svid-theme-domain' ),
  				    esc_url( 'mailto:secretaris-svid@tudelft.nl' )
  				); ?>
        </p>
      </div>

      <div class="user__info__column user__info__column--right">
        <label for="phone" class="user__info__label"><?php echo esc_attr_x('Phone number', 'User page phone number label', 'svid-theme-domain');?></label>
        <input name="phone" class="user__info__input user__info__input--editable" id="phone" type="tel" placeholder="<?php echo esc_attr_x('Phone number', 'User page phone number label', 'svid-theme-domain');?>" value="<?=$phone?>" readonly>

        <label for="address_street" class="user__info__label"><?php echo esc_attr_x('Streetname', 'User page streetname label', 'svid-theme-domain');?></label>
        <input name="address_street" class="user__info__input user__info__input--editable" id="address_street" type="text" placeholder="<?php echo esc_attr_x('Streetname', 'User page streetname label', 'svid-theme-domain');?>" value="<?=$address_street?>" readonly>

        <label for="address_number" class="user__info__label"><?php echo esc_attr_x('House number', 'User page house number label', 'svid-theme-domain');?></label>
        <input name="address_number" class="user__info__input user__info__input--editable" id="address_number" type="text" placeholder="<?php echo esc_attr_x('House number', 'User page house number label', 'svid-theme-domain');?>" value="<?=$address_number?>" readonly>

        <label for="address_zip" class="user__info__label"><?php echo esc_attr_x('Zipcode', 'User page address_zip label', 'svid-theme-domain');?></label>
        <input name="address_zip" class="user__info__input user__info__input--editable" id="address_zip" type="text" placeholder="<?php echo esc_attr_x('Zipcode', 'User page address_zip label', 'svid-theme-domain');?>" value="<?=$address_zip?>" readonly>

        <label for="address_city" class="user__info__label"><?php echo esc_attr_x('City', 'User page address_city label', 'svid-theme-domain');?></label>
        <input name="address_city" class="user__info__input user__info__input--editable" id="address_city" type="text" placeholder="<?php echo esc_attr_x('City', 'User page address_city label', 'svid-theme-domain');?>" value="<?=$address_city?>" readonly>

        <label for="address_country" class="user__info__label"><?php echo esc_attr_x('Country', 'User page address_country label', 'svid-theme-domain');?></label>
        <input name="address_country" class="user__info__input user__info__input--editable" id="address_country" type="text" placeholder="<?php echo esc_attr_x('Country', 'User page address_country label', 'svid-theme-domain');?>" value="<?=$address_country?>" readonly>

        <div class="user__info__column--bottom">
          <button href="#" type="button" class="button button--white user__info__edit user__info__edit--edit"><i class="fas fa-pencil-alt"></i> <?php echo esc_attr_x('Edit', 'User page edit button label', 'svid-theme-domain');?></button>
          <button href="#" type="submit" class="button button--white user__info__edit user__info__edit--save hidden"><i class="fas fa-save"></i> <?php echo esc_attr_x('Save', 'User page save button label', 'svid-theme-domain');?></button>
          <button href="#" type="button" class="button button--white user__info__edit user__info__edit--cancel hidden"><i class="fas fa-ban"></i> <?php echo esc_attr_x('Cancel', 'User page cancel button label', 'svid-theme-domain');?></button>
        </div>
      </div>

      <input type="hidden" name="action" value="user_update">
    </form>

    <section class="user__tickets">
      <h2 class="user__heading">🎟 Your event tickets & signups</h2>
      <?php
        // Get subscriptions for person
        $LassieModelInstance = Lassie::getLassieApi();
        $current_user = wp_get_current_user();
        $lassie_user_id = (int)$current_user->user_login;
        $LassiePersonSubscriptions = Lassie\Model\PersonModel::get_subscriptions_by_person_id($LassieModelInstance, [
          'person_id' => $lassie_user_id
        ]);

        $event_archive_link = get_post_type_archive_link('event');

      // Are there event subscriptions in the list?
      if ($LassiePersonSubscriptions): // yes ?>

        <ul class="user__instructions user__list">

        <?php foreach ($LassiePersonSubscriptions as $subscription):

          $lassie_event_id = $subscription->event_id;
          $LassieEvent = Lassie\Model\EventModel::get_event_by_id($LassieModelInstance, [
            'id' => $lassie_event_id,
          ]);
          $startDate = new DateTime($LassieEvent->start_date);
          $startDateHumanReadable = $startDate->format('F jS, Y \a\t G:i');
          echo "<li><strong>$LassieEvent->name</strong><br> ($startDateHumanReadable)</li>";

          // TODO: get a link from the event on the website

        endforeach; ?>

        </ul>
      <?php // Are there event subscriptions in the list?
      else: // no ?>
        <p class="user__instructions">It looks like you haven’t bought any tickets or signed up for any of our events yet. Hope we’ll see you at one of our <a href="<?php echo $event_archive_link; ?>">events</a> soon!</p>
      <?php endif; ?>
      <p class="user__instructions">
        <a href="<?php echo $event_archive_link; ?>"
          class="button button--white">Find more events to join</a>
      </p>
    </section>

    <section class="user__mid">
      <h2 class="user__heading">
        <?php echo esc_attr_e('Password change', 'svid-theme-domain'); ?>
      </h2>

      <p class="user__instructions">
        <?php echo esc_attr_e('You can change your password here by entering your current password and a new one.', 'svid-theme-domain'); ?>
      </p>

      <form class="user__password" action="#" method="post">

        <label for="current_password" class="login__label">
          <?php echo esc_attr_e('Current password', 'svid-theme-domain');?>
        </label>
        <input name="current_password" id="current_password" type="password"
          class="login__input" minlength="8" required autocomplete="current-password"
          placeholder="<?=esc_attr_e('password', 'svid-theme-domain')?>">
        <?php password_show_hide(); ?>

        <label for="new_password" class="login__label">
          <?php echo esc_attr_e('New password', 'svid-theme-domain');?>
          <span class="login__label-supplement">
            <?= esc_attr_e('(8 characters or more)', 'svid-theme-domain')?>
          </span>
        </label>
        <input name="new_password" id="new_password" type="password"
          class="login__input" minlength="8" required autocomplete="new-password"
          placeholder="<?=esc_attr_e('password', 'svid-theme-domain')?>">
        <?php password_show_hide(); ?>

        <button href="#" type="submit"
          class="button button--white user__info__edit user__info__edit--change-password">
          <i class="fas fa-lock"></i>
          <?php echo esc_attr_e('Save new password', 'svid-theme-domain');?>
        </button>

        <input type="hidden" name="action" value="user_password">
      </form>
    </section>
	</main>

<?php
	get_footer();
}
?>
