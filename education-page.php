<?php
/*
Template Name: Education Page
*/
 get_header();
?>

<section class="education__hero">

    <?php if ( has_post_thumbnail() ) :
        the_post_thumbnail('post-thumbnail',
            array('class' => 'education__hero-image')
        );
    endif; ?>

    <h2><?= the_title(); ?></h2>

    <form action="#" class="education__feedback">
        <textarea name="feedback" id="" cols="30" rows="20" placeholder="<?= esc_attr_x('Wat is je feedback?', 'feedback-form-placeholder')?>"></textarea>
        <button type="submit"><?= esc_attr_x('Stuur feedback', 'feedback-form-button')?></button>
    </form>
</section>



<?php
 get_footer();
?>