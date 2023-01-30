<?php
$electrician_options = electrician_options();

$addSticky = '';

if ( isset( $electrician_options['electrician-site-sticky'] ) && $electrician_options['electrician-site-sticky'] ) {
	$addSticky = 'sticky';
}?>
  <header class="page-header <?php echo esc_attr( $addSticky ); ?>">

 <?php if ( isset( $electrician_options['electrician-display-header-mobile-contact-text'] ) && $electrician_options['electrician-display-header-mobile-contact-text'] ) { ?>
		<div class="header-info-mobile">
		  <!-- update header left -->
		<?php
		if ( isset( $electrician_options['electrician-header-mobile-contact-text'] ) && $electrician_options['electrician-header-mobile-contact-text'] ) {
			echo wp_kses_post( $electrician_options['electrician-header-mobile-contact-text'] );
		}
		?>

		<?php if ( isset( $electrician_options['electrician-display-header-social'] ) && $electrician_options['electrician-display-header-social'] ) { ?>
				<div class="social-links">
				  <ul>
			<?php
			if ( isset( $electrician_options['electrician-header-twitter'] ) && ! empty( $electrician_options['electrician-header-twitter'] ) ) {
				?>
					<li>
					  <a target="_blank" class="icon icon-twitter" href="<?php echo esc_url( $electrician_options['electrician-header-twitter'] ); ?>"></a>
					</li>
				<?php
			}
			if ( isset( $electrician_options['electrician-header-facebook'] ) && ! empty( $electrician_options['electrician-header-facebook'] ) ) {
				?>
					<li>
					  <a target="_blank" class="icon icon-facebook" href="<?php echo esc_url( $electrician_options['electrician-header-facebook'] ); ?>"></a>
					</li>
				<?php
			}
			if ( isset( $electrician_options['electrician-header-instagram'] ) && ! empty( $electrician_options['electrician-header-instagram'] ) ) {
				?>
					<li>
					  <a target="_blank" class="icon icon-instagram" href="<?php echo esc_url( $electrician_options['electrician-header-instagram'] ); ?>"></a>
					</li>
			<?php } ?>
			<?php
			if ( isset( $electrician_options['electrician-header-google-plus'] ) && ! empty( $electrician_options['electrician-header-google-plus'] ) ) {
				?>
					<li>
					  <a target="_blank" class="icon icon-google-plus" href="<?php echo esc_url( $electrician_options['electrician-header-google-plus'] ); ?>"></a>
					</li>
			<?php } ?>

			<?php
			if ( isset( $electrician_options['electrician-header-linkedin'] ) && ! empty( $electrician_options['electrician-header-linkedin'] ) ) {
				?>
					<li>
					  <a target="_blank" class="icon icon-linkedin" href="<?php echo esc_url( $electrician_options['electrician-header-linkedin'] ); ?>"></a>
					</li>
			<?php } ?>

			<?php
			if ( isset( $electrician_options['electrician-header-tumblr'] ) && ! empty( $electrician_options['electrician-header-tumblr'] ) ) {
				?>
					<li>
					  <a target="_blank" class="icon icon-tumblr" href="<?php echo esc_url( $electrician_options['electrician-header-tumblr'] ); ?>"></a>
					</li>
			<?php } ?>
			<?php
			if ( isset( $electrician_options['electrician-header-youtube'] ) && ! empty( $electrician_options['electrician-header-youtube'] ) ) {
				?>
					<li>
					  <a target="_blank" class="icon icon-youtube" href="<?php echo esc_url( $electrician_options['electrician-header-youtube'] ); ?>"></a>
					</li>
			<?php } ?>
				  </ul>
				</div>
		<?php } ?>
		<?php get_sidebar( 'header-left' ); ?>
		<?php get_sidebar( 'header-right' ); ?>
		</div>
	<div class="header-info-toggle js-info-toggle"><i class="icon-arrow_right"></i></div>
 <?php } ?>

	<nav class="navbar" id="slide-nav">
	  <div class="container">
		<div class="navbar-header">
		  <div class="header-top">
			<div class="row">
			  <div class="col-sm-4 visible-lg visible-md">
				<!-- update header left -->
				<?php
				if ( isset( $electrician_options['electrician-display-header-left'] ) && $electrician_options['electrician-display-header-left'] ) {
					echo wp_kses_post( $electrician_options['electrician-header-left-text'] );
				}
				?>
				<?php if ( isset( $electrician_options['electrician-display-header-social'] ) && $electrician_options['electrician-display-header-social'] ) { ?>
				<div class="social-links">
				  <ul>
					<?php
					if ( isset( $electrician_options['electrician-header-twitter'] ) && ! empty( $electrician_options['electrician-header-twitter'] ) ) {
						?>
					<li>
					  <a target="_blank" class="icon icon-twitter" href="<?php echo esc_url( $electrician_options['electrician-header-twitter'] ); ?>"></a>
					</li>
						<?php
					}
					if ( isset( $electrician_options['electrician-header-facebook'] ) && ! empty( $electrician_options['electrician-header-facebook'] ) ) {
						?>
					<li>
					  <a target="_blank" class="icon icon-facebook" href="<?php echo esc_url( $electrician_options['electrician-header-facebook'] ); ?>"></a>
					</li>
						<?php
					}
					if ( isset( $electrician_options['electrician-header-instagram'] ) && ! empty( $electrician_options['electrician-header-instagram'] ) ) {
						?>
					<li>
					  <a target="_blank" class="icon icon-instagram" href="<?php echo esc_url( $electrician_options['electrician-header-instagram'] ); ?>"></a>
					</li>
					<?php } ?>
					<?php
					if ( isset( $electrician_options['electrician-header-google-plus'] ) && ! empty( $electrician_options['electrician-header-google-plus'] ) ) {
						?>
					<li>
					  <a target="_blank" class="icon icon-google-plus" href="<?php echo esc_url( $electrician_options['electrician-header-google-plus'] ); ?>"></a>
					</li>
					<?php } ?>

					<?php
					if ( isset( $electrician_options['electrician-header-linkedin'] ) && ! empty( $electrician_options['electrician-header-linkedin'] ) ) {
						?>
					<li>
					  <a target="_blank" class="icon icon-linkedin" href="<?php echo esc_url( $electrician_options['electrician-header-linkedin'] ); ?>"></a>
					</li>
					<?php } ?>

					<?php
					if ( isset( $electrician_options['electrician-header-tumblr'] ) && ! empty( $electrician_options['electrician-header-tumblr'] ) ) {
						?>
					<li>
					  <a target="_blank" class="icon icon-tumblr" href="<?php echo esc_url( $electrician_options['electrician-header-tumblr'] ); ?>"></a>
					</li>
					<?php } ?>
					<?php
					if ( isset( $electrician_options['electrician-header-youtube'] ) && ! empty( $electrician_options['electrician-header-youtube'] ) ) {
						?>
					<li>
					  <a target="_blank" class="icon icon-youtube" href="<?php echo esc_url( $electrician_options['electrician-header-youtube'] ); ?>"></a>
					</li>
					<?php } ?>
				  </ul>
				</div>
				<?php } ?>
				<?php get_sidebar( 'header-left' ); ?>
			  </div>
			  <div class="col-sm-4 text-center">
				<?php if ( isset( $electrician_options['electrician-logo']['url'] ) && $electrician_options['electrician-logo']['url'] ) { ?>
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $electrician_options['electrician-logo']['url'] ); ?>" alt="<?php esc_html_e( 'Logo', 'electrician' ); ?>">
					<?php if ( ! isset( $electrician_options['electrician-bolt-animation'] ) || $electrician_options['electrician-bolt-animation'] ) { ?>
						<span><img src="<?php echo esc_url( $electrician_options['electrician-bolt-logo']['url'] ); ?>" alt="<?php esc_attr_e( 'Electrician', 'electrician' ); ?>"></span>
					<?php } ?>
					</a>
				</div>
				<?php } ?>
			  </div>
			  <div class="col-sm-4">
				  <div class="header-right-bottom">
					<?php if ( isset( $electrician_options['electrician_is_cart_in_all_page'] ) && $electrician_options['electrician_is_cart_in_all_page'] != 1 ) { ?>
						<?php
						if ( class_exists( 'woocommerce' ) ) {
							if ( isset( $electrician_options['electrician_is_cart_in_home'] ) && $electrician_options['electrician_is_cart_in_home'] == 1 ) {

								?>


					  <!-- start mini  cart-->
					  <div class="header-cart">
								<?php
								$count = WC()->cart->cart_contents_count;
								?>
			<a class="cart-contents icon icon-shopping-cart" href="<?php echo esc_js( 'javascript:void(0)' ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'electrician' ); ?>">
								<?php
								if ( $count > 0 ) {
									?>
							  <span class="badge cart-contents-count"><?php echo esc_html( $count ); ?></span>
															   <?php
								}
								?>
							</a>

							<div class="header-cart-dropdown">
								<?php get_template_part( 'woocommerce/cart/mini', 'cart' ); ?>
							</div>
					  </div>
					  <!--stop mini cart-->

								<?php
							} else {
								?>
				<!-- start mini  cart-->
				<div class="header-cart">
								<?php
								$count = WC()->cart->cart_contents_count;
								?>
		<a class="cart-contents icon icon-shopping-cart" href="<?php echo esc_js( 'javascript:void(0)' ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'electrician' ); ?>">
								<?php
								if ( $count > 0 ) {
									?>
						<span class="badge cart-contents-count"><?php echo esc_html( $count ); ?></span>
									   <?php
								}
								?>
					  </a>

					  <div class="header-cart-dropdown">
								<?php get_template_part( 'woocommerce/cart/mini', 'cart' ); ?>
					  </div>
				</div>
				<!--stop mini cart-->
								<?php
							}
						}
					}
					?>
					  <?php if ( isset( $electrician_options['electrician-display-header-contact-text'] ) && $electrician_options['electrician-display-header-contact-text'] ) { ?>
					  <div class="phone visible-lg visible-md">
							<?php
							if ( isset( $electrician_options['electrician-header-contact-text'] ) && $electrician_options['electrician-header-contact-text'] ) {
								echo wp_kses_post( $electrician_options['electrician-header-contact-text'] );
							}
							?>
					  </div>
					  <?php } ?>
				  </div>
				   <?php get_sidebar( 'header-right' ); ?>
				</div>
			  </div>
			  </div>

			<button type="button" class="navbar-toggle"><i class="icon icon-interface icon-menu"></i></button>
		  </div>

		<div id="slidemenu" data-hover="dropdown" data-animations="fadeIn">
		<button type="button" class="navbar-toggle"><i class="icon icon-cancel"></i></button>
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
		</div>
	  </div>
	  </div>
	</nav>
  </header>
