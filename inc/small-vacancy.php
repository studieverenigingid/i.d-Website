<article class="vacancy--small">
		<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('large', array( 'class' => 'vacancy--small__thumb')); ?><?php endif; ?>
		<div>
			<h3 class="vacancy--small__type">
				<?php 
					$categories = get_the_category();

					if ( ! empty( $categories ) ) {
					    echo esc_html( $categories[0]->name );   
					}
				?>
			</h3>
			<p class="vacancy--small__title">
				<?php the_title(); ?>
			</p>
			<?php 

				$file = get_field('vacancy_attachment');

				if( $file ): ?>
					
					<a target="_BLANK" href="<?php echo $file['url']; ?>">Attachment</a>

				<?php endif; ?>
		</div>
</article>
