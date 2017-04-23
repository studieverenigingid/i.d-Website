<?php get_header(); ?>

<main>

	<h1 class="archive__title"><?php echo esc_attr_x( 'Vacancies', 'archive title' ); ?></h1>

	<div class="vacancies--small">
		<?php while(have_posts()) : the_post(); ?>

			<?php include( 'inc/small-vacancy.php' ); ?>

		<?php endwhile; ?>
	</div>

</main>

<?php include 'inc/pagination.php'; ?>

<?php get_footer(); ?>
