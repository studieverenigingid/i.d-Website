<article class="event--small">
	<a href="<?php the_permalink(); ?>"
		class="event--small__anchor">
		<?php
			the_post_thumbnail(
				'medium',
				array('class' => 'event--small__thumb')
			);
		?>
		<h3 class="event--small__name"><?php the_title(); ?></h3>
		<p class="event--small__descr"><?php echo get_the_excerpt(); ?></p>
	</a>
</article>
