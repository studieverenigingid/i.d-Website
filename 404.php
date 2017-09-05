<?php
	get_header();
?>

<main class="not-found">
	<h1 class="not-found__title">
		<?php echo esc_attr_x('Page not found', 'title 404.php', 'svid-theme-domain'); ?>
	</h1>
	<p><?php echo esc_attr_x('It seems this page does not exist. Try the menu on the right or the sitemap below.', 'svid-theme-domain'); ?></p>
</main>

<?php
	get_footer();
?>
