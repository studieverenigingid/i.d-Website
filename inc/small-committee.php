<article class="committee <?=$group_class?>" data-visible="<?=$group_count?>">
	<a class="committee__link"
		href="<?php the_permalink(); ?>">
		<div class="committee__thumb <?=$group_class_styling?>"
			style="background-image: url(<?=the_post_thumbnail_url('medium')?>)">
		</div>
		<h4 class="committee__name"><?php the_title(); ?></h4>
	</a>
	<?php the_excerpt(); ?>
</article>
