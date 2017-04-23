<?php
	get_header();
?>

<main>

	<h1 class="archive__title"><?php the_archive_title(); ?></h1>

	<div class="news">

	<?php
		$args = array( 'post_type' => 'post', 'posts_per_page' => 6 );
		$loop = new WP_Query( $args );
		if($loop->have_posts()) : while($loop->have_posts()) :
			$loop->the_post();
			include 'inc/small-news-item.php';
		endwhile; endif;

		wp_reset_postdata();
	?>

	</div>

</main>

<?php include 'inc/pagination.php'; ?>

<?php
	get_footer();
?>
