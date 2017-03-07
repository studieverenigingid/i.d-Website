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

		<article class="event--large">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail('post-thumbnail',
            array('class' => 'event--large__thumb')
          );
				endif; ?>
        <div class="event--large__info">
          <h2 class="event--large__name"><?php the_title(); ?></h2>
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
        </div>
			</a>
		</article>

    <section class="events--small">
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

    </section>

    <section class="events--small">
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
        <article class="event--small event-small--2">
          <h2 class="events--small__series-title">Past events</h2>
        </article>
    <?php
          while($past_loop->have_posts()) {
            $past_loop->the_post();
            include( 'inc/small-event.php' );
          } endif; ?>

    </section>
	</section>

<?php wp_reset_postdata(); ?>

<section class="vacancies">
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
		<a href="<?php echo get_post_type_archive_link( 'vacancy' ); ?>"><h2>All vacancies</h2></a>
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
