<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<header class="event--page__header">

		<div class="event--page__short-info">

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$end = new DateTime(get_field('end_datetime'));
				$end->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$month = $start->format('M');
				$day   = $start->format('j');
			?>
			<div class="date-block">
				<?php
					echo '<div class="date-block__month">' . $month . '</div>';
					echo '<div class="date-block__day">' . $day . '</div>';
				?>
			</div>

			<h1 class="event--page__name"><?php the_title(); ?></h1>

			<?php
				$start_time = $start->format('H:i');
				$end_time   = $end->format('H:i');
			?>
			<div class="event--page__time time-block">
				<?php
					echo $start_time . " – " . $end_time;
				?>
			</div>

			<div class="event--page__thumb">
				<?php if ( has_post_thumbnail() ) :
					the_post_thumbnail(
						'large',
						array('class' => 'event--page__img')
					);
				endif; ?>
			</div>

		</div>

	</header>



	<?php the_content(); ?>



<?php endwhile; endif; ?>

<?php get_footer(); ?>
