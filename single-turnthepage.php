<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header class="ttp-issue__header" style="background-color:<?php the_field('issue_background_color');?>;">

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

    <h2>Read Online</h2>
    <?php
      if ( is_user_logged_in() ) {
        if( get_field('issuu_full_embed') ):
					echo "<p>You're a member, you can read the full magazine!</p>";
          the_field('issuu_full_embed');
        endif;
      } else {
				echo "<p>Note: This is a preview.</p>";
        the_field('issuu_preview_embed');
      }
    ?>
	</main>

<?php
	endwhile; endif;
	get_footer();
?>
