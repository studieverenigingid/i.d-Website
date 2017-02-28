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
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail('post-thumbnail',
            array('class' => 'event--large__thumb')
          );
				endif; ?>
				<h2 class="event--large__name"><?php the_title(); ?></h2>
			</a>
		</article>

    <section class="events--small">
	<?php else:

      include( 'inc/small-event.php' );

		endif;
		$upcoming_no++;
		endwhile; ?>

    </section>
	</section>

<?php endif; wp_reset_postdata(); ?>

<section class="vacancies">
	<?php
		$args = array( 'post_type' => 'vacancy', 'posts_per_page' => 3 );
		$loop = new WP_Query( $args );
		if(have_posts()) : while($loop->have_posts()) : $loop->the_post(); ?>

		<article class="vacancy">

			<div class="vacancy__thumb">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail('thumb--vacancy', array(
						'class' => 'thumb--vacancy')); ?>
				<?php endif; ?>
			</div>

			<div class="vacancy__content">
				<h3 class="vacancy__title">
					<a href="<?php the_permalink(); ?>">
						Vacancy:
						<?php 
							$categories = get_the_category();
	 
							if ( ! empty( $categories ) ) {
							    echo esc_html( $categories[0]->name );   
							}
						?>
					</a>
				</h3>
				<?php the_title(); ?>
			</div>

		</article>

	<?php
		endwhile;
		endif;

		wp_reset_postdata();
	?>

	<div class="vacancy__archivelink">
		<a href=""><h2>All vacancies</h2></a>
	</div>

</section>

<h2>Nieuws en blog</h2>
<section class="news">
	

	<?php
		$args = array( 'post_type' => 'post', 'posts_per_page' => 6 );
		$loop = new WP_Query( $args );
		if(have_posts()) : while($loop->have_posts()) : $loop->the_post(); ?>

	<article class="news-item">
		<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbnail', array( 'class' => 'news-item__thumb')); ?><?php endif; ?>
		<h3 class="news-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<h4 class="news-item__meta">
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

		wp_reset_postdata();
	?>

</section>





<?php get_footer(); ?>
