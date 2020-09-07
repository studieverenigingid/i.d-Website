<?php

/**
 * Template Name: Career block page
 */

get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<header id="site-content" class="page-top">

	<h1 class="page-top__title"><?php the_title(); ?></h1>

  <div class="page-top__descr">
    <?php the_content(); ?>
  </div>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="page-top__thumb">
			<?php
			the_post_thumbnail(
				'large',
				array('class' => 'page-top__img')
			);
			?>
		</div>
	<?php endif; ?>

</header>
<?php endwhile; endif; ?>



<?php

if( have_rows('career_content_blocks') ):

 	// loop through the rows of data
    while ( have_rows('career_content_blocks') ) : the_row();
		$section_id = strtolower(get_sub_field('career_content_title'));
		$section_id = str_replace(" ", "", $section_id); ?>

			<hr class="divider">

			<section class="career__block"
				id="<?php echo $section_id; ?>">
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
