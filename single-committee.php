<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header class="news-item__header"
		style="background-color: <?php theme_color(false); ?>;">

		<div class="news-item__meta--large">
			<a class="all-committees-link"
				href="<?php echo get_post_type_archive_link( 'committee' ); ?>">
				<?php echo esc_attr_x('View all committees', 'View all committees button text', 'svid-theme-domain'); ?>
			</a>
		</div>

		<h1 class="news-item__title--large"><?php the_title(); ?></h1>

		<div class="news-item__meta--large">
			<?php
				$groups = get_the_terms($post, 'committee-group');
				if ($groups) {
					foreach ($groups as $key => $group) {
						$grp_link = get_term_link($group->term_id);
						$grp_name = $group->name;
						echo "<a href='$grp_link' class='news-item__category'>$grp_name</a>";
						if ($key+1 < count($groups)) echo ', ';
					}
				}
			?>
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
