<?php get_header(); ?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<main class="hon-mem--page">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="hon-mem--page__avatar">
				<?php the_post_thumbnail('large'); ?>
			</div>
		<?php endif; ?>

		<section class="hon-mem--page__descr">
			<h1 class="hon-mem--page__name">
				<?php the_title(); ?>
			</h1>
			<?php the_content(); ?>
		</section>

	</main>

<?php
	endwhile; endif;
	get_footer();
?>
