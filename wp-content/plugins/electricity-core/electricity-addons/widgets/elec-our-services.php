<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;

class Elec_Our_Services extends Widget_Base {

	public function get_name() {
		return 'elec_our_services';
	}

	public function get_title() {
		return __( 'Our Services', 'electricity-core' );
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
				'default'     => __( 'Our <b>Services</b>', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$this->add_control(
			'phone',
			array(
				'label'       => __( 'Phone', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( '1 (800) 765-43-21', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'Never hesitate when it comes to potential electrical problems. Electrical issues can quickly develop into major catastrophes.', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'icon-light',
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
			'title_2',
			array(
				'label'       => __( 'Content', 'electricity-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
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
						'title_1' => __( 'Electrical', 'electricity-core' ),
						'title_2' => __( 'Wiring, Remodels and Additions, Heat detectors', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Heating', 'electricity-core' ),
						'title_2' => __( 'Trust our professionals to listen to your needs and problems', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Air Conditioning', 'electricity-core' ),
						'title_2' => __( 'Then present you with options that fit your budget and designs', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Security Systems', 'electricity-core' ),
						'title_2' => __( 'You can view events over a monitor in our home', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Panels Changes', 'electricity-core' ),
						'title_2' => __( 'IPrices that meet your needs and budget', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Trouble Shooting', 'electricity-core' ),
						'title_2' => __( 'We think before we start working to save you money', 'electricity-core' ),
					),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'slider_options',
			array(
				'label' => __( 'Slider Settings', 'electricity-core' ),
			)
		);

		$this->add_control(
			'mobile_first',
			array(
				'label'   => __( 'Enable Mobile First', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'slidesToShow',
			array(
				'label'   => __( 'Slides To Show', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 1,
			)
		);

		$this->add_control(
			'slidesToScroll',
			array(
				'label'   => __( 'Slides To Show', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 1,
			)
		);

		$this->add_control(
			'infinite',
			array(
				'label'   => __( 'Infinite', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'   => __( 'Autoplay', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'autoplaySpeed',
			array(
				'label'   => __( 'Autoplay Speed', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '2000',
			)
		);

		$this->add_control(
			'arrows',
			array(
				'label'   => __( 'Array', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'   => __( 'Dots', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$slides_to_show   = $settings['slidesToShow'];
		$slides_to_scroll = $settings['slidesToScroll'];

		if ( $settings['mobile_first'] == 'yes' ) {
			$mobile_first = 'true';
		} else {
			$mobile_first = 'false';
		}
		if ( $settings['infinite'] == 'yes' ) {
			$infinite = 'true';
		} else {
			$infinite = 'false';
		}

		if ( $settings['autoplay'] == 'yes' ) {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}

		$autoplay_speed = $settings['autoplaySpeed'];

		if ( $settings['arrows'] == 'yes' ) {
			$arrows = 'true';
		} else {
			$arrows = 'false';
		}

		if ( $settings['dots'] == 'yes' ) {
			$dots = 'true';
		} else {
			$dots = 'false';
		}

		$slider_settings = array(
			'mobile_first'     => $mobile_first,
			'slides_to_show'   => $slides_to_show,
			'slides_to_scroll' => $slides_to_scroll,
			'infinite'         => $autoplay,
			'autoplay'         => $infinite,
			'autoplay_speed'   => $autoplay_speed,
			'arrows'           => $arrows,
			'dots'             => $dots,
		);

		?>
<!-- Services Block -->
<div class="block bottom-sm">
  <div class="container">
	<h2 class="text-center">
		<?php
		echo wp_kses_post( $settings['title_1'] );
		?>
	</h2>
		<?php if ( ! empty( $settings['phone'] ) ) { ?>
	<h4 class="text-center subtitle"><i class="icon icon-telephone"></i><?php echo wp_kses_post( $settings['phone'] ); ?>
	</h4>
			<?php
		}
		?>
	<p class="font24 text-center">
		<?php
		echo wp_kses_post( $settings['title_2'] );
		?>
	</p>
	<div class="row text-icon-carousel text-icon-grid" data-slick='<?php echo wp_json_encode( $slider_settings ); ?>'>
		<?php
		if ( ! empty( $settings['item_list'] ) ) {
			foreach ( $settings['item_list'] as $item ) {
				?>
	  <div class="col-sm-6 col-md-4">
		<div class="text-icon">
		  <div class="text-icon-icon"><span><i class="icon <?php echo $item['icon']['value']; ?>"></i><span
				class="icon-hover"></span></span>
		  </div>
		  <h5 class="text-icon-title"><?php echo wp_kses_post( $item['title_1'] ); ?></h5>
		  <div class="text-icon-text"><?php echo wp_kses_post( $item['title_2'] ); ?></div>
		</div>
	  </div>
				<?php
			}
		}
		?>
	</div>
  </div>
</div>
<!-- //Services Block -->
		<?php
	}
}
