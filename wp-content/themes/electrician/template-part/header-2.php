<?php
$electrician_options = electrician_options();
?>
<nav class="panel-menu" id="mobile-menu">
	<ul>

	</ul>
	<div class="mm-navbtn-names">
		<div class="mm-closebtn"><?php esc_html_e( 'Close', 'electrician' ); ?></div>
		<div class="mm-backbtn"><?php esc_html_e( 'Back', 'electrician' ); ?></div>
	</div>
</nav>
<header id="tt-header">
	<!-- holder-top (mobile) -->
	<div class="holder-top-mobile d-block d-md-none">
		<div class="h-topbox__content">
		<?php if ( isset( $electrician_options['electrician-header-address'] ) && $electrician_options['electrician-header-address'] ) { ?>
			<div class="tt-item"><div class="tt-item__icon"><span class="icon-map-marker"></span></div><div class="tt-item__text"><address><?php echo esc_html( $electrician_options['electrician-header-address'] ); ?></address></div></div>
		<?php } ?>
		<?php if ( isset( $electrician_options['electrician-header-email'] ) && $electrician_options['electrician-header-email'] ) { ?>
			<div class="tt-item"><div class="tt-item__icon"><span class="icon-482948"></span></div><div class="tt-item__text"><a href="mailto:<?php echo esc_attr( $electrician_options['electrician-header-email'] ); ?>"><?php echo esc_html( $electrician_options['electrician-header-email'] ); ?></a></div></div>
		<?php } ?>
		<?php if ( isset( $electrician_options['electrician-header-phone'] ) && $electrician_options['electrician-header-phone'] ) { ?>
			<div class="tt-item"><div class="tt-item__icon"><span class="icon-telephone"></span></div><div class="tt-item__text"><address><a href="tel:<?php echo esc_attr( $electrician_options['electrician-header-phone'] ); ?>"><?php echo esc_html( $electrician_options['electrician-header-phone'] ); ?></a></address></div></div>
		<?php } ?>
		<?php if ( isset( $electrician_options['electrician-header-hours'] ) && $electrician_options['electrician-header-hours'] ) { ?>
			<div class="tt-item"><div class="tt-item__icon"><span class="icon-clock-circular-outline-1"></span></div><div class="tt-item__text"><?php echo esc_html( $electrician_options['electrician-header-hours'] ); ?></div></div>
		<?php } ?>
		<?php if ( isset( $electrician_options['electrician-display-header-social'] ) && $electrician_options['electrician-display-header-social'] ) { ?>
				<ul class="social-links">
							<?php
							if ( isset( $electrician_options['electrician-header-twitter'] ) && ! empty( $electrician_options['electrician-header-twitter'] ) ) {
								?>
					<li><a target="_blank" class="icon-twitter-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-twitter'] ); ?>"></a></li>
								<?php
							}
							if ( isset( $electrician_options['electrician-header-facebook'] ) && ! empty( $electrician_options['electrician-header-facebook'] ) ) {
								?>
					<li><a target="_blank" class="icon-facebook-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-facebook'] ); ?>"></a></li>
								<?php
							}
							if ( isset( $electrician_options['electrician-header-instagram'] ) && ! empty( $electrician_options['electrician-header-instagram'] ) ) {
								?>
					<li><a target="_blank" class="icon-instagram-logo" href="<?php echo esc_url( $electrician_options['electrician-header-instagram'] ); ?>"></a></li>
							<?php } ?>
							<?php
							if ( isset( $electrician_options['electrician-header-google-plus'] ) && ! empty( $electrician_options['electrician-header-google-plus'] ) ) {
								?>
					<li><a target="_blank" class="icon-google-plus-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-google-plus'] ); ?>"></a></li>
							<?php } ?>
							<?php if ( isset( $electrician_options['electrician-header-linkedin'] ) && ! empty( $electrician_options['electrician-header-linkedin'] ) ) { ?>
					<li><a target="_blank" class="icon-linkedin-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-linkedin'] ); ?>"></a></li>
					<?php } ?>
							<?php if ( isset( $electrician_options['electrician-header-tumblr'] ) && ! empty( $electrician_options['electrician-header-tumblr'] ) ) { ?>
					<li><a target="_blank" class="icon-tumblr-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-tumblr'] ); ?>"></a></li>
					<?php } ?>
							<?php if ( isset( $electrician_options['electrician-header-youtube'] ) && ! empty( $electrician_options['electrician-header-youtube'] ) ) { ?>
					<li><a target="_blank" class="icon icon-youtube" href="<?php echo esc_url( $electrician_options['electrician-header-youtube'] ); ?>"><img src="<?php echo ELECTRICITY_IMG_URL; ?>youtube_play.png"/></a></li>
					<?php } ?>
					<?php if ( isset( $electrician_options['electrician-header-yelp'] ) && ! empty( $electrician_options['electrician-header-yelp'] ) ) { ?>
					<li><a target="_blank" class="icon icon-yelp" href="<?php echo esc_url( $electrician_options['electrician-header-yelp'] ); ?>"><img src="<?php echo ELECTRICITY_IMG_URL; ?>yelp.png"/></a></li>
					<?php } ?>
				</ul>
		<?php } ?>
		</div>
		<a href="#" class="h-topbox__btn" id="js-toggle-h-holder">
			<i class="tt-arrow down"></i>
		</a>
	</div>
	<!-- /holder-top (mobile) -->
	<!-- holder-top (desktop) -->
	<div class="holder-top-desktop d-none d-md-block">
		<div class="container container-lg-fluid">
			<div class="row no-gutters">
				<div class="col-auto">
					<div class="h-info01">
					<?php if ( isset( $electrician_options['electrician-header-address'] ) && $electrician_options['electrician-header-address'] ) { ?>
						<div class="tt-item"><address><span class="icon-map-marker"></span>    <?php echo esc_html( $electrician_options['electrician-header-address'] ); ?></address></div>
					<?php } ?>
					<?php if ( isset( $electrician_options['electrician-header-hours'] ) && $electrician_options['electrician-header-hours'] ) { ?>
						<div class="tt-item"><span class="icon-clock-circular-outline-1"></span><?php echo esc_html( $electrician_options['electrician-header-hours'] ); ?></div>
					<?php } ?>
					</div>
				</div>
				<div class="col-auto ml-auto">
					<div class="tt-obj">
						<div class="h-info02">
						<?php if ( isset( $electrician_options['electrician-display-header-social'] ) && $electrician_options['electrician-display-header-social'] ) { ?>
								<ul class="f-social">
											<?php
											if ( isset( $electrician_options['electrician-header-twitter'] ) && ! empty( $electrician_options['electrician-header-twitter'] ) ) {
												?>
									<li><a target="_blank" class="icon-twitter-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-twitter'] ); ?>"></a></li>
												<?php
											}
											if ( isset( $electrician_options['electrician-header-facebook'] ) && ! empty( $electrician_options['electrician-header-facebook'] ) ) {
												?>
									<li><a target="_blank" class="icon-facebook-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-facebook'] ); ?>"></a></li>
												<?php
											}
											if ( isset( $electrician_options['electrician-header-instagram'] ) && ! empty( $electrician_options['electrician-header-instagram'] ) ) {
												?>
									<li><a target="_blank" class="icon-instagram-logo" href="<?php echo esc_url( $electrician_options['electrician-header-instagram'] ); ?>"></a></li>
											<?php } ?>
											<?php
											if ( isset( $electrician_options['electrician-header-google-plus'] ) && ! empty( $electrician_options['electrician-header-google-plus'] ) ) {
												?>
									<li><a target="_blank" class="icon-google-plus-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-google-plus'] ); ?>"></a></li>
											<?php } ?>
											<?php if ( isset( $electrician_options['electrician-header-linkedin'] ) && ! empty( $electrician_options['electrician-header-linkedin'] ) ) { ?>
									<li><a target="_blank" class="icon-linkedin-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-linkedin'] ); ?>"></a></li>
									<?php } ?>
											<?php if ( isset( $electrician_options['electrician-header-tumblr'] ) && ! empty( $electrician_options['electrician-header-tumblr'] ) ) { ?>
									<li><a target="_blank" class="icon-tumblr-logo-button" href="<?php echo esc_url( $electrician_options['electrician-header-tumblr'] ); ?>"></a></li>
									<?php } ?>
											<?php if ( isset( $electrician_options['electrician-header-youtube'] ) && ! empty( $electrician_options['electrician-header-youtube'] ) ) { ?>
									<li><a target="_blank" class="icon icon-youtube" href="<?php echo esc_url( $electrician_options['electrician-header-youtube'] ); ?>"><img src="<?php echo ELECTRICITY_IMG_URL; ?>youtube_play.png"/></a></li>
									<?php } ?>
									<?php if ( isset( $electrician_options['electrician-header-yelp'] ) && ! empty( $electrician_options['electrician-header-yelp'] ) ) { ?>
									<li><a target="_blank" class="icon icon-youtube" href="<?php echo esc_url( $electrician_options['electrician-header-yelp'] ); ?>"><img src="<?php echo ELECTRICITY_IMG_URL; ?>yelp.png"/></a></li>
									<?php } ?>
								</ul>
							<?php
						}
						if ( isset( $electrician_options['electrician-email-switch'] ) && $electrician_options['electrician-email-switch'] == 1 ) {
							?>
							<div class="tt-item">    
								<address>
									<a href="mailto:<?php echo esc_attr( $electrician_options['electrician-header-email'] ); ?>"><span class="icon-482948"></span><?php echo esc_html( $electrician_options['electrician-header-email'] ); ?></a>
								</address>
							</div>
							<?php } ?>
							<?php if ( isset( $electrician_options['electrician-header-phone'] ) && $electrician_options['electrician-header-phone'] ) { ?>
							<div class="tt-item">    
								<address>
									<a href="tel:<?php echo esc_attr( $electrician_options['electrician-header-phone'] ); ?>"><span class="icon-telephone"></span><?php echo esc_html( $electrician_options['electrician-header-phone'] ); ?></a>
								</address>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php if ( isset( $electrician_options['electrician_is_cart_in_all_page'] ) && $electrician_options['electrician_is_cart_in_all_page'] != 1 ) { ?>
						<?php if ( class_exists( 'woocommerce' ) ) { ?>
					<div class="header-cart tt-obj tt-obj-cart js-dropdown-cart">
						<a href="<?php echo esc_js( 'javascript:void(0)' ); ?>" class="tt-obj__btn cart-contents">
							<i class="icon-808584"></i>
							<?php
							$count = WC()->cart->cart_contents_count;
							if ( $count > 0 ) {
								?>
							<div class="tt-obj__badge cart-contents-count"><?php echo esc_html( $count ); ?></div>
							<?php } ?>
						</a>
						<div class="tt-obj__dropdown header-cart-dropdown">
							<?php wc_get_template_part( 'cart/mini', 'cart' ); ?>
						</div>
					</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- /holder-top (desktop) -->
	<!-- holder- -->

	<div id="js-init-sticky">
		<div class="tt-holder-wrapper">
			<div class="container container-lg-fluid">
				<div class="tt-holder">
					<div class="tt-col-logo">
						<!-- logo -->
						<?php
						if ( isset( $electrician_options['electrician-logo']['url'] ) && $electrician_options['electrician-logo']['url'] ) {
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tt-logo tt-logo-alignment">
							<?php if ( isset( $electrician_options['electrician-bolt-animation']['url'] ) && $electrician_options['electrician-bolt-animation']['url'] ) { ?>
								<span class="tt-icon"><img src="<?php echo esc_url( $electrician_options['electrician-bolt-logo']['url'] ); ?>" alt="<?php esc_attr_e( 'Logo Icon', 'electrician' ); ?>">
								</span>
								<?php } ?>
								<img src="<?php echo esc_url( $electrician_options['electrician-logo']['url'] ); ?>" alt="<?php esc_attr_e( 'Logo', 'electrician' ); ?>">
							</a>
						<?php } else { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tt-logo tt-logo-alignment">
							<?php if ( isset( $electrician_options['electrician-bolt-animation']['url'] ) && $electrician_options['electrician-bolt-animation']['url'] ) { ?>
							<span class="tt-icon"><img src="<?php echo esc_url( $electrician_options['electrician-bolt-logo']['url'] ); ?>" alt="<?php esc_attr_e( 'Logo', 'electrician' ); ?>"></span>
						<?php } else { ?>
							<span class="tt-icon"><img src="<?php echo ELECTRICITY_IMG_URL; ?>logo2.png" alt="<?php esc_attr_e( 'Logo icon', 'electrician' ); ?>"></span>
						<?php } ?>
							<?php esc_html_e( 'Electrician', 'electrician' ); ?></a>
						<?php } ?>

						<!-- /logo -->
					</div>
					<div class="tt-col-objects tt-col-wide text-center">
						<!-- desktop-nav -->
						<nav id="tt-nav">
						<?php
						if ( has_nav_menu( 'primary-menu' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'primary-menu',
									'menu_class'     => 'nav navbar-nav',
									'container'      => 'ul',
									'walker'         => new Walker_Electricity_Menu(),
								)
							);
						} else {
							wp_nav_menu(
								array(
									'menu_class' => 'nav navbar-nav',
									'container'  => 'ul',
									'walker'     => new Walker_Electricity_Menu(),
								)
							);
						}
						?>
						</nav>
						<!-- /desktop-nav -->
					</div>
					<div class="tt-col-objects">
					<?php if ( isset( $electrician_options['electrician_is_cart_in_all_page'] ) && $electrician_options['electrician_is_cart_in_all_page'] != 1 ) { ?>
						<?php if ( class_exists( 'woocommerce' ) ) { ?>
						<div class="tt-col__item d-block d-lg-none">
							<div class="header-cart tt-obj tt-obj-cart js-dropdown-cart">
								<a href="<?php echo esc_js( 'javascript:void(0)' ); ?>" class="tt-obj__btn cart-contents">
									<i class="icon-808584"></i>
							<?php
							$count = WC()->cart->cart_contents_count;
							if ( $count > 0 ) {
								?>
									<div class="tt-obj__badge cart-contents-count"><?php echo esc_html( $count ); ?></div>
							<?php } ?>
								</a>
								<div class="tt-obj__dropdown header-cart-dropdown">
							<?php wc_get_template_part( 'cart/mini', 'cart' ); ?>
								</div>
							</div>
						</div>
						<?php } ?>
					<?php } ?>
						<div class="tt-col__item d-block d-lg-none">
							<a href="#" id="tt-menu-toggle" class="icon-545705"></a>
						</div>
						<?php if ( isset( $electrician_options['electrician-header-button'] ) && $electrician_options['electrician-header-button'] ) { ?>
						<div class="tt-col__item d-none d-lg-block">
							<?php if ( isset( $electrician_options['electrician_modal_link'] ) && $electrician_options['electrician_modal_link'] ) { ?>
							<a href="<?php echo esc_url( $electrician_options['electrician_modal_link'] ); ?>" target='_blank' class="tt-btn btn__color01">
							<?php } else { ?>
								<a href="#" class="tt-btn btn__color01" data-toggle="modal" data-target="#modalMakeAppointment">
							<?php } ?>	
								<?php if ( ! empty( $electrician_options['electrician-site-wide-icon'] ) ) { ?>
								<span class="icon-sitewide"><?php echo wp_kses_post( $electrician_options['electrician-site-wide-icon'] ); ?></span>
								<?php } else { ?>
								<span class="icon-lightning"></span>
								 <?php } ?>
								 <?php echo esc_html( $electrician_options['electrician-header-button'] ); ?>
							</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</header>
