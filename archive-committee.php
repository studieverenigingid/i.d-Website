<?php get_header(); ?>

<main>

	<h1 class="archive__title"><?php echo esc_attr_x('Our committees', 'archive title'); ?></h1>

	<div class="committees__grid">

	<?php
		if(have_posts()) : while(have_posts()) :
			the_post();
			$groups = get_the_terms($post, 'committee-group');
			$group_class = 'comm-group';
			if ($groups) $group_class .= ' comm-group--' . $groups[0]->slug;
			include 'inc/small-committee.php';
		endwhile; endif;

		wp_reset_postdata();
	?>

	</div>

</main>

<?php get_footer(); ?>
