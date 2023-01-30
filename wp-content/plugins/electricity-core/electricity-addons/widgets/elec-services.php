<?php
namespace ElectricianAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Elec_Services extends Widget_Base {


	public function get_name() {
		return 'electrician_services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'electricity-core' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'electrician' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			array(
				'label' => esc_html__( 'Images', 'electricity-core' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Image 1', 'electricity-core' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'image_1',
			array(
				'label'   => esc_html__( 'Image 2', 'electricity-core' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'image_2',
			array(
				'label'   => esc_html__( 'Image 3', 'electricity-core' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'introduction_section',
			array(
				'label' => esc_html__( 'Content', 'electricity-core' ),
			)
		);
		$this->add_control(
			'title_1',
			array(
				'label'       => esc_html__( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Your home comfort experts', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => esc_html__( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '<span>Quality</span> Heating & Cooling Services', 'electricity-core' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => esc_html__( 'Content 1', 'electricity-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'We provide customers with an industry leading 10-year installation warranty and a two-year service and repair warranty. With most companies, you will get a standard manufacturers warranty on installations and a one-year warranty on service and repair work. ', 'electricity-core' ),
			)
		);

		$this->add_control(
			'content_1',
			array(
				'label'   => esc_html__( 'Content 2', 'electricity-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'We believe our warranties set us apart from our competitors and show our commitment to quality work and service.', 'electricity-core' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'electricity-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'electricity-core' ),
			)
		);

		$this->add_control(
			'action_link',
			array(
				'label'         => __( 'Action Button', 'electricity-core' ),
				'type'          => Controls_Manager::URL,
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'show_external' => true,
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$url      = '#';
		$target   = '';
		if ( ! empty( $settings['action_link'] ) ) {
			$link   = $settings['action_link'];
			$url    = $link['url'];
			$target = $link['is_external'] ? 'target="_blank"' : '';
		}
		$image_url   = $settings['image']['url'];
		$image_alt   = get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true );
		$image_url_1 = $settings['image_1']['url'];
		$image_alt_1 = get_post_meta( $settings['image_1']['id'], '_wp_attachment_image_alt', true );
		$image_url_2 = $settings['image_2']['url'];
		$image_alt_2 = get_post_meta( $settings['image_2']['id'], '_wp_attachment_image_alt', true );
		?>

		<section class="qck-sec">
			<div class="container">
				<div class="qck-sec-details">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="qck-imgs">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<div class="qck-img mgt--24">
											<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
										</div><!--qck-img end-->
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<div class="qck-img mgb-30">
											<img src="<?php echo esc_url( $image_url_1 ); ?>" alt="<?php echo esc_attr( $image_alt_1 ); ?>">
										</div><!--qck-img end-->
										<div class="qck-img">
											<img src="<?php echo esc_url( $image_url_2 ); ?>" alt="<?php echo esc_attr( $image_alt_2 ); ?>">
										</div><!--qck-img end-->
									</div>
								</div>
							</div><!--qck-imgs end-->
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="qck-services">
								<h4>
								<?php
									echo electrician_kses_intermediate( $settings['title_1'] );
								?>
								</h4>
								<h2>
									<?php
									echo electrician_kses_intermediate( $settings['title_2'] );
									?>
								</h2>
								<p>
									<?php
									echo wp_kses_post( $settings['content'] );
									?>
								</p>
								<p>
									<?php
									echo wp_kses_post( $settings['content_1'] );
									?>
								</p>
								<?php if ( ! empty( $settings['button_text'] ) ) { ?>
									<a href="<?php echo esc_url( $url ); ?>" <?php echo $target; ?>  class="lnk-default">
														<?php
														echo esc_html( $settings['button_text'] );
														?>
									</a>
									<?php
								}
								?>
							</div><!---qck-services end-->
						</div>
					</div>
				</div><!--qck-sec-details end-->
			</div>
		</section><!---qck-sec end-->
		<?php
	}

}
