<?php

/**
 * Template Name: Vacancy Archive
 */

get_header(); ?>

<main>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<h1 class="archive__title archive__title--vacancies"
		style="background-color: <?php theme_color(false); ?>;">
		<?php echo esc_attr_x( 'Vacancies', 'archive title', 'svid-theme-domain'); ?>
	</h1>

	<div class="vacancies__context"
		style="background-color: <?php theme_color(false); ?>;">
		<?php the_content(); ?>
	</div>

	<div class="vacancies vacancies--archive">
    <?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    // args
    $args = array(
      'post_type' => 'vacancy',
      'posts_per_page' => 10,
			'paged' => $paged,
    );

    $vacancy_loop = new WP_Query( $args );
    if($vacancy_loop->have_posts()) :
			while($vacancy_loop->have_posts()) : $vacancy_loop->the_post(); ?>

			<?php include( 'inc/small-vacancy.php' ); ?>

			<?php endwhile;
		endif; ?>
	</div>

</main>

<nav class="pagination"><?php
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $vacancy_loop->max_num_pages
	) ); ?></nav>

<?php endwhile; endif; get_footer(); ?>
