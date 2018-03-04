<?php

/**
 * Template Name: i.d-Kafee page
 */

get_header(); ?>

<header class="kafee--page__header
	<?php if ( !has_post_thumbnail() ) echo 'kafee--page__header--short-header'; ?>"
	style="background-color: <?php theme_color(false); ?>;">

	<div class="kafee--page__short-info
		<?php if ( !has_post_thumbnail() ) echo 'kafee--page__short-info--short-header'; ?>"
		style="background-color: <?php theme_color(false); ?>;">

		<h1 class="kafee--page__name"><?php the_title(); ?></h1>

		<?php
		    // TO SHOW THE PAGE CONTENTS
		    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
		        <div class="kafee--page__kafee">
		            <?php the_content(); ?> <!-- Page Content -->
		        </div><!-- .entry-content-page -->

		    <?php
		    endwhile; //resetting the page loop
		    wp_reset_query(); //resetting the page query
		?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="kafee--page__thumb">
				<?php
				the_post_thumbnail(
					'large',
					array('class' => 'kafee--page__img')
				);
				?>
			</div>
		<?php endif; ?>

	</div>

</header>

<?php

if( have_rows('kafee_content_blocks') ):

 	// loop through the rows of data
    while ( have_rows('kafee_content_blocks') ) : the_row(); ?>
			<section class="kafee--page__container">
				<h2 class="kafee--page__blocktitle">
					<?php the_sub_field('kafee_content_title'); ?>
				</h2>
				<p>
					<?php the_sub_field('kafee_content_info'); ?>
				</p>
			</section>

    <?php endwhile;

else :
	echo "no content found";
endif;

?>

<section class="kafee--page__container">
	<h2 class="kafee--page__blocktitle">
		<?= esc_attr_e('Reserve i.d-Kafee', 'svid-theme-domain'); ?>
	</h2>
	<p>
		If you want to reserve i.d-Kafee for your event, you can do so here. Please do note that this is a request, which has to be approved first.
	</p>
	<form action="#" class="reserve-kafee__wrap" id="reserve-kafee-form">
		<?php
		if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$current_email = $current_user->user_email;
		} else {
			$current_email = '';
		}
		?>

		<label for="event-name" class="reserve-kafee__label">
			<?= esc_attr_x('What do you want to reserve i.d-Kafee for?', 'reserve-kafee-eventname-label', 'svid-theme-domain')?>
		</label>
		<input type="text" name="event-name" class="reserve-kafee__input-short" required>

		<label for="email" class="reserve-kafee__label">
			<?= esc_attr_x('What is your email address?', 'reserve-kafee-email-label', 'svid-theme-domain')?>
		</label>
		<input type="email" name="email" class="reserve-kafee__input-short"
		placeholder="<?= esc_attr_x('jamie@doe.com', 'reserve-kafee-email-placeholder', 'svid-theme-domain') ?>"
		value="<?=$current_email?>" required>

		<p class="reserve-kafee__label"><?= esc_attr_x('When do you want to use i.d-Kafee?', 'reserve-kafee-datetime-label', 'svid-theme-domain')?></p>
		<p class="reserve-kafee__small-label"><?= esc_attr_x('i.d-Kafee is available from 15:00 for private events on all weekdays except Wednesday. It closes at 21:00 on Mondays, Tuesdays and Thursdays but closes at 19:00 on Fridays.', 'reserve-kafee-datetime-description', 'svid-theme-domain')?></p>

		<div class="reserve-kafee__input-group">
			<label for="date" class="reserve-kafee__small-label">
				<?= esc_attr_x('Set date', 'reserve-kafee-date-label', 'svid-theme-domain')?>
			</label>
			<input type="date" name="date" class="reserve-kafee__input-date" required>
		</div>

		<div class="reserve-kafee__input-group">
			<label for="starttime" class="reserve-kafee__small-label">
				<?= esc_attr_x('Set start time', 'reserve-kafee-starttime-label', 'svid-theme-domain')?>
			</label>
			<input type="time" name="starttime" class="reserve-kafee__input-date" required>
		</div>

		<div class="reserve-kafee__input-group">
			<label for="endtime" class="reserve-kafee__small-label">
				<?= esc_attr_x('Set end time', 'reserve-kafee-endtime-label', 'svid-theme-domain')?>
			</label>
			<input type="time" name="endtime" class="reserve-kafee__input-date" required>
		</div>

		<label for="attendants" class="reserve-kafee__label">
			<?= esc_attr_x('How many people will attend your event?', 'reserve-kafee-attendants-label', 'svid-theme-domain')?>
		</label>
		<input type="number" min="0" name="attendants" class="reserve-kafee__input-short" required>

		<label for="invoice" class="reserve-kafee__label">
			<?= esc_attr_x('What is your invoice address or BAAN code?', 'reserve-kafee-invoice-label', 'svid-theme-domain')?>
		</label>
		<input type="text" name="invoice" class="reserve-kafee__input-short" required>

		<label for="drinks-on-account" class="reserve-kafee__label reserve-kafee__label--toggle">
			<?= esc_attr_x('Will you pay for consumptions?', 'reserve-kafee-paidfor-label', 'svid-theme-domain')?>
		</label>
		<input type="checkbox" name="drinks-on-account" class="reserve-kafee__toggle-button">

		<label for="consumptions" class="reserve-kafee__label reserve-kafee__label--toggle">
			<?= esc_attr_x('Do you want to make use of the \'Study association i.d consumptions service\'&trade;?', 'reserve-kafee-consumptions-label', 'svid-theme-domain')?>
		</label>
		<input type="checkbox" name="consumptions" class="reserve-kafee__toggle-button">



		<div class="reserve-kafee__validate-and-send">

			<input type="hidden" name="action" value="reserve_kafee_input">

			<div class="g-recaptcha"
				data-sitekey="6Ld7pCUUAAAAAFY2ezdhFaWW25L_c254ali_Hpsg">
		</div>

		<button type="submit" class="button kafee__submit">
			<?= esc_attr_x('Send Reservation Request', 'reserve-kafee-form-button', 'svid-theme-domain')?>
		</button>

	</form>
</section>

<?php get_footer(); ?>
