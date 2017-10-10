<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header class="news-item__header" style="background-color: <?php theme_color(false);?>;">

		<h1 class="news-item__title--large"><?php the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('post-thumbnail',
				array( 'class' => 'news-item__thumb--large')
			); ?>
		<?php endif; ?>

	</header>

	<main class="primary-content news--page__content">
		<?php the_content(); ?>
	</main>

<?php
	endwhile; endif;
	get_footer();
?>
