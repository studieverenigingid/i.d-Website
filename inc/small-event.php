<article class="event--small">
	<a href="<?php the_permalink(); ?>"
		class="event--small__anchor">
		<?php if (has_post_thumbnail()): ?>
			<div class="event--small__thumb">
				<?php
					the_post_thumbnail(
						'medium',
						array('class' => 'event--small__img')
					); ?>
			</div>
		<?php endif; ?>
		<h3 class="event--small__name"><?php the_title(); ?></h3>
		<p class="event--small__datetime">

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$end = new DateTime(get_field('end_datetime'));
				$end->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$start_to_end = $start->format('F jS, H:i') . $end->format(' – H:i');
				// TODO: make a language adaptive version of this; Dutch needs another
				// date and time representation, like j F, H:i – H:i.

				echo $start_to_end;
			?>

		</p>
	</a>
</article>
