<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header class="news-item__header">

		<h1 class="news-item__title--large"><?php the_field('issue_number'); echo " | "; the_title(); ?></h1>

		<div class="news-item__meta--large">
			<?php $parentscategory = "";
				$has_cats = false;
				foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
						$cat_link = get_category_link($category->cat_ID);
						$cat_name = $category->name;
						$parentscategory .= ' <a ' .
							'href="' . $cat_link . '"' .
							'class="news-item__category"' .
							'title="' . $cat_name . '">' .
							$cat_name . '</a>, ';
						$has_cats = true;
					}
				}
				if ($has_cats) echo substr($parentscategory,0,-2) . ' | '; ?>
 			<?php echo get_the_date(); ?>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('post-thumbnail',
				array( 'class' => 'news-item__thumb--large')
			); ?>
		<?php endif; ?>

	</header>

	<main class="primary-content news--page__content">
		<?php the_content(); ?>

    <h2>Read Online</h2>
    <?php
      if ( is_user_logged_in() ) {
        if( get_field('issuu_full_embed') ):
          the_field('issuu_full_embed');
        endif;
      } else {
        the_field('issuu_preview_embed');
      }
    ?>
	</main>

<?php
	endwhile; endif;
	get_footer();
?>
