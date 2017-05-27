<?php get_header(); ?>

<main>

	<h1 class="archive__title"><?php post_type_archive_title(); ?></h1>

	<div class="news">

	<?php
		$loop = new WP_Query( $args );
		if(have_posts()) : while(have_posts()) :
			the_post();
			include 'inc/small-turnthepage.php';
		endwhile; endif;

		wp_reset_postdata();
	?>

	</div>

</main>

<?php include 'inc/pagination.php'; ?>

<?php get_footer(); ?>
