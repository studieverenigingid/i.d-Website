<?php
  get_header();
?> 

<section class="news">
	<h1>Nieuws en blog</h1>

	<?php
	  if(have_posts()) : while(have_posts()) : the_post();
	?>
		
	<article class="news__item">
		<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbnail', array( 'class' => 'news__item__thumb')); ?><?php endif; ?>
		<h2 class="news__item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<h4 class="news__item__meta">
			<?php $parentscategory ="";
				foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
						$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
					}
				}
				echo substr($parentscategory,0,-2); ?>
 		| <?php echo get_the_date(); ?>
		</h4>
		<?php the_excerpt(); ?>
  	</article>
	
	<?php
	  endwhile;
	  endif;
	?>

</section>

<?php
  get_footer();
?>
