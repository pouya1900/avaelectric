<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;

class Elec_Services_Page_Footer extends Widget_Base {

	public function get_name() {
		return 'elec_services_page_footer';
	}

	public function get_title() {
		return __( 'Services Page Footer', 'electricity-core' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'electrician' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section_1',
			array(
				'label' => __( 'Content', 'electricity-core' ),
			)
		);

		$repeater_1 = new \Elementor\Repeater();

		$repeater_1->add_control(
			'title_1',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$repeater_1->add_control(
			'item_content',
			array(
				'label'       => __( 'Content', 'electricity-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$this->add_control(
			'item_list_1',
			array(
				'label'   => __( 'Item List', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater_1->get_controls(),
				'default' => array(
					array(
						'title_1' => __( 'We Specialize <b>In</b>', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Electrical Lighting <b>Upgrades</b>', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Our Electrical <b>Technicians are:</b>', 'electricity-core' ),
					),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['item_list_1'] ) ) {
			foreach ( $settings['item_list_1'] as $item ) {
				?>
			<h2 class="smaller"><?php echo wp_kses_post( $item['title_1'] ); ?></h2>
			<div class="row">
				<?php echo wp_kses_post( $item['item_content'] ); ?>
			</div>
				<?php
			}
		}
	}
}
