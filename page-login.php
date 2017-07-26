<?php

/**
 * Template Name: User Profile Page
 */
	get_header();
?>

	<main class="primary-content news--page__content">

    <main class="primary-content">

      <?php

      $args = array(
        'redirect' => home_url(null, 'user'),
        'value_remember' => true
      );

      wp_login_form($args); ?>

  	</main>

	</main>

<?php
	get_footer();
?>
