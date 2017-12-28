<form name="loginform" id="loginform" class="login__wrap" method="post" action="<?=home_url('wp-login.php','login_post') ?>">
  <div class="form-group">
    <label for="login-name" class="login__label">
      <?= esc_attr_x('Username or Email Address', 'Username value on login page', 'svid-theme-domain')?>
    </label>
    <input type="text" name="log" class="login__input" id="login-name"
      required autocomplete="username"
      placeholder="<?= esc_attr_x('john@doe.com', 'feedback-form-placeholder', 'svid-theme-domain') ?>">
  </div>

  <div class="form-group">
    <label for="login-pass" class="login__label">
      <?= esc_attr_x('Password', 'Password value on login page', 'svid-theme-domain')?>
    </label>
    <input type="password" name="pwd" class="login__input" id="login-pass"
      minlength="8" required autocomplete="current-password"
      placeholder="<?= esc_attr_e('password', 'svid-theme-domain') ?>">
    <?php password_show_hide(); ?>
  </div>

  <p class="login-submit">
    <input type="submit" name="wp-submit" id="wp_submit" class="button button--white" value="Log In">
    <input type="hidden" name="redirect_to" value="<?=home_url()?>">
  </p>
</form>
