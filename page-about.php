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
		<h2 class="board__title">
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
	<?php
		wp_reset_postdata();
		$args = array( 'post_type' => 'committee', 'posts_per_page' => 30 );
		$loop = new WP_Query( $args );
    if($loop->have_posts()) : ?>

		<h2>Our committees</h2>

		<div class="committees__grid">
			<?php while($loop->have_posts()) : $loop->the_post(); ?>
				<article class="committee">
					<h3 class="committee__name"><?php the_title(); ?></h3>
				</article>
			<?php
				endwhile; endif;
				wp_reset_postdata();
			?>
		</div>

</section>



<section class="hon-mems"></section>



<section class="master-coms"></section>



<?php get_footer(); ?>
