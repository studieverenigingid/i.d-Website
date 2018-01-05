<?php get_header(); if(have_posts()) : while(have_posts()) : the_post(); ?>

	<h1 class="archive__title">
		<?php the_title(); ?>
	</h1>

	<main class="primary-content">
		<?php the_content(); ?>
	</main>

<?php endwhile; endif; get_footer(); ?>
