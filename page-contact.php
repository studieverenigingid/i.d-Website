<?php

/**
 * Template Name: contact page
 */

get_header(); ?>

<header class="contact--page__header
	<?php if ( !has_post_thumbnail() ) echo 'contact--page__header--no-thumb'; ?>">

	<div class="contact--page__short-info
		<?php if ( !has_post_thumbnail() ) echo 'contact--page__short-info--no-thumb'; ?>">

		<h1 class="contact--page__name"><?php the_title(); ?></h1>

		<?php
		    // TO SHOW THE PAGE CONTENTS
		    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
		        <div class="contact--page__contact">
		            <?php the_content(); ?> <!-- Page Content -->
		        </div><!-- .entry-content-page -->

		    <?php
		    endwhile; //resetting the page loop
		    wp_reset_query(); //resetting the page query
		?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="contact--page__thumb">
				<?php
				the_post_thumbnail(
					'large',
					array('class' => 'contact--page__img')
				);
				?>
			</div>
		<?php endif; ?>

	</div>

</header>

<section class="contact--page__container">
	<h2 class="contact--page__blocktitle">I want to stalk you on social media</h2>
	<div class="contact--page__block">
		<a href="https://www.instagram.com/studieverenigingid/"
			class="button button--insta">
			<i class="fa fa-instagram"></i> Instagram
		</a>
		<a href="https://www.facebook.com/studieverenigingi.d/"
			class="button button--facebook">
			<i class="fa fa-facebook"></i> Facebook
		</a>
		<a href="https://www.flickr.com/photos/svid/"
			class="button button--flickr">
			<i class="fa fa-flickr"></i> Flickr
		</a>
		<a href="https://vimeo.com/studieverenigingid"
			class="button button--vimeo">
			<i class="fa fa-vimeo"></i> Vimeo
		</a>
	</div>
</section>

<section class="contact--page__container">
	<h2 class="contact--page__blocktitle">Opening Hours</h2>
	<div class="contact--page__block">
		<p>Study association i.d is opened on:</p>
		<ul>
			<li>Monday: 9:00 - 17:00</li>
			<li>Tuesday: 9:00 - 17:00</li>
			<li>Wednesday: 12:30 - 17:00</li>
			<li>Thursday: 9:00 - 17:00</li>
			<li>Friday: 9:00 - 17:00</li>
		</ul>
	</div>
</section>

<section class="contact--page__container">
	<h2 class="contact--page__blocktitle">Other information</h2>
	<div class="contact--page__block">
		<ul>
			<li>KVK: Haaglanden V 40397069</li>
			<li>BTW: NL 8058.24.352 B01</li>
			<li>IBAN: NL 08 RABO 0319423239</li>
			<li>RABONL2U</li>
		</ul>
	</div>
</section>

<?php get_footer(); ?>
