<article class="vacancy vacancy--frontpage">

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

	</div>

</article>
