<?php
/*
Template Name: Education Page
*/
 get_header();
?>

<section class="education-hero fix-me">

    <?php if ( has_post_thumbnail() ) :
        the_post_thumbnail('post-thumbnail',
            array('class' => 'education-hero__image')
        );
    endif; ?>

    <h2><?= the_title(); ?></h2>

    <form action="#" class="education-feedback">
        <h2><?= esc_attr_x('Feedback', 'feedback-form-title')?></h2>
        <div class="education-feedback__wrap">
            <div class="education-feedback__message education-feedback__message--success">
                <?= esc_attr_x('Je feedback is verzonden, bedankt!', 'feedback-form-message')?>
            </div>
            <div class="education-feedback__message education-feedback__message--failed">
                <?= esc_attr_x('Je feedback is niet verzonden, er ging iets fout!', 'feedback-form-message')?>
            </div>
            <textarea name="feedback" id="" cols="30" rows="20" placeholder="<?= esc_attr_x('Wat is je feedback?', 'feedback-form-placeholder')?>" required></textarea>
            <button type="submit"><?= esc_attr_x('Stuur feedback', 'feedback-form-button')?></button>
        </div>
    </form>
</section>


<section class="education-process">
    <h2><?= esc_attr_x('Wat doen we met je feedback?', 'education-what-we-do-with-it')?></h2>

    <div class="education-process__item-wrap">
        <div class="education-process__item">
            Content
        </div>
    </div>
    <div class="education-process__item-wrap">
        <div class="education-process__item">
            Content
        </div>
    </div>
    <div class="education-process__item-wrap">
        <div class="education-process__item">
            Content
        </div>
    </div>
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