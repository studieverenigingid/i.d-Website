<?php

/**
 * Template Name: contact page
 */

get_header(); ?>

<header class="contact--page__header
	<?php if ( !has_post_thumbnail() ) echo 'contact--page__header--short-header'; ?>"
	style="background-color: <?php theme_color(false); ?>;">

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

<?php if( have_rows('board_members') ): ?>
	<section class="board-members contact--page__container">
		<h2 class="board-members__title contact--page__blocktitle">
			Send one of our board members an email
		</h2>
	</section>
	<section>
		<div class="board-members__cont">
			<?php // loop through the rows of data
	    while ( have_rows('board_members') ) : the_row(); ?>
				<div class="board-members__person">
					<?php
					$image = get_sub_field('photo');
					if( !empty( $image ) ): ?>
					<img src="<?php echo esc_url($image['url']); ?>"
						alt="Portrait photo of <?php the_sub_field('name') ?>"
						class="board-members__profile-pic">
					<?php endif; ?>
					<h3 class="board-members__name">
						<?php the_sub_field('name'); ?>
					</h3>
					<p class="board-members__function">
						<?php the_sub_field('func'); ?></p>
					<p class="board-members__email">
						<a href="mailto:<?php the_sub_field('email'); ?>">
							<?php the_sub_field('email'); ?>
						</a>
					</p>
				</div>
  	<?php endwhile; ?>
			<div class="board-members__spacer">&nbsp;</div>
		</div>
	</section>
<?php endif; ?>


<?php

if( have_rows('contact_page_block') ):

 	// loop through the rows of data
    while ( have_rows('contact_page_block') ) : the_row(); ?>
			<section class="contact--page__container">
				<h2 class="contact--page__blocktitle">
					<?php the_sub_field('contact_block_title'); ?>
				</h2>
				<?php the_sub_field('contact_block_content'); ?>
			</section>

    <?php endwhile;
endif;

?>

<?php get_footer(); ?>
