<?php
$electrician_options = electrician_options();
$theme               = $electrician_options['electrician_demo_select'];
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	?>
<!-- Footer -->
	<?php if ( $theme == '2' ) { ?>
<footer id="tt-footer">
	<div class="footer-wrapper">
		<?php if ( isset( $electrician_options['electrician_footer_subscribe'] ) && ! empty( $electrician_options['electrician_footer_subscribe'] ) ) { ?>
	<div class="container container-lg-fluid container-lg__no-gutters">
			<?php echo do_shortcode( $electrician_options['electrician_footer_subscribe'] ); ?>
	</div>
	<?php } ?>
	<div class="container container-lg-fluid container-lg__no-gutters">
		<div class="f-holder row no-gutters">
			<div class="col-xl-7">
				<div class="additional-strut">
					<div class="row">
						<div class="col-xl-5">
							<div class="f-logo">
								<?php if ( ! empty( $electrician_options['electrician-ft-logo']['url'] ) ) { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="f-logo">
										<img src="<?php echo esc_url( $electrician_options['electrician-ft-logo']['url'] ); ?>" alt="<?php esc_html_e( 'logo', 'electrician' ); ?>">
									</a>
								<?php } else { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="f-logo"><span class="tt-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-dark.png" alt="<?php esc_html_e( 'logo', 'electrician' ); ?>"></span><span class="tt-text"><?php esc_html_e( 'Electrician', 'electrician' ); ?></span></a>
								<?php } ?>
								<!-- /logo -->
							</div>
						</div>
						<?php if ( isset( $electrician_options['electrician_footer_desc'] ) && ! empty( $electrician_options['electrician_footer_desc'] ) ) { ?>
						<div class="col-xl-7">
							<div class="f-info-text">
								<?php echo wp_kses_post( $electrician_options['electrician_footer_desc'] ); ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<?php
					if ( is_active_sidebar( 'footer_col_1' ) ) {
						?>
					<div class="col-sm-6 col-md-5">
						<?php dynamic_sidebar( 'footer_col_1' ); ?>
					</div>
					<?php } ?>
						<?php
						if ( is_active_sidebar( 'footer_col_2' ) ) {
							?>
					<div class="col-sm-6 col-md-7">
							<?php dynamic_sidebar( 'footer_col_2' ); ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php if ( is_active_sidebar( 'footer_col_3' ) ) { ?>
		<div id="map">
			<?php dynamic_sidebar( 'footer_col_3' ); ?>
		</div>
		<?php } ?>
		<div class="f-copyright row no-gutters">
			<?php if ( isset( $electrician_options['electrician_footer_copyright_text'] ) && ! empty( $electrician_options['electrician_footer_copyright_text'] ) ) { ?>
			<div class="col-sm-auto"> <?php echo wp_kses_post( $electrician_options['electrician_footer_copyright_text'] ); ?></div>
		<?php } ?>
			<?php if ( isset( $electrician_options['electrician_footer_social_link'] ) && ! empty( $electrician_options['electrician_footer_social_link'] ) ) { ?>
			<div class="col-sm-auto ml-sm-auto">
				<ul class="f-social">
					<?php echo wp_kses_post( $electrician_options['electrician_footer_social_link'] ); ?>
				</ul>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
</footer>
			<?php if ( isset( $electrician_options['electrician-scroll-to-top'] ) && $electrician_options['electrician-scroll-to-top'] ) { ?>
			<a href="<?php echo esc_url( '#' ); ?>" id="js-backtotop" class="tt-back-to-top">
				<?php if ( isset( $electrician_options['electrician-scroll-to-top-image'] ) && $electrician_options['electrician-scroll-to-top-image']['url'] ) { ?>
				<img src="<?php echo esc_url( $electrician_options['electrician-scroll-to-top-image']['url'] ); ?>" >
			<?php } else { ?>
				<i class="icon-lightning"></i>
		<?php } ?>
	</a>
<?php } ?>
		<?php } else { ?>
	<div class="page-footer">
		<?php if ( isset( $electrician_options['electrician-scroll-to-top'] ) && $electrician_options['electrician-scroll-to-top'] ) { ?>
			<div class="back-to-top">
				<a href="<?php echo esc_url( '#' ); ?>" title="To Top">
					<?php if ( isset( $electrician_options['electrician-scroll-to-top-image'] ) && $electrician_options['electrician-scroll-to-top-image']['url'] ) { ?>
						<img src="<?php echo esc_url( $electrician_options['electrician-scroll-to-top-image']['url'] ); ?>" >
					<?php } else { ?>
							<span class="icon icon-lightning"></span>
					<?php } ?>
				</a>
			</div>
		<?php } ?>
		<?php get_sidebar( 'footer-top' ); ?>
		<div class="container">
			<div class="row footer-row">
		<?php
		if ( is_active_sidebar( 'footer_col_1' ) ) {
			?>
				<div class="col-sm-3 col-lg-3 hidden-xs-content">
			<?php dynamic_sidebar( 'footer_col_1' ); ?>
				</div>
		<?php } ?>
		<?php if ( is_active_sidebar( 'footer_col_2' ) ) { ?>
				<div class="col-sm-4">
			<?php dynamic_sidebar( 'footer_col_2' ); ?>
				</div>
		<?php } ?>
		<?php if ( is_active_sidebar( 'footer_col_3' ) ) { ?>
				<div class="col-sm-5">
			<?php dynamic_sidebar( 'footer_col_3' ); ?>
				</div>
		<?php } ?>
		<?php
		if ( is_active_sidebar( 'footer_col_1' ) ) {
			?>
				<div class="visible-xs text-center">
			<?php dynamic_sidebar( 'footer_col_1' ); ?>
				</div>
		<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<!-- //Footer -->
	<?php } ?>
<?php wp_footer(); ?>
</body>
</html>
