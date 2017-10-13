<article class="ttp-issue" style="background-color:<?php the_field('page_color');?>;">
	<?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large', array( 'class' => 'ttp-issue__thumb')); ?></a><?php endif; ?>
	<div class="ttp-issue__meta">
		<div class="ttp-issue__number"><?php echo esc_attr_x('Issue', 'Turn The Page issue title', 'svid-theme-domain');?> #<?php the_field('issue_number');?></div>
		<h3 class="ttp-issue__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="ttp-issue__excerpt"><?php echo get_the_excerpt(); ?></p>
	</div>
</article>
