<?php
/*
Template Name: Education Page
*/

$header_class = 'education__header';

get_header();
?>


<main class="about__top education__header">
	<p class="education__pre-title">Do you have something to say about</p>
	<h1 class="education__title">
    <?php the_title(); ?><span class="education__title--light">?</span>
  </h1>
	<div class="">
		<form action="#" class="education-feedback">
			<div class="education-feedback__wrap">

				<div class="education-feedback__message education-feedback__message--success">
					<?= esc_attr_x('Your input was sent, thanks!', 'feedback-form-message')?>
				</div>
				<div class="education-feedback__message education-feedback__message--failed">
					<?= esc_attr_x('Your feedback wasn’t sent, something went wrong. Please try again!', 'feedback-form-message')?>
				</div>

        <label for="feedback" class="education__label">
          <?= esc_attr_x('What is it?', 'feedback-form-question')?>
        </label>
				<textarea name="feedback" id="" cols="30" rows="12"
          placeholder="<?= esc_attr_x('I love course PO5 because...', 'feedback-form-placeholder') ?>"
          class="education__input-message"
          required></textarea>

        <div class="education__updater">
          <p class="education__label education__label--right">
            <?= esc_attr_x('Do you want to be updates about this input?', 'feedback-form')?>
          </p>
          <input type="checkbox" name="update" value="true"
            class="js-edu-checkbox education__toggle">
          <label for="update"
            class="education__toggle-button js-edu-toggle"></label>
        </div>

        <div class="education__hideble-fields js-edu-hidable-fields">

          <label for="feedback" class="education__label">
            <?= esc_attr_x('What is your name?', 'feedback-form-question')?>
          </label>
  				<input name="name" type="text" class="education__input-short"
            placeholder="<?= esc_attr_x('John Doe', 'feedback-form-placeholder') ?>">

          <label for="feedback" class="education__label">
            <?= esc_attr_x('And your email address?', 'feedback-form-question')?>
          </label>
  				<input type="text" name="email" class="education__input-short"
            placeholder="<?= esc_attr_x('john@doe.com', 'feedback-form-placeholder') ?>">

        </div>

				<button type="submit" class="button education__submit">
          <?= esc_attr_x('Send input', 'feedback-form-button')?>
        </button>

			</div>
		</form>
	</div>
</main>


  <section class="education-process">
    <h2><?= esc_attr_x('Wat doen we met je feedback?', 'education-what-we-do-with-it')?></h2>

    <div class="education-process__item-wrap">
      <div class="education-process__item" style="background-image: url('<?= get_field( "feedback_steps_1" )['sizes']['medium'] ?>')">
      </div>
    </div>
    <div class="education-process__item-wrap">
      <div class="education-process__item" style="background-image: url('<?= get_field( "feedback_steps_2" )['sizes']['medium'] ?>')">
      </div>
    </div>
    <div class="education-process__item-wrap">
      <div class="education-process__item" style="background-image: url('<?= get_field( "feedback_steps_3" )['sizes']['medium'] ?>')">
      </div>
    </div>
  </section>


  <section class="news education-news">

    <h2><?= esc_attr_x('Wat deden we met jullie feedback?', 'education-what-we-did-with-it')?></h2>

    <?php
    $args = array( 'post_type' => 'post', 'category_name' => 'education', 'posts_per_page' => 3 );
    $loop = new WP_Query( $args );
    if(have_posts()) : while($loop->have_posts()) : $loop->the_post(); ?>

      <article class="news-item">
        <?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('medium_large', array( 'class' => 'news-item__thumb')); ?><?php endif; ?>
        <h3 class="news-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <h4 class="news-item__meta">
          <?php $parentscategory ="";
          foreach((get_the_category()) as $category) {
            if ($category->category_parent == 0) {
              $parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
            }
          }
          echo substr($parentscategory,0,-2); ?>
          | <?php echo get_the_date(); ?>
        </h4>
        <?php the_excerpt(); ?>
      </article>

      <?php
    endwhile;
    endif;

    wp_reset_postdata();
    ?>

  </section>

  <section class="education-about">
    <h2><?= esc_attr_x('Wie zijn we?', 'education-who-are-we')?></h2>
    <img src="<?= get_field( "commity_photo" )['sizes']['large'] ?>" alt="<?= get_field( "commity_photo" )['url'] ?>">
    <div class="education-about__description">
      <?= get_field( "commity_description" ); ?>
    </div>
  </section>



<?php
get_footer();
?>
