<?php

/**
 * Template Name: User Profile Page
 */
  if (!is_user_logged_in()) {
    header('Location: '. get_home_url(null, 'login'));
  } else {
	get_header();
?>
  <?php
      $person = Lassie::getPerson();
      $first_name = $person->first_name;
      $last_name = $person->last_name;
      $email = $person->email_primary;
      $birthdate = date('Y/m/j',strtotime($person->birthdate));
      $age = date_diff(date_create($person->birthdate), date_create('now'))->y;
      $phone = $person->phone_mobile;
      $address_street = $person->address_street;
      $address_number = $person->address_number;
      $zipcode = $person->address_zip;
      $country = $person->address_country;
  ?>

	<main class="user__top">
    <h2 class="user__info">
      <span class="user__info__editable" data-placeholder="first name"><?=$first_name?></span> <span class="user__info__editable" data-placeholder="last name"><?=$last_name?></span>
    </h2>
    <p class="user__info"><span class="user__info__editable" data-placeholder="email"><?=$email?></span></p>
    <p class="user__info"><span class="user__info__editable" data-placeholder="00-00-0000"><?=$birthdate?> </span> (<?=$age?> years old)</p>
    <p class="user__info"><span class="user__info__editable" data-placeholder="phone"><?=$phone?></span></p>
    <p class="user__info">
      <span class="user__info__editable" data-placeholder="street name"><?=$address_street?></span> <span class="user__info__editable" data-placeholder="address Number"><?=$address_number?></span>
    </p>
    <p class="user__info"><span class="user__info__editable" data-placeholder="zip code"><?=$zipcode?></span>,
      <span class="user__info__editable" data-placeholder="Zipcode"><?=$country?></span>
    </p>
	</main>
  <div class="user__mid">
    <button href="#" class="button user__info__edit user__info__edit--edit"><i class="fa fa-pencil"></i> Edit</button>
    <button href="#" class="button user__info__edit user__info__edit--save hidden"><i class="fa fa-save"></i> Save</button>
    <button href="#" class="button user__info__edit user__info__edit--cancel hidden"><i class="fa fa-ban"></i> Cancel</button>
  </div>

<?php
	get_footer();
  }
?>
