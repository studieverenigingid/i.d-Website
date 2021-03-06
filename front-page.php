<?php get_header(); ?>





<?php
  $in_memoriam_title = get_theme_mod('in_memoriam_title');
  $in_memoriam_body = get_theme_mod('in_memoriam_body');
  $in_memoriam_photo = get_theme_mod('in_memoriam_photo');
  $in_memoriam = !empty($in_memoriam_title)
    && !empty($in_memoriam_body);
  if ($in_memoriam): ?>
  <!-- *********** -->
  <!-- IN MEMORIAM -->
  <!-- *********** -->
  <section id="site-content" class="in-memoriam">
    <div class="in-memoriam__flex">

      <a class="in-memoriam__link" href="#continue">
        <?php echo esc_attr_x( 'Continue to website', 'in memoriam continue link', 'svid-theme-domain' ) ?>
      </a>

      <?php if (!empty($in_memoriam_photo)) { ?>
        <img class="in-memoriam__photo"
          src="<?php echo $in_memoriam_photo; ?>"
          alt="<?php echo $in_memoriam_title; ?>">
      <?php } ?>

      <div class="in-memoriam__text">
        <h1 class="in-memoriam__title"><?php echo $in_memoriam_title; ?></h1>
        <p class="in-memoriam__body"><?php echo $in_memoriam_body; ?></p>
      </div>

    </div>
  </section>
<?php endif; ?>





<!-- ****** -->
<!-- EVENTS -->
<!-- ****** -->
<section class="events--frontpage"
  <?php if (!$in_memoriam) echo 'id="site-content"'; ?>>

<?php

// Create the loop with upcoming events
$today = date('Ymd');
$upcoming_loop = new WP_Query( array(
  'post_type' => 'event',
  'posts_per_page' => 4,
  'meta_query' => array(
	array(
	  'key'     => 'end_datetime',
	  'compare' => '>=',
	  'value'   => $today,
	  'type'    => 'DATE'
	),
  ),
  'orderby' => 'meta_value',
  'meta_key' => 'start_datetime',
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
	      <div class="events events-one-row">
		      <div class="event--small">
		        <h2 class="events__series-title">
              <?php echo esc_attr_x( 'Upcoming events', 'frontpage list title', 'svid-theme-domain'); ?>
            </h2>
		        <h3 class="events__series-link">
              <a href="<?php echo get_post_type_archive_link('event'); ?>">
                <?php echo esc_attr_x( 'All events', 'frontpage list', 'svid-theme-domain'); ?>
              </a>
            </h3>
		      </div>
	    <?php } ?>

      <?php include( 'inc/small-event.php' ); ?>

      <?php if($upcoming_no === $upcoming_loop->post_count - 1) { ?>

        <div class="event--small">
          <h3 class="events__series-link events__series-link--mobile-only">
            <a href="<?php echo get_post_type_archive_link('event'); ?>">
              <?php echo esc_attr_x( 'All events', 'frontpage list', 'svid-theme-domain'); ?> →
            </a>
          </h3>
        </div>
        </div>

      <?php }

	  }
		$upcoming_no++;
	endwhile;
endif;
wp_reset_postdata();
?>

</section>





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
	  <?php echo esc_attr_x('Looking for a job?', 'vacancy title', 'svid-theme-domain'); ?>
	</h2>

	<?php while($vacancy_loop->have_posts()) : $vacancy_loop->the_post(); ?>

		<?php include 'inc/frontpage-vacancy.php'; ?>

	<?php endwhile; ?>

	<div class="vacancy vacancy--full-width">
		<a class="vacancy__archivelink vacancy__archivelink--frontpage"
		href="<?php echo get_home_url(null, 'vacancies'); ?>">
		<?php echo esc_attr_x('All vacancies.', 'All vacancy link text', 'svid-theme-domain'); ?>
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
<section class="social" id="js-feed">

	<h2 class="section__title section__title--social">Social Media</h2>

	<div class="social__wrapper">
    <div class="ajax-load">
      <div class="ajax-load__strip"></div>
      <div class="ajax-load__strip"></div>
      <div class="ajax-load__strip"></div>
    </div>
	</div>

  <template id="js-social-post">
    <a class="social__link" target="_blank" rel="noreferrer">
  		<div class="social__container">
  		  <div class="social__title">
  		    <i class="social__ico fab"></i>
          <span class="social__text"></span>
  		  </div>
      </div>
    </a>
  </template>

  <template id="js-more-social">
    <a class="social__link social__link--more">
  		<div class="social__container social__container--more">
        <div class="social__more-button button button--white">
          <?php echo esc_attr_x('More posts', 'frontpage social feed', 'svid-theme-domain'); ?>
        </div>
      </div>
    </a>
  </template>

</section>





<!-- **** -->
<!-- BLOG -->
<!-- **** -->
<section class="news">
  <h2 class="section__title news__section-title"><?php echo esc_attr_x('Updates', 'frontpage news and blog title', 'svid-theme-domain');?></h2>
  <h3 class="news__archive-link">
    <a href="<?php echo get_post_type_archive_link('post'); ?>">
      <?php echo esc_attr_x('All updates', 'Link to blog on homepage', 'svid-theme-domain'); ?> →
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





<!-- ************** -->
<!-- CALL TO ACTION -->
<!-- ************** -->
<section class="call-to-action">
  <header class="call-to-action__head">
    <h2 class="call-to-action__question">What’s up next?</h2>
  </header>

  <div class="call-to-action__group call-to-action__group--social">
    <h3 class="call-to-action__group-name">
      For members
    </h3>
    <ul class="call-to-action__options">
      <li>
        <a href="<?php echo get_post_type_archive_link('committee'); ?>">
          Take a look at our committees
        </a>
      </li>
      <li>
        <a href="<?php echo get_post_type_archive_link('post'); ?>">
          Read the latest news
        </a>
      </li>
      <li>
        <a href="<?php echo get_home_url(null, 'user'); ?>">
          Update your information
        </a>
      </li>
    </ul>
    <a class="button" href="<?php echo get_post_type_archive_link('event'); ?>">
      Join an upcoming event
    </a>
  </div>

  <div class="call-to-action__group call-to-action__group--education">
    <h3 class="call-to-action__group-name">
      For (IDE) students
    </h3>
    <ul class="call-to-action__options">
      <li>
        <a href="<?php echo get_home_url(null, 'about'); ?>">
          Check out who we are
        </a>
      </li>
      <li>
        <a href="<?php echo get_home_url(null, 'career/vacancies'); ?>">
          Find a job or internship
        </a>
      </li>
      <li>
        <a href="<?php echo get_home_url(null, 'education'); ?>">
          Give feedback about IDE education
        </a>
      </li>
    </ul>
    <a class="button" href="<?php echo get_home_url(null, 'contact'); ?>">
      Ask us anything
    </a>
  </div>

  <div class="call-to-action__group call-to-action__group--career">
    <h3 class="call-to-action__group-name">
      For businesses
    </h3>
    <ul class="call-to-action__options">
      <li>
        <a href="<?php echo get_home_url(null, 'career/alumni'); ?>">
          Get to know our alumni
        </a>
      </li>
      <li>
        <a href="<?php echo get_home_url(null, 'career/partner-companies'); ?>">
          Our partners
        </a>
      </li>
      <li>
        <a href="<?php echo get_home_url(null, 'career/vacancies'); ?>">
          Check out our vacancy page
        </a>
      </li>
    </ul>
    <a class="button" href="<?php echo get_home_url(null, 'career/collaborate'); ?>">
      See what we can do for you
    </a>
  </div>

</section>



<?php get_footer(); ?>
