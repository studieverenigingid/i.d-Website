<article class="vacancy">

	<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail('thumb',
				array( 'class' => 'vacancy__logo')
			);
		}
	?>

	<div class="vacancy__text">

		<?php
			$company = get_field('company');
		?>
		<p class="vacancy__intro">
			<span class="vacancy__company"><?=$company?></span> is looking for a
		</p>

		<h3 class="vacancy__title">
			<?php the_title(); ?>
		</h3>

		<p class="vacancy__details">
			<?php
				$location = get_field('location');
				if ( !empty($location) ) { ?>
					<span class="vacancy__tag  vacancy__location">
			    	<i class="fa fa-map-marker"></i> <?=$location?>
					</span>
			<?php	} ?>

			&bull;

			<?php
				$categories = get_the_category();
				if ( !empty($categories) ) {
					$category = esc_html( $categories[0]->name ); ?>
					<span class="vacancy__tag  vacancy__type">
			    	<?=$category?>
					</span>
			<?php	} ?>
		</p>

		<?php
			$file = get_field('vacancy_attachment');
			if ( $file ): ?>
				<a target="_blank" class="button  vacancy__button"
					href="<?php echo $file['url']; ?>">
					<i class="fa fa-file-text-o"></i> Description
				</a>
		<?php endif; ?>

	</div>

</article>
