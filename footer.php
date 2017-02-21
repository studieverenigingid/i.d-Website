		<footer class="pri-footer">

			<a href="<?php echo get_site_url(); ?>">
				<picture>
					<source srcset="<?=$img_folder?>logo.svg" type="image/svg+xml">
					<img class="pri-footer__logo" alt="Study association i.d"
						srcset="<?=$img_folder?>logo.png 1x,
							<?=$img_folder?>logo@2x.png 2x"
						src="<?=$img_folder?>logo.png">
				</picture>
			</a>

			<h2 class="sitemap__heading">Sitemap</h2>
			<?php wp_nav_menu( array(
				'theme_location' => 'sitemap',
				'container' => 'nav',
				'container_class' => 'sitemap',
				'menu_class' => 'sitemap__list',
				'walker' => new Walker_Sitemap() ) ); ?>

		</footer>

		<?php wp_footer(); ?>

		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</body>
</html>
