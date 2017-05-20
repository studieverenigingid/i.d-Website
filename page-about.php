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



<section class="committees">

	<h2 class="about__sub-title">Our committees</h2>

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
				'posts_per_page' => 30,
				'tax_query' => array(
        	array(
            'taxonomy' => 'committee-group',
            'field' => 'slug',
            'terms' => array($group->slug)
        	)
    		)
			);

			$group_class = 'committee--'.$group->slug;
			$group_name = $group->name;

			$loop = new WP_Query( $args );
	    if($loop->have_posts()) : ?>

			<article class="committee committee--group <?=$group_class?>">
				<h3 class="committee--group__name"><?=$group_name?></h3>
			</article>

				<?php while($loop->have_posts()) : $loop->the_post(); ?>
					<article class="committee">
						<h4 class="committee__name"><?php the_title(); ?></h4>
					</article>
				<?php
					endwhile; endif;
					wp_reset_postdata();
				?>
		<?php } ?>

	</div>

</section>



<section class="hon-mems"></section>



<section class="master-coms"></section>



<?php get_footer(); ?>
