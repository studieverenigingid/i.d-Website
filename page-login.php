<?php

/**
 * Template Name: Login Page
 */

	get_header();
?>
  <main class="about__top login"
		style="background-color: <?php theme_color(false); ?>;">
		<h1 class="login__title">
	    <?php the_title(); ?>
	  </h1>

		<div class="login__form">
			<div class="login__form__message">
			<?php
				if (isset($_GET['login'])) {
					$login = $_GET['login'];

					if ( $login === "failed" ) {
					  echo '<h4 class="login__form--failed">'.esc_attr_x('Invalid username and/or password.', 'Invalid username and/or password error', 'svid-theme-domain').'</h4>';
					} elseif ( $login === "empty" ) {
					  echo '<h4 class="login__form--failed">'.esc_attr_x('Username and/or password is empty.', 'Username and/or password is empty error', 'svid-theme-domain').'</h4>';
					} elseif ( $login === "false" ) {
					  echo '<h4 class="login__form--success">'.esc_attr_x('You are logged out.', 'You are logged out success message', 'svid-theme-domain').'</h4>';
					}
				}
			?>
			</div>

			<?php custom_login_form(); ?>
		</div>

		<?php
		/**
		 * Detect if SAMLTUD is active. (This is a little hacky but quite useful at
		 * the moment.)
		 */
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'samltud/samltud.php' ) ) { ?>
		<div class="login__alternative">
			<hr class="divider divider--light login__divider">
			<span class="login__divider-text">or</span>
			<a href="<?php echo site_url('wp-login.php?use_sso=true'); ?>"
				class="login__netid button button--white">
				<?php echo esc_attr_x('Login using', 'login page', 'svid-theme-domain'); ?>
				<span class="login__netid-name">NetID</span>
			</a>
		</div>
		<?php } ?>

		<hr class="divider divider--light">

		<div class="login__reg-text">
			<?php echo sprintf(
					__('Don’t you have an account yet? <a href="%s" class="login__reg-link">Register here!</a>', 'svid-theme-domain' ),
					esc_url( 'https://id.lassie.cloud/auth/create_user' )
			);
			?>
		</div>

	</main>

<?php
	get_footer();
?>
