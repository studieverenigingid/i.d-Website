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



	<main class="user__top">
    <form action="#" class="user__info">
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
      </div>

      <div class="user__info__column user__info__column--right">
        <label for="phone" class="user__info__label"><?php echo esc_attr_x('Phone number', 'User page phone number label', 'svid-theme-domain');?></label>
        <input name="phone" class="user__info__input user__info__input--editable" type="phone_mobile" placeholder="<?php echo esc_attr_x('Phone number', 'User page phone number label', 'svid-theme-domain');?>" value="<?=$phone?>" readonly>

        <label for="address_street" class="user__info__label"><?php echo esc_attr_x('Streetname', 'User page streetname label', 'svid-theme-domain');?></label>
        <input name="address_street" class="user__info__input user__info__input--editable" type="text" placeholder="<?php echo esc_attr_x('Streetname', 'User page streetname label', 'svid-theme-domain');?>" value="<?=$address_street?>" readonly>

        <label for="address_number" class="user__info__label"><?php echo esc_attr_x('House number', 'User page house number label', 'svid-theme-domain');?></label>
        <input name="address_number" class="user__info__input user__info__input--editable" type="text" placeholder="<?php echo esc_attr_x('House number', 'User page house number label', 'svid-theme-domain');?>" value="<?=$address_number?>" readonly>

        <label for="address_zip" class="user__info__label"><?php echo esc_attr_x('Zipcode', 'User page address_zip label', 'svid-theme-domain');?></label>
        <input name="address_zip" class="user__info__input user__info__input--editable" type="text" placeholder="<?php echo esc_attr_x('Zipcode', 'User page address_zip label', 'svid-theme-domain');?>" value="<?=$address_zip?>" readonly>

        <label for="address_city" class="user__info__label"><?php echo esc_attr_x('City', 'User page address_city label', 'svid-theme-domain');?></label>
        <input name="address_city" class="user__info__input user__info__input--editable" type="text" placeholder="<?php echo esc_attr_x('City', 'User page address_city label', 'svid-theme-domain');?>" value="<?=$address_city?>" readonly>

        <label for="address_country" class="user__info__label"><?php echo esc_attr_x('Country', 'User page address_country label', 'svid-theme-domain');?></label>
        <input name="address_country" class="user__info__input user__info__input--editable" type="text" placeholder="<?php echo esc_attr_x('Country', 'User page address_country label', 'svid-theme-domain');?>" value="<?=$address_country?>" readonly>

        <div class="user__info__column--bottom">
          <button href="#" type="button" class="button button--white user__info__edit user__info__edit--edit"><i class="fa fa-pencil"></i> <?php echo esc_attr_x('Edit', 'User page edit button label', 'svid-theme-domain');?></button>
          <button href="#" type="submit" class="button button--white user__info__edit user__info__edit--save hidden"><i class="fa fa-save"></i> <?php echo esc_attr_x('Save', 'User page save button label', 'svid-theme-domain');?></button>
          <button href="#" type="button" class="button button--white user__info__edit user__info__edit--cancel hidden"><i class="fa fa-ban"></i> <?php echo esc_attr_x('Cancel', 'User page cancel button label', 'svid-theme-domain');?></button>
        </div>
      </div>

      <input type="hidden" name="action" value="user_update">
    </form>
	</main>

<?php
	get_footer();
}
?>
