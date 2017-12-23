<?php

/**
 * Template Name: Smoelenboek
 */
if (!is_user_logged_in()):
  header('Location: '. get_home_url(null, 'login'));
else:
  get_header();
?>

<main class="smoelenboek__top">
  <h1 class="smoelenboek__title">Smoelenboek</h1>
</main>

<?php
	get_footer();
endif;
?>
