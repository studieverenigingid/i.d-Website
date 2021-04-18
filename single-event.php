<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<header id="site-content" class="event--page__header
		<?php if ( !has_post_thumbnail() ) echo 'event--page__header--short-header'; ?>">

		<div class="event--page__short-info event--page__short-info--short-header">

			<h1 class="event--page__name"><?php the_title(); ?></h1>

			<?php
				$start = new DateTime(get_field('start_datetime'));
				$end = new DateTime(get_field('end_datetime'));

				$start_month = $start->format('F');
				$start_day   = $start->format('jS');

				$end_month = $end->format('F');
				$end_day   = $end->format('jS');

				$start_time = $start->format('H:i');
				$end_time   = $end->format('H:i');

				$year = $start->format('Y');

				$event_duration = $start->diff($end);

				$location_name = get_field('location_name');
			?>
			<div class="event--page__datetime">
				<?php
					echo $start_month . ' ' . $start_day . ', ' . $year;

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

		<?php
			$buttons = array();

			$buttons['fb'] = [
				'url' => get_field('facebook_url'),
				'text' => esc_attr_x('Facebook event', 'Facebook event link text', 'svid-theme-domain')
			];

			$buttons['tickets'] = [
				'url' => get_field('ticket_url'),
				'text' => esc_attr_x('Get your tickets', 'Ticket link text', 'svid-theme-domain')
			];

			$start->setTimezone(new DateTimeZone('UTC'));
			$end->setTimezone(new DateTimeZone('UTC'));
			$google_cal_url = "https://www.google.com/calendar/render?action=TEMPLATE&sf=true&output=xml";
			$google_cal_url .= "&text=" . urlencode(get_the_title());
			$google_cal_url .= "&dates=" . $start->format('Ymd\THis') .
				"/" . $end->format('Ymd\THis');
			$google_cal_url .= "&location=" . urlencode($location_name);
			$google_cal_url .= "&details=" . urlencode(get_the_excerpt());

			$buttons['add-to-google'] = [
				'url' => $google_cal_url,
				'text' => esc_attr_x('Add to Google Calendar', 'Google Calendar link', 'svid-theme-domain')
			];

			foreach ($buttons as $key => $butt) {
				$url = $butt['url'];
				$text = $butt['text'];
				$class = 'button--' . $key;
				if ($url !== '' && $url !== null && $url)
					echo "<a href='$url' class='button $class'>$text</a>";
			}
		?>

		<?php the_content(); ?>
		<?php include('inc/lassie-event.php'); ?>
		<?php include('inc/file-list.php'); ?>

	</main>



<?php endwhile; endif; ?>

<?php get_footer(); ?>
