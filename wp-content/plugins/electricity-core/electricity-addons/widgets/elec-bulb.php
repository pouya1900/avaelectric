<?php
namespace ElectricianAddons\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if accessed directly

/**
 *  Main Slider
 *
 *  widget for Main Slider.
 *
 * @since 1.0.0
 */

class Elec_Bulb extends Widget_Base {


	public $slick_default = array(
		'navigation' => true,
		'arrow'      => false,
	);

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'electrician-bulb';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team', 'electricity-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'electrician' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array( 'electrician-addons-script' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
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
			'tagline',
			array(
				'label'   => esc_html__( 'Tagline', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Our Team', 'electrician' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Fully Qualified Electricians', 'electrician' ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'Subtitle', 'electrician' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'All our personnel operate within an Integrated Management System to ensure the delivery of services that are at an exception level of quality, reliability, and value', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);
		$this->add_control(
			'used_home_page',
			array(
				'label'        => __( 'Used Home Page', 'plugin-domain' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'your-plugin' ),
				'label_off'    => __( 'No', 'your-plugin' ),
				'return_value' => 'block',
				'default'      => 'block',
			)
		);

		$this->add_control(
			'enable_style',
			array(
				'label'   => __( 'Enable Slider', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'slider',
				'options' => array(
					'slider' => __( 'Slider', 'electricity-core' ),
					'grid'   => __( 'Grid', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'column_no',
			array(
				'label'     => __( 'Column No', 'electricity-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'2' => __( '2', 'electricity-core' ),
					'3' => __( '3', 'electricity-core' ),
					'4' => __( '4', 'electricity-core' ),
				),
				'condition' => array( 'enable_style' => 'grid' ),
			)
		);

		$this->add_control(
			'mask_image',
			array(
				'label'   => __( 'Mask Image', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slider_image',
			array(
				'label'   => __( 'Slider image', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'title_1',
			array(
				'label'       => __( 'Title one', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			)
		);
		$repeater->add_control(
			'title_2',
			array(
				'label'       => __( 'Title two', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			)
		);
		$repeater->add_control(
			'url',
			array(
				'label' => __( 'URL', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::URL,
			)
		);
		$this->add_control(
			'slider_list',
			array(
				'label'   => __( 'Slider List', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title_1' => __( 'Switch ON<br> Higher <b>Standards</b>', 'electricity-core' ),
						'title_2' => __( 'for quality work and safety', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Switch ON<br> Better <b>Solutions</b>', 'electricity-core' ),
						'title_2' => __( 'for design and energy saving', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Switch ON<br> Personal <b>Commitment</b>', 'electricity-core' ),
						'title_2' => __( 'for your comfort and security', 'electricity-core' ),
					),
				),
			)
		);

		$this->end_controls_section();

		electrician_slider_controls( $this );
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings        = $this->get_settings_for_display();
		$slider_settings = electrician_slider_controls_settings( $settings );
		// wp_localize_script('electrician-custom', 'ajax_bulb', $slider_settings);
		$layout_select  = $settings['layout_select'];
		$tagline        = $settings['tagline'];
		$title          = $settings['title'];
		$subtitle       = $settings['subtitle'];
		$mask_image     = ( $settings['mask_image']['id'] != '' ) ? wp_get_attachment_image( $settings['mask_image']['id'], 'full', false, array( 'class' => 'tt-img-mask' ) ) : $settings['mask_image']['url'];
		$mask_image_alt = get_post_meta( $settings['mask_image']['id'], '_wp_attachment_image_alt', true );
		$column_no      = $settings['column_no'];

		switch ( (int) $column_no ) {
			case 2:
				$colclass = 'col-sm-6 col-xs-12';
				break;
			case 4:
				$colclass = 'col-md-3 col-sm-3 col-xs-12';
				break;
			default:
				$colclass = 'col-md-4 col-sm-4 col-xs-12';
				break;
		}

		$used_home_page = $settings['used_home_page'];

		?>
		<?php if ( $layout_select == 'style_1' ) { ?>
<div class="<?php echo $used_home_page; ?>">
<div class="container">
			<?php if ( $settings['enable_style'] == 'slider' ) { ?>
  <div class="row bulb-carousel top-negative" data-slick='<?php echo wp_json_encode( $slider_settings ); ?>'>
				<?php
			} else {
				?>
	<div class="row top-negative">
				<?php
			}
			if ( ! empty( $settings['slider_list'] ) ) {
				foreach ( $settings['slider_list'] as $item ) {
					$image_alt    = get_post_meta( $item['slider_image']['id'], '_wp_attachment_image_alt', true );
					$slider_image = ( $item['slider_image']['id'] != '' ) ? wp_get_attachment_image( $item['slider_image']['id'], 'full' ) : $item['slider_image']['url'];
					?>
	  <div class="<?php echo esc_attr( $colclass ); ?>">
		<div class="bulb-block">
		  <div class="bulb">
			<div class="bulb-img">
					<?php
					if ( wp_http_validate_url( $slider_image ) ) {
						?>
					<img src="<?php echo esc_url( $slider_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						<?php
					} else {
						echo $slider_image;
					}
					?>
			</div>
			<div class="bulb-mask">
							<?php
							if ( wp_http_validate_url( $mask_image ) ) {
								?>
								<img src="<?php echo esc_url( $mask_image ); ?>" alt="<?php echo esc_attr( $mask_image_alt ); ?>">
								<?php
							} else {
								echo $mask_image;
							}
							?>
			</div>
		  </div>
		  <h5 class="bulb-block-title"><?php echo wp_kses_post( $item['title_1'] ); ?></h5>
		  <div class="bulb-block-text"><?php echo wp_kses_post( $item['title_2'] ); ?></div>
		</div>
	  </div>
					<?php
				}
			}
			?>
	</div>
  </div>
  </div>
	<?php } elseif ( $layout_select == 'style_2' ) { ?>
		<div class="section-indent">
		<div class="container container-lg-fluid">
			<div class="section-title max-width-01">
				<div class="section-title__01"><?php echo $tagline; ?></div>
				<div class="section-title__02"><?php echo $title; ?></div>
				<div class="section-title__03">
				<?php echo $subtitle; ?>
				</div>
			</div>
			<div 
			<?php if ( $settings['enable_style'] == 'slider' ) { ?>
				class="tt-box05_wrapper row slick-type01 slick-type01"
				data-slick='{
					"slidesToShow": 3,
					"slidesToScroll": 2,
					"responsive": [
						{
							"breakpoint": 750,
							"settings": {
								"slidesToShow": 2
							}
						},
						{
							"breakpoint": 546,
							"settings": {
								"slidesToShow": 1,
								"slidesToScroll": 1
							}
						}
					]
				}'>
			<?php }else{ ?>
				class="tt-box05_wrapper row" >
			<?php } ?>
			<?php
			if ( ! empty( $settings['slider_list'] ) ) {
				foreach ( $settings['slider_list'] as $item ) {
					$image_alt    = get_post_meta( $item['slider_image']['id'], '_wp_attachment_image_alt', true );
					$slider_image = ( $item['slider_image']['id'] != '' ) ? wp_get_attachment_image( $item['slider_image']['id'], 'full', false, array( 'class' => 'tt-img-main' ) ) : $item['slider_image']['url'];

					?>
				<div class="<?php echo esc_attr( $colclass ); ?>">
					<a href="<?php echo esc_url( $item['url']['url'] ); ?>" class="tt-box05">
						<div class="tt-box05__img">
							<?php
							if ( wp_http_validate_url( $slider_image ) ) {
								?>
								<img src="<?php echo esc_url( $slider_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
								<?php
							} else {
								echo $slider_image;
							}
							?>
							<?php
							if ( wp_http_validate_url( $mask_image ) ) {
								?>
								<img src="<?php echo esc_url( $mask_image ); ?>" alt="<?php echo esc_attr( $mask_image_alt ); ?>">
								<?php
							} else {
								echo $mask_image;
							}
							?>
						</div>
						<div class="tt-box05__title">
							<div class="tt-text-01"><?php echo wp_kses_post( $item['title_1'] ); ?></div>
							<div class="tt-text-02"><?php echo wp_kses_post( $item['title_2'] ); ?></div>
						</div>
					</a>
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
