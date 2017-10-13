<?php
	$fp = get_posts("post_type=turnthepage&numberposts=1");
?>

<?php get_header(); ?>

<main>

	<div class="archive__title__parent"
		style="background-color:<?php the_field("page_color", $fp[0]->ID); ?>;">
		<h1 class="archive__title--turnthepage"><?php post_type_archive_title(); ?></h1>
	</div>

	<div class="turnthepage">

	<?php
		if(have_posts()) : while(have_posts()) :
			the_post();
			include 'inc/small-turnthepage.php';
		endwhile; endif;

		wp_reset_postdata();
	?>

	</div>

</main>

<?php get_footer(); ?>
