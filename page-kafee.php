<?php

/**
 * Template Name: i.d-Kafee page
 */

get_header(); ?>

<header class="kafee--page__header
	<?php if ( !has_post_thumbnail() ) echo 'kafee--page__header--no-thumb'; ?>">

	<div class="kafee--page__short-info
		<?php if ( !has_post_thumbnail() ) echo 'kafee--page__short-info--no-thumb'; ?>">

		<h1 class="kafee--page__name"><?php the_title(); ?></h1>

		<?php
		    // TO SHOW THE PAGE CONTENTS
		    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
		        <div class="kafee--page__kafee">
		            <?php the_content(); ?> <!-- Page Content -->
		        </div><!-- .entry-content-page -->

		    <?php
		    endwhile; //resetting the page loop
		    wp_reset_query(); //resetting the page query
		?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="kafee--page__thumb">
				<?php
				the_post_thumbnail(
					'large',
					array('class' => 'kafee--page__img')
				);
				?>
			</div>
		<?php endif; ?>

	</div>

</header>

<?php

if( have_rows('kafee_content_blocks') ):

 	// loop through the rows of data
    while ( have_rows('kafee_content_blocks') ) : the_row(); ?>
			<section class="kafee--page__container">
				<h2 class="kafee--page__blocktitle">
					<?php the_sub_field('kafee_content_title'); ?>
				</h2>
				<p>
					<?php the_sub_field('kafee_content_info'); ?>
				</p>
			</section>

    <?php endwhile;

else :
	echo "no content found";
endif;

?>

<?php get_footer(); ?>
