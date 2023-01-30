<?php
namespace ElectricianAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Elec_Coupons extends Widget_Base {




	public function get_name() {
		return 'elec-coupons';
	}

	public function get_title() {
		return __( 'Coupons', 'electricity-core' );
	}

	public function get_icon() {
		return 'eicon-post';
	}

	public function get_categories() {
		return array( 'electrician' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_blogs',
			array(
				'label' => __( 'Coupons', 'electricity-core' ),
			)
		);
		$this->add_control(
			'layout_style',
			array(
				'label'   => __( 'Layout Style', 'plugin-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'plugin-core' ),
					'style_2' => __( 'Style 2', 'plugin-core' ),
				),
			)
		);
		$this->add_control(
			'tagline',
			array(
				'label'   => esc_html__( 'Tagline', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Coupons', 'electrician' ),
			)
		);
		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Coupons &amp; <b>Special Offers</b>', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'The electrical coupons for electrical services is how Electrician shows their customers how much <br>they are valued', 'electricity-core' ),
			)
		);

		$this->add_control(
			'logo_text',
			array(
				'label'       => __( 'Logo Text', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Electrician', 'electricity-core' ),
			)
		);

		$this->add_control(
			'number',
			array(
				'label'   => __( 'Number of Post', 'electricity-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 4,
			)
		);

		$this->add_control(
			'order_by',
			array(
				'label'   => __( 'Order By', 'electricity-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => __( 'Date', 'electricity-core' ),
					'ID'            => __( 'ID', 'electricity-core' ),
					'author'        => __( 'Author', 'electricity-core' ),
					'title'         => __( 'Title', 'electricity-core' ),
					'modified'      => __( 'Modified', 'electricity-core' ),
					'rand'          => __( 'Random', 'electricity-core' ),
					'comment_count' => __( 'Comment count', 'electricity-core' ),
					'menu_order'    => __( 'Menu order', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'column',
			array(
				'label'   => __( 'Column', 'electricity-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => array(
					'2' => __( '2', 'electricity-core' ),
					'4' => __( '4', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Schedule for Service', 'electricity-core' ),
			)
		);

		$this->add_control(
			'cf7',
			array(
				'label'       => esc_html__( 'Select Contact Form', 'electricity-core' ),
				'description' => esc_html__( 'Contact form 7 - plugin must be installed and there must be some contact forms made with the contact form 7', 'electricity-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => false,
				'label_block' => 1,
				'options'     => get_contact_form_7_posts(),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$layout_style   = $settings['layout_style'];
		$posts_per_page = $settings['number'];
		$order_by       = $settings['order_by'];
		$column         = $settings['column'];

		$args = array(
			'posts_per_page' => $posts_per_page,
			'post_type'      => 'our-coupons',
			'orderby'        => $order_by,
			'no_found_rows'  => true,
		);

		$column_no = $column;
		switch ( (int) $column_no ) {
			case 2:
				$colclass = 'col-sm-6 col-xs-12';
				break;
			case 4:
				$colclass = 'col-md-3 col-sm-4 col-xs-12';
				break;
			default:
				$colclass = 'col-md-4 col-sm-4 col-xs-12';
				break;
		}
		$query = new \WP_Query( $args );
		?>
		<?php if ( $layout_style == 'style_1' ) { ?>
		<div class="block">
			<div class="container">
				<h1 class="text-center"><?php echo wp_kses_post( $settings['title_1'] ); ?></h1>
				<p class="font24 text-center"><?php echo wp_kses_post( $settings['title_2'] ); ?></p>
				<div class="row">
			<?php
			if ( $query->have_posts() ) {
				$i = 1;
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id           = get_the_ID();
					$top_left          = get_post_meta( get_the_ID(), '_coupon-top-left', true );
					$top_right_title   = get_post_meta( get_the_ID(), '_coupon-top-right-title', true );
					$right_percentance = get_post_meta( get_the_ID(), '_coupon-top-righ-percentance', true );
					$right_content     = get_post_meta( get_the_ID(), '_coupon-top-right-content', true );
					$bottom_right      = get_post_meta( get_the_ID(), '_coupon-bottom-right', true );
					$bottom_image      = get_post_meta( get_the_ID(), '_coupon-bottom-right-mage', true );
					?>
							<div class="col-lg-6">
								<div class="coupon">
									<div class="coupon-inside">
										<div class="coupon-bg">
					<?php echo get_the_post_thumbnail( $post_id, 'electrician_coupon' ); ?>
										</div>
										<div class="coupon-address">
					<?php echo wp_kses_post( $top_left ); ?>
										</div>
										<div class="coupon-print-link">
											<div><i class="icon icon-print"></i></div>
											<a href="javascript:void(0)" data-id="<?php echo $post_id; ?>" class="print-link">
					<?php echo esc_html__( 'Print Now!', 'electricity-core' ); ?></a>
											<div id="popUpLoader_<?php echo $post_id; ?>"  class="more-loader-coupon">
												<img src="<?php echo ELECTRICITY_THEME_URI; ?>/images/ajax-loader.gif" alt="">
											</div>
										</div>
										<div class="coupon-text">
											<div class="coupon-text-1"><?php echo wp_kses_post( $top_right_title ); ?></div>
											<div class="coupon-text-2"><?php echo wp_kses_post( $right_percentance ); ?></div>
											<div class="coupon-text-3"><?php echo wp_kses_post( $right_content ); ?></div>
											<div class="coupon-text-4">
					<?php echo wp_kses_post( $bottom_right ); ?>
					<?php
					$attachement = wp_get_attachment_image_src( (int) $bottom_image, 'full' );
					?>
												<img src="<?php echo esc_url( $attachement[0] ); ?>" alt="">
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
					$i++;
				}
				wp_reset_postdata();
			}
			?>
				</div>
				<div class="divider divider-md"></div>
			<?php
			if ( $settings['button_text'] ) {
				?>
					<div class="form-popup-wrap form-popup-wrap-full text-center">
						<a href="#" class="btn btn-xl btn-border form-popup-link"><i class="icon icon-lightning"></i>
							<span>
				<?php
				echo esc_html( $settings['button_text'] );
				?>
							</span>
						</a>
						<div class="form-popup">
				 <?php
					if ( ! empty( $settings['cf7'] ) ) {
						echo do_shortcode( '[contact-form-7 id="' . $settings['cf7'] . '"]' );
					}
					?>
						</div>
					</div>
			<?php } ?>
			</div>
		</div>
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
			<div class="section-indent">
		<div class="container container-lg-fluid">
			<div class="section-title max-width-01">
				<div class="section-title__01"><?php echo wp_kses_post( $settings['tagline'] ); ?></div>
				<div class="section-title__02"><?php echo wp_kses_post( $settings['title_1'] ); ?></div>
				<div class="section-title__03">
			<?php echo wp_kses_post( $settings['title_2'] ); ?>
				</div>
			</div>
			<div class="slick-type01 tt-coupons-wrapper"
				data-slick='{
						"slidesToShow": 2,
						"slidesToScroll": 1,
						"autoplaySpeed": 3500,
						"responsive": [
							{
								"breakpoint": 1229,
								"settings": {
									"slidesToShow": 1,
									"slidesToScroll": 1
								}
							}
						]
					}'>
			<?php
			if ( $query->have_posts() ) {
				$i = 1;
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id           = get_the_ID();
					$top_left          = get_post_meta( get_the_ID(), '_coupon-top-left', true );
					$top_right_title   = get_post_meta( get_the_ID(), '_coupon-top-right-title', true );
					$right_percentance = get_post_meta( get_the_ID(), '_coupon-top-righ-percentance', true );
					$right_content     = get_post_meta( get_the_ID(), '_coupon-top-right-content', true );
					$bottom_right      = get_post_meta( get_the_ID(), '_coupon-bottom-right', true );
					$bottom_image      = get_post_meta( get_the_ID(), '_coupon-bottom-right-mage', true );
					?>
								
							<div class="tt-item">
								<div class="tt-coupons">
				<div <?php if( has_post_thumbnail() ) { ?> class="tt-coupons__bg cust-coupons__bg" style="background:url(<?php  wp_get_attachment_url( the_post_thumbnail_url() ); ?>) 0 0 no-repeat;" <?php }else{ ?> class="tt-coupons__bg" <?php } ?> >
										<div class="tt-top-left">
					<?php echo wp_kses_post( $top_left ); ?>
										</div>
										<div class="tt-bottom-left">
											<a href="javascript:void(0)" data-id="<?php echo $post_id; ?>" class="print-ele-link btn-custom">
												<div class="tt-icon">
													<i class="tt-icon icon-printer"></i>
												</div>
												<span><?php esc_html_e( 'Print Now!', 'electrician-core' ); ?></span>
											</a>
										</div>
										<div class="tt-right-top text-right">
											<div class="tt-title">
												<div class="tt-title__01">
					<?php echo wp_kses_post( $top_right_title ); ?>
												</div>
												<div class="tt-title__02">
					<?php echo wp_kses_post( $right_percentance ); ?>
												</div>
											</div>
											<p>
					<?php echo wp_kses_post( $right_content ); ?>
											</p>
										</div>
										<div class="tt-right-bottom">
											<div class="tt-row-bottom">
												<div class="tt-col">
													<div class="tt-text"><?php echo wp_kses_post( $bottom_right ); ?></div>
												</div>
												<div class="tt-col">
													<div class="tt-coupons__logo">
														<span class="tt-icon">
					<?php
					 $attachement = wp_get_attachment_image_src( (int) $bottom_image, 'full' );
					?>
															<img src="<?php echo esc_url( $attachement[0] ); ?>" alt="">
														</span>
					<?php echo wp_kses_post( $settings['logo_text'] ); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
					$i++;
				}
				wp_reset_postdata();
			}
			?>
			</div>
		</div>
	</div>
		<?php } ?>
		<?php
	}

}
