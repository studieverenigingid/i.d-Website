<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header id="site-content" class="ttp-issue__header">

		<h1 class="ttp-issue__title--large"><?php the_field('issue_number'); echo " | "; the_title(); ?></h1>

		<div class="ttp-issue__meta--large">
			<?php $parentscategory = "";
				$has_cats = false;
				foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
						$cat_link = get_category_link($category->cat_ID);
						$cat_name = $category->name;
						$parentscategory .= ' <a ' .
							'href="' . $cat_link . '"' .
							'class="ttp-issue__category"' .
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
				array( 'class' => 'ttp-issue__thumb--large')
			); ?>
		<?php endif; ?>

	</header>

	<main class="primary-content news--page__content">
		<?php the_content(); ?>

    <h2><?php echo esc_attr_x('Read Online', 'Read TTP online title', 'svid-theme-domain');?></h2>
    <?php
      if ( is_user_logged_in() ) {
        if( get_field('issuu_full_embed') ):
					echo "<p>".esc_attr_x('You\'re a member, you can read the full magazine!', 'Read full TTP text', 'svid-theme-domain')."</p>";
          the_field('issuu_full_embed');
        endif;
      } else {
				echo "<p>".esc_attr_x('Note: this is a preview', 'Read preview TTP text', 'svid-theme-domain')."</p>";
        the_field('issuu_preview_embed');
      }
    ?>
	</main>

<?php
	endwhile; endif;
	get_footer();
?>
