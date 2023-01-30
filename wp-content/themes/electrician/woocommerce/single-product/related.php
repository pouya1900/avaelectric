<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$electrician_option = electrician_options();
$theme = $electrician_option['electrician_demo_select'];
if ( $theme == '2' ) { 
	if ( $related_products ) : ?>

		<div class="section-indent">
		<div class="container container-lg-fluid">
			<?php
			$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Similar <span class="color">Products</span>', 'electrician' ) );
	
			if ( $heading ) :
				?>
				<div class="section-title"><div class="section-title__02"><?php echo wp_kses_post( $heading ); ?></div></div>
			<?php endif; ?>
	
			<div
                        class="carusel-product js-carusel-product slick-type01"
                        data-slick='{
						"slidesToShow": 4,
						"slidesToScroll": 1,
						"autoplaySpeed": 3500,
						"responsive": [
							{
								"breakpoint": 767,
								"settings": {
									"slidesToShow": 3,
									"slidesToScroll": 1
								}
							},
							{
								"breakpoint": 576,
								"settings": {
									"slidesToShow": 2,
									"slidesToScroll": 1
								}
							}
						]
				}'
                    >
	
				<?php foreach ( $related_products as $related_product ) : ?>
	
					<?php
						 $post_object = get_post( $related_product->get_id() );
	
						setup_postdata( $GLOBALS['post'] =& $post_object );
	
						wc_get_template_part( 'content', 'product' ); ?>
	
				<?php endforeach; ?>
	
				</div>
	
			</div>
	
	<?php endif;
}else{
if ( $related_products ) : ?>

	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Similar <span class="color">Products</span>', 'electrician' ) );

		if ( $heading ) :
			?>
			<h2 class="h-lg text-center"><?php echo wp_kses_post( $heading ); ?></h2>
		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;
}
wp_reset_postdata();
