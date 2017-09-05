<?php get_header(); ?>

<main>

	<h1 class="archive__title"><?php echo esc_attr_x( 'Events', 'archive title', 'svid-theme-domain'); ?></h1>

	<div class="events">

		<h2 class="events__archive-title" style="order: -100;">
			<?php echo esc_attr_x( 'Upcoming events', 'archive', 'svid-theme-domain'); ?>
		</h2>

		<?php
			$current_date = new DateTime();
			$current_date->setTimezone( new DateTimeZone('Europe/Amsterdam') );
			$first_past = true;
			$post_no = 0;
		?>

		<?php while(have_posts()) : the_post(); ?>

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );
				if ($start < $current_date && $first_past):
					$first_past = false;
			?>
				<h2 class="events__archive-title">
					<?php echo esc_attr_x( 'Past events', 'archive', 'svid-theme-domain'); ?>
				</h2>
			<?php endif; ?>

			<?php
				// Add a order to upcoming events to sort them reverse from how we got them
				if ($start > $current_date) {
					$order_override = "style='order: -$post_no'";
					$post_no++;
				} else {
					$order_override = '';
				}
			?>

			<?php include( 'inc/small-event.php' ); ?>

		<?php endwhile; ?>
	</div>

</main>

<?php include 'inc/pagination.php'; ?>

<?php get_footer(); ?>
