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
      $student_number = $person->external_id;
      $email = $person->email_primary;
      $birthdate = date('F jS, Y',strtotime($person->birthdate));
      $age = date_diff(date_create($person->birthdate), date_create('now'))->y;
      $phone = $person->phone_mobile;
      $address_street = $person->address_street;
      $address_number = $person->address_number;
      $zipcode = $person->address_zip;
      $country = $person->address_country;
  ?>



	<main class="user__top">
    <form action="#" class="user__info">
      <div class="user__info__column user__info__column--left">
        <label for="first_name" class="user__info__label">First name</label>
        <input name="first_name" class="user__info__input user__info__input--name user__info__input--editable" type="text" placeholder="First name" value="<?=$first_name?>" readonly>

        <label for="last_name" class="user__info__label">Last name</label>
        <input name="last_name" class="user__info__input user__info__input--name user__info__input--editable" type="text" placeholder="Last name" value="<?=$last_name?>" readonly>

        <label for="student_number" class="user__info__label">Student number</label>
        <div name="student_number" class="user__info__input" readonly><?=$student_number?></div>
      </div>

      <div class="user__info__column user__info__column--right">
        <label for="email" class="user__info__label">E-mail address</label>
        <input name="email" class="user__info__input user__info__input--editable" type="email" placeholder="E-mail address" value="<?=$email?>" readonly>

        <label for="birthdate" class="user__info__label">Birthdate</label>
        <div name="birthdate" class="user__info__input" readonly><?=$birthdate?> (<?=$age?> years old)</div>

        <label for="phone" class="user__info__label">Phone number</label>
        <input name="phone" class="user__info__input user__info__input--editable" type="phone_mobile" placeholder="Phone number" value="<?=$phone?>" readonly>

        <label for="address_street" class="user__info__label">Streetname</label>
        <input name="address_street" class="user__info__input user__info__input--editable" type="text" placeholder="Streetname" value="<?=$address_street?>" readonly>

        <label for="address_number" class="user__info__label">Number</label>
        <input name="address_number" class="user__info__input user__info__input--editable" type="text" placeholder="Number" value="<?=$address_number?>" readonly>

        <label for="zipcode" class="user__info__label">Zipcode</label>
        <input name="zipcode" class="user__info__input user__info__input--editable" type="text" placeholder="Zipcode" value="<?=$zipcode?>" readonly>

        <label for="country" class="user__info__label">Country</label>
        <input name="country" class="user__info__input user__info__input--editable" type="text" placeholder="Country" value="<?=$country?>" readonly>
      </div>

      <input type="hidden" name="action" value="user_update">

      <div class="user__info__column user__info__column--bottom">
        <button href="#" type="button" class="button button--white user__info__edit user__info__edit--edit"><i class="fa fa-pencil"></i> Edit</button>
        <button href="#" type="submit" class="button button--white user__info__edit user__info__edit--save hidden"><i class="fa fa-save"></i> Save</button>
        <button href="#" type="button" class="button button--white user__info__edit user__info__edit--cancel hidden"><i class="fa fa-ban"></i> Cancel</button>
      </div>
    </form>
	</main>

  <div class="user__mid">

  </div>

<?php
	get_footer();
  }
?>
