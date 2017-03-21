<article class="vacancy--small">

	<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail('large',
				array( 'class' => 'vacancy__img')
			);
		}
	?>

	<div>

		<?php
			$categories = get_the_category();
			if ( !empty($categories) ) {
		    echo '<h3>' . esc_html( $categories[0]->name ) . '</h3>';
			}
		?>

		<p class="vacancy--small__title">
			<?php the_title(); ?>
		</p>

		<?php
			$file = get_field('vacancy_attachment');
			if( $file ): ?>
				<a target="_blank" class="button"
					href="<?php echo $file['url']; ?>">
					<i class="fa fa-file-text-o"></i> Attachment
				</a>
		<?php endif; ?>

	</div>

</article>
