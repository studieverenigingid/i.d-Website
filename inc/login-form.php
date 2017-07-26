<form name="loginform" id="loginform" class="login__wrap" method="post" action="<?=site_url('wp-login.php','login_post') ?>">
  <div class="form-group">
    <label for="log" class="login__label">
      <?= esc_attr_x('Username or Email Address', 'Username value on login page')?>
    </label>
    <input type="text" name="log" class="login__input" placeholder="<?= esc_attr_x('john@doe.com', 'feedback-form-placeholder') ?>" id="login-name">
  </div>

  <div class="form-group">
    <label for="pwd" class="login__label">
      <?= esc_attr_x('Password', 'Password value on login page')?>
    </label>
    <input type="password" name="pwd" class="login__input" placeholder="<?= esc_attr_x('password', 'feedback-form-placeholder') ?>" id="login-pass">
  </div>

  <div class="login__remember">
    <p class="login__label login__label--right">Remember Me</p>
    <input name="rememberme" type="checkbox" class="login__toggle js-login-checkbox" id="rememberme" value="forever" checked="checked") />
    <label for="rememberme" class="login__toggle-button js-login-toggle"></label>
  </div>

  <p class="login-submit">
    <input type="submit" name="wp-submit" id="wp_submit" class="button button--white" value="Log In" />
  </p>
</form>
