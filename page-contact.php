<?php

/**
 * Template Name: contact page
 */

get_header(); ?>

<header class="contact--page__header
	<?php if ( !has_post_thumbnail() ) echo 'contact--page__header--short-header'; ?>">

	<div class="contact--page__short-info
		<?php if ( !has_post_thumbnail() ) echo 'contact--page__short-info--short-header'; ?>">

		<h1 class="contact--page__name"><?php the_title(); ?></h1>

		<?php
		    // TO SHOW THE PAGE CONTENTS
		    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
		        <div class="contact--page__contact">
		            <?php the_content(); ?> <!-- Page Content -->
		        </div><!-- .entry-content-page -->

		    <?php
		    endwhile; //resetting the page loop
		    wp_reset_query(); //resetting the page query
		?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="contact--page__thumb">
				<?php
				the_post_thumbnail(
					'large',
					array('class' => 'contact--page__img')
				);
				?>
			</div>
		<?php endif; ?>

	</div>

</header>

<?php

if( have_rows('contact_page_block') ):

 	// loop through the rows of data
    while ( have_rows('contact_page_block') ) : the_row(); ?>
			<section class="contact--page__container">
				<h2 class="contact--page__blocktitle">
					<?php the_sub_field('contact_block_title'); ?>
				</h2>
				<p>
					<?php the_sub_field('contact_block_content'); ?>
				</p>
			</section>

    <?php endwhile;

else :
	echo "no content found";
endif;

?>

<?php get_footer(); ?>
