<?php

/**
 * Template Name: ID Kafee page
 */

get_header(); ?>

<header id="site-content" class="page-top">

	<h1 class="page-top__title"><?php the_title(); ?></h1>

	<div class="page-top__descr">
		<?php
			if(have_posts()) : while(have_posts()) :
				the_post();
				the_content();
			endwhile; endif; ?>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="page-top__thumb">
			<?php
			the_post_thumbnail(
				'large',
				array('class' => 'page-top__img')
			);
			?>
		</div>
	<?php endif; ?>

</header>

<?php

if( have_rows('kafee_content_blocks') ):

 	// loop through the rows of data
    while ( have_rows('kafee_content_blocks') ) : the_row(); ?>
			<section class="kafee--page__container"
				id="<?php echo strtolower(get_sub_field('kafee_content_title')) ?>">
				<h2 class="kafee--page__blocktitle">
					<?php the_sub_field('kafee_content_title'); ?>
				</h2>
				<p>
					<?php the_sub_field('kafee_content_info'); ?>
				</p>
			</section>

    <?php endwhile;

else :
	echo "no content found";
endif;

?>

<section id="isitkafee" class="kafee--page__container isitkafee">
	<h2 class="kafee--page__blocktitle isitkafee__question">
		🍻 Is it ID Kafee already?
	</h2>
	<p class="isitkafee__answer">
		<span id="yesorno">
			<noscript>maybe</noscript>
		</span>
	</p>
	<p class="isitkafee__countdown">
		<span id="countdown">
		  <noscript>Your Javascript is turned off, but if it’s Wednesday after 17:00, you already know...</noscript>
	  </span>
	</p>
	<p class="isitkafee__disclaimer">Please note we’re not taking off-days into account here, so during holidays, IDE Business Fair and IO Festival we’re closed even if it says ‘yes’.</p>
</section>

<?php get_footer(); ?>
