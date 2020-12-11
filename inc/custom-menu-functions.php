<?php
/**
  * Login page url
  * @return (bool|string) $login_page; false if page doesn’t exist, otherwise
  * its url
  */
function login_page_url($ignore_redirect_to = false) {
  $login_page = home_url( '/login' ) . '?'; // new login page
  $exists = get_page_by_path( '/login' );
  if (!empty($_GET['redirect_to']) && !$ignore_redirect_to) { // if there is a redirect supplied
    $login_page .= 'redirect_to=' . urlencode($_GET['redirect_to']) . '&'; // make sure it sustains
  } elseif($ignore_redirect_to) {
    global $wp;
    $target_url = home_url($wp->request);
    $login_page .= 'redirect_to=' . urlencode($target_url);
  }
  if ($exists) return $login_page;
  return false;
}

// Custom Login Functions
function custom_login_page() {
  $login_page = login_page_url();
  global $pagenow;
  if( $pagenow == "wp-login.php" && $login_page
    && $_SERVER['REQUEST_METHOD'] == 'GET'
    || $pagenow == get_home_url(null, 'user') ) {
    if ( array_key_exists('use_sso', $_GET) && $_GET['use_sso'] == 'true' ) return;
    wp_redirect($login_page);
    exit;
  }
}

function custom_login_form() {
  include 'login-form.php';
}

function login_failed() {
  $login_page = login_page_url();
  if($login_page) {
    wp_redirect($login_page . "login=failed");
    exit;
  }
}

function login_success($user_login, $user) {
  // Save username to 1. prefill and 2.
  setcookie('svid_username', $user->user_email, [
    'expires' => time()+(60*60*24*365*2),
    'secure' => true, // only on https because you know
    'httponly' => true, // just kidding no idea what I’m doing but this seems safer
  ]);
}

function verify_username_password($user, $username, $password ) {
  $login_page = login_page_url();
  if ( !array_key_exists('use_sso', $_GET) || $_GET['use_sso'] !== 'true' ) {
    if($login_page && empty($username) || $login_page && empty($password)) {
      wp_redirect( $login_page . "login=empty");
      exit;
    }
  }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function complete_redirect($redirect_to, $request, $user) {
  if (!empty($_GET['redirect_to'])) {
    return $_GET['redirect_to'];
  } else {
    return home_url();
  }
}
add_filter('login_redirect', 'complete_redirect', 10, 3);

function login_first_redirect() {
  header('Location: '. get_home_url(null, 'login') . '?redirect_to=' . urlencode(get_permalink()));
}


function custom_menu_items( $items, $args ) {
  if ( $args->theme_location === 'sitemap' ) return $items;
  if ( is_user_logged_in() ) {
    if (login_page_url()) {
      $logout_url = wp_logout_url( get_home_url(null, 'login/?login=false') );
    } else {
      $logout_url = wp_logout_url();
    }
    $items .= '<li class="menu-item"><a href="' . $logout_url . '">' . __( 'Log Out', 'svid-theme-domain' ) . '</a></li>';
  } else {
    $items .= '<li class="menu-item"><a href="' . login_page_url(true) . '">' . __( 'Log In', 'svid-theme-domain' ) . '</a></li>';
  }
  return $items;
}
add_filter( 'wp_nav_menu_items', 'custom_menu_items', 199, 2 );

?>
