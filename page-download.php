<?php
/*
Template Name: Download page
*/

if(!is_user_logged_in()):
	header('Location: ' . wp_login_url($_SERVER['REQUEST_URI']));

else:

	$file = get_attached_file( $_GET['id'] );

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);

endif;
