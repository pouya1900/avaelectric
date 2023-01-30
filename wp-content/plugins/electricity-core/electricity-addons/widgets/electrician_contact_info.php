<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Contact_Info extends Widget_Base {

	public function get_name() {
		return 'electrician_contact_info';
	}

	public function get_title() {
		return esc_html__( 'Electrician Contact Info', 'electrician' );
	}

	public function get_icon() {
		return '';
	}

	public function get_categories() {
		return array( 'Electrician' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'item', 'electrician' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Address:', 'electrician' ),
			)
		);

		$repeater->add_control(
			'item_content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'Electrician Company<br> 8494 Signal Hill Road Manassas,<br> VA, 20110', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$repeater->add_control(
			'item_icon',
			array(
				'label' => esc_html__( 'Icon', 'electrician' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$this->add_control(
			'items',
			array(
				'label'   => esc_html__( 'Repeater List', 'electrician' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'list_title'   => esc_html__( 'Title #1', 'electrician' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'electrician' ),
					),
					array(
						'list_title'   => esc_html__( 'Title #2', 'electrician' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'electrician' ),
					),
				),
			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		?> <div class="section-indent-extra">
		<div class="container container-lg-fluid">
			<div class="section__wrapper02 tt-contact-wrapper">
				<div class="row justify-content-center">
				 <?php
								$i = 1;
					foreach ( $settings['items'] as $item ) {
						$item_title   = $item['item_title'];
						$item_content = $item['item_content'];
						$item_icon    = $item['item_icon'];
						?>
					  <div class="col-sm-6 col-md-4">
  <div class="tt-contact">
	<div class="tt-icon">
						<?php \Elementor\Icons_Manager::render_icon( ( $item_icon ), array( 'aria-hidden' => 'true' ) ); ?>
	</div>
	<div class="tt-content">
	  <div class="tt-title"><?php echo $item_title; ?></div>
						<?php echo $item_content; ?>
	</div>
  </div>
</div> <?php } ?> 
									
				</div>
			</div>
		</div>
	</div> 
		<?php
	}

	protected function content_template() {
	}
}


