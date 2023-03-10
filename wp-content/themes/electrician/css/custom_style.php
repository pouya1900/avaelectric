<?php
/*
 * print css with cheking value is empty or not
 *
 */
function electrician_print_css( $props = '', $values = array(), $vkey = '', $pre_fix = '', $post_fix = '' ) {
	if ( isset( $values[ $vkey ] ) && ! empty( $values[ $vkey ] ) ) {
		print wp_kses_post( $props . ':' . $pre_fix . $values[ $vkey ] . $post_fix . ";\n" );
	}

}

function electrician_hex2rgb( $hex ) {
	$hex = str_replace( '#', '', $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );
	// return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}
function electrician_color_brightness( $colourstr, $steps, $darken = false ) {
	$colourstr = str_replace( '#', '', $colourstr );
	$rhex      = substr( $colourstr, 0, 2 );
	$ghex      = substr( $colourstr, 2, 2 );
	$bhex      = substr( $colourstr, 4, 2 );

	$r = hexdec( $rhex );
	$g = hexdec( $ghex );
	$b = hexdec( $bhex );

	if ( $darken ) {
		$steps = $steps * -1;
	}

	$r = max( 0, min( 255, $r + $steps ) );
	$g = max( 0, min( 255, $g + $steps ) );
	$b = max( 0, min( 255, $b + $steps ) );

	$hex  = '#';
	$hex .= str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
	$hex .= str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
	$hex .= str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

	return $hex;
}

function electrician_get_custom_styles() {
	global $electrician_option;
	$electrician_colors = get_theme_mod( 'electrician_colors', array() );
	$electrician_css    = get_theme_mod( 'electrician_css', array() );

	ob_start();
	?>

	/*body*/
	body,.modal-content{
	<?php
	if ( isset( $electrician_option['electrician-body-typography'] ) ) {
		electrician_print_css( 'font-family', $electrician_option['electrician-body-typography'], 'font-family' );
		electrician_print_css( 'font-weight', $electrician_option['electrician-body-typography'], 'font-weight' );
		electrician_print_css( 'font-size', $electrician_option['electrician-body-typography'], 'font-size' );
		electrician_print_css( 'line-height', $electrician_option['electrician-body-typography'], 'line-height' );
		electrician_print_css( 'color', $electrician_option['electrician-body-typography'], 'color' );
		electrician_print_css( 'background-color', $electrician_colors, 'body_color' );
	}
	?>
	}
	h1, h2, h3, h4, h5, h6{
	<?php
	if ( isset( $electrician_option['electrician-heading-typography'] ) ) {
		electrician_print_css( 'font-family', $electrician_option['electrician-heading-typography'], 'font-family' );
	}
	?>
	}

 /*-------- 1.2 Page Preloader    --------*/

	<?php if ( isset( $electrician_colors['preloader_border_color'] ) && $electrician_colors['preloader_border_color'] ) { ?>
.loader .bolt{
		<?php electrician_print_css( 'border-bottom', $electrician_colors, 'preloader_border_color', '55px solid ', '', '!important' ); ?>
}
.loader .one .other,.loader .three .other{
		<?php electrician_print_css( 'border-top', $electrician_colors, 'preloader_border_color', '55px solid ', '', '!important' ); ?>
}





.loader .two {
  border-bottom: 55px solid #FEFEFE;
  transform: translateY(-7px);
  animation: orangeb 0.7s linear infinite;
}
.loader .two .other {
  border-top: 55px solid #FEFEFE;
  animation: oranget 0.7s linear infinite;
}


@-webkit-keyframes orangeb {
  to {
		<?php electrician_print_css( 'border-bottom-color', $electrician_colors, 'preloader_border_color', '', '', '!important' ); ?>
  }
}
@keyframes orangeb {
  to {
		<?php electrician_print_css( 'border-bottom-color', $electrician_colors, 'preloader_border_color', '', '', '!important' ); ?>
  }
}


@keyframes oranget {
	to {
		<?php electrician_print_css( 'border-top-color', $electrician_colors, 'preloader_border_color', '', '', '!important' ); ?>
	}
}
@-webkit-keyframes oranget {
  to {
		<?php electrician_print_css( 'border-top-color', $electrician_colors, 'preloader_border_color', '', '', '!important' ); ?>

  }
}
	<?php } ?>

/*anchor*/
dl dd a,
a {
	<?php electrician_print_css( 'color', $electrician_colors, 'link_color' ); ?>
}


a:hover,h1 a:hover, h2 a:hover,.column-right .side-block ul li a:hover{
	<?php electrician_print_css( 'color', $electrician_colors, 'link_hover_color' ); ?>
}
/*heading*/
h1, h2, h3, h4, h5, h6 ,h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,header .phone .number,.news-preview-link:hover{
	  <?php electrician_print_css( 'color', $electrician_colors, 'heading_color' ); ?>
}

h1 b, h2 b,.marker-list > li:after,.contact-box [class*='icon-'],.testimonials-box-title:after,
.bulb-block .bulb-block-title b,.page-footer .contact-list li b,.color-txt{
	  <?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tags-list li a, .tagcloud > a{
	  <?php electrician_print_css( 'color', $electrician_colors, 'tags_color' ); ?>
	  <?php electrician_print_css( 'border', $electrician_colors, 'tags_border_color', '1px solid' ); ?>
}
@media (max-width: 479px) {
  .news-preview{
	<?php electrician_print_css( 'border-top', $electrician_colors, 'tags_border_color', '4px solid' ); ?>
  }
}
.news-preview-text{
	<?php electrician_print_css( 'border-top', $electrician_colors, 'tags_border_color', '4px solid' ); ?>
}
.counter-box.counted .decor{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_bg_color' ); ?>
}
.tags-list li a:hover{
	  <?php electrician_print_css( 'color', $electrician_colors, 'tags_hover_color' ); ?>
	  <?php electrician_print_css( 'background-color', $electrician_colors, 'tags_bg_color' ); ?>
}

.skew-wrapper .straight .title,.block.bg-dark p,
.block.bg-dark h1, .block.bg-dark h2, .block.bg-dark h3,.testimonials h2,
.testimonials-item .testimonials-text,.testimonials-item .testimonials-username {
	  <?php electrician_print_css( 'color', $electrician_colors, 'title_color' ); ?>
}
header.page-, ''header {
	  <?php electrician_print_css( 'background-color', $electrician_colors, 'header_bg_color' ); ?>
}
header .phone .number .icon,.marker-list > li:after,
.icn-list li [class*='icon'],
.column-right .side-block ul li:after,.address-block .icon{
	  <?php electrician_print_css( 'color', $electrician_colors, 'header_icon_color' ); ?>
}
body, .text-icon-title,.text-icon-text{
	  <?php electrician_print_css( 'color', $electrician_colors, 'theme_text_color' ); ?>
}
.social-links ul li a{
	  <?php electrician_print_css( 'color', $electrician_colors, 'social_icon_color' ); ?>
}
header .social-links ul li a:hover{
	  <?php electrician_print_css( 'color', $electrician_colors, 'social_icon_hover_color' ); ?>
}

/*menu*/

@media (min-width: 768px){
#slidemenu {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'menu_bg_color' ); ?>
}
.page-header.is-sticky {
	<?php electrician_print_css( 'background', $electrician_colors, 'menu_bg_color' ); ?>
}
.navbar-nav > li > a{
	<?php electrician_print_css( 'color', $electrician_colors, 'menu_link_color' ); ?>
}
.navbar-nav > li > a:hover, .navbar-nav > li > a:focus,
.navbar-nav li.current-menu-item a{
	<?php electrician_print_css( 'color', $electrician_colors, 'menu_link_hover_color' ); ?>
}
.electric-btn:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'menu_link_hover_color' ); ?>
}
.dropdown-menu{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'dropdown_menu_bg_color' ); ?>
}
.navbar-nav .dropdown .dropdown-menu li > a{
	<?php electrician_print_css( 'color', $electrician_colors, 'submenu_link_color' ); ?>
}
.navbar-nav .dropdown .dropdown-menu li > a:hover{
	<?php electrician_print_css( 'color', $electrician_colors, 'submenu_link_hover_color' ); ?>
}
}

/*slider*/

.nivo-caption{
	<?php electrician_print_css( 'color', $electrician_colors, 'nivo_slider_color' ); ?>
}
.theme-default .nivo-directionNav a {
	<?php electrician_print_css( 'color', $electrician_colors, 'nivo_slider_navigation_color' ); ?>
}
@media (max-width: 767px) {

	.service-23-mobile .slick-dots li.slick-active button:after{
		<?php electrician_print_css( 'background', $electrician_colors, 'slider_pagi_color' ); ?>
	}
}
.work-categories-slide .slick-dots li.slick-active button:after, .slick-dots li.slick-active button:after, .slick-dots li.slick-active button:hover:after{
	 <?php electrician_print_css( 'background', $electrician_colors, 'slider_pagi_color' ); ?>
}

.blog-post .post-quote p:after, .blog-post .post-quote p:before,
.testimonials-carousel.slick-slider:before,
.testimonials-carousel.slick-slider:after,
.slick-dots li.slick-active button:after,
.slick-dots li.slick-active button:hover:after,
.block .testimonials .slick-dots li.slick-active button:after,
.block .testimonials .slick-dots li.slick-active button:hover:after{
	<?php electrician_print_css( 'color', $electrician_colors, 'slider_pagi_color' ); ?>
}
.work-categories-slide .slick-dots li.slick-active button:after, .block .testimonials .slick-dots li.slick-active button:after, .block .testimonials .slick-dots li.slick-active button:hover:after,
.slick-dots li.slick-active button:after,
.slick-dots li.slick-active button:hover:after,.block .counter-carousel .slick-dots li.slick-active button::after{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'slider_pagi_bg_color' ); ?>
}

/*Button*/

.btn, .search-submit,.request-form h4,.blog-post .post-date,
.comment-form .form-submit .submit,.post-date a,.maintenence-free .btn-invert:hover,
.big-button .services-btn-full .btn-invert,.tagcloud > a:hover,
.bg-dark .btn.btn-invert:hover{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_bg_color' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'button_text_color' ); ?>

}
.services-btn-full .btn-invert{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_bg_color' ); ?>
	<?php electrician_print_css( 'border', $electrician_colors, 'button_bg_color', '1px solid ', '', '!important' ); ?>
}
.services-btn-full .btn-invert:hover i{
	<?php electrician_print_css( 'color', $electrician_colors, 'button_bg_color', '', '', '!important' ); ?>
}
.btn:hover, .btn.active, .btn:active, .btn.focus, .btn:focus,.btn-invert .icon{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_bg_hover_color' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'button_hover_text_color' ); ?>
}

.maintenence-free .btn-invert{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_text_black_bg_color' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'button_text_black_color' ); ?>
}

.btn:hover .icon, .btn.active .icon, .btn:active .icon, .btn.focus .icon, .btn:focus .icon,
.text-icon-icon span .icon,.news-preview-link,.text-icon-sm-icon span .icon,.maintenence-free .btn-invert i
{
	<?php electrician_print_css( 'color', $electrician_colors, 'icon_hover_color' ); ?>
}
.text-icon:hover .icon{
	<?php electrician_print_css( 'color', $electrician_colors, 'service_icon_hover_color' ); ?>
}
.text-icon-icon .icon-hover ,.text-icon:hover .icon-hover,.text-icon-sm-icon .icon-hover{
	<?php
	if ( isset( $electrician_colors['service_icon_hover_bg_color'] )
		&& isset( $electrician_colors['service_icon_hover_bg_color2'] )
		&& $electrician_colors['service_icon_hover_bg_color']
		&& $electrician_colors['service_icon_hover_bg_color2']
	) {
		echo 'background-color:' . $electrician_colors['service_icon_hover_bg_color'] . ";\n";
		echo 'background: -webkit-gradient(linear, left top, left bottom, from(' . $electrician_colors['service_icon_hover_bg_color'] . '), to(' . $electrician_colors['service_icon_hover_bg_color2'] . '));
        background: -webkit-linear-gradient(top, ' . $electrician_colors['service_icon_hover_bg_color'] . ', ' . $electrician_colors['service_icon_hover_bg_color2'] . ');
        background: -moz-linear-gradient(top, ' . $electrician_colors['service_icon_hover_bg_color'] . ', ' . $electrician_colors['service_icon_hover_bg_color2'] . ');
        background: -ms-linear-gradient(top, ' . $electrician_colors['service_icon_hover_bg_color'] . ', ' . $electrician_colors['service_icon_hover_bg_color2'] . ');
        background: -o-linear-gradient(top, ' . $electrician_colors['service_icon_hover_bg_color'] . ', ' . $electrician_colors['service_icon_hover_bg_color2'] . ');' . "\n";

	} elseif ( isset( $electrician_colors['service_icon_hover_bg_color'] ) && $electrician_colors['service_icon_hover_bg_color'] ) {
		echo 'background:' . $electrician_colors['service_icon_hover_bg_color'] . ";\n";
	}
	?>
}
.btn-border{
	<?php electrician_print_css( 'border', $electrician_colors, 'button_border_color', '1px solid', '' ); ?>
}

/*Table color*/
.price-table > tbody > tr.table-header{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'price_table_bg_color', '', '!important' ); ?>
}
.price-table > tbody > tr:nth-of-type(odd){
	<?php electrician_print_css( 'background-color', $electrician_colors, 'price_table_odd_bg_color' ); ?>
}
.price-table > tbody > tr:nth-of-type(even){
	<?php electrician_print_css( 'background-color', $electrician_colors, 'price_table_even_bg_color' ); ?>
}

/*Footer color*/

.page-footer{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'footer_bg_color' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'footer_text_color' ); ?>
}
.page-footer .footer-top{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'footer_top_bg_color' ); ?>
}
.page-footer .copyright,.page-footer .copyright p,.page-footer .social-links ul li a{
	<?php electrician_print_css( 'color', $electrician_colors, 'footer_copyright_color' ); ?>
}
.back-to-top a {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'scroll_to_top' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'scroll_to_top_color' ); ?>
}

.back-to-top a:hover {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'scroll_to_top_hover' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'scroll_to_top_hover_color' ); ?>
}

/*Shop color*/
.woocommerce .product-categories > li:after,.prd-sm-info h3 a:hover,.prd-info h3:hover,
.tabs.wc-tabs li.active a,.header-cart:hover a.icon, .header-cart.opened a.icon{
	<?php electrician_print_css( 'color', $electrician_colors, 'shop_active_color', '', '!important' ); ?>
}
.header-cart .badge,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.wc-tabs > li > a::after{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'shop_active_bg_color' ); ?>
}
.btn.btn-invert.add_to_cart_button,
.btn.btn-invert.product_type_simple,
.header-right-bottom .btn,
.woocommerce button.btn,
.wc-proceed-to-checkout .btn,
.btn.btn-invert.btn-lg.product-block-add-to-cart,
.apply-coupon.btn.btn-invert,
#commentform #submit{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'shop_button_bg_color' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'shop_button_color' ); ?>

}
.btn.btn-invert.add_to_cart_button, .btn.btn-invert.product_type_simple{
	<?php electrician_print_css( 'border', $electrician_colors, 'shop_button_bg_color', '1px solid' ); ?>
}
.btn.btn-invert.add_to_cart_button:hover, .btn.btn-invert.product_type_simple:hover{
	<?php electrician_print_css( 'border', $electrician_colors, 'shop_button_bg_color', '1px solid' ); ?>
}
.btn.btn-invert.add_to_cart_button:hover,
.btn.btn-invert.product_type_simple:hover,
.header-cart-dropdown .buttons .btn:hover,
.woocommerce button.btn:hover,
.wc-proceed-to-checkout .btn:hover,
.btn.btn-invert.btn-lg.product-block-add-to-cart:hover,
#commentform #submit:hover
{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'shop_button_bg_hover_color' ); ?>
	<?php electrician_print_css( 'color', $electrician_colors, 'shop_button_hover_color' ); ?>
}

/*other color*/
.faq-red-head a span:hover,
.electrician-toggle .vc_toggle_title:hover >h4,
.faq-red-head .vc_tta-panel.vc_active a span{
	<?php electrician_print_css( 'color', $electrician_colors, 'faq_items_hover_color' ); ?>
}
.faq-red-head .vc_tta-panel.vc_active a i::before{
	<?php electrician_print_css( 'border-color', $electrician_colors, 'faq_items_hover_color', '', '!important' ); ?>
}
.gallery__item .hover{
	<?php electrician_print_css( 'color', $electrician_colors, 'gallery_item_overly_text_color' ); ?>
}
	<?php if ( isset( $electrician_colors['gallery_item_overly_bg_color'] ) ) { ?>
.gallery__item .hover{
		<?php
		$gallery_overly_bg = electrician_hex2rgb( $electrician_colors['gallery_item_overly_bg_color'] );
		$gallery_overly_bg = implode( ', ', $gallery_overly_bg );
		?>
	 background-color:rgba(<?php print wp_kses_post( $gallery_overly_bg ); ?>,0.8);
}<?php } ?>

.category-image h1,.service-btn:not(.collapsed), .service-btn:hover{
	<?php electrician_print_css( 'color', $electrician_colors, 'services_title_color' ); ?>
	<?php electrician_print_css( 'background-color', $electrician_colors, 'services_title_bg_color' ); ?>
}
.coupon-text-2,.coupon-text-4 b{
	<?php electrician_print_css( 'color', $electrician_colors, 'copoun_highlight_text' ); ?>
}

.pagination .nav-links span.page-numbers.current,
.pagination .nav-links .page-numbers:hover,
.woocommerce-pagination .page-numbers .page-numbers.current,
.woocommerce-pagination .page-numbers .page-numbers:hover{
	<?php electrician_print_css( 'color', $electrician_colors, 'pagi_active_color', '', '!important' ); ?>
	<?php electrician_print_css( 'border', $electrician_colors, 'pagi_active_border_color', '1px solid ', '!important' ); ?>
	<?php electrician_print_css( 'background-color', $electrician_colors, 'pagi_active_bg_color', '', '!important' ); ?>
}
.filters-by-category ul li a:hover,
.filters-by-category ul li a.selected{
	<?php electrician_print_css( 'border-color', $electrician_colors, 'gallery_border_color' ); ?>
}


#header{
	<?php electrician_print_css( 'background-color', $electrician_colors, 'header_bg_color' ); ?>
	<?php
	if ( isset( $electrician_option['electrician_header_bg'] ) ) {
		electrician_print_css( 'background-image', $electrician_option['electrician_header_bg'], 'url', 'url(', ')' );
	}
	?>
}





.h-info01 .tt-item [class^="icon-"] {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.h-info02 .tt-item a {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
@media (min-width: 1025px){
	.tt-obj-cart .tt-obj__btn .tt-obj__badge {
		<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
	}
}
.tt-obj-cart.active .tt-obj__btn {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
@media (min-width: 1025px){
	#tt-nav > ul > li.current_page_item > a {
		<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
	}
}
.order-form .order-form__title {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.section-title .section-title__01 {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-list01 li:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-slideinfo .tt-item__btn a {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-slideinfo .tt-item__btn a::after {
	<?php electrician_print_css( 'background', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-slideinfo .tt-item__btn_link a {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-slideinfo .tt-item__btn_link a::after {
	<?php electrician_print_css( 'background', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-box02 .tt-box02__title a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-box02:hover .tt-box02__img:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-link:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-link [class^="icon-"] {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-base-color {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-box01 .tt-box01__title:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
#filter-nav ul li.active a {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
#filter-nav ul li > a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-box03 .tt-box03__extra {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-box03 .item .tt-item__img:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-layout02 .tt-layout02__icon {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-layout02 .tt-layout02__list li:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.modal-layout-dafault .form-group .form-group__icon {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-video {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
	<?php electrician_print_css( 'border-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-video::after {
	<?php electrician_print_css( 'background', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-news-list .tt-item .tt-item__title:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-news-list .tt-item .tt-item__title a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-news-obj .tt-news-obj__title a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-news-obj .tt-news-obj__title:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.f-form {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-btn.btn__color02 [class^="icon-"] {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.f-nav li:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.f-nav li a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.f-info-icon li [class^=icon] {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.f-social li a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-back-to-top:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-info-value .tt-col-title .tt-title__01 {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-box04 .tt-box04__figure {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-services-promo .tt-wrapper .tt-col-icon {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-box05:hover .tt-box05__title .tt-text-01 {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-info address a {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
#tt-pageContent .tt-obj .tt-obj__title a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-back-to-top:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
	<?php electrician_print_css( 'border-color', $electrician_colors, 'heading_span_color' ); ?>
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-coupons .tt-right-top .tt-title__02 {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-table01 table thead {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.blockquote03:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.blog-obj .blog-obj__title a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.blog-obj .blog-obj__data a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-pagination ul li a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-img-link:hover .tt-text {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-img-link .tt-icon {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.custom-select select:focus {
	<?php electrician_print_css( 'border-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-product .tt-product__title a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-product .tt-btn-addtocart:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-product .tt-btn-addtocart .tt-icon {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.woocommerce .star-rating span::before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.nav-categories li a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.nav-categories li a:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-aside-search02 input:focus {
	<?php electrician_print_css( 'border-color', $electrician_colors, 'heading_span_color' ); ?>
}
td#today {
	<?php electrician_print_css( 'background', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-list02 li a:hover {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-recent-obj .recent-obj__title:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-recent-obj .recent-obj__title a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-faq .tt-item__title:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-contact .tt-icon {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
@media (min-width: 1025px){
	#tt-nav > ul > li > a:hover {
		<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
	}
	#tt-nav > ul > li ul li a:hover {
		<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
	}
	.tt-obj-cart .tt-obj__btn:hover {
		<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
	}
}
.holder-top-mobile .h-topbox__content .tt-item .tt-item__icon {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
@media (max-width: 1024.98px){
	.tt-obj-cart .tt-obj__btn .tt-obj__badge {
		<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
	}
}
.tt-social li a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.personal-info__img::before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>	
}
.submenu-aside .tt-item.tt-item__open .tt-item__title {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.submenu-aside .tt-item .tt-item__title:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.submenu-aside ul li:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>	
}
.submenu-aside ul li a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>	
}
.submenu-aside .tt-item .tt-item__title:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.box-aside-info li [class^="icon-"] {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.blockquote01:before {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.blockquote02:before {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.nav-tabs li a:hover, .nav-tabs li a.active {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.header-right-bottom .btn, .woocommerce button.btn, .wc-proceed-to-checkout .btn {
	<?php electrician_print_css( 'border-color', $electrician_colors, 'heading_span_color' ); ?>
}
#commentform #submit:hover {
	<?php electrician_print_css( 'border-color', $electrician_colors, 'heading_span_color' ); ?>
}
a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}

.tt-btn:hover [class^="icon-"] {
	<?php electrician_print_css( 'color', $electrician_colors, 'button_bg_color' ); ?>
}
.tt-btn.btn__color01 {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_bg_color' ); ?>
	color: #ffffff;
}
.tt-btn:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'button_bg_color' ); ?>
	<?php electrician_print_css( 'border-color', $electrician_colors, 'button_bg_color' ); ?>
	background-color: #fff;
}
.modal .modal-body .close:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-comments-layout .tt-item div[class^="tt-comments-level-"] .tt-content .tt-btn-default {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
	<?php electrician_print_css( 'border-color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-comments-layout .tt-item div[class^="tt-comments-level-"] .tt-content .tt-comments-title .username {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.breadcrumb-area p#breadcrumbs a:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.tt-cart-list .tt-item__remove:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'heading_span_color' ); ?>
}
.woocommerce .product-categories > li:after{
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color', '', '!important' ); ?>
}
a {
	<?php electrician_print_css( 'color', $electrician_colors, 'heading_span_color' ); ?>
}
.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_bg_color' ); ?>
}
.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'button_bg_color' ); ?>
	<?php electrician_print_css( 'border-color', $electrician_colors, 'button_bg_color' ); ?>
}
#commentform #submit {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'button_bg_color' ); ?>
}
#commentform #submit:hover {
	<?php electrician_print_css( 'border-color', $electrician_colors, 'button_bg_color' ); ?>
}
#commentform #submit:hover {
	<?php electrician_print_css( 'color', $electrician_colors, 'button_bg_color' ); ?>
	<?php electrician_print_css( 'border-color', $electrician_colors, 'button_bg_color' ); ?>
}
.woocommerce button.btn, .wc-proceed-to-checkout .btn {
	<?php electrician_print_css( 'border-color', $electrician_colors, 'button_bg_color' ); ?>
}
<!-- section_background_color_change_option_added -->
#tt-footer {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'bg_color' ); ?>
}
.section__wrapper {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'bg_color' ); ?>
}
.order-form .order-form__content {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'bg_color' ); ?>
}
.holder-top-desktop {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'bg_color' ); ?>
}

	<?php

	if ( isset( $electrician_option['extra_css'] ) ) {
		echo sprintf( __( '%s', 'electrician' ), $electrician_option['extra_css'] );
	}

	$electrician_custom_css = ob_get_clean();

	return $electrician_custom_css;
}
