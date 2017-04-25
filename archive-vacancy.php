<?php get_header(); ?>

<main>

	<h1 class="archive__title archive__title--vacancies">
		<?php echo esc_attr_x( 'Vacancies', 'archive title' ); ?>
	</h1>

	<div class="vacancies vacancies--archive">
		<?php while(have_posts()) : the_post(); ?>

			<?php include( 'inc/small-vacancy.php' ); ?>

		<?php endwhile; ?>
	</div>

	<nav class="pagination"><?php
		$big = 999999999;
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) ); ?>
	</nav>

</main>

<?php get_footer(); ?>
