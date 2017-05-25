<article class="event--page__header colorVibrant">
	<a href="<?php the_permalink(); ?>" class="event--page__link">
		<div class="event--page__short-info">

			<span class="event--page__indication">Up next</span>
			<h2 class="event--page__name"><?php the_title(); ?></h2>

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$end = new DateTime(get_field('end_datetime'));
				$end->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$month = $start->format('F');
				$day   = $start->format('jS');

				$start_time = $start->format('H:i');
				$end_time   = $end->format('H:i');

				$location_name = get_field('location_name');
			?>
			<div class="event--page__datetime">
				<?php
					echo $month . ' ' . $day . ', ';
					echo $start_time . ' – ' . $end_time;
					echo ($location_name) ? ' @ ' . $location_name : '';
				?>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
			<div class="event--page__thumb colorVibrantGradient">
				<?php
				the_post_thumbnail(
					'large',
					array('class' => 'event--page__img')
				);
				?>
			</div>
			<?php endif; ?>

		</div>
	</a>
</article>
