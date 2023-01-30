<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Elec_Serives_Text extends Widget_Base {

	public function get_name() {
		return 'ele_banner';
	}

	public function get_title() {
		return __( 'Services Text', 'electricity-core' );
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
			'content',
			array(
				'label'   => __( 'Content', 'electricity-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Service Content', 'electricity-core' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Request Form', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Order Service Now', 'electricity-core' ),
			)
		);

		$this->add_control(
			'button_style',
			array(
				'label'   => __( 'Button Action', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'popup',
				'options' => array(
					'popup' => __( 'Popup', 'electricity-core' ),
					'link'  => __( 'Link', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'action_link',
			array(
				'label'         => __( 'Link', 'electricity-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'condition'     => array( 'button_style' => 'link' ),
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'show_external' => true,
			)
		);

		$this->add_control(
			'form_shortcode',
			array(
				'label'       => esc_html__( 'Select Contact Form', 'electricity-core' ),
				'description' => esc_html__( 'Contact form 7 - plugin must be installed and there must be some contact forms made with the contact form 7', 'electricity-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => false,
				'label_block' => 1,
				'options'     => get_contact_form_7_posts(),
				'condition'   => array( 'button_style' => 'popup' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo wp_kses_post( $settings['content'] );
		if ( $settings['button_text'] ) {
			?>
			<div class="divider divider-md"></div>
			<div class="form-popup-wrap form-popup-wrap-full text-center">
				<a href="#" class="btn btn-lg btn-border form-popup-link"><i class="icon icon-lightning"></i><span><?php echo esc_html( $settings['button_text'] ); ?>s</span></a>
				<div class="form-popup form-popup--top">
					<div class="request-form-popup">
						<?php
						if ( ! empty( $settings['form_shortcode'] ) ) {
							echo do_shortcode( '[contact-form-7 id="' . $settings['form_shortcode'] . '"]' );
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}

}
