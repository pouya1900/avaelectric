<?php

namespace ElectricianAddons\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 *  Main Slider
 *
 *  widget for Main Slider.
 *
 * @since 1.0.0
 */

class Elec_Map extends Widget_Base {

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
		return 'electrician-map';
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
		return __( 'Maps', 'electricity-core' );
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
			'embed_map',
			array(
				'label' => __( 'Embed Map', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'aws_icon',
			array(
				'label' => __( 'Title', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label' => __( 'Title', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'content',
			array(
				'label' => __( 'Content', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'item_list',
			array(
				'label'   => __( 'List', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title'   => __( '<span>Address:</span>', 'electricity-core' ),
						'content' => __( '1531 Moonlight Drive, Maple Shade, NJ', 'electricity-core' ),
					),
					array(
						'title'   => __( '<span>E-mail:</span>', 'electricity-core' ),
						'content' => __( 'info@yourdomain.com', 'electricity-core' ),
					),
					array(
						'title'   => __( '<span>Phone:</span>', 'electricity-core' ),
						'content' => __( '1 (609) 123-45-67', 'electricity-core' ),
					),
					array(
						'title'   => __( 'Mon-Fri:', 'electricity-core' ),
						'content' => __( '8:00 AM - 8:00 PM, Sat-Sun', 'electricity-core' ),
					),
				),
			)
		);

		$this->end_controls_section();
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
		$settings = $this->get_settings_for_display();
		?>
		<section class="map-full">
			<div class="mapouter">
				<?php echo $settings['embed_map']; ?> 
			</div>
			<div class="mp_contact_info">
				<div class="container">
					<div class="mp_contact_info_details">
						<div class="row">
							<?php
							if ( ! empty( $settings['item_list'] ) ) {
								foreach ( $settings['item_list'] as $item ) {
									?>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 full_wdth">
										<div class="cpt_info">
											<span class="cpt_icon"><i class="fa <?php echo $item['aws_icon']['value']; ?>"></i></span>
											<div class="cppt">
												<?php echo wp_kses_post( $item['title'] ); ?> 	
												<h3> <?php echo wp_kses_post( $item['content'] ); ?> </h3>
											</div>
										</div><!--cpt_info end-->
									</div>
									<?php
								}
							}
							?>
						</div>
					</div><!--mp_contact_info_details end-->
				</div>
			</div><!--mp_contact_info end-->
		</section><!--map-full end-->
		<?php
	}

}
