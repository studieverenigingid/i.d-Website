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
      <div class="user__info__group">
        <div class="user__info">
          <label class="user__info__label hidden">First name</label>
          <h2 class="user__info--name"><div class="user__info__editable" data-placeholder="empty"><?=$first_name?></div></h2>
        </div>

        <div class="user__info">
          <label class="user__info__label hidden">Last name</label>
          <h2 class="user__info--name"><div class="user__info__editable" data-placeholder="empty"><?=$last_name?></div></h2>
        </div>
      </div>

      <div class="user__info__group">
        <div class="user__info">
          <label class="user__info__label hidden">E-mail address</label>
          <a href="mailto:<?=$email?>" class="user__info__editable" data-placeholder="empty"><?=$email?></a>
        </div>
      </div>

      <div class="user__info__group">
        <div class="user__info">
          <label class="user__info__label hidden">Birthdate</label>
          <div class="user__info__editable" data-placeholder="empty"><?=$birthdate?></div>
        </div>
        <div class="user__info">
          (<?=$age?> years old)
        </div>
      </div>

      <div class="user__info__group">
        <div class="user__info">
          <label class="user__info__label hidden">Phone</label>
          <a href="tel:<?=$phone?>" class="user__info__editable" data-placeholder="empty"><?=$phone?></a>
        </div>
      </div>

      <div class="user__info__group">
        <div class="user__info">
          <label class="user__info__label hidden">Street</label>
          <div class="user__info__editable" data-placeholder="empty"><?=$address_street?></div>
        </div>

        <div class="user__info">
          <label class="user__info__label hidden">Number</label>
          <div class="user__info__editable" data-placeholder="empty"><?=$address_number?></div>
        </div>
      </div>


      <div class="user__info__group">
        <div class="user__info">
          <label class="user__info__label hidden">Zip code</label>
          <div class="user__info__editable" data-placeholder="empty"><?=$zipcode?></div>
        </div>

        <div class="user__info">
          <label class="user__info__label hidden">Country</label>
          <div class="user__info__editable" data-placeholder="empty"><?=$country?></div>
        </div>
      </div>
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
