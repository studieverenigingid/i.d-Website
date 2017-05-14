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
		<h2 class="contact-page__subtitle">I have a question</h2>
		<div class="contact-page__block">
			<h3>How do I change my address?</h3>
			<p>If you'd like to change your address (or other contact info), please send our secretary an e-mail. Or do it yourself in our fancy new member area.</p>
			<a class="contact-page__info__button button button--mail" href="mailto:svid@tudelft.nl"><i class="fa fa-envelope"></i> svid@tudelft.nl</a>
		</div>
		<div class="contact-page__block">
			<h3>Can I add a vacancy to your website?</h3>
			<p>If you'd like your vacancy to be on our vacancy page, send our commissioner of external affairs an e-mail, if you prefer to call, that's fine as well.</p>
			<a class="contact-page__info__button button button--mail" href="mailto:extern-svid@tudelft.nl"><i class="fa fa-envelope"></i> extern-svid@tudelft.nl</a>
			<a class="contact-page__info__button button button--call" href="tel:+31(0)152783012"><i class="fa fa-envelope"></i> +31 (0)15 278 3012</a>
		</div>
		<div class="contact-page__block">
			<h3>Where do I send feedback about education?</h3>
			<p>If you have any feedback on education at IDE, be sure to check out the <a href="/education">education</a> page. You can send an e-mail with any questions as well.</p>
			<a class="contact-page__info__button button button--mail" href="mailto:bachelor-svid@tudelft.nl"><i class="fa fa-envelope"></i> bachelor-svid@tudelft.nl</a>
			<a class="contact-page__info__button button button--mail" href="mailto:master-svid@tudelft.nl"><i class="fa fa-envelope"></i> master-svid@tudelft.nl</a>
		</div>
		<div class="contact-page__block">
			<h3>I have another question.</h3>
			<p>If you have any other questions, there's plenty of ways to reach us.</p>
			<a class="contact-page__info__button button button--mail" href="mailto:svid@tudelft.nl"><i class="fa fa-envelope"></i> svid@tudelft.nl</a>
			<a class="contact-page__info__button button button--call" href="tel:+31(0)152783012"><i class="fa fa-envelope"></i> +31 (0)15 278 3012</a>
			<a class="contact-page__info__button button button--messenger" target="blank" href="https://m.me/studieverenigingi.d"><i class="fa fa-comment"></i> /studieverenigingi.d</a>
		</div>
</section>

<section class="contact-page__container">
	<h2 class="contact-page__subtitle">I want to stalk you on social media</h2>
	<div class="contact-page__block">
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

<section class="contact-page__container">
	<h2 class="contact-page__subtitle">Opening Hours</h2>
	<div class="contact-page__block">
		<p>Study association i.d is opened on:</p>
		<ul>
			<li>Monday: 9:00 - 17:00</li>
			<li>Tuesday: 9:00 - 17:00</li>
			<li>Wednesday: 12:30 - 17:00</li>
			<li>Thursday: 9:00 - 17:00</li>
			<li>Friday: 9:00 - 17:00</li>
		</ul>
	</div>

	<h2 class="contact-page__subtitle">Other information</h2>
	<div class="contact-page__block">
		<ul>
			<li>KVK: Haaglanden V 40397069</li>
			<li>BTW: NL 8058.24.352 B01</li>
			<li>IBAN: NL 08 RABO 0319423239</li>
			<li>RABONL2U</li>
		</ul>
	</div>
</section>

<?php get_footer(); ?>
