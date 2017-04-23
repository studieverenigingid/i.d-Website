<article class="news-item">
	<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbnail', array( 'class' => 'news-item__thumb')); ?><?php endif; ?>
	<h3 class="news-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<div class="news-item__meta">
		<?php $parentscategory ="";
			foreach((get_the_category()) as $category) {
				if ($category->category_parent == 0) {
					$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
				}
				echo substr($parentscategory,0,-2) . ' | ';
			} ?>
	<?php echo get_the_date(); ?>
	</div>
	<?php the_excerpt(); ?>
</article>
