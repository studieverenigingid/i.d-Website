<?php

/**
 * Template Name: Account Creation Page
 */

get_header();
?>
  <main id="site-content" class="page-top login login--create-account">

    <p>
      <a href="<?php echo home_url('login'); ?>">← Back to login</a>
    </p>

		<h1 class="login__title">
	    <?php the_title(); ?>
	  </h1>

    <?php if (is_user_logged_in()): ?>
		<p class="notification notification--failed">
			<?php echo esc_attr_e('It appears you are already logged in. Use the menu to see a whole new world! ✨', 'svid-theme-domain'); ?>
		</p></main>
		<?php else: ?>

		<div class="login__form">

			<?php
      // Was the account just created?
			if (isset($_GET['account_created']) && $_GET['account_created'] === "1"): // yes
					$message = __( 'Your account creation was successful! You should have received an email with a link to activate your account. After activation you can login <a href="%s">here</a>.', 'svid-theme-domain' );
					$message = sprintf(
						$message,
						esc_url( home_url('login') )
					);
          echo '<p class="notification notification--success">'.$message.'</p>';
      // Was the account just created?
      else: // no
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

        <label for="special" class="contact-form__special">
          <?= esc_attr_x('This is for robots', 'feedback-form-question', 'svid-theme-domain')?>
        </label>
        <input name="special" id="special" type="text" class="contact-form__special"
          placeholder="<?= esc_attr_x('silence', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
          value="">

				<p class="form-group">
					<input type="hidden" name="action" value="user_create_account">
					<?php wp_nonce_field( $action = 'user_create_account' ); ?>

			    <button type="submit" name="wp-submit" id="wp_submit"
						class="button button--white">
            <?= esc_attr_x('Create account', 'Button value create account form', 'svid-theme-domain')?>
          </button>
			  </p>

			</form>

      <?php endif; // Was the account just created? ?>

			<p class="login__information">
				If you are already a member of ID, you can easily
				create your account here. With this, you can log in to read the full
				Turn The Page, get the General Members Assembly documents and change
				your contact information. You will get an email to activate your
				account.
			</p>

		</div>

	</main>

<?php
  endif;
	get_footer();
?>
