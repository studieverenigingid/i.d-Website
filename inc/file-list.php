<?php

/*
   Include: File List
   Lists the files for this post
*/

// Are there files?
if ( have_rows('file_list') ): // yes

	// Is the user is logged in?
	if ( !is_user_logged_in() ): // no ?>

	<section class="event__files event__files--unauth">
		<h2 class="event__section-title">
			<?php echo esc_attr_x('Files', 'title above file list', 'svid-theme-domain'); ?>
		</h2>
		<h3>
			<?php echo esc_attr_x('To see the files, you have to log in.', 'only show files when logged in on event page', 'svid-theme-domain'); ?>
		</h3>
		<a href="<?php echo wp_login_url( get_permalink() ); ?>" class="button">
			Login
		</a>
	</section>

	<?php // Is the user is logged in?
	else: // yes ?>

	<section class="event__files">
		<h2 class="event__section-title">
			<?php echo esc_attr_x('Files', 'title above file list', 'svid-theme-domain'); ?>
		</h2>
		<?php
			// loop through the files
			while ( have_rows('file_list') ) : the_row();

				$file = get_sub_field('file');

				if ( get_sub_field('file_name') !== '' ) {
					$file_name = get_sub_field('file_name');
				} else {
					$file_name = $file['name'];
				} ?>

				<a class="event__file" target="_blank"
					href="/download/?id=<?=$file['id']?>">
					<h3 class="event__file-name">
						<i class="fas fa-file-alt"></i>
						<?=$file_name?>
					</h3>
				</a>

			<?php endwhile;?>

		</section>

	<?php endif; // Is the user is logged in? ?>
<?php endif; // Are there files? ?>
