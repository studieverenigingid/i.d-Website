<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<header class="event--page__header
		<?php if ( !has_post_thumbnail() ) echo 'event--page__header--short-header'; ?>"
		style="background-color: <?php theme_color(false); ?>;">

		<div class="event--page__short-info event--page__short-info--short-header"
			style="background:<?php theme_color(false);?>">

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
				<style media="screen">
					.event--page__thumb:before {
						background-image: linear-gradient(
							to bottom right, <?php theme_color(true); ?>,
							transparent 50%
						);
					}
				</style>
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

			foreach ($buttons as $key => $butt) {
				$url = $butt['url'];
				$text = $butt['text'];
				$class = 'button--' . $key;
				if ($url !== '' && $url !== null && $url)
					echo "<a href='$url' class='button $class'>$text</a>";
			}
		?>

		<?php the_content(); ?>

		<?php
		// Files
		// Check if there are files
		if ( have_rows('file_list') ):
		// Check if user is logged in; if not, tell them to log in
		if ( !is_user_logged_in() ): ?>

		</main>

		<section class="event__files event__files--unauth">
			<h2 class="event__section-title"><?php echo esc_attr_x('Files', 'title above file list', 'svid-theme-domain'); ?></h2>
			<h3><?php echo esc_attr_x('To see the files, you have to log in.', 'only show files when logged in on event page', 'svid-theme-domain'); ?></h3>
			<a href="<?php echo wp_login_url( get_permalink() ); ?>" class="button">
				Login
			</a>
		</section>

		<?php else: ?>

		</main>

		<section class="event__files">
			<h2 class="event__section-title">
				<?php echo esc_attr_x('Files', 'title above file list', 'svid-theme-domain'); ?>
			</h2>
			<?php
				// loop through the files
				while ( have_rows('file_list') ) :
					the_row();
					$file = get_sub_field('file');
					if ( get_sub_field('file_name') !== '' ) {
						$file_name = get_sub_field('file_name');
					} else {
						$file_name = $file['name'];
					} ?>
					<a class="event__file" target="_blank"
						href="/download/?id=<?=$file['id']?>">
						<h3 class="event__file-name">
							<i class="fa fa-file-text-o"></i>
							<?=$file_name?>
						</h3>
					</a>
				<?php endwhile;?>

			</section>

		<?php endif; else: ?>
			</main>
		<?php endif; ?>



<?php endwhile; endif; ?>

<?php get_footer(); ?>
