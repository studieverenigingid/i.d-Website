<?php
/*
Template Name: Education Page
*/

get_header();
wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
?>


<main class="about__top" style="background-color: <?php theme_color(false); ?>">

	<picture>
		<source srcset="<?=$img_folder?>scroll.svg" type="image/svg+xml">
		<img class="scroll-indicator" alt="Study association i.d"
			srcset="<?=$img_folder?>scroll.png 1x,
				<?=$img_folder?>scroll@2x.png 2x"
			src="<?=$img_folder?>scroll.png">
	</picture>

	<p class="education__pre-title"><?php echo esc_attr_x('Do you have something to say about', 'Education intro question', 'svid-theme-domain');?></p>
	<h1 class="education__title">
    <?php the_title(); ?><span class="education__title--light">?</span>
  </h1>
	<div class="education-feedback">
    <div class="education-feedback__message education-feedback__message--success">
      <?= esc_attr_x('Your input was sent, thanks!', 'feedback-form-message', 'svid-theme-domain')?><br>
			<a href="#reset" class="education-feedback__link js-reset-link"><?php echo esc_attr_x('I have even more feedback.', 'More feedback label text', 'svid-theme-domain');?></a>
    </div>

		<form action="#" class="education-feedback__wrap">

        <label for="feedback" class="education__label">
          <?= esc_attr_x('What is it?', 'feedback-form-question', 'svid-theme-domain')?>
        </label>
				<textarea name="feedback" id="" cols="30" rows="12"
          placeholder="<?= esc_attr_x('I love course PO5 because...', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
          style="background-color: <?php theme_color(false); ?>"
          class="education__input-message"
          required></textarea>

        <div class="education__updater">
          <p class="education__label education__label--right">
            <?= esc_attr_x('Do you want to be updated about this input?', 'feedback-form', 'svid-theme-domain')?>
          </p>
          <input type="checkbox" name="update" value="true"
            class="js-edu-checkbox education__toggle">
          <label for="update"
            class="education__toggle-button js-edu-toggle"></label>
        </div>

        <div class="education__hideble-fields js-edu-hidable-fields">

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

          <label for="feedback" class="education__label">
            <?= esc_attr_x('What is your name?', 'feedback-form-question', 'svid-theme-domain')?>
          </label>
  				<input name="name" type="text" class="education__input-short"
            placeholder="<?= esc_attr_x('Jamie Doe', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
						style="background-color: <?php theme_color(false); ?>"
						value="<?=$current_name?>">

          <label for="feedback" class="education__label">
            <?= esc_attr_x('And your email address?', 'feedback-form-question', 'svid-theme-domain')?>
          </label>
  				<input type="email" name="email" class="education__input-short"
            placeholder="<?= esc_attr_x('jamie@doe.com', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
						style="background-color: <?php theme_color(false); ?>"
						value="<?=$current_email?>">

        </div>


        <div class="education__validate-and-send">

          <input type="hidden" name="action" value="education_input">

          <div class="g-recaptcha"
            data-sitekey="6Ld7pCUUAAAAAFY2ezdhFaWW25L_c254ali_Hpsg">
          </div>

          <button type="submit" class="button education__submit">
            <?= esc_attr_x('Send input', 'feedback-form-button', 'svid-theme-domain')?>
          </button>

        </div>

		</form>
	</div>
</main>



<?php
if( have_rows('feedback_step') ) { ?>
  <section class="education-process">
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
<?php } ?>


<?php
$args = array( 'post_type' => 'post', 'category_name' => 'education', 'posts_per_page' => 3 );
$loop = new WP_Query( $args );
if($loop->have_posts()) : ?>
  <section class="news education-news">
    <h2><?= esc_attr_x('What have we done in the past?', 'education-what-we-did-with-it', 'svid-theme-domain')?></h2>
    <?php while($loop->have_posts()) : $loop->the_post(); ?>

		<?php include('inc/small-news-item.php') ?>

    <?php endwhile; ?>
  </section>
<?php endif; wp_reset_postdata(); ?>


  <section class="education-about">
    <h2><?= esc_attr_x('Who are we?', 'education-who-are-we', 'svid-theme-domain')?></h2>
    <img src="<?= get_field( "commity_photo" )['sizes']['large'] ?>" alt="<?= get_field( "commity_photo" )['url'] ?>">
    <div class="education-about__description">
      <?= get_field( "commity_description" ); ?>
    </div>
  </section>



<?php
get_footer();
?>
