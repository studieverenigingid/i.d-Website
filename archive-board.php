<?php get_header(); ?>

<main>

	<h1 class="archive__title" style="background-color:<?php the_field("page_color", $fp[0]->ID); ?>;"><?php echo esc_attr_x('Our boards', 'archive title', 'svid-theme-domain'); ?></h1>

	<div class="committees__grid">

	<?php
		if(have_posts()) : while(have_posts()) :
			the_post();
			include 'inc/small-board.php';
		endwhile; endif;

		wp_reset_postdata();
	?>

	</div>

</main>

<?php get_footer(); ?>
