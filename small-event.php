<article class="event--small">
	<?php
		the_post_thumbnail(
			'large',
			array('class' => 'event--small__img')
		);
	?>
	<h3><?php the_title(); ?></h3>
	<p><?php the_excerpt(); ?></p>
</article>
