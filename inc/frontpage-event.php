<article class="event--page__header" style="background:<?php theme_color(false);?>">
	<a href="<?php the_permalink(); ?>" class="event--page__link">
		<div class="event--page__short-info">

			<span class="event--page__indication"><?php echo esc_attr_x('Up next', 'frontpage up next title', 'svid-theme-domain');?></span>
			<h2 class="event--page__name"><?php the_title(); ?></h2>

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$end = new DateTime(get_field('end_datetime'));
				$end->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$start_month = $start->format('F');
				$start_day   = $start->format('jS');

				$end_month = $end->format('F');
				$end_day   = $end->format('jS');

				$start_time = $start->format('H:i');
				$end_time   = $end->format('H:i');

				$event_duration = $start->diff($end);

				$location_name = get_field('location_name');
			?>
			<div class="event--page__datetime">
				<?php
					echo $start_month . ' ' . $start_day;

					if ($event_duration->days === 0) {
						echo ', ' . $start_time;
					}

					echo ' – ';

					if ($start_day != $end_day){
						echo $end_month . ' ' . $end_day;
					} else {
						echo $end_time;
					}
					echo ($location_name) ? ' @ ' . $location_name : '';
				?>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
			<style media="screen">
				.event--page__thumb:before {
					background-image: linear-gradient(
						to bottom right, <?php theme_color(true); ?>,
						transparent 50%
					);
				}
			</style>
			<div class="event--page__thumb event--frontpage__thumb">
				<?php
				the_post_thumbnail(
					'large',
					array('class' => 'event--page__img event--frontpage__img')
				);
				?>
			</div>
			<?php endif; ?>

		</div>
	</a>
</article>
