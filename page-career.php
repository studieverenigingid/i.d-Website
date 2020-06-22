<?php

/**
 * Template Name: Career page
 */

get_header(); ?>



<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<header id="site-content" class="kafee--page__header
	<?php if ( !has_post_thumbnail() ) echo 'kafee--page__header--short-header'; ?>"
	style="background-color: <?php theme_color(false); ?>;">

	<div class="kafee--page__short-info
		<?php if ( !has_post_thumbnail() ) echo 'kafee--page__short-info--short-header'; ?>"
		style="background-color: <?php theme_color(false); ?>;">

		<h1 class="kafee--page__name"><?php the_title(); ?></h1>

      <div class="kafee--page__kafee">
        <?php the_content(); ?>
      </div>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="kafee--page__thumb">
				<?php
				the_post_thumbnail(
					'large',
					array('class' => 'kafee--page__img')
				);
				?>
			</div>
		<?php endif; ?>

	</div>

</header>
<?php endwhile; endif; ?>



<p class="career__jump" style="background-color: <?php theme_color(false); ?>;">
	Jump to our:
	<a class="about__jump-link" href="#partner-companies">
		<?php echo esc_attr_x('partner companies',
			'Partner companies link',
			'svid-theme-domain'); ?></a> –
	<a class="about__jump-link" href="#vacancies">
		<?php echo esc_attr_x('vacancies',
			'Vacancies link',
			'svid-theme-domain'); ?></a> –
	<a class="about__jump-link" href="#collaboration">
		<?php echo esc_attr_x('collaborate with ID',
			'Collaboration link',
			'svid-theme-domain'); ?></a> –
	<a class="about__jump-link" href="#alumni">
		<?php echo esc_attr_x('alumni',
			'Alumni link',
			'svid-theme-domain'); ?></a> –
	<a class="about__jump-link" href="#idebf">
		<?php echo esc_attr_x('ide business fair',
			'IDEBF link',
			'svid-theme-domain'); ?></a>
</p>




<section class="career__block" id="partner-companies">

	<h2 class="about__sub-title"><?php echo esc_attr_x('Partner companies', 'Our committees title', 'svid-theme-domain'); ?></h2>

	<?php if(get_field('about_partners')): ?>
	<div class="career__description">
		<?php the_field('about_partners'); ?>
	</div>
	<?php endif; ?>

	<?php
		$partner_page_ID = (get_page_by_path('partner-companies')) ? get_page_by_path('partner-companies') : get_page_by_path('career/partner-companies');
		if( have_rows('companies', $partner_page_ID) ): $i = 0; ?>
			<section class="partner-companies partner-companies--career">
		 	<?php // loop through the rows of data
		    while ( have_rows('companies', $partner_page_ID) ) : the_row();
				$i++; if($i > 4) break; ?>
					<?php
						$logo = get_sub_field('logo');
						$logo = $logo['sizes']['medium'];
					?>
					<div class="partner-company__logo-bubble partner-company__logo-bubble--career">
						<img class="partner-company__logo" src="<?php echo $logo; ?>"
							alt="Logo <?php the_sub_field('name'); ?>">
					</div>
		    <?php endwhile; ?>
				<div class="partner-company__logo-bubble partner-company__logo-bubble--career">
					<strong>And more</strong>
				</div>
			</section>
		<?php else :
			echo "no partner companies found";
		endif;
	?>

	<a class="button committees__all"
		href="<?php echo get_permalink( $partner_page_ID ); ?>">
		<?php echo esc_attr_x('All partners', 'View all partner companies button text', 'svid-theme-domain'); ?>
	</a>

</section>



<hr class="divider">



<section class="career__block" id="vacancies">

	<h2 class="about__sub-title"><?php echo esc_attr_x('Looking for a job or internship?', 'Vacancies title', 'svid-theme-domain'); ?></h2>

	<?php if(get_field('about_vacancies')): ?>
	<div class="career__description">
		<?php the_field('about_vacancies'); ?>
	</div>
	<?php endif; ?>

	<div class="career__small-vacancy">

		<h3 class="career__small-heading">Most recent vacancy</h3>

		<?php
			$args = array(
				'post_type' => 'vacancy',
				'posts_per_page' => 1
			);

			$loop = new WP_Query( $args );
	    if($loop->have_posts()) :
				while($loop->have_posts()) :
					$loop->the_post();
					include 'inc/small-vacancy.php';
				endwhile;
			endif;
			wp_reset_postdata();
		?>

	</div>

	<?php
		$vacancy_page_ID = (get_page_by_path('vacancies')) ? get_page_by_path('vacancies') : get_page_by_path('career/vacancies');
	?>
	<a class="button committees__all"
		href="<?php echo get_permalink( $vacancy_page_ID ); ?>">
		<?php echo esc_attr_x('All vacancies', 'View all vacancies button text', 'svid-theme-domain'); ?>
	</a>

</section>



<hr class="divider">



<section class="career__block" id="collaboration">
	<h2 class="about__sub-title">
		<?php echo esc_attr_x('Collaborate with ID', 'Coll title', 'svid-theme-domain'); ?>
	</h2>

	<?php if(get_field('about_collaboration')): ?>
	<div class="career__description">
		<?php the_field('about_collaboration'); ?>
	</div>
	<?php endif; ?>

	<?php
	$collab_page_ID = (get_page_by_path('collaborate')) ? get_page_by_path('collaborate') : get_page_by_path('career/collaborate');
	?>
	<a class="button committees__all"
		href="<?php echo get_permalink( $collab_page_ID ); ?>">
		<?php echo esc_attr_x('About collaborations', 'Collaboration page button text', 'svid-theme-domain'); ?>
	</a>

</section>



<hr class="divider">



<section class="career__block" id="alumni">
	<h2 class="about__sub-title">
		<?php echo esc_attr_x('About our alumni', 'Alumni title', 'svid-theme-domain'); ?>
	</h2>

	<?php if(get_field('about_alumni')): ?>
	<div class="career__description">
		<?php the_field('about_alumni'); ?>
	</div>
	<?php endif; ?>

	<?php
	$alumni_page_ID = (get_page_by_path('alumni')) ? get_page_by_path('alumni') : get_page_by_path('career/alumni');
	?>
	<a class="button committees__all"
		href="<?php echo get_permalink( $alumni_page_ID ); ?>">
		<?php echo esc_attr_x('Read about alumni', 'Collaboration page button text', 'svid-theme-domain'); ?>
	</a>

</section>



<hr class="divider">



<section class="career__block" id="idebf">
	<h2 class="about__sub-title">
		<?php echo esc_attr_x('IDE Business Fair', 'IDEBF title', 'svid-theme-domain'); ?>
	</h2>

	<?php if(get_field('idebf')): ?>
	<div class="career__description">
		<?php the_field('idebf'); ?>
	</div>
	<?php endif; ?>

	<a class="button committees__all"
		href="https://idebusinessfair.com/">
		<?php echo esc_attr_x('Visit IDE Business Fair website', 'Website button text', 'svid-theme-domain'); ?>
	</a>

</section>



<?php get_footer(); ?>
