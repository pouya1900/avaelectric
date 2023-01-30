<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;

class Elec_Our_Advantage extends Widget_Base {


	public function get_name() {
		return 'elec_our_advantage';
	}

	public function get_title() {
		return __( 'Our Advantage', 'electricity-core' );
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
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Our <b>Advantages</b>', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'Electrician is your single source for a complete range of high-quality electrical services, including design/build, engineering, construction, start-up, commissioning, operation, and maintenance.', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label'   => __( 'Image', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'icon-24-hours',
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

		$this->add_control(
			'item_list',
			array(
				'label'   => __( 'Item List', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title_1' => __( '24/7 Emergency Services', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Free<br>Estimates', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Low Price Guarantee', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Licensed & Insured Experts', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Fast & Reliable Response Times', 'electricity-core' ),
					),
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<!-- Advantages Block -->
		<div class="block">
			<div class="container">
				<h1 class="text-center">
				<?php
				echo wp_kses_post( $settings['title_1'] );
				?>
				</h1>
				<p class="font24 text-center">
				<?php
				echo wp_kses_post( $settings['title_2'] );
				?>
				</p>
				<div class="row text-icon-grid-flex">
					<?php
					if ( ! empty( $settings['item_list'] ) ) {
						foreach ( $settings['item_list'] as $item ) {
							?>
							<div class="col-xs-6 col-sm-4 col-5">
								<div class="text-icon-sm">
									<div class="text-icon-sm-icon"><span><i class="icon <?php echo $item['icon']['value']; ?>"></i><span class="icon-hover"></span></span>
									</div>
									<h5 class="text-icon-sm-title"><?php echo wp_kses_post( $item['title_1'] ); ?></h5>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
		<!-- //Advantages Block -->
		<?php
	}
}
