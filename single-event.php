<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<header class="event--page__header">

		<div class="event--page__short-info">

			<h1 class="event--page__name"><?php the_title(); ?></h1>

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$end = new DateTime(get_field('end_datetime'));
				$end->setTimezone( new DateTimeZone('Europe/Amsterdam') );

				$month = $start->format('F');
				$day   = $start->format('jS');

				$start_time = $start->format('H:i');
				$end_time   = $end->format('H:i');
			?>
			<div class="event--page__datetime">
				<?php
					echo $month . ' ' . $day . ', ';
					echo $start_time . ' – ' . $end_time;
				?>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="event--page__thumb">
					<?php
					the_post_thumbnail(
						'large',
						array('class' => 'event--page__img')
					);
					?>
				</div>
			<?php endif; ?>

		</div>

	</header>



	<main class="primary-content event--page__content">

		<?php the_content(); ?>

	</main>



<?php endwhile; endif; ?>

<?php get_footer(); ?>
