<article class="vacancy vacancy--archive">

	<?php
		if ( has_post_thumbnail() ) { ?>
		<div class="vacancy__thumb">
			<?php
				the_post_thumbnail('thumb',
					array( 'class' => 'vacancy__logo')
				);
			?>
		</div>
	<?php } ?>

	<div class="vacancy__text">

		<?php
			$company = get_field('company');
		?>
		<p class="vacancy__intro">
			<span class="vacancy__company"><?=$company?></span><?php echo esc_attr_x('is looking for', 'vacancy <company> is looking for string', 'svid-theme-domain');?>
		</p>

		<h3 class="vacancy__title">
			<a href="<?php the_permalink(); ?>" class="vacancy__link">
				<?php the_title(); ?>
			</a>
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

	</div>

</article>
