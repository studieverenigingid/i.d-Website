<?php
/*
Template Name: Education Page
*/

get_header();
?>


<main id="site-content" class="page-top">

	<h1 class="page-top__title">
    <?php the_title(); ?>
  </h1>

	<div class="page-top__descr">
		<?php
			if(have_posts()) : while(have_posts()) :
				the_post();
				the_content();
			endwhile; endif; ?>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="page-top__thumb">
			<?php the_post_thumbnail('post-thumbnail',
				array( 'class' => 'page-top__img')
			); ?>
		</div>
	<?php endif; ?>

</main>



<?php
$args = array( 'post_type' => 'post', 'category_name' => 'education', 'posts_per_page' => 3 );
$loop = new WP_Query( $args );
if($loop->have_posts()) : ?>
  <section class="news education-news" id="education-news">
    <h2><?= esc_attr_x('What is happening in education?', 'education-what-we-did-with-it', 'svid-theme-domain')?></h2>
    <?php while($loop->have_posts()) : $loop->the_post(); ?>

		<?php include('inc/small-news-item.php') ?>

    <?php endwhile; ?>
  </section>
<?php endif; wp_reset_postdata(); ?>



<?php
if( have_rows('feedback_step') ) { ?>
	<div class="form-cols">

		<section class="contact-form" id="feedback-form">
			<h2><?= esc_attr_x('Orange feedback note', 'education-what-we-do-with-it', 'svid-theme-domain')?></h2>

			<form action="#" class="contact-form__wrap">

					<label for="subject" class="contact-form__label">
						<?= esc_attr_x('What course or facility is your feedback about?', 'feedback-form-question', 'svid-theme-domain')?>
					</label>
					<input name="subject" id="subject" type="text" class="contact-form__input-short"
						placeholder="<?= esc_attr_x('‘PO5’ or ‘printers’', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
						required>

					<label for="feedback" class="contact-form__label">
						<?= esc_attr_x('What could be improved? Or what should never change?', 'feedback-form-question', 'svid-theme-domain')?>
					</label>
					<textarea name="feedback" id="feedback" cols="30" rows="12"
						placeholder="<?= esc_attr_x('I love this course because...', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
						class="contact-form__input-message"
						required></textarea>

					<label for="special" class="contact-form__special">
						<?= esc_attr_x('This is for robots', 'feedback-form-question', 'svid-theme-domain')?>
					</label>
					<input name="special" id="special" type="text" class="contact-form__special"
						placeholder="<?= esc_attr_x('silence', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
						value="">

					<div class="contact-form__updater">
						<p class="contact-form__label contact-form__label--right">
							<?= esc_attr_x('Do you want to stay anonymous?', 'feedback-form', 'svid-theme-domain')?>
						</p>
						<input type="checkbox" name="anonymous" value="true"
							class="js-edu-checkbox contact-form__toggle">
						<label for="anonymous"
							class="contact-form__toggle-button js-edu-toggle"></label>
					</div>

					<div class="contact-form__hideble-fields js-edu-hidable-fields">

						<?php
							if (is_user_logged_in()) {
								$current_user = wp_get_current_user();
								$current_name = $current_user->display_name;
								$current_email = $current_user->user_email;
							} else {
								$current_name = '';
								$current_email = '';
							}
						?>

						<label for="name" class="contact-form__label">
							<?= esc_attr_x('What is your name?', 'feedback-form-question', 'svid-theme-domain')?>
						</label>
						<input name="name" id="name" type="text" class="contact-form__input-short"
							placeholder="<?= esc_attr_x('Jamie Doe', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
							value="<?=$current_name?>" required>

						<label for="email" class="contact-form__label">
							<?= esc_attr_x('And your email address?', 'feedback-form-question', 'svid-theme-domain')?>
						</label>
						<input type="email" id="email" name="email" class="contact-form__input-short"
							placeholder="<?= esc_attr_x('jamie@doe.com', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
							value="<?=$current_email?>" required>

					</div>


					<div class="contact-form__validate-and-send">

						<input type="hidden" name="action" value="education_input">

						<button type="submit" class="button button--white contact-form__submit">
							<?= esc_attr_x('Send input', 'feedback-form-button', 'svid-theme-domain')?>
						</button>

					</div>

			</form>
		</section>

		<section class="education-process" id="feedback-process">
	    <h2><?= esc_attr_x('What will we do with your feedback?', 'education-what-we-do-with-it', 'svid-theme-domain')?></h2>
	    <?php while( have_rows('feedback_step') ) {
	      the_row();
	      $img_url = get_sub_field('image')['sizes']['medium']; ?>
	      <div class="education-process__item-wrap">
	        <div class="education-process__item"
	          style="background-image: url('<?= $img_url ?>')">
	        </div>
	        <h3 class="education-process__item-title"><?= get_sub_field('sub_title') ?></h3>
	      </div>
		  <?php } ?>
	  </section>

	</div>
<?php } ?>



  <section class="education-about" id="about-committee">
    <h2><?= esc_attr_x('Who are we?', 'education-who-are-we', 'svid-theme-domain')?></h2>
    <img src="<?= get_field( "commity_photo" )['sizes']['large'] ?>" alt="<?= get_field( "commity_photo" )['url'] ?>">
    <div class="education-about__description">
      <?= get_field( "commity_description" ); ?>
    </div>
  </section>



<?php
get_footer();
?>
