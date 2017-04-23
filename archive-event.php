<?php get_header(); ?>

<main>

	<h1 class="archive__title"><?php echo esc_attr_x( 'Events', 'archive title' ); ?></h1>

	<div class="events--small">
		<?php while(have_posts()) : the_post(); ?>

			<?php include( 'inc/small-event.php' ); ?>

		<?php endwhile; ?>
	</div>

</main>

<?php include 'inc/pagination.php'; ?>

<?php get_footer(); ?>
