<?php
	get_header();
?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

	<header class="vacancy__header">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="vacancy__logo-box">
				<?php the_post_thumbnail('post-thumbnail',
					array( 'class' => 'vacancy__logo vacancy__logo--large')
				); ?>
			</div>
		<?php endif; ?>

		<?php
			$company = get_field('company');
		?>
		<p class="vacancy__intro  vacancy__intro--large">
			<span class="vacancy__company"><?=$company?></span> <?php echo esc_attr_x('is looking for a', 'vacancy <company> is looking for string', 'svid-theme-domain');?>
		</p>

		<h1 class="vacancy__title  vacancy__title--large"><?php the_title(); ?></h1>

		<p class="vacancy__details  vacancy__details--large">
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

	</header>

	<main class="primary-content news--page__content">

		<div class="vacancy__button-group">
			<?php
				$file = get_field('vacancy_attachment');
				if ( $file ): ?>
					<a target="_blank" class="button  button--light  vacancy__button"
						href="<?php echo $file['url']; ?>">
						<i class="fa fa-file-text-o"></i> <?php echo esc_attr_x('Download this description', 'Download vacancy description button text', 'svid-theme-domain');?>
					</a>
			<?php endif; ?>

			<?php
				$apply = get_field('apply_directly');
				if ( $apply ): ?>
				<a target="_blank" class="button  vacancy__button"
					href="<?php echo $apply ?>">
					<i class="fa fa-send"></i> <?php echo esc_attr_x('Apply directly', 'Apply for vacancy button text', 'svid-theme-domain');?>
				</a>
			<?php endif; ?>
		</div>

		<?php the_content(); ?>

		<div class="vacancy__button-group">
			<?php
				if ( $file ): ?>
					<a target="_blank" class="button  button--light  vacancy__button"
						href="<?php echo $file['url']; ?>">
						<i class="fa fa-file-text-o"></i> <?php echo esc_attr_x('Download this description', 'Download vacancy description button text', 'svid-theme-domain');?>
					</a>
			<?php endif; ?>

			<?php
				if ( $apply ): ?>
				<a target="_blank" class="button  vacancy__button"
					href="<?php echo $apply ?>">
					<i class="fa fa-send"></i> <?php echo esc_attr_x('Apply directly', 'Apply for vacancy button text', 'svid-theme-domain');?>
				</a>
			<?php endif; ?>
		</div>

	</main>

<?php
	endwhile; endif;
	get_footer();
?>
