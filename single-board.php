<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header id="site-content" class="news-item__header">

		<h1 class="news-item__title--large"><?php the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('post-thumbnail',
				array( 'class' => 'news-item__thumb--large')
			); ?>
		<?php endif; ?>

	</header>

	<main class="primary-content">
		<?php the_content(); ?>
	</main>

<?php
	endwhile; endif;
	get_footer();
?>
