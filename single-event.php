<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<div class="event--page__thumb">
		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail(
				'large',
				array('class' => 'event--page__img')
			);
		endif; ?>
	</div>



	<header class="event--page__date-and-name">

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

	</header>



	<?php
		$start_time = $start->format('H:i');
		$end_time   = $end->format('H:i');
	?>
	<div class="time-block">
		<?php
			echo $start_time . " – " . $end_time;
		?>
	</div>



	<?php the_content(); ?>



<?php endwhile; endif; ?>

<?php get_footer(); ?>
