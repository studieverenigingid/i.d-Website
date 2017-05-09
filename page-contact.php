<?php 

/**
 * Template Name: contact page
 */

get_header(); ?>

<h1 class="contact-page__title"><?php the_title(); ?></h1>

<!-- <?php if ( has_post_thumbnail() ) : ?>
		<?php
		the_post_thumbnail(
			'large',
			array('class' => 'contact-page__img')
		);
		?>
<?php endif; ?> -->

<section class="contact-page__container">
		<div class="contact-page__block">
			<h3>Change address?</h3>
			<p>You can call us any time during business hours.</p>
			<a class="contact-page__info__button button button--call" href="tel:+31152783012"><i class="fa fa-phone"></i> Call us</a>
		</div>
		<div class="contact-page__block">
			<h3>Add vacancy?</h3>
			<p>If you'd rather send an e-mail, that's fine too.</p>
			<a class="contact-page__info__button button button--mail" href="mailto:svid@tudelft.nl"><i class="fa fa-envelope"></i> Send e-mail</a>
		</div>
		<div class="contact-page__block">
			<h3>Feedback on education?</h3>
			<p>Send us mail or come over at our facility.</p>
			<p>
				Landbergstraat 15 <br>
				2628CE
			</p>
			<a class="contact-page__info__button button button--maps" target="blank" href="https://www.google.nl/maps/place/Studievereniging+i.d/@52.0019488,4.3678436,17z/data=!3m1!4b1!4m5!3m4!1s0x47c5b5930fa650eb:0xc234015f7f4f3fcf!8m2!3d52.0019455!4d4.3700323"><i class="fa fa-map-marker"></i> Open in Maps</a>
		</div>
		<div class="contact-page__block">
			<h3>Other questions?</h3>
			<p>We're on Facebook messenger, send us a message and we'll get back to you shortly.</p>
			<p>/studieverenigingi.d</p>
			<a class="contact-page__info__button button button--messenger" target="blank" href="https://m.me/studieverenigingi.d"><i class="fa fa-comment"></i> Send message</a>
		</div>

	<!-- <h2>I want to stalk you on social media</h2>
	<div>
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

	<h2>Opening Hours</h2>
	<p>Study association i.d is opened on:</p>
	<ul>
		<li>Monday: 9:00 - 17:00</li>
		<li>Tuesday: 9:00 - 17:00</li>
		<li>Wednesday: 12:30 - 17:00</li>
		<li>Thursday: 9:00 - 17:00</li>
		<li>Friday: 9:00 - 17:00</li>
	</ul>

	<h2>Other information</h2>
	<ul>
		<li>KVK: Haaglanden V 40397069</li>
		<li>BTW: NL 8058.24.352 B01</li>
		<li>IBAN: NL 08 RABO 0319423239</li>
		<li>RABONL2U</li>
	</ul>-->
</section>

<?php get_footer(); ?>