<?php

/**
 * Template Name: User Profile Page
 */
	get_header();
?>
  <main class="about__top login">
		<h1 class="login__title">
	    <?php the_title(); ?>
	  </h1>

		<div class="login__form">
			<div class="login__form__message login__form__message--success">
				<?= esc_attr_x('You were succesfully logged in, awesome!', 'login-form-message')?>
			</div>
			
			<?php custom_login_form(); ?>
		</div>

	</main>

<?php
	get_footer();
?>
