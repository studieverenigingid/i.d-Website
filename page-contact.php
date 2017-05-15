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

		<?php
			// check if the repeater field has rows of data
			if( have_rows('contact_page_block') ):

				// loop through the rows of data
				while ( have_rows('contact_page_block') ) : the_row();

					// display a sub field value ?>
					<div class="contact-page__block">
						<h3><?php the_sub_field('contact_block_title');?></h3>
						<?php the_sub_field('contact_block_content'); ?>

						<?php
							// check if the repeater field has rows of data
							if( have_rows('contact_block_buttons') ):

								// loop through the rows of data
								while ( have_rows('contact_block_buttons') ) : the_row();
									$field_name = "contact_button_type";
									$field = get_sub_field_object($field_name)['value'];

									if($field == "mail"){
										$type = "mail";
										$prefix = "mailto:";
										$fa_class = "envelope";
									} elseif ($field == "call") {
										$type = "call";
										$prefix = "tel:";
										$fa_class = "phone";
									} elseif ($field == "messenger") {
										$type = "messenger";
										$prefix = "https://m.me";
										$fa_class = "comment";
									} else {} ?>

									<a class="contact-page__info__button button button--<?php echo $type; ?>" 
									href="<?php echo $prefix; the_sub_field('contact_button_content'); ?>"><i class="fa fa-<?php echo $fa_class; ?>"></i>
										<?php the_sub_field('contact_button_content');?>
									</a>

								<?php endwhile;

							else :

								// no rows found

							endif;
						?>

					</div>

				<?php endwhile;

			else :

				// no rows found

			endif;

		?>
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
</section>

<section class="contact-page__container">
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
