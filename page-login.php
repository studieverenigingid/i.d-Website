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
				if (isset($_GET['login'])) {
					$login = $_GET['login'];

					if ( $login === "failed" ) {
					  echo '<h4 class="login__form--failed">Invalid username and/or password.</h4>';
					} elseif ( $login === "empty" ) {
					  echo '<h4 class="login__form--failed">Username and/or Password is empty.</h4>';
					} elseif ( $login === "false" ) {
					  echo '<h4 class="login__form--success">You are logged out.</h4>';
					}
				}
			?>
			</div>

			<div class="login__form--info">
				Don’t you have an account yet? Go to <a href="https://id.lassie.cloud/auth/create_user">Lassie</a> (our new member administration) and create an account using your email address which is known to us. You can return here after that to login.
			</div>

			<?php custom_login_form(); ?>
		</div>

	</main>

<?php
	get_footer();
?>
