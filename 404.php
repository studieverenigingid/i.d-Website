<?php
	get_header();
?>

<main class="not-found"
	style="background-color: <?php theme_color(false); ?>;">
	<picture>
		<source srcset="<?=$img_folder?>404.svg" type="image/svg+xml">
		<img class="not-found__image" alt="?"
			srcset="<?=$img_folder?>404.png 1x,
				<?=$img_folder?>404@2x.png 2x"
			src="<?=$img_folder?>404.png">
	</picture>
	<h1 class="not-found__title">
		<?php echo esc_attr_x('You’ve hit a 404, which means...', 'title 404.php', 'svid-theme-domain'); ?>
	</h1>
	<h2 class="not-found__sub-title">
		<?php echo esc_attr_x('we have no ID where that page went', 'sub-title 404.php', 'svid-theme-domain'); ?>
	</h2>
	<p>
		<?php echo esc_attr_x('It seems this page does not exist. Try the menu or the sitemap below.', '404.php action suggestion', 'svid-theme-domain'); ?>
	</p>
</main>

<?php
	get_footer();
?>

<script type="text/javascript">
	notFound(jQuery);
</script>
