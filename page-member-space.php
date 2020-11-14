<?php
/**
 * Template Name: Member Space
 */

if (!is_user_logged_in()) {
  login_first_redirect();
} else {
	get_header();
?>

<header id="site-content" class="news-item__header
  <?php if ( !has_post_thumbnail() ) echo 'news-item__header--short-header'; ?>">
  <h1 class="news-item__title--large"><?php the_title(); ?></h1>
</header>

<?php
  comments_template();
	get_footer();
}
?>
