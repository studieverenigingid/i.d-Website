<?php

/**
 * Template Name: contact page
 */

get_header();
wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' ); ?>

<header id="site-content" class="contact--page__header
	<?php if ( !has_post_thumbnail() ) echo 'contact--page__header--short-header'; ?>">

	<div class="contact--page__short-info
		<?php if ( !has_post_thumbnail() ) echo 'contact--page__short-info--short-header'; ?>">

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

<?php if( have_rows('board_members') ): ?>
	<section class="board-members contact--page__container">
		<h2 class="board-members__title contact--page__blocktitle">
			Send one of our board members an email
		</h2>
	</section>
	<section>
		<div class="board-members__cont">
			<?php // loop through the rows of data
	    while ( have_rows('board_members') ) : the_row(); ?>
				<div class="board-members__person">
					<?php
					$image = get_sub_field('photo');
					if( !empty( $image ) ): ?>
					<img src="<?php echo esc_url($image['url']); ?>"
						alt="Portrait photo of <?php the_sub_field('name') ?>"
						class="board-members__profile-pic">
					<?php endif; ?>
					<h3 class="board-members__name">
						<?php the_sub_field('name'); ?>
					</h3>
					<p class="board-members__function">
						<?php the_sub_field('func'); ?></p>
					<p class="board-members__email">
						<a href="mailto:<?php the_sub_field('email'); ?>">
							<?php the_sub_field('email'); ?>
						</a>
					</p>
				</div>
  	<?php endwhile; ?>
			<div class="board-members__spacer">&nbsp;</div>
		</div>
	</section>
<?php endif; ?>

<div class="form-cols">

	<section class="faq">

		<?php

		if( have_rows('contact_page_block') ):

		 	// loop through the rows of data
		    while ( have_rows('contact_page_block') ) : the_row(); ?>
					<article class="contact--page__container">
						<h2 class="contact--page__blocktitle">
							<?php the_sub_field('contact_block_title'); ?>
						</h2>
						<?php the_sub_field('contact_block_content'); ?>
					</article>

		    <?php endwhile;
		endif;

		?>

	</section>

	<section class="contact-form">
		<h2><?= esc_attr_x('Anonymous feedback', '', 'svid-theme-domain')?></h2>

		<form action="#" class="contact-form__wrap">

				<label for="feedback" class="contact-form__label">
					<?= esc_attr_x('We would like to hear what you think about ID as an association and about the current board of ID. Do you have any feedback?', 'feedback-form-question', 'svid-theme-domain')?>
				</label>
				<textarea name="feedback" id="" cols="30" rows="12"
					placeholder="<?= esc_attr_x('I love the study association because...', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
					class="contact-form__input-message"
					required></textarea>

				<fieldset class="contact-form__radioq">
					<legend class="contact-form__question">
						<?= esc_attr_x('What is the feedback about?', 'feedback-form-question', 'svid-theme-domain')?>
					</legend>

					<input id="theboard" name="about" type="radio" class="contact-form__input-radio"
						value="The board">
					<label for="theboard" class="contact-form__option">
						The board
					</label>

					<input id="thestudyassociation" name="about" type="radio" class="contact-form__input-radio"
						value="The study association">
					<label for="thestudyassociation" class="contact-form__option">
						The study association
					</label>
				</fieldset>

			<fieldset class="contact-form__radioq">
				<legend class="contact-form__question">
					<?= esc_attr_x('What is your relation to the study association?', 'feedback-form-question', 'svid-theme-domain')?>
				</legend>

				<input id="amember" name="relation" type="radio" class="contact-form__input-radio"
					value="I’m a member">
				<label for="amember" class="contact-form__option">
					I’m a member
				</label>

				<input id="notamember" name="relation" type="radio" class="contact-form__input-radio"
					value="I’m not a member">
				<label for="notamember" class="contact-form__option">
					I’m not a member
				</label>
			</fieldset>

				<div class="contact-form__validate-and-send">

					<input type="hidden" name="action" value="anonymous_input">

					<div class="g-recaptcha"
						data-sitekey="6Ld7pCUUAAAAAFY2ezdhFaWW25L_c254ali_Hpsg">
					</div>

					<button type="submit" class="button button--white contact-form__submit">
						<?= esc_attr_x('Send input', 'feedback-form-button', 'svid-theme-domain')?>
					</button>

				</div>

				<p class="contact-form__comment">
					<?php $education_link = get_permalink( get_page_by_path( 'education' ) ); ?>
					Are you looking to submit feedback about the education of the faculty of Industrial Design Engineering? Check <a class="contact-form__link" href="<?php echo $education_link; ?>">our education page</a>.
				</p>

		</form>

	</section>

</div>

<?php get_footer(); ?>
