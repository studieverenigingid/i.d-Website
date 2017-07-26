<?php

/**
 * Template Name: Login Page
 */
	get_header();
?>
  <main class="about__top login">
		<h1 class="login__title">
	    <?php the_title(); ?>
	  </h1>

		<div class="login__form">
			<div class="login__form__message">
			<?php
				$login = $_GET['login'];

				if ( $login === "failed" ) {
				  echo '<h4 class="login__form--failed">Invalid username and/or password.</h4>';
				} elseif ( $login === "empty" ) {
				  echo '<h4 class="login__form--failed">Username and/or Password is empty.</h4>';
				} elseif ( $login === "false" ) {
				  echo '<h4 class="login__form--success">You are logged out.</h4>';
				}
			 ?>
			</div>

			<?php custom_login_form(); ?>
		</div>

	</main>

<?php
	get_footer();
?>
