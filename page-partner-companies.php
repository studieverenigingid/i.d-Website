<?php

/**
 * Template Name: Partner companies
 */

get_header(); ?>

<main id="site-content" class="partner-intro">

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<h1 class="archive__title archive__title--vacancies">
		<?php the_title(); ?>
	</h1>

	<div class="vacancies__context">
		<?php the_content(); ?>
	</div>

	<?php endwhile; endif; ?>

</main>

<?php
	if( have_rows('companies') ): ?>
		<section class="partner-companies">
	 	<?php // loop through the rows of data
	    while ( have_rows('companies') ) : the_row(); ?>
				<article class="partner-company">
					<?php
						$thematic_photo = get_sub_field('thematic_photo');
						$thematic_photo = $thematic_photo['sizes']['medium_large'];
					?>
					<div class="partner-company__visual"
						style="background-image: url(<?php echo $thematic_photo; ?>);">
						<?php
							$logo = get_sub_field('logo');
							$logo = $logo['sizes']['medium'];
						?>
						<a class="partner-company__logo-bubble" target="_blank"
							href="<?php the_sub_field('url'); ?>">
							<img class="partner-company__logo" src="<?php echo $logo; ?>"
								alt="Logo <?php the_sub_field('name'); ?>">
						</a>
					</div>
					<h2 class="partner-company__name">
						<?php the_sub_field('name'); ?>
					</h2>
					<?php if (get_sub_field('tagline')) { ?>
						<p class="partner-company__tagline">
							<?php the_sub_field('tagline'); ?>
						</p>
					<?php } ?>
					<div class="partner-company__description">
						<?php the_sub_field('description'); ?>

						<a class="partner-company__website button" target="_blank"
							href="<?php the_sub_field('url'); ?>">
								<?php the_sub_field('name'); ?>’s website
							</a>
					</div>
				</article>
	    <?php endwhile; ?>
		</section>
	<?php else :
		echo "no partner companies found";
	endif;
?>

<?php get_footer(); ?>
