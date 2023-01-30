<?php
add_action( 'init', 'electrician_demo_2_helper' );

function electrician_demo_2_helper() {

	global $electrician_option;

	$theme = isset( $electrician_option['electrician_demo_select'] ) ? $electrician_option['electrician_demo_select'] : 1;
	if ( $theme == '2' ) {
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

		add_action( 'woocommerce_shop_loop_item_title', 'electrician_shop_loop_item_title', 4 );

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart' );

		function electrician_shop_loop_item_title() {
			global $product;
			$link  = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
			$title = apply_filters( 'woocommerce_loop_product_title', get_the_title(), $product );
			?>
		<h2 class="tt-product__title"><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a></h2>
			<?php
		}
		add_action( 'woocommerce_before_main_content', 'electrician_before_main_content', 5 );
		function electrician_before_main_content() {
			global $electrician_option;
			if ( isset( $electrician_option['electrician_breadcrumb_bg']['url'] ) && ! empty( $electrician_option['electrician_breadcrumb_bg']['url'] ) ) {
				$breadcrumb_bg = $electrician_option['electrician_breadcrumb_bg']['url'];
			}

			if ( ! is_home() && ! is_front_page() ) {

				?>
		
		<div class="tt-breadcrumb" style="background-image: url(<?php echo esc_url( $breadcrumb_bg ); ?>)">
		<div class="container container-lg-fluid">
		<div class="breadcrumb-area">
				<?php woocommerce_breadcrumb(); ?>
		</div></div></div>
		
		<!--End Banner Section -->
				<?php
			}
		}

		add_filter( 'widget_tag_cloud_args', 'electrician_tag_cloud_widget' );
		function electrician_tag_cloud_widget() {
			$tag_args = array(
				'format' => 'list',
				'echo'   => false,
			);
			return $tag_args;
		}
	}
}


