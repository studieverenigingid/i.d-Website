<article class="news-item">
	<a class="news-item__link" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('thumb--news', array( 'class' => 'news-item__thumb')); ?><?php endif; ?>
		<h3 class="news-item__title"><?php the_title(); ?></h3>
	</a>
	<div class="news-item__meta">
		<?php $parentscategory = "";
			$has_cats = false;
			foreach((get_the_category()) as $category) {
				if ($category->category_parent == 0) {
					$cat_link = get_category_link($category->cat_ID);
					$cat_name = $category->name;
					$parentscategory .= ' <a ' .
						'href="' . $cat_link . '"' .
						' class="news-item__category"' .
						' title="' . $cat_name . '">' .
						$cat_name . '</a>, ';
					$has_cats = true;
				}
			}
			if ($has_cats) echo substr($parentscategory,0,-2) . ' | '; ?>
	<?php echo get_the_date(); ?>
	</div>
	<?php the_excerpt(); ?>
</article>
