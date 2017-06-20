<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<header class="event--page__header colorVibrant
		<?php if ( !has_post_thumbnail() ) echo 'event--page__header--no-thumb'; ?>">

		<div class="event--page__short-info
			<?php if ( !has_post_thumbnail() ) echo 'event--page__short-info--no-thumb'; ?>">

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

				$location_name = get_field('location_name');
			?>
			<div class="event--page__datetime">
				<?php
					echo $month . ' ' . $day . ', ';
					echo $start_time . ' – ' . $end_time;
					echo ($location_name) ? ' @ ' . $location_name : '';
				?>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="event--page__thumb colorVibrantGradient">
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
				'text' => 'Facebook event'
			];

			$buttons['tickets'] = [
				'url' => get_field('ticket_url'),
				'text' => 'Get your tickets'
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

	</main>

	<?php
		// Files
		// check if there are files
		if ( have_rows('file_list') ):
	?>
		<section class="event__files">
			<h2 class="event__section-title"><?php echo esc_attr_x('Files', 'title above file list'); ?></h2>
			<?php
				// loop through the files
				while ( have_rows('file_list') ) :
					the_row();
					$file = get_sub_field('file');

					if ( get_sub_field('file_name') !== '' ) {
						$file_name = get_sub_field('file_name');
					} else {
						$file_name = $file['name'];
					}
				?>
					<a class="event__file" href="<?=$file['url']?>" target="_blank">
						<h3 class="event__file-name">
							<i class="fa fa-file-text-o"></i>
							<?=$file_name?>
						</h3>
					</a>
			<?php endwhile;?>
		</section>
	<?php endif; ?>



<?php endwhile; endif; ?>

<?php get_footer(); ?>
