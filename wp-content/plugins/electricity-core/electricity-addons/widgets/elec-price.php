<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;

class Elec_Price extends Widget_Base {





	public function get_name() {
		return 'elec_price';
	}

	public function get_title() {
		return __( 'Price', 'electricity-core' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'electrician' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'electricity-core' ),
			)
		);
		$this->add_control(
			'layout_select',
			array(
				'label'   => __( 'Layout Style', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'electricity-core' ),
					'style_2' => __( 'Style 2', 'electricity-core' ),
				),
			)
		);
		$this->add_control(
			'slide_grid',
			array(
				'label' => __( 'Slider or Grid?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Slider', 'your-plugin' ),
				'label_off' => __( 'Grid', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'background',
			array(
				'label'     => __( 'Background', 'electricity-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'condition' => array( 'layout_select' => 'style_2' ),
			)
		);
		$this->add_control(
			'subtitle',
			array(
				'label'       => __( 'Subtitle', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Save on the Service You Need', 'electricity-core' ),
			)
		);
		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Maintenance <b>Plans</b>', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'Rest easy with a Maintenance Plans from our company', 'electricity-core' ),
			)
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'icon-867257',
				),
			)
		);
		$repeater->add_control(
			'title_1',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$repeater->add_control(
			'currency',
			array(
				'label'       => __( 'Currency', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '$',
			)
		);

		$repeater->add_control(
			'price',
			array(
				'label'       => __( 'Price', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'duration',
			array(
				'label'       => __( 'Period', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( '/ mo', 'electricity-core' ),
			)
		);
		$repeater->add_control(
			'content',
			array(
				'label' => __( 'Include', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Order Now', 'electricity-core' ),
			)
		);

		$repeater->add_control(
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

		$this->add_control(
			'item_list',
			array(
				'label'   => __( 'Item List', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title_1' => __( 'Commercial Service', 'electricity-core' ),
						'price'   => __( '89', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Industrial Service', 'electricity-core' ),
						'price'   => __( '130', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Residential Service', 'electricity-core' ),
						'price'   => __( '89', 'electricity-core' ),
					),
				),
			)
		);
		$this->end_controls_section();

		electrician_slider_controls( $this );
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$layout_select = $settings['layout_select'];
		$changed_atts  = electrician_slider_controls_settings( $settings );
		?>
<!-- Plans Block -->
		<?php if ( $layout_select == 'style_1' ) { ?>
<div class="block bottom-sm">
	<div class="container">
		<div class="text-center">
			<h2>
			<?php echo wp_kses_post( $settings['title_1'] ); ?>
			</h2>
			<p class="font24">
			<?php echo wp_kses_post( $settings['title_2'] ); ?>
			</p>
		</div>
		<div class="row price-box-carousel" data-slick='<?php echo wp_json_encode( $changed_atts ); ?>'>
			<?php
			if ( ! empty( $settings['item_list'] ) ) {
				foreach ( $settings['item_list'] as $key => $item ) {
					$url    = '#';
					$target = '';
					if ( ! empty( $item['button_url'] ) ) {
							  $link   = $item['button_url'];
							  $url    = $link['url'];
							  $target = $link['is_external'] ? 'target="_blank"' : '';
					}
					$priceboxspecial = '';
					if ( $key == 1 ) {
								$priceboxspecial = 'price-box-special';
					}
					?>
			<div class="col-md-4">
				<div class="price-box <?php echo esc_attr( $priceboxspecial ); ?>">
					<div class="price-box-heading">
						<div class="price-box-title">
					<?php echo wp_kses_post( $item['title_1'] ); ?>
						</div>
						<div class="price-box-price">
							<span class="price-currency">
					<?php echo wp_kses_post( $item['currency'] ); ?>
							</span>
							<span class="price-value">
					<?php echo wp_kses_post( $item['price'] ); ?>
							</span>
							<span class="price-period">
					<?php
					echo wp_kses_post( $item['duration'] );
					?>
							</span></div>
					</div>
					<div class="price-box-content">
						<ul class="marker-list">
					<?php echo wp_kses_post( $item['content'] ); ?>
						</ul>
					<?php
					if ( $item['button_text'] ) {
						?>
						<div class="text-center">
							<div class="form-popup-wrap">
								<a href="#" class="btn btn-border form-popup-link"><i
										class="icon icon-lightning"></i><?php echo esc_html( $item['button_text'] ); ?></a>
								<div class="form-popup">
								 <?php
									if ( ! empty( $item['cf7'] ) ) {
										echo do_shortcode( '[contact-form-7 id="' . $item['cf7'] . '"]' );
									}
									?>
								</div>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
			<?php
		} elseif ( $layout_select == 'style_2' ) {
			$background = ( $settings['background']['id'] != '' ) ? wp_get_attachment_url( $settings['background']['id'], 'full' ) : $settings['background']['url'];
			?>
			<div class="section-indent">
	<div class="container">
		<div class="section-title max-width-01">
			<div class="section-title__01"><?php echo wp_kses_post( $settings['subtitle'] ); ?></div>
			<div class="section-title__02"><?php echo wp_kses_post( $settings['title_1'] ); ?></div>
			<div class="section-title__03">
			<?php echo wp_kses_post( $settings['title_2'] ); ?>
			</div>
		</div>
		<div class="tt-block-marker">
			<img class="bg-marker01 block-marker__obj lazyload" src="<?php echo $background; ?>" data-src="<?php echo $background; ?>" alt="">
			<div class="tt-layout02-wrapper slick-type01 row"
			<?php if ( 'yes' === $settings['slide_grid'] ) { ?>
				data-slick='{
					"slidesToShow": 3,
					"slidesToScroll": 2,
					"autoplaySpeed": 5000,
					"responsive": [
						{
							"breakpoint": 1230,
							"settings": {
								"slidesToShow": 2,
								"slidesToScroll": 2
							}
						},
						{
							"breakpoint": 767,
							"settings": {
								"slidesToShow": 1,
								"slidesToScroll": 1
							}
						}
					]
					}'<?php } ?>>

			<?php
			if ( ! empty( $settings['item_list'] ) ) {
				foreach ( $settings['item_list'] as $key => $item ) {
					$url    = '#';
					$target = '';
					if ( ! empty( $item['button_url'] ) ) {
						$link   = $item['button_url'];
						$url    = $link['url'];
						$target = $link['is_external'] ? 'target="_blank"' : '';
					}
					  $priceboxspecial = '';
					if ( $key == 1 ) {
						$priceboxspecial = 'price-box-special';
					}
					?>
				<div class="item col-md-4">
					<div class="tt-layout02">
						<div class="tt-layout02__icon">
							<span class="<?php echo esc_attr( $item['icon']['value'] ); ?>"></span>
						</div>
						<div class="tt-layout02__title">
					<?php echo wp_kses_post( $item['title_1'] ); ?>
						</div>
						<ul class="tt-layout02__list">
					<?php echo wp_kses_post( $item['content'] ); ?>
						</ul>
						<hr class="tt-layout02__hr">
						<div class="tt-layout02__price">
					<?php echo wp_kses_post( $item['currency'] ); ?><?php echo wp_kses_post( $item['price'] ); ?>
						</div>
						<div class="tt-layout02__link">
							<a href="#" data-toggle="modal" data-target="#modalMakeAppointment" class="tt-link"><?php echo esc_html( $item['button_text'] ); ?><span class="icon-arrowhead"></span></a>
						</div>
					</div>
				</div>
					<?php
				}
			}
			?>
	   
			</div>
		</div>
	</div>
		<?php } ?>
		<?php
	}

}
