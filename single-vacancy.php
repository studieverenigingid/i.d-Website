<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<header class="vacancy--page__header">

		<div class="vacancy--page__short-info">

			<h1 class="vacancy--page__title"><?php the_title(); ?></h1>

			<div class="vacancy--page__type">
				<?php 
						$categories = get_the_category();

						if ( ! empty( $categories ) ) {
						    echo esc_html( $categories[0]->name );   
						}
					?>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="vacancy--page__thumb">
					<?php
					the_post_thumbnail(
						'large',
						array('class' => 'vacancy--page__img')
					);
					?>
				</div>
			<?php endif; ?>

		</div>

	</header>



	<main class="primary-content vacancy--page__content">

		<?php
			$buttons = array();

			$buttons['fb'] = [
				'url' => get_field('facebook_url'),
				'text' => 'Facebook vacancy'
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



<?php endwhile; endif; ?>

<?php get_footer(); ?>
