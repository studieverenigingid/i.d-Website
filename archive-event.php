<?php get_header(); ?>

<main>

	<h1 class="archive__title"><?php echo esc_attr_x( 'Events', 'archive title' ); ?></h1>

	<div class="events--small">
		<?php
			$current_date = new DateTime();
			$current_date->setTimezone( new DateTimeZone('Europe/Amsterdam') );
			$post_no = 0;
		?>
		<?php while(have_posts()) : the_post(); ?>

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$start->setTimezone( new DateTimeZone('Europe/Amsterdam') );
			?>
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
