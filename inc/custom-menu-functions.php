<?php
// Custom Login Functions
function custom_login_page() {
  $login_page = home_url( '/login' ); // new login page
  $exists = get_page_by_path( '/login' );
  global $pagenow;
  if( $pagenow == "wp-login.php" && $exists && $_SERVER['REQUEST_METHOD'] == 'GET' || $pagenow == get_home_url(null, 'user') ) {
    wp_redirect($login_page);
    exit;
  }
}

function custom_login_form() {
  include 'login-form.php';
}

function login_failed() {
  $login_page = home_url('/login');
  $exists = get_page_by_path( '/login' );
  if($exists) {
    wp_redirect($login_page . "?login=failed");
    exit;
  }
}

function verify_username_password($user, $username, $password ) {
  $login_page = home_url('/login');
  $exists = get_page_by_path( '/login' );
  if($exists && empty($username) || $exists && empty($password)) {
    wp_redirect( $login_page . "?login=empty");
    exit;
  }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
  $login_page = home_url('/login');
  $exists = get_page_by_path( '/login' );
  if($exists) {
    wp_redirect($login_page . "?login=false");
    exit;
  }
}

function add_login_logout_register_menu( $items, $args ) {
  if ( $args->theme_location != 'primary-menu' ) {
    return $items;
  }

  if ( is_user_logged_in() ) {
    $items .= '<li class="menu-item"><a href="' . get_home_url(null, 'user') . '">' . __( 'Profile' ) . '</a></li>';
    $items .= '<li class="menu-item"><a href="' . wp_logout_url() . '">' . __( 'Log Out' ) . '</a></li>';
  } else {
    $items .= '<li class="menu-item"><a href="' . wp_login_url() . '">' . __( 'Log In' ) . '</a></li>';
  }
  return $items;
}
add_filter( 'wp_nav_menu_items', 'add_login_logout_register_menu', 199, 2 );
?>
