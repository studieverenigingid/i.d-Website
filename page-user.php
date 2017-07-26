<?php

/**
 * Template Name: User Profile Page
 */
  if (!is_user_logged_in()) {
    header('Location: '. get_home_url(null, 'login'));
  } else {
	get_header();
?>

	<main class="primary-content news--page__content">

		<?php

        $person = Lassie::getPerson();
        echo $person->first_name." ".$person->last_name."<br />";
        echo $person->email_primary."<br />";
        echo $person->birthdate."<br />";
        echo $person->phone_mobile."<br />";
        echo $person->address_street." ".$person->address_number."<br />";
        echo $person->address_zip."<br />";
        echo $person->address_country."<br />";

    ?>

	</main>

<?php
	get_footer();
  }
?>
