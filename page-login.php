<?php

/**
 * Template Name: Login Page
 */

get_header();
?>
  <main id="site-content" class="page-top login">
		<h1 class="login__title">
	    <?php the_title(); ?>
	  </h1>

		<?php if (is_user_logged_in()): ?>
		<p class="notification notification--failed">
			<?php echo esc_attr_e('It appears you are already logged in. Use the menu to see a whole new world! ✨', 'svid-theme-domain'); ?>
		</p></main>
		<?php else: ?>

		<div class="login__form">
			<div class="login__form__message">
			<?php
				if (isset($_GET['login'])) {
					$login = $_GET['login'];

					if ( $login === "failed" ) {
					  echo '<p class="notification notification--failed">'.esc_attr_x('Invalid username and/or password.', 'Invalid username and/or password error', 'svid-theme-domain').'</p>';
          } elseif ( $login === "empty" ) {
					  echo '<p class="notification notification--failed">'.esc_attr_x('Username and/or password is empty.', 'Username and/or password is empty error', 'svid-theme-domain').'</p>';
          } elseif ( $login === "unknown_netid" ) {
					  echo '<p class="notification notification--failed">'.esc_attr_x('Your NetID is not connected to an account on this website. Please try logging in with your username and password; this functionality should work afterwards. If you do not have a password, please register. If those actions do not help, please verify with us that your NetID is known to us.', 'Username and/or password is empty error', 'svid-theme-domain').'</p>';
					} elseif ( $login === "false" ) {
					  echo '<p class="notification notification--success">'.esc_attr_x('You are logged out.', 'You are logged out success message', 'svid-theme-domain').'</p>';
          } elseif ( $login === "account_activated" ) {
					  echo '<p class="notification notification--success">'.esc_attr_x('Your account was created successfully, you can now log in!', 'Account creation success message', 'svid-theme-domain').'</p>';
					}
				}

        if (empty($_COOKIE['svid_username'])) {
          echo sprintf('<p class="notification notification--info">Is this your first time logging in? You might need to <a href="%s">create an account first</a>.</p>',
            esc_url( home_url('create_account') ) );
        }
			?>
			</div>

			<?php custom_login_form(); ?>
		</div>

		<div class="login__right-column">
			<hr class="divider divider--light login__divider">
			<span class="login__divider-text">or</span>
			<?php
			/**
			 * Detect if SAMLTUD is active. (This is a little hacky but quite useful at
			 * the moment.)
			 */
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( is_plugin_active( 'samltud/samltud.php' ) ) {
        if ( $SAML_Client->settings->get_enabled() ) {
          $saml_url = site_url('wp-login.php?use_sso=true');
          if (!empty($_GET['redirect_to'])) { // if there is a redirect supplied
            $saml_url .= '&redirect_to=' . urlencode($_GET['redirect_to']); // make sure it sustains
          } ?>
			<a href="<?php echo $saml_url; ?>"
				class="login__netid button button--white">
				<?php echo esc_attr_x('Login using', 'login page', 'svid-theme-domain'); ?>
				<span class="login__netid-name">NetID</span>
			</a>
		<?php } } ?>
		</div>

    <div class="login__reg-text">
      <p>
        <?php echo __('<strong>Do you want to become a member?</strong> Cool! For identification purposes, you should come by the counter at the faculty of IDE. Trust us, it’s worth it.', 'svid-theme-domain' ); ?>
      </p>
      <p>
        <?php echo sprintf(
          __('Don’t have an account yet? <a href="%s" class="login__reg-link">Create it here!</a>', 'svid-theme-domain' ),
          esc_url( home_url('create_account') ) ); ?>
      </p>
      <p>
        <?php echo sprintf(
          __('Forgot your password? <a href="%s" class="login__reg-link" target="_blank">Reset it here!</a>', 'svid-theme-domain' ),
          esc_url( "https://id.lassie.cloud/auth/forgot_password" ) ); ?>
      </p>
    </div>


	</main>

<?php
	endif;
	get_footer();
?>
