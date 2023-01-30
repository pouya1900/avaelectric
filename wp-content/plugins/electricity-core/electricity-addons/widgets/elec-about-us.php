<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Elec_About_Us extends Widget_Base {


	public function get_name() {
		return 'ele_about_us';
	}

	public function get_title() {
		return __( 'About Us', 'electricity-core' );
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
			'design_style',
			array(
				'label'   => __( 'Style', 'plugin-domain' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1' => __( 'Style 1', 'electricity-core' ),
					'2' => __( 'Style 2', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'video_url',
			array(
				'label'       => __( 'Ifram URL', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'https://player.vimeo.com/video/103180506',
				'condition'   => array( 'design_style' => '1' ),
			)
		);

		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'About <b>Us</b>', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'We are locally owned and operated which makes our services causal as they are done by friendly and helpful technicians.', 'electricity-core' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'electricity-core' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'design_style' => '2' ),
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'electricity-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'All of our services are backed by our 100% satisfaction guarantee. Our electricians can install anything from new security lighting for your outdoors to a whole home generator that will keep your appliances working during a power outage. Our installation services are always done promptly and safely.', 'electricity-core' ),
			)
		);

		$this->add_control(
			'more_options',
			array(
				'label'     => __( 'Certificates Section', 'plugin-name' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array( 'design_style' => '2' ),
			)
		);

		$this->add_control(
			'show_section',
			array(
				'label'        => __( 'Show Section', 'plugin-domain' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'your-plugin' ),
				'label_off'    => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'design_style' => '2' ),
			)
		);

		$this->add_control(
			'cert_title',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Certificates', 'electricity-core' ),
				'condition'   => array( 'design_style' => '2' ),
			)
		);

		$this->add_control(
			'image_1',
			array(
				'label'     => __( 'Footer Image 1', 'electricity-core' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'design_style' => '2' ),
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'image_2',
			array(
				'label'     => __( 'Footer Image 2', 'electricity-core' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'design_style' => '2' ),
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Button Text', 'electricity-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Know more', 'electricity-core' ),
				'condition' => array( 'design_style' => '1' ),
			)
		);

		$this->add_control(
			'action_link',
			array(
				'label'         => __( 'Action Button', 'electricity-core' ),
				'type'          => Controls_Manager::URL,
				'condition'     => array( 'design_style' => '1' ),
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
		?>

<!-- //About Block -->
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
		<?php if ( $settings['design_style'] == '1' ) { ?>
	<div class="row text-sm-center">
	  <div class="col-md-6">
		<div class="video-wrap">
		  <div class="video-responsive max-width">
			<iframe src="<?php echo esc_url( $settings['video_url'] ); ?>"></iframe>
		  </div>
		</div>
	  </div>
	  <div class="divider visible-sm"></div>
	  <div class="divider-sm visible-xs"></div>
	  <div class="col-md-6">
			<?php
							echo wp_kses_post( $settings['content'] );
			?>
			<?php if ( $settings['action_link']['url'] ) { ?>
		<a href="<?php echo esc_url( $settings['action_link']['url'] ); ?>" <?php echo $target; ?>
		  class="btn btn-border"><i
			class="icon icon-lightning"></i><span><?php echo esc_html( $settings['button_text'] ); ?></span></a> </div>
			<?php } ?>
	</div>
			<?php
		} else {
			$image_alt   = get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true );
			$image_alt_1 = get_post_meta( $settings['image_1']['id'], '_wp_attachment_image_alt', true );
			$image_alt_2 = get_post_meta( $settings['image_1']['id'], '_wp_attachment_image_alt', true );
			?>
	<div class="row">
	  <div class="col-sm-7 float-right-lg float-right-md float-right-sm">
		<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" class="img-responsive"
		  alt="<?php echo esc_url( $image_alt ); ?>">
	  </div>
	  <div class="divider visible-xs"></div>
	  <div class="col-sm-5">
			<?php
					echo wp_kses_post( $settings['content'] );
			?>
	  </div>
	</div>

			<?php
			if ( isset( $settings['show_section'] ) && $settings['show_section'] ) {
				?>
	<div class="divider divider-lg"></div>
	<div class="row">
	  <div class="col-sm-6">
		<img src="<?php echo esc_url( $settings['image_1']['url'] ); ?>" class="img-responsive"
		  alt="<?php echo esc_url( $image_alt_1 ); ?>">
	  </div>
	  <div class="divider-sm visible-xs"></div>
	  <div class="col-sm-6">
		<div class="divider-sm"></div>
		<h2>
				<?php
				if ( isset( $settings['cert_title'] ) && ! empty( $settings['cert_title'] ) ) {
					echo $settings['cert_title'];
				}
				?>
		</h2>
		<img src="<?php echo esc_url( $settings['image_2']['url'] ); ?>" class="img-responsive"
		  alt="<?php echo esc_url( $image_alt_2 ); ?>">
	  </div>
	</div>
				<?php
			}
		}
		?>
  </div>
</div>
		<?php
	}
}
