<?php get_header(); ?>





<?php $today = date('Ymd');

$upcoming_loop = new WP_Query( array(
  'post_type' => 'event',
  'posts_per_page' => 4,
  // 'meta_query' => array(
  //   array(
  //     'key'     => 'date',
  //     'compare' => '>=',
  //     'value'   => $today,
  //   ),
  // ),
  // 'orderby' => 'date',
  // 'order' => 'ASC',
) );
if ($upcoming_loop->have_posts()) :
	$upcoming_no = 0; ?>

	<section class="events">

	<?php while($upcoming_loop->have_posts()) : $upcoming_loop->the_post();
		if($upcoming_no === 0): ?>

		<article class="event--large">
			<?php if ( has_post_thumbnail() ) :
				the_post_thumbnail('post-thumbnail', array(
					'class' => 'event--large__thumb'
				));
			endif; ?>
			<h2><?php the_title(); ?></h2>
		</article>

	<?php else:

		 	include( 'small-event.php' );

		endif;
		$upcoming_no++;
		endwhile; ?>

	</section>

<?php endif; wp_reset_postdata(); ?>






<section class="news">
	<h2>Nieuws en blog</h2>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<article class="news__item">
		<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbnail', array( 'class' => 'news__item__thumb')); ?><?php endif; ?>
		<h3 class="news__item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<h4 class="news__item__meta">
			<?php $parentscategory ="";
				foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
						$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
					}
				}
				echo substr($parentscategory,0,-2); ?>
 		| <?php echo get_the_date(); ?>
		</h4>
		<?php the_excerpt(); ?>
  	</article>

	<?php
	  endwhile;
	  endif;
	?>

</section>





<?php get_footer(); ?>
