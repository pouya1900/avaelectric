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
.loader .one .other,
.loader .three .other{
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
	<?php electrician_print_css( 'color', $electrician_colors, 'button_bg_color' ); ?>
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
.tt-testimonials .tt-testimonials__marker {
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
#tt-menu-toggle:hover {
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
.section__wrapper {
	<?php electrician_print_css( 'background-color', $electrician_colors, 'bg_color' ); ?>
}
.footer-wrapper {
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
