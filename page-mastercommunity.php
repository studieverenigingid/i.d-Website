<?php

/**
 * Template Name: Master community
 */

	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<main id="site-content" class="primary-content">

		<h1>
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail('thumbnail',
					array('class' => 'master-com__logo')); ?>
			<?php endif; ?>
			<?php the_title(); ?>
		</h1>

		<?php the_content(); ?>

	</main>

<?php
	endwhile; endif;
	get_footer();
?>
