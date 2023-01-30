<?php
namespace ElectricianAddons\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if accessed directly

/**
 *  Testimonials Slider
 *
 *  widget for Testimonials Slider.
 *
 * @since 1.0.0
 */

class Elec_Testimonials_One extends Widget_Base {


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
		return 'electrician-testimonials-1';
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
		return __( 'Testimonials', 'electricity-core' );
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
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'electricity-core' ),
			)
		);

		$this->add_control(
			'testi_style',
			array(
				'label'   => __( 'Style', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'slider',
				'options' => array(
					'slider' => __( 'Slider', 'electricity-core' ),
					'grid'   => __( 'Grid', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Our Testimonials', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Here is what some of our happy customers have had to say about us', 'electricity-core' ),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			array(
				'name'      => 'background',
				'label'     => __( 'Background', 'electricity-core' ),
				'types'     => array( 'classic' ),
				'selector'  => '{{WRAPPER}} .block.bg-1',
				'condition' => array(
					'testi_style' => 'slider',
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'content',
			array(
				'label'       => __( 'Review Text', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			)
		);
		$repeater->add_control(
			'username',
			array(
				'label'       => __( 'Reviewer Name', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
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
						'content'  => __( 'Great service. They really helped me out when my heater went out. They made the service and payment very convenient for me. I highly recommend this company.', 'electricity-core' ),
						'username' => __( 'Paul Grant', 'electricity-core' ),
					),
					array(
						'content'  => __( 'I love my new heaters. I should have done this years ago. The installation was done professionally and in the time frame allotted. It was a great experience.', 'electricity-core' ),
						'username' => __( 'Eldon C. Caron', 'electricity-core' ),
					),
					array(
						'content'  => __( 'Great service. They really helped me out when my heater went out. They made the service and payment very convenient for me. I highly recommend this company.', 'electricity-core' ),
						'username' => __( 'Paul Grant', 'electricity-core' ),
					),
					array(
						'content'  => __( 'I love my new heaters. I should have done this years ago. The installation was done professionally and in the time frame allotted. It was a great experience.', 'electricity-core' ),
						'username' => __( 'Eldon C. Caron', 'electricity-core' ),
					),
					array(
						'content'  => __( 'Great service. They really helped me out when my heater went out. They made the service and payment very convenient for me. I highly recommend this company.', 'electricity-core' ),
						'username' => __( 'Paul Grant', 'electricity-core' ),
					),
					array(
						'content'  => __( 'I love my new heaters. I should have done this years ago. The installation was done professionally and in the time frame allotted. It was a great experience.', 'electricity-core' ),
						'username' => __( 'Eldon C. Caron', 'electricity-core' ),
					),
				),
			)
		);

		$this->end_controls_section();

		electrician_slider_controls( $this, 1 );
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
		$settings     = $this->get_settings_for_display();
		$changed_atts = electrician_slider_controls_settings( $settings );
		// wp_localize_script('electrician-custom', 'ajax_testimonial', $changed_atts);
		if ( $settings['testi_style'] == 'slider' ) {
			?>
<div class="block bg-1 bottom-sm">
  <div class="container">
	<div class="testimonials">
	  <h2 class="text-center"><?php echo wp_kses_post( $settings['title_1'] ); ?></h2>
	  <div class="testimonials-carousel light-arrow" data-slick='<?php echo wp_json_encode( $changed_atts ); ?>'>
			<?php
			if ( ! empty( $settings['slider_list'] ) ) {
				foreach ( $settings['slider_list'] as $item ) {
					?>
		<div class="testimonials-item">
		  <div class="testimonials-text"><?php echo wp_kses_post( $item['content'] ); ?></div>
		  <div class="testimonials-username"><?php echo wp_kses_post( $item['username'] ); ?></div>
		</div>
					<?php
				}
			}
			?>
	  </div>
	</div>
  </div>
</div>
		<?php } else { ?>
<div class="container">
  <h1 class="text-center"><?php echo wp_kses_post( $settings['title_1'] ); ?></h1>
  <p class="font24 text-center"><?php echo wp_kses_post( $settings['title_2'] ); ?></p>
  <div class="testimonials-grid">
			<?php
			if ( ! empty( $settings['slider_list'] ) ) {
				foreach ( $settings['slider_list'] as $item ) {
					?>
	<div class="testimonials-box">
	  <div class="inside">
		<div class="testimonials-box-title"><?php echo wp_kses_post( $item['title'] ); ?></div>
		<div class="testimonials-box-text"><?php echo wp_kses_post( $item['content'] ); ?></div>
		<div class="testimonials-box-username"><?php echo wp_kses_post( $item['username'] ); ?></div>
	  </div>
	</div>
					<?php
				}
			}
			?>
  </div>
  <div id="testimonialPreload"></div>
  <div id="moreLoader" class="more-loader">
	<img src="<?php echo ELECTRICITY_THEME_URI; ?>/images/ajax-loader.gif" alt=""></div>
  <div class="text-center">
	<a class="btn btn-lg btn-border view-more-testimonials" data-load="">
	  <i class="icon icon-lightning"></i>
	  <span><?php echo esc_html__( 'More Testimonials', 'electricity-core' ); ?></span></a>
  </div>
</div>
			<?php
		}
	}

}
