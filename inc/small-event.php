<article class="event--small"
	<?php if (isset($order_override))
	 	echo $order_override; ?>>
		<a href="<?php the_permalink(); ?>" class="event--small__anchor" >
			<h3 class="event--small__name"><?php the_title(); ?></h3>
		</a>
		<p class="event--small__datetime">

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$end = new DateTime(get_field('end_datetime'));

				$event_duration = $start->diff($end);

				if ($event_duration->days > 0) {
					$start_to_end = $start->format('F jS') . $end->format(' – F jS');
				} else {
					$start_to_end = $start->format('F jS, H:i') . $end->format(' – H:i');
				}

				echo $start_to_end;
			?>

		</p>

</article>
