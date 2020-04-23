<?php

/**
 * Template Name: Career block page
 */

get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<header id="site-content" class="kafee--page__header career__header
	<?php if ( !has_post_thumbnail() ) echo 'kafee--page__header--short-header'; ?>"
	style="background-color: <?php theme_color(false); ?>;">

	<div class="kafee--page__short-info
		<?php if ( !has_post_thumbnail() ) echo 'kafee--page__short-info--short-header'; ?>"
		style="background-color: <?php theme_color(false); ?>;">

		<h1 class="kafee--page__name"><?php the_title(); ?></h1>

      <div class="kafee--page__kafee">
        <?php the_content(); ?>
      </div>

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
<?php endwhile; endif; ?>



<?php

if( have_rows('career_content_blocks') ):

 	// loop through the rows of data
    while ( have_rows('career_content_blocks') ) : the_row(); ?>

			<hr class="divider">

			<section class="career__block">
				<h2 class="about__sub-title">
					<?php the_sub_field('career_content_title'); ?>
				</h2>

				<?php $wide = (get_sub_field('wide')) ? 'career__description--wide' : ''; ?>
				<div class="career__description <?php echo $wide; ?>">
					<?php the_sub_field('career_content_info'); ?>
				</div>

				<?php
					$button_url = get_sub_field('career_content_button_url');
					$button_text = get_sub_field('career_content_button_text');
					if($button_url && $button_text):
				?>
				<a class="button committees__all" href="<?php echo $button_url; ?>">
					<?php echo $button_text; ?>
				</a>
				<?php endif; ?>

			</section>

    <?php endwhile;

else :
	echo "no content found";
endif;

?>

<?php get_footer(); ?>
