<?php get_header(); ?>





<section class="events">

<?php $today = date('Ymd');

$upcoming_loop = new WP_Query( array(
  'post_type' => 'event',
  'posts_per_page' => 4,
  'meta_query' => array(
	array(
	  'key'     => 'start_datetime',
	  'compare' => '>=',
	  'value'   => $today,
	  'type'    => 'DATE'
	),
  ),
  'orderby' => 'start_datetime',
  'order' => 'ASC',
) );
if ($upcoming_loop->have_posts()) :
	$upcoming_no = 0; ?>

	<?php while($upcoming_loop->have_posts()) : $upcoming_loop->the_post();
		if($upcoming_no === 0): ?>

		<article class="event--page__header">
			<a href="<?php the_permalink(); ?>" class="event--page__link">
		<div class="event--page__short-info">
		  <span class="event--page__indication">Up next</span>
		  <h2 class="event--page__name"><?php the_title(); ?></h2>
		  <?php
					$start = new DateTime(get_field('start_datetime'));
					$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );

					$end = new DateTime(get_field('end_datetime'));
					$end->setTimezone( new DateTimeZone('Europe/Amsterdam') );

					$month = $start->format('F');
					$day   = $start->format('jS');

					$start_time = $start->format('H:i');
					$end_time   = $end->format('H:i');

					$location_name = get_field('location_name');
				?>
				<div class="event--page__datetime">
					<?php
						echo $month . ' ' . $day . ', ';
						echo $start_time . ' – ' . $end_time;
						echo ($location_name) ? ' @ ' . $location_name : '';
					?>
				</div>

		  <?php if ( has_post_thumbnail() ) : ?>
					<div class="event--page__thumb">
						<?php
						the_post_thumbnail(
							'large',
							array('class' => 'event--page__img')
						);
						?>
					</div>
				<?php endif; ?>
		</div>
			</a>
		</article>

	<div class="events--small">
	<?php else:

	  if($upcoming_no === 1) { ?>

		<article class="event--small">
		  <h2 class="events--small__series-title">Upcoming events</h2>
		</article>

	  <?php }

	  include( 'inc/small-event.php' );

		endif;
		$upcoming_no++;
		endwhile; endif; ?>

	</div>

	<hr class="events--divider">

	<div class="events--small">
	  <?php
		wp_reset_postdata();
		$past_loop = new WP_Query( array(
		  'post_type' => 'event',
		  'posts_per_page' => 3,
		  'meta_query' => array(
			array(
			  'key'     => 'start_datetime',
			  'compare' => '<',
			  'value'   => $today,
			  'type'    => 'DATE'
			),
		  ),
		  'orderby' => 'start_datetime',
		  'order' => 'DESC',
		) );
		if ($past_loop->have_posts()) : ?>
		<div class="event--small event--small--end">
		  <h2 class="events--small__series-title">Past events</h2>
		</div>
	<?php
		  while($past_loop->have_posts()) {
			$past_loop->the_post();
			include( 'inc/small-event.php' );
		  } endif; ?>

	</div>
	</section>

<?php wp_reset_postdata(); ?>

<?php
	// filter
	function my_posts_where( $where ) {

		$where = str_replace("meta_key = 'dates_%", "meta_key LIKE 'dates_%", $where);

		return $where;
	}

	add_filter('posts_where', 'my_posts_where');


	// find todays date
	$date = date('Ymd');

	// args
	$args = array(
		'post_type' => 'vacancy',
		'meta_query'	=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'dates_%_start_date',
				'compare'	=> '<=',
				'value'		=> $date,
			),
			array(
				'key'		=> 'dates_%_end_date',
				'compare'	=> '>=',
				'value'		=> $date,
			)
		)
	);

	$vacancy_loop = new WP_Query( $args );
	if($vacancy_loop->have_posts()) : ?>
	<section class="vacancies">
	<?php while($vacancy_loop->have_posts()) : $vacancy_loop->the_post(); ?>

		<?php include 'inc/small-vacancy.php'; ?>

	<?php endwhile; ?>

  <div class="vacancy">
		<a class="vacancy__archivelink"
      href="<?php echo get_post_type_archive_link( 'vacancy' ); ?>">
      All vacancies
    </a>
	</div>

  </section>

  <?php
		endif;

		wp_reset_postdata();
	?>

<h2>Nieuws en blog</h2>
<section class="news">


	<?php
		$args = array( 'post_type' => 'post', 'posts_per_page' => 6 );
		$loop = new WP_Query( $args );
		if(have_posts()) : while($loop->have_posts()) : $loop->the_post(); ?>

	<article class="news-item">
		<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbnail', array( 'class' => 'news-item__thumb')); ?><?php endif; ?>
		<h3 class="news-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="news-item__meta">
			<?php $parentscategory ="";
				foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
						$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
					}
				}
				echo substr($parentscategory,0,-2); ?>
		| <?php echo get_the_date(); ?>
	</div>
		<?php the_excerpt(); ?>
	</article>

	<?php
		endwhile;
		endif;

		wp_reset_postdata();
	?>

</section>


<section class="social">
	<h2>Social Media</h2>

	<div class="social__wrapper">
		<?php include 'inc/social-feed.php'; ?>
	</div>


</section>


<?php get_footer(); ?>
