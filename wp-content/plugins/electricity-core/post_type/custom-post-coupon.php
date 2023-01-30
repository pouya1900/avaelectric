<?php

// Register Custom Post Type
function electrician_coupons_post_type() {

	$labels = array(
		'name'                  => __( 'Coupons', 'Post Type General Name', 'electricity-core' ),
		'singular_name'         => __( 'Coupon', 'Post Type Singular Name', 'electricity-core' ),
		'menu_name'             => __( 'Coupons', 'electricity-core' ),
		'name_admin_bar'        => __( 'Coupon', 'electricity-core' ),
		'archives'              => __( 'Item Archives', 'electricity-core' ),
		'parent_item_colon'     => __( 'Parent Item:', 'electricity-core' ),
		'all_items'             => __( 'All Coupons', 'electricity-core' ),
		'add_new_item'          => __( 'Add New Coupon', 'electricity-core' ),
		'add_new'               => __( 'Add New Coupon', 'electricity-core' ),
		'new_item'              => __( 'New Service Item', 'electricity-core' ),
		'edit_item'             => __( 'Edit Coupon Item', 'electricity-core' ),
		'update_item'           => __( 'Update Coupon Item', 'electricity-core' ),
		'view_item'             => __( 'View Coupon Item', 'electricity-core' ),
		'search_items'          => __( 'Search Item', 'electricity-core' ),
		'not_found'             => __( 'Not found', 'electricity-core' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'electricity-core' ),
		'featured_image'        => __( 'Featured Image', 'electricity-core' ),
		'set_featured_image'    => __( 'Set featured image', 'electricity-core' ),
		'remove_featured_image' => __( 'Remove featured image', 'electricity-core' ),
		'use_featured_image'    => __( 'Use as featured image', 'electricity-core' ),
		'insert_into_item'      => __( 'Insert into item', 'electricity-core' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'electricity-core' ),
		'items_list'            => __( 'Items list', 'electricity-core' ),
		'items_list_navigation' => __( 'Items list navigation', 'electricity-core' ),
		'filter_items_list'     => __( 'Filter items list', 'electricity-core' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'electricity-core' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'rewrite'            => array( 'slug' => 'our-coupons' ),
		'capability_type'    => 'post',
		'supports'           => array( 'title', 'thumbnail' ),
	);

	register_post_type( 'our-coupons', $args );
}

add_action( 'init', 'electrician_coupons_post_type', 0 );

add_filter( 'post_row_actions', 'electrician_coupons_remove_row_actions', 10, 1 );
function electrician_coupons_remove_row_actions( $actions ) {
	if ( get_post_type() === 'our-coupons' ) {
		unset( $actions['view'] );
		unset( $actions['inline hide-if-no-js'] );
	}
	return $actions;
}
add_filter( 'get_sample_permalink_html', 'electrician_coupons_hide_permalinks' );
function electrician_coupons_hide_permalinks( $in ) {
	global $post;
	if ( $post->post_type == 'our-coupons' ) {
		$out = '';
	}
	return $out;
}

// Hide "Preview" button
add_action( 'admin_head', 'electrician_coupons_hide_preview_button' );
function electrician_coupons_hide_preview_button() {
	global $current_screen;
	if ( 'our-coupons' == $current_screen->post_type ) {
		  echo '<style>#preview-action,.updated a{display:none;}</style>';
	}
}


add_action( 'wp_ajax_coupon_popup_ajax', 'coupon_popup_ajax' );
add_action( 'wp_ajax_nopriv_coupon_popup_ajax', 'coupon_popup_ajax' );
if ( ! function_exists( 'coupon_popup_ajax' ) ) :
	function coupon_popup_ajax() {

		check_ajax_referer( 'coupon_popup_ajax', 'security' );

		$electrician_option = electrician_options();
		$theme              = $electrician_option['electrician_demo_select'];
		if ( $theme == '2' ) {
			?>
		<div class="modal fade" id="couponForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body" id="modal-coupon">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo esc_html__( 'Close', 'electricity-core' ); ?></button>
						<button id="btn_save_and_close_for_ele" type="button" class="btn btn-primary"><?php echo esc_html__( 'Print', 'electricity-core' ); ?></button>
					</div>
				</div>
			</div>
		</div>
		<script>
			$document.ready(function ($) {

			$(document).on('click', '#btn_save_and_close_for_ele', function() {
				PrintElementor()
			})

			function PrintElementor(elem)
			{
				var mywindow = window.open('', 'PRINT', 'height=400,width=550');
				mywindow.document.write('<html><head>');
				mywindow.document.write('<style type="text/css">');
				mywindow.document.write('.print-ele-link { display:none }.tt-coupons { overflow: hidden;position: relative; border: 5px solid #f3f3f3; background-color: #ffffff;-webkit-print-color-adjust: exact;}.tt-coupons:before,.tt-coupons:after { content: ""; display: block; position: absolute; height: 1px;width: 100%; left: 0;  z-index: 1; }.tt-coupons:after { top: 1px;}.tt-coupons:before { bottom: 1px;}.tt-coupons .tt-coupons__bg { height: 251px;} .tt-coupons .tt-coupons__bg:after,.tt-coupons .tt-coupons__bg:before { content: ""; display: block; position: absolute; top: 0;}.tt-coupons .tt-coupons__bg:after { height: 100%; width: 1px; right: 1px;  z-index: 1;}.tt-coupons .tt-coupons__bg:before {  width: 228px; height: 100%; z-index: 2;background-color: #333; transform: rotate(6deg);left: -47px;top: 11px;}.tt-coupons .btn-custom { text-decoration: none; text-align: center; display: inline-block; color: #ffffff;}.tt-coupons .btn-custom .tt-icon { font-size: 23px; line-height: 1;}.tt-coupons .btn-custom span { display: inline-block; position: relative;  font-size: 14px; line-height: 1; top: 3px;}.tt-coupons .btn-custom span:before { display: inline-block; position: relative; content: "";  display: block; position: absolute; bottom: -1px;  width: 100%; height: 2px; margin: auto;left: 0; right: 0; background-color: #87888e;-webkit-print-color-adjust: exact; -webkit-transition: width .2s linear; transition: width .2s linear;}.tt-coupons .btn-custom:hover { color: #ffffff;}.tt-coupons .btn-custom:hover span:before { width: 0;}.tt-coupons .tt-top-left { position: absolute; top: 22px; left: 20px;  color: #ffffff;  font-size: 14px; line-height: 22px; z-index: 3;}.tt-coupons .tt-top-left a {color: #ffffff;} .tt-coupons .tt-bottom-left { position: absolute;  bottom: 22px; left: 22px; z-index: 3;}.tt-coupons .tt-right-top { width: 64%;  float: right; padding: 18px 24px 50px 0; position: relative; z-index: 3;} .tt-coupons .tt-right-top .tt-title { font-family: "Poppins", sans-serif; font-weight: 600; padding-bottom: 14px;}.tt-coupons .tt-right-top .tt-title+* {  margin-top: 0;} .tt-coupons .tt-right-top .tt-title__01 { color: #303442; font-size: 24px; line-height: 34px;}.tt-coupons .tt-right-top .tt-title__02 { color: #f47629; font-size: 36px; line-height: 34px;  margin-top: 8px;}.tt-coupons .tt-right-bottom { position: absolute; padding: 0 24px 0px 0; width: 70%; right: 0;bottom: 16px;} .tt-coupons .tt-right-bottom .tt-row-bottom {display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: horizontal; -webkit-box-direction: normal;-ms-flex-direction: row;flex-direction: row;  -ms-flex-wrap: wrap; flex-wrap: wrap; -webkit-box-pack: justify; -ms-flex-pack: justify;justify-content: space-between; -ms-flex-line-pack: start; align-content: flex-start; -webkit-box-align: start; -ms-flex-align: start;  align-items: flex-start; position: absolute;  bottom: 0;  right: 24px; width: 100%; font-size: 14px; color: #252936;} .tt-coupons .tt-right-bottom .tt-row-bottom .tt-col {  display: inline-block;}.tt-coupons .tt-right-bottom .tt-row-bottom .tt-col:not(:last-child) { margin-left: 30px;}.tt-coupons .tt-right-bottom .tt-coupons__logo { font-size: 19px; line-height: 19px; color: #303442; font-family: "Poppins", sans-serif;  font-weight: 600; display: inline-block;  position: relative;letter-spacing: -0.02em;}.tt-coupons .tt-right-bottom .tt-coupons__logo .tt-icon {  position: absolute;  top: -4px;  left: -11px; max-width: 20px;}.tt-coupons .tt-right-bottom .tt-text {  display: inline-block; position: relative; top: -2px;} @media print {.print-ele-link { display:none }.tt-coupons { overflow: hidden;position: relative; border: 5px solid #f3f3f3; background-color: #ffffff;-webkit-print-color-adjust: exact;}.tt-coupons:before,.tt-coupons:after { content: ""; display: block; position: absolute; height: 1px;width: 100%; left: 0;  z-index: 1; }.tt-coupons:after { top: 1px;}.tt-coupons:before { bottom: 1px;}.tt-coupons .tt-coupons__bg { height: 251px;} .tt-coupons .tt-coupons__bg:after,.tt-coupons .tt-coupons__bg:before { content: ""; display: block; position: absolute; top: 0;}.tt-coupons .tt-coupons__bg:after { height: 100%; width: 1px; right: 1px;  z-index: 1;}.tt-coupons .tt-coupons__bg:before {  width: 228px; height: 100%; z-index: 2;background-color: #333; transform: rotate(6deg);left: -47px;top: 11px;}.tt-coupons .btn-custom { text-decoration: none; text-align: center; display: inline-block; color: #ffffff;}.tt-coupons .btn-custom .tt-icon { font-size: 23px; line-height: 1;}.tt-coupons .btn-custom span { display: inline-block; position: relative;  font-size: 14px; line-height: 1; top: 3px;}.tt-coupons .btn-custom span:before { display: inline-block; position: relative; content: "";  display: block; position: absolute; bottom: -1px;  width: 100%; height: 2px; margin: auto;left: 0; right: 0; background-color: #87888e;-webkit-print-color-adjust: exact; -webkit-transition: width .2s linear; transition: width .2s linear;}.tt-coupons .btn-custom:hover { color: #ffffff;}.tt-coupons .btn-custom:hover span:before { width: 0;}.tt-coupons .tt-top-left { position: absolute; top: 22px; left: 20px;  color: #ffffff;  font-size: 14px; line-height: 22px; z-index: 3;}.tt-coupons .tt-top-left a {color: #ffffff;} .tt-coupons .tt-bottom-left { position: absolute;  bottom: 22px; left: 22px; z-index: 3;}.tt-coupons .tt-right-top { width: 64%;  float: right; padding: 18px 24px 50px 0; position: relative; z-index: 3;} .tt-coupons .tt-right-top .tt-title { font-family: "Poppins", sans-serif; font-weight: 600; padding-bottom: 14px;}.tt-coupons .tt-right-top .tt-title+* {  margin-top: 0;} .tt-coupons .tt-right-top .tt-title__01 { color: #303442; font-size: 24px; line-height: 34px;}.tt-coupons .tt-right-top .tt-title__02 { color: #f47629; font-size: 36px; line-height: 34px;  margin-top: 8px;}.tt-coupons .tt-right-bottom { position: absolute; padding: 0 24px 0px 0; width: 70%; right: 0;bottom: 16px;} .tt-coupons .tt-right-bottom .tt-row-bottom {display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: horizontal; -webkit-box-direction: normal;-ms-flex-direction: row;flex-direction: row;  -ms-flex-wrap: wrap; flex-wrap: wrap; -webkit-box-pack: justify; -ms-flex-pack: justify;justify-content: space-between; -ms-flex-line-pack: start; align-content: flex-start; -webkit-box-align: start; -ms-flex-align: start;  align-items: flex-start; position: absolute;  bottom: 0;  right: 24px; width: 100%; font-size: 14px; color: #252936;} .tt-coupons .tt-right-bottom .tt-row-bottom .tt-col {  display: inline-block;}.tt-coupons .tt-right-bottom .tt-row-bottom .tt-col:not(:last-child) { margin-left: 30px;}.tt-coupons .tt-right-bottom .tt-coupons__logo { font-size: 19px; line-height: 19px; color: #303442; font-family: "Poppins", sans-serif;  font-weight: 600; display: inline-block;  position: relative;letter-spacing: -0.02em;}.tt-coupons .tt-right-bottom .tt-coupons__logo .tt-icon {  position: absolute;  top: -4px;  left: -11px; max-width: 20px;}.tt-coupons .tt-right-bottom .tt-text {  display: inline-block; position: relative; top: -2px;}}');
				mywindow.document.write('</style>');
				mywindow.document.write('</head><body>');
				mywindow.document.write(document.querySelector('#couponForm .tt-coupons').outerHTML);
				mywindow.document.write('</body></html>');
				mywindow.document.close(); // necessary for IE >= 10
				mywindow.focus(); // necessary for IE >= 10*/
				mywindow.print();
				setTimeout(function() { mywindow.close(); }, 300);

			}
			});

		</script>
			<?php
		} else {
				$post_id           = $_POST['post_id'];
				$top_left          = get_post_meta( $post_id, '_coupon-top-left', true );
				$top_right_title   = get_post_meta( $post_id, '_coupon-top-right-title', true );
				$right_percentance = get_post_meta( $post_id, '_coupon-top-righ-percentance', true );
				$right_content     = get_post_meta( $post_id, '_coupon-top-right-content', true );
				$bottom_right      = get_post_meta( $post_id, '_coupon-bottom-right', true );
				$bottom_image      = get_post_meta( $post_id, '_coupon-bottom-right-mage', true );
			?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><?php echo esc_html__( 'Coupon', 'electricity-core' ); ?></h4>
					</div>
					<div class="modal-body" id="modal-coupon">
						<div class="coupon">
							<div class="coupon-inside">
								<div class="coupon-bg">
									<?php echo get_the_post_thumbnail( $post_id, 'electrician_coupon' ); ?>
								</div>
								<div class="coupon-address" style="color: #ffffff">
									<?php echo wp_kses_post( $top_left ); ?>
								</div>
								<div class="coupon-text">
									<div class="coupon-text-1"><?php echo wp_kses_post( $top_right_title ); ?></div>
									<div class="coupon-text-2">  <?php echo wp_kses_post( $right_percentance ); ?></div>
									<div class="coupon-text-3">  <?php echo wp_kses_post( $right_content ); ?></div>
									<div class="coupon-text-4">
										<?php echo wp_kses_post( $bottom_right ); ?>
										<?php
										$attachement = wp_get_attachment_image_src( (int) $bottom_image, 'full' );
										?>
										<img src="<?php echo esc_url( $attachement[0] ); ?>" alt="<?php echo esc_attr( 'Image' ); ?>">
									</div>
								</div>
							</div>
						</div>
						<style>
							@media print {
								@import url('https://fonts.googleapis.com/css?family=Roboto:400,700,700i,900');
							.coupon::before {
								top: 0;
							}
							.coupon::after, .coupon::before {
								background: rgba(0, 0, 0, 0) url("<?php echo ELECTRICITY_IMG_URL . 'border-hor.png'; ?>") repeat-x scroll 0 0;
								bottom: 0;
								content: "";
								height: 2px;
								left: 0;
								position: absolute;
								width: 100%;
								z-index: 0;
							}
							*::after, *::before {
								box-sizing: border-box;
							}
							.coupon::after, .coupon::before {
								background: rgba(0, 0, 0, 0) url("<?php echo ELECTRICITY_IMG_URL . 'border-hor.png'; ?>") repeat-x scroll 0 0;
								bottom: 0;
								content: "";
								height: 2px;
								left: 0;
								position: absolute;
								width: 100%;
								z-index: 0;
							}
							*::after, *::before {
								box-sizing: border-box;
							}
							.coupon {
								margin-bottom: 30px;
								min-height: 261px;
								position: relative;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-inside::before {
								left: 0;
							}
							.coupon-inside::after, .coupon-inside::before {
								background: rgba(0, 0, 0, 0) url("<?php echo ELECTRICITY_IMG_URL . 'border-vert.png'; ?>") repeat-y scroll 0 0;
								bottom: 0;
								content: "";
								position: absolute;
								top: 0;
								width: 2px;
								z-index: 0;
							}
							*::after, *::before {
								box-sizing: border-box;
							}
							.coupon-inside::after {
								right: 0;
							}
							.coupon-inside::after, .coupon-inside::before {
								background: rgba(0, 0, 0, 0) url("<?php echo ELECTRICITY_IMG_URL . 'border-vert.png'; ?>") repeat-y scroll 0 0;
								bottom: 0;
								content: "";
								position: absolute;
								top: 0;
								width: 2px;
								z-index: 0;
							}
							.coupon-bg {
								bottom: 0;
								left: 0;
								max-width: 45%;
								position: absolute;
								top: 0;
								z-index: 1;
							}
							.coupon-bg img {
								height: 100%;
								max-width: 100%;
							}
							.coupon-address {
								color: #ffffff;
								font-size: 14px;
								left: 15px;
								line-height: 20px;
								position: absolute;
								top: 20px;
								width: 150px;
								z-index: 2;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-print-link {
								bottom: 24px;
								color: #ffffff;
								font-size: 14px;
								font-style: italic;
								font-weight: bold;
								left: 0;
								line-height: 20px;
								position: absolute;
								text-align: center;
								width: 95px;
								z-index: 2;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-text {
								padding: 20px 20px 15px 25%;
								position: relative;
								text-align: right;
								z-index: 1;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-text-1 {
								color: #252936;
								font-size: 36px;
								font-weight: bold;
								line-height: 0.944em;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-text-2, .coupon-text-4 b {
								color: #f47629;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-text-2 {
								color: #e40522;
								font-size: 50px;
								font-style: italic;
								font-weight: bold;
								line-height: 1em;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-text-3 {
								font-size: 15px;
								line-height: 20px;
								margin-top: 14px;
								padding-left: 75px;
								font-family: 'Roboto', sans-serif;
							}
							.coupon-text-4 {
								font-size: 16px;
								font-style: italic;
								line-height: 29px;
								margin-top: 15px;
								font-family: 'Roboto', sans-serif;
							}
							img {
								vertical-align: middle;
							}
							.coupon-text-2, .coupon-text-4 b {
								color: #f47629;
								font-family: 'Roboto', sans-serif;
							}
							.print-link{
								display: none;
							}
							}
							</style>
					</div>
					<div class="modal-footer">
						<button type="button" id="btn_save_close" class="btn btn-default" data-dismiss="modal"><?php echo esc_html__( 'Close', 'electricity-core' ); ?></button>
						<button id="btn_save_close" type="button" class="btn btn-primary" onclick="javascript:PrintElem('modal-coupon')"><?php echo esc_html__( 'Print', 'electricity-core' ); ?></button>
					</div>
				</div>
			</div>
		</div>
		<script>
			function PrintElem(elem)
			{
				var mywindow = window.open('', 'PRINT', 'height=400,width=600');
				mywindow.document.write('<html><head>');
				mywindow.document.write('</head><body>');
				mywindow.document.write(document.getElementById(elem).innerHTML);
				mywindow.document.write('</body></html>');
				mywindow.document.close(); // necessary for IE >= 10
				mywindow.focus(); // necessary for IE >= 10*/
				mywindow.print();
				mywindow.close();
				return true;
			}
		</script>
		<?php } ?>


		<?php
		exit();
	}
endif; // end IF  For coupon_popup_ajax
