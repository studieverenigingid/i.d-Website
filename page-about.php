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



<section class="board"></section>



<section class="committees"></section>



<section class="hon-mems"></section>



<?php get_footer(); ?>
