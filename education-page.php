<?php
/*
Template Name: Education Page
*/
get_header();
?>


    <header class="event--page__header
		<?php if ( !has_post_thumbnail() ) echo 'event--page__header--no-thumb'; ?>">

        <div class="event--page__short-info
			<?php if ( !has_post_thumbnail() ) echo 'event--page__short-info--no-thumb'; ?>">

            <h1 class="event--page__name"><?php the_title(); ?></h1>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="event--page__thumb event--page__thumb--education">
                    <form action="#" class="education-feedback">
                        <div class="education-feedback__wrap">
                            <h2><?= esc_attr_x('Feedback', 'feedback-form-title')?></h2>
                            <div class="education-feedback__message education-feedback__message--success">
                                <?= esc_attr_x('Je feedback is verzonden, bedankt!', 'feedback-form-message')?>
                            </div>
                            <div class="education-feedback__message education-feedback__message--failed">
                                <?= esc_attr_x('Je feedback is niet verzonden, er ging iets fout!', 'feedback-form-message')?>
                            </div>
                            <textarea name="feedback" id="" cols="30" rows="15" placeholder="<?= esc_attr_x('Wat is je feedback?', 'feedback-form-placeholder')?>" required></textarea>
                            <button type="submit"><?= esc_attr_x('Stuur feedback', 'feedback-form-button')?></button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

        </div>

    </header>


    <section class="education-process">
        <h2><?= esc_attr_x('Wat doen we met je feedback?', 'education-what-we-do-with-it')?></h2>

        <div class="education-process__item-wrap">
            <div class="education-process__item" style="background-image: url('<?= get_field( "feedback_steps_1" ); ?>')">
            </div>
        </div>
        <div class="education-process__item-wrap">
            <div class="education-process__item" style="background-image: url('<?= get_field( "feedback_steps_2" ); ?>')">
            </div>
        </div>
        <div class="education-process__item-wrap">
            <div class="education-process__item" style="background-image: url('<?= get_field( "feedback_steps_3" ); ?>')">
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
                <?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbnail', array( 'class' => 'news-item__thumb')); ?><?php endif; ?>
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

        <img src="<?=$img_folder?>whoarewe.jpg" alt="A demo image">

        <div class="education-about__description">
            Lorem Khaled Ipsum is a major key to success. A major key, never panic. Don’t panic, when it gets crazy and rough, don’t panic, stay calm. Congratulations, you played yourself.
        </div>

    </section>



<?php
get_footer();
?>