<?php

/**
 * Template Name: Member Page
 */
if (!is_user_logged_in()) {
  login_first_redirect();
} else {
	get_header();
?>

<header id="site-content" class="news-item__header
  <?php if ( !has_post_thumbnail() ) echo 'news-item__header--short-header'; ?>">

  <h1 class="news-item__title--large"><?php the_title(); ?></h1>

  <div class="news-item__meta--large">
    <?php if ( is_page() && $post->post_parent ): ?>
      <a href="<?php echo get_permalink($post->post_parent); ?>"
        class="news-item__category">
        <?php echo esc_attr_x( 'Back to the members’ page', 'link under title', 'svid-theme-domain'); ?>
      </a>
    <?php endif; ?>
  </div>

  <?php if ( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail('post-thumbnail',
      array( 'class' => 'news-item__thumb--large')
    ); ?>
  <?php endif; ?>

</header>

<main class="primary-content news--page__content">
  <?php the_content(); ?>
</main>

<?php
// Files
// Check if there are files
if ( have_rows('file_list') ): ?>

<section class="event__files">

  <h2 class="event__section-title">
    <?php echo esc_attr_x('Official documents', 'title above official document list', 'svid-theme-domain'); ?>
  </h2>

  <?php
  // loop through the files
  while ( have_rows('file_list') ) :
    the_row();
    $file = get_sub_field('file');
    if ( get_sub_field('file_name') !== '' ) {
      $file_name = get_sub_field('file_name');
    } else {
      $file_name = $file['name'];
    } ?>
    <a class="event__file" target="_blank"
      href="/download/?id=<?=$file['id']?>">
      <h3 class="event__file-name">
        <i class="fa fa-file-text-o"></i>
        <?=$file_name?>
      </h3>
    </a>
  <?php endwhile;?>

</section>

<?php endif; ?>


<?php
	get_footer();
}
?>
