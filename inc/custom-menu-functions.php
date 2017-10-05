<?php
/**
  * Login page url
  * @return (bool|string) $login_page; false if page doesn’t exist, otherwise
  * its url
  */
function login_page_url() {
  $login_page = home_url( '/login' ); // new login page
  $exists = get_page_by_path( '/login' );
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
    wp_redirect($login_page . "?login=failed");
    exit;
  }
}

function verify_username_password($user, $username, $password ) {
  $login_page = login_page_url();
  if ( !array_key_exists('use_sso', $_GET) || $_GET['use_sso'] !== 'true' ) {
    if($login_page && empty($username) || $login_page && empty($password)) {
      wp_redirect( $login_page . "?login=empty");
      exit;
    }
  }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
  $login_page = login_page_url();
  if($login_page) {
    wp_redirect($login_page . "?login=false");
    exit;
  }
}

function custom_menu_items( $items, $args ) {
  if ( $args->theme_location === 'sitemap' ) return $items;
  if ( is_user_logged_in() ) {
    $items .= '<li class="menu-item"><a href="' . get_home_url(null, 'user') . '">' . __( 'Profile', 'svid-theme-domain' ) . '</a></li>';
    $items .= '<li class="menu-item"><a href="' . wp_logout_url() . '">' . __( 'Log Out', 'svid-theme-domain' ) . '</a></li>';
  } else {
    $items .= '<li class="menu-item"><a href="' . wp_login_url() . '">' . __( 'Log In', 'svid-theme-domain' ) . '</a></li>';
  }
  return $items;
}
add_filter( 'wp_nav_menu_items', 'custom_menu_items', 199, 2 );

?>
