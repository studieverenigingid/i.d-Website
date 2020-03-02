<?php get_header(); ?>

<main id="site-content">

	<h1 class="archive__title archive__title--vacancies"
		style="background-color: <?php theme_color(false); ?>;">
		<?php echo esc_attr_x( 'Career', 'archive title', 'svid-theme-domain'); ?>
	</h1>

	<div class="vacancies vacancies--archive">
		<?php while(have_posts()) : the_post(); ?>

			<?php include( 'inc/small-vacancy.php' ); ?>

		<?php endwhile; ?>
	</div>

</main>

<?php include 'inc/pagination.php'; ?>

<?php get_footer(); ?>
