<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header class="news-item__header">

		<h1 class="news-item__title--large"><?php the_title(); ?></h1>

		<div class="news-item__meta--large">
			<?php
				$groups = get_the_terms($post, 'committee-group');
				$group_link = get_term_link($groups[0]->term_id);
				$group_name = $groups[0]->name;
			?>
			<a href="<?=$group_link?>" class="news-item__category">
				<?=$group_name?>
			</a>
		</div>

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
