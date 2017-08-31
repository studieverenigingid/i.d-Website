<?php

/**
 * Template Name: Smoelenboek
 */
  if (!is_user_logged_in()) {
    header('Location: '. get_home_url(null, 'login'));
  } else {
	get_header();
?>

<div class="person-search">
  <input class="person-search__searchbar" placeholder="Search user..." value="">
</div>

<?php
	get_footer();
  }
?>
