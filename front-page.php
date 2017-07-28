<?php get_header(); ?>





<!-- ****** -->
<!-- EVENTS -->
<!-- ****** -->
<section class="events">

<?php

// Create the loop with upcoming events
$today = date('Ymd');
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

// Cycle through the upcoming event loop
if ($upcoming_loop->have_posts()) :
  $upcoming_no = 0;
  while($upcoming_loop->have_posts()) :
    $upcoming_loop->the_post();
    if($upcoming_no === 0) {

      // Render the large event at the top of the page
      include 'inc/frontpage-event.php';

    } else {

      // Render the up to three other upcoming events

      // If it is the first small one, open the container and show title
      if($upcoming_no === 1) { ?>
	      <div class="events--small">
		      <div class="event--small">
		        <h2 class="events--small__series-title">Upcoming events</h2>
		        <h3 class="events--small__series-link"><a href="<?php echo get_post_type_archive_link('event'); ?>">All events</a></h3>
		      </div>
	    <?php } ?>

      <?php include( 'inc/small-event.php' ); ?>

      <?php if($upcoming_no === $upcoming_loop->post_count - 1) { ?>

        </div>
        <hr class="divider">

      <?php }

	  }
		$upcoming_no++;
	endwhile;
endif;
wp_reset_postdata();

// Create the loop with past events
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

// Cycle through the upcoming event loop
if ($past_loop->have_posts()) : ?>

  <div class="events--small">

		<div class="event--small event--small--end">
		  <h2 class="events--small__series-title">Past events</h2>
		  <h3 class="events--small__series-link"><a href="<?php echo get_post_type_archive_link('event'); ?>">All events</a></h3>
		</div>

  	<?php
  		while($past_loop->have_posts()) {
  		  $past_loop->the_post();
  			include( 'inc/small-event.php' );
      }
    ?>
  </div>

<?php endif; ?>

</section>

<?php wp_reset_postdata(); ?>





<!-- ********* -->
<!-- VACANCIES -->
<!-- ********* -->
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
		'posts_per_page' => 2,
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

	<section class="vacancies vacancies--frontpage">

	<h2 class="vacancies__title vacancies__title--frontpage">
	  Looking for a job?
	</h2>

	<?php while($vacancy_loop->have_posts()) : $vacancy_loop->the_post(); ?>

		<?php include 'inc/frontpage-vacancy.php'; ?>

	<?php endwhile; ?>

	<div class="vacancy vacancy--full-width">
		<a class="vacancy__archivelink vacancy__archivelink--frontpage"
		href="<?php echo get_post_type_archive_link( 'vacancy' ); ?>">
		All vacancies
	  </a>
	</div>

  </section>

  <?php else: ?>

  <hr class="divider">

<?php
endif;

wp_reset_postdata();
?>





<!-- ****** -->
<!-- SOCIAL -->
<!-- ****** -->
<section class="social">
	<h2 class="section__title">Social Media</h2>
	<div class="social__wrapper">
    <div class="ajax-load">
      <div class="ajax-load__strip"></div>
      <div class="ajax-load__strip"></div>
      <div class="ajax-load__strip"></div>
    </div>
	</div>
</section>





<!-- **** -->
<!-- BLOG -->
<!-- **** -->
<section class="news">
  <h2 class="section__title news__section-title">News and blog</h2>
  <h3 class="news__archive-link">
    <a href="<?php echo get_post_type_archive_link('post'); ?>">
      <?php echo esc_attr_x('All news items and blog posts', 'Link to blog on homepage'); ?> →
    </a>
  </h3>
	<?php
		$args = array( 'post_type' => 'post', 'posts_per_page' => 3 );
		$loop = new WP_Query( $args );
	if($loop->have_posts()) : while($loop->have_posts()) :
			$loop->the_post();
			include 'inc/small-news-item.php';
		endwhile; endif;
		wp_reset_postdata();
	?>
</section>



<?php get_footer(); ?>
