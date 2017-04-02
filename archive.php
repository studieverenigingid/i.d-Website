<?php
	get_header();
?>

<main>

	<h1 class="archive__title"><?php echo esc_attr_x( 'News and blog', 'archive title' ); ?></h1>

	<div class="news">

	<?php
		$args = array( 'post_type' => 'post', 'posts_per_page' => 6 );
		$loop = new WP_Query( $args );
		if(have_posts()) : while($loop->have_posts()) : $loop->the_post(); ?>

	<article class="news-item">
		<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbnail', array( 'class' => 'news-item__thumb')); ?><?php endif; ?>
		<h3 class="news-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="news-item__meta">
			<?php $parentscategory ="";
				foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
						$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
					}
				}
				echo substr($parentscategory,0,-2); ?>
 		| <?php echo get_the_date(); ?>
    </div>
		<?php the_excerpt(); ?>
	</article>

	<?php
		endwhile;
		endif;

		wp_reset_postdata();
	?>

	</div>

</main>

<nav class="pagination"><?php
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	) ); ?></nav>

<?php
	get_footer();
?>
