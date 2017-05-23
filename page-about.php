<?php get_header(); ?>



<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<main class="about__top">
	<h1 class="about__title"><?php the_title(); ?></h1>
	<p class="about__descr"><?php echo get_the_content(); ?></p>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="about__thumb">
			<?php the_post_thumbnail('post-thumbnail',
				array( 'class' => 'about__img')
			); ?>
		</div>
	<?php endif; ?>
</main>
<?php endwhile; endif; ?>



<section class="board">

	<?php
		wp_reset_postdata();
		$args = array( 'post_type' => 'board', 'posts_per_page' => 6 );
		$loop = new WP_Query( $args );
    if($loop->have_posts()) : while($loop->have_posts()) :
			$loop->the_post();?>

		<p class="board__indication">
			<?php echo esc_attr_x('The current board', 'shows above the board title'); ?>
		</p>
		<h2 class="about__sub-title">
			<?php the_title(); ?>
		</h2>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="board__thumb">
				<?php the_post_thumbnail('large',
					array( 'class' => 'board__img')
				); ?>
			</div>

		<?php endif; ?>
	<?php
		endwhile; endif;
		wp_reset_postdata();
	?>

</section>



<hr class="divider">



<section class="committees">

	<h2 class="about__sub-title">Some of our committees</h2>

	<div class="committees__grid">
	<?php
		wp_reset_postdata();

		// Get groups/types of committees
		$groups = get_terms( array(
    	'taxonomy' => 'committee-group',
    	'hide_empty' => true,
		) );

		// Cycle through those types and spawn
		foreach ($groups as $key => $group) {
			$args = array(
				'post_type' => 'committee',
				'posts_per_page' => 1,
				'tax_query' => array(
        	array(
            'taxonomy' => 'committee-group',
            'field' => 'slug',
            'terms' => array($group->slug)
        	)
    		)
			);

			$group_class = 'comm-group--'.$group->slug;
			$group_name = $group->name;

			$loop = new WP_Query( $args );
	    if($loop->have_posts()) : ?>

			<?php while($loop->have_posts()) : $loop->the_post(); ?>
				<article class="committee">
					<div class="committee__thumb <?=$group_class?>"
						style="background-image: url(<?=the_post_thumbnail_url('thumb')?>)"
					></div>
					<h4 class="committee__name"><?php the_title(); ?></h4>
					<?php the_excerpt(); ?>
				</article>
			<?php
				endwhile; endif;
				wp_reset_postdata();
			?>
		<?php } ?>

	</div>

	<a class="button committees__all"
		href="<?php echo get_post_type_archive_link( 'committee' ); ?>">
		View all committees
	</a>

</section>



<hr class="divider">



<section class="master-coms">
	<h2 class="about__sub-title">Our master communities</h2>
</section>



<hr class="divider">



<section class="hon-mems">
	<h2 class="about__sub-title">Our honorary members</h2>
</section>



<?php get_footer(); ?>
