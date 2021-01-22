<?php get_header(); ?>

<main id="site-content">

	<h1 class="archive__title">
		<?php echo esc_attr_x( 'Events', 'archive title', 'svid-theme-domain'); ?>
	</h1>

	<div class="archive__button">
		<a class="button"
			href="https://studieverenigingid.nl/members/add-id-activities-to-calendar/">
				Add to calendar
			</a>
	</div>

	<div class="events">

		<?php
			$current_date = new DateTime();
			$first_past = true;
			$post_no = 0;
		?>

		<?php while(have_posts()) : the_post(); ?>

			<?php
				$end = new DateTime(get_field('end_datetime'));
				if ($end >= $current_date && $first_past && $post_no === 0):
			?>
				<h2 class="events__archive-title" style="order: -100;">
					<?php echo esc_attr_x( 'Upcoming events', 'archive', 'svid-theme-domain'); ?>
				</h2>
			<?php
				endif;
				if ($end < $current_date && $first_past):
					$first_past = false;
			?>
				<h2 class="events__archive-title">
					<?php echo esc_attr_x( 'Past events', 'archive', 'svid-theme-domain'); ?>
				</h2>
			<?php endif; ?>

			<?php
				// Add a order to upcoming events to sort them reverse from how we got them
				if ($end > $current_date) {
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
