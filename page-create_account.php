<?php

/**
 * Template Name: Account Creation Page
 */

get_header();
wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
?>
  <main id="site-content" class="about__top login login--create-account"
		style="background-color: <?php theme_color(false); ?>;">

		<h1 class="login__title">
	    <?php the_title(); ?>
	  </h1>

    <?php if (is_user_logged_in()): ?>
		<h4 class="notification notification--failed">
			<?php echo esc_attr_e('It appears you are already logged in. Use the menu to see a whole new world! ✨', 'svid-theme-domain'); ?>
		</h4></main>
		<?php else: ?>

		<div class="login__form">

			<?php
			if (isset($_GET['account_created'])) {
				$login = $_GET['account_created'];

				if ( $login === "1" ) {
					$message = __( 'Your account creation was successful! You should have received an email with a link to activate your account. After activation you can login <a href="%s">here</a>.', 'svid-theme-domain' );
					$message = sprintf(
						$message,
						esc_url( home_url('login') )
					);
					echo '<h4 class="login__form--success">'.$message.'</h4>';
				}
			}
			?>

			<form class="login__wrap" method="post" id="create_account_form"
        action="<?=esc_url( admin_url('admin-post.php') ) ?>">

				<div class="form-group">
					<label for="account-email" class="login__label">
						<?= esc_attr_x('Email Address', 'Email label for account creation', 'svid-theme-domain')?>
						<span class="login__label-supplement">
							<?= esc_attr_e('(as we know it)', 'svid-theme-domain')?>
						</span>
			    </label>
					<input type="email" name="user_email" class="login__input"
            id="account-email" required
						placeholder="<?=esc_attr_e('jamie@doe.com', 'svid-theme-domain')?>">
				</div>

				<div class="form-group">
					<label for="account-pwd" class="login__label">
			      <?= esc_attr_x('Password', 'Password label for account creation', 'svid-theme-domain')?>
						<span class="login__label-supplement">
							<?= esc_attr_e('(think of a strong 8+ character password!)', 'svid-theme-domain')?>
						</span>
			    </label>
					<input type="password" name="user_password" class="login__input"
						id="account-pwd" minlength="8" required autocomplete="new-password"
						placeholder="<?=esc_attr_e('password', 'svid-theme-domain')?>">
          <?php password_show_hide(); ?>
				</div>

				<div class="form-group">
					<label for="g-recaptcha" class="login__label">
			      <?= esc_attr_x('Verification of humanness', 'Recaptcha label for account creation', 'svid-theme-domain')?>
			    </label>
					<div class="g-recaptcha"
						data-sitekey="6Ld7pCUUAAAAAFY2ezdhFaWW25L_c254ali_Hpsg">
					</div>
				</div>

				<p class="form-group">
					<input type="hidden" name="language" value="<?=constant('ICL_LANGUAGE_CODE')?>">
					<input type="hidden" name="action" value="user_create_account">
					<?php wp_nonce_field( $action = 'user_create_account' ); ?>

			    <button type="submit" name="wp-submit" id="wp_submit"
						class="button button--white">
            <?= esc_attr_x('Create account', 'Button value create account form', 'svid-theme-domain')?>
          </button>
			  </p>

			</form>

		</div>

		<aside class="login__right-column">
			<hr class="divider divider--light login__divider">
			<p class="login__information">
				If you are already a member of ID, you can easily
				create your account here. With this, you can log in to read the full
				Turn The Page, get the General Members Assembly documents and change
				your contact information. You will get an email to activate your
				account.
			</p>
		</aside>

	</main>

<?php
  endif;
	get_footer();
?>
