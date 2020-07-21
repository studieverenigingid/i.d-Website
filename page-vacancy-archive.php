<?php

/**
 * Template Name: Vacancy Archive
 */

get_header(); ?>

<main id="site-content">

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<h1 class="archive__title archive__title--vacancies"
		style="background-color: <?php theme_color(false); ?>;">
		<?php echo esc_attr_x( 'Vacancies', 'archive title', 'svid-theme-domain'); ?>
	</h1>

	<div class="vacancies__context"
		style="background-color: <?php theme_color(false); ?>;">
		<?php the_content(); ?>
	</div>

	<div class="filters">
		<div class="filters__label">
			<?php echo esc_attr_x('Filter by type:', 'Filter by type vacancy/career label', 'svid-theme-domain');?>
			<span class="filters__master-switch" data-for="comm-group"><?php echo esc_attr_x('[none]', 'select no vacancy type label', 'svid-theme-domain');?></span>
		</div>
		<div class="filters__group" id="comm-group"
			data-for="comm-group--" data-multiple="true">
			<?php
				$vacancy_cat = get_category_by_slug('vacancy');
				$vacancy_types = get_categories( array( 'parent' => $vacancy_cat->cat_ID ) );
				foreach ($vacancy_types as $key => $group_opt):
			?>
			<label class="filters__tag vacancy-tag"
				for="<?=$group_opt->slug?>">
				<input type="checkbox" name="committee-group" checked
					value="<?=$group_opt->slug?>" id="<?=$group_opt->slug?>"
					><?=$group_opt->name?>
			</label>
			<?php endforeach; ?>
		</div>
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
