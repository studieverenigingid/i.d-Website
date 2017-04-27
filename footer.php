		<?php global $img_folder; ?>
		<footer class="pri-footer">

			<div class="pri-footer__association pri-footer__col">
				<a href="<?php echo get_site_url(); ?>">
					<picture>
						<source srcset="<?=$img_folder?>logo.svg" type="image/svg+xml">
						<img class="pri-footer__logo" alt="Study association i.d"
							srcset="<?=$img_folder?>logo.png 1x,
								<?=$img_folder?>logo@2x.png 2x"
							src="<?=$img_folder?>logo.png">
					</picture>
				</a>
				<p class="pri-footer__contact">
					<strong class="pri-footer__name">Study association i.d</strong><br>
					Landbergstraat 15<br>
					2628 CE Delft<br>
					Netherlands<br>
					<a class="pri-footer__link"
						href="tel:0031152783012">+31 (0) 15 278 3012</a><br>
					<a class="pri-footer__link"
						href="mailto:svid@tudelft.nl">svid@tudelft.nl</a><br>
				</p>
			</div>

			<div class="pri-footer__sitemap pri-footer__col">
				<h2 class="pri-footer__heading">Sitemap</h2>
				<?php wp_nav_menu( array(
					'theme_location' => 'sitemap',
					'container' => 'nav',
					'container_class' => 'sitemap',
					'menu_class' => 'sitemap__list',
					'walker' => new Walker_Sitemap() ) ); ?>
			</div>

			<div class="pri-footer__contact pri-footer__col">
				<h2 class="pri-footer__heading">Social media</h2>
				<div>
					<a href="https://www.instagram.com/studieverenigingid/"
						class="button button--insta">
						<i class="fa fa-instagram"></i> Instagram
					</a>
					<a href="https://www.facebook.com/studieverenigingi.d/"
						class="button button--facebook">
						<i class="fa fa-facebook"></i> Facebook
					</a>
					<a href="https://www.flickr.com/photos/svid/"
						class="button button--flickr">
						<i class="fa fa-flickr"></i> Flickr
					</a>
					<a href="https://vimeo.com/studieverenigingid"
						class="button button--vimeo">
						<i class="fa fa-vimeo"></i> Vimeo
					</a>
				</div>
			</div>

		</footer>

		<?php wp_footer(); ?>

		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</body>
</html>
