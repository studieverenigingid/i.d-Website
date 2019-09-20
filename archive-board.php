<?php
	$fp = get_posts("post_type=board&numberposts=1");
?>

<?php get_header(); ?>

<main>

	<h1 class="archive__title"
		style="background-color: <?php theme_color(false); ?>;">
		<?php echo esc_attr_x('Our boards', 'archive title', 'svid-theme-domain'); ?>
	</h1>

	<div class="committees__grid">

	<?php
		if(have_posts()) : while(have_posts()) :
			the_post();
			include 'inc/small-board.php';
		endwhile; endif;

		wp_reset_postdata();
	?>

	</div>

</main>

<?php get_footer(); ?>
