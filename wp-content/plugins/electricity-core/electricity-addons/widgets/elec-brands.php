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

class Elec_Brands extends Widget_Base {





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
		return 'electrician-brands';
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
		return __( 'Brands', 'electricity-core' );
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
			'title',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'default'     => __( 'Trusted <b>By</b>', 'electricity-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slider_image',
			array(
				'label'   => __( 'Brand image', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'action_link',
			array(
				'label'         => __( 'Action Button', 'electricity-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'show_external' => true,
			)
		);

		$this->add_control(
			'slider_list',
			array(
				'label'  => __( 'Brand List', 'electricity-core' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			)
		);

		$this->end_controls_section();
		electrician_slider_controls( $this, 7 );
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
		$settings      = $this->get_settings_for_display();
		$layout_select = $settings['layout_select'];
		$changed_atts  = electrician_slider_controls_settings( $settings );
		$for_vc_atts   = array(
			'mobile_first'     => 'true',
			'slides_to_show'   => '7',
			'slides_to_scroll' => '1',
			'infinite'         => 'true',
			'autoplay'         => 'true',
			'autoplay_speed'   => '2000',
			'arrows'           => 'false',
			'dots'             => 'true',
		);
		// wp_localize_script('electrician-custom', 'ajax_brand', $for_vc_atts);
		?>
		<?php if ( $layout_select == 'style_1' ) { ?>
<div class="block bottom-sm">
  <div class="container">
	<div class="brands-carousel-row">
	  <div class="brands-carousel-title hidden-xs">
		<h2><?php echo wp_kses_post( $settings['title'] ); ?></h2>
	  </div>
	  <div class="brands-carousel-wrap">
		<ul class="brands-carousel" data-slick='<?php echo wp_json_encode( $changed_atts ); ?>'>
			<?php
			if ( ! empty( $settings['slider_list'] ) ) {
				foreach ( $settings['slider_list'] as $item ) {
					$url    = '#';
					$target = '';
					if ( ! empty( $item['action_link'] ) ) {
							  $link   = $item['action_link'];
							  $url    = $link['url'];
							  $target = $link['is_external'] ? 'target="_blank"' : '';
					}
					$image_alt    = get_post_meta( $item['slider_image']['id'], '_wp_attachment_image_alt', true );
					$slider_image = ( $item['slider_image']['id'] != '' ) ? wp_get_attachment_image( $item['slider_image']['id'], 'full' ) : $item['slider_image']['url'];
					?>
		  <li>
			<a href="<?php echo esc_url( $url ); ?>" <?php echo $target; ?>>
					<?php
					if ( wp_http_validate_url( $slider_image ) ) {
						?>
					<img src="<?php echo esc_url( $slider_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						<?php
					} else {
						echo $slider_image;
					}
					?>
			</a>
		  </li>
					<?php
				}
			}
			?>
		</ul>
	  </div>
	</div>
  </div>
</div>
		<?php } elseif ( $layout_select == 'style_2' ) { ?>
	<div class="section-indent section_hr">
		<div class="container container-md-fluid">
			<div class="tt-logo-list slick-type01 js-init-carusel-05">
			<?php
			if ( ! empty( $settings['slider_list'] ) ) {
				foreach ( $settings['slider_list'] as $item ) {
					$url    = '#';
					$target = '';
					if ( ! empty( $item['action_link'] ) ) {
							  $link   = $item['action_link'];
							  $url    = $link['url'];
							  $target = $link['is_external'] ? 'target="_blank"' : '';
					}
					$image_alt    = get_post_meta( $item['slider_image']['id'], '_wp_attachment_image_alt', true );
					$slider_image = ( $item['slider_image']['id'] != '' ) ? wp_get_attachment_image( $item['slider_image']['id'], 'full' ) : $item['slider_image']['url'];
					?>
				<div class="tt-item">
					<a href="<?php echo esc_url( $url ); ?>" <?php echo $target; ?>>
					<?php
					if ( wp_http_validate_url( $slider_image ) ) {
						?>
					<img src="<?php echo esc_url( $slider_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						<?php
					} else {
						echo $slider_image;
					}
					?>
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
