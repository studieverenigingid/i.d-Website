		<?php global $img_folder; ?>
		<footer class="pri-footer">

			<div class="pri-footer__association pri-footer__col">
				<?php
				$wpml_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
				?>
				<a href="<?php echo $wpml_home_url; ?>">
					<picture>
						<source srcset="<?=$img_folder?>logo-payoff.svg" type="image/svg+xml">
						<img class="pri-footer__logo" alt="ID study association"
							srcset="<?=$img_folder?>logo-payoff.png 1x,
								<?=$img_folder?>logo-payoff@2x.png 2x"
							src="<?=$img_folder?>logo-payoff.png">
					</picture>
				</a>
				<p class="pri-footer__paragraph">
					<strong class="pri-footer__name"><?php echo esc_attr_x('ID', 'Company Name', 'svid-theme-domain');?></strong><br>
					Landbergstraat 15<br>
					2628 CE Delft<br>
					<?php echo esc_attr_x('Netherlands', 'Netherlands in footer', 'svid-theme-domain');?><br>
					<a class="pri-footer__link"
						href="tel:0031152783012">+31 (0) 15 278 3012</a><br>
					<a class="pri-footer__link"
						href="mailto:svid@tudelft.nl">svid@tudelft.nl</a><br>
				</p>
				<p class="pri-footer__paragraph">
					KvK: 40397069<br>
					Btw: NL 8058.24.352 B01<br>
					IBAN: NL08 RABO 0319 4232 39<br>
					BIC: RABONL2U<br>
				</p>

				<p class="pri-footer__paragraph pri-footer__paragraph--small">
					<?php echo sprintf (
						__('Do you want to become a member or end your membership? Please visit <a href="%s" class="pri-footer__link">our contact page</a> for more information.', 'svid-theme-domain'),
						home_url( '/contact/' ) ); ?>
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

			<div class="pri-footer__paragraph pri-footer__col">
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
					<a href="https://medium.com/turnthepage"
						class="button button--medium">
						<i class="fa fa-medium"></i> Medium
					</a>
				</div>
			</div>

		</footer>
		<?php if (current_user_can('administrator')) { ?>
			<a href="javascript:location.reload(true);">
				<div class="force-refresh-button">
					<i class="fa fa-refresh" aria-hidden="true"></i>
				</div>
			</a>
		<?php } ?>

		<?php wp_footer(); ?>

		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</body>
</html>
