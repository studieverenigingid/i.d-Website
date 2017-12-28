<?php

/**
 * Allow the user to accept cookies
 */

if (isset($_SERVER['HTTP_REFERER'])) $header_ref = parse_url($_SERVER['HTTP_REFERER']);
if (isset($_POST['cookie_referer'])) $form_ref = $_POST['cookie_referer'];

setcookie('accept_svid_cookies', 'true', time()+60*60*24*60, '/');

if ($header_ref['path'] === $form_ref) {
	Header("Location: $form_ref");
}
