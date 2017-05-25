<article class="committee board--small"
	style="border-color: <?php the_field('board_color'); ?>;">
	<a class="committee__link"
		href="<?php the_permalink(); ?>">
		<div class="committee__thumb"
			style="background-image: url(<?=the_post_thumbnail_url('thumb')?>);
				background-color: <?php the_field('board_color'); ?>;">
		</div>
		<h4 class="committee__name"><?php the_title(); ?></h4>
	</a>
</article>
