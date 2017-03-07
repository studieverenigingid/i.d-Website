<article class="vacancy--small">
		<a href="<?php the_permalink(); ?>" class="vacancy--small__anchor">
			<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('large', array( 'class' => 'vacancy--small__thumb')); ?><?php endif; ?>
		</a>
		<div>
			<h3 class="vacancy--small__type">
				<a href="<?php the_permalink(); ?>">
					<?php 
						$categories = get_the_category();

						if ( ! empty( $categories ) ) {
						    echo esc_html( $categories[0]->name );   
						}
					?>
				</a>
			</h3>
			<p class="vacancy--small__title">
				<?php the_title(); ?>
			</p>
		</div>
</article>
