<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Why_Us extends Widget_Base {

	public function get_name() {
		return 'electrician_why_us';
	}

	public function get_title() {
		return esc_html__( 'Electrician Why us', 'electrician' );
	}

	public function get_icon() {
		return '';
	}

	public function get_categories() {
		return array( 'Electrician' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__( 'general', 'electrician' ),
			)
		);
		$this->add_control(
			'background_shape',
			array(
				'label'   => esc_html__( 'Background Shape', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$this->add_control(
			'tagline',
			array(
				'label'   => esc_html__( 'Tagline', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Why us?', 'electrician' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Our Electricians are:', 'electrician' ),
			)
		);

		$this->add_control(
			'content_list',
			array(
				'label'       => esc_html__( 'Content List', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Image', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings             = $this->get_settings_for_display();
		$tagline              = $settings['tagline'];
				$title        = $settings['title'];
				$content_list = $settings['content_list'];
				$image        = ( $settings['image']['id'] != '' ) ? wp_get_attachment_image( $settings['image']['id'], 'full' ) : $settings['image']['url'];
				$image_alt    = get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true );
		$background_shape     = ( $settings['background_shape']['id'] != '' ) ? wp_get_attachment_image( $settings['background_shape']['id'], 'full' ) : $settings['background_shape']['url'];
		$background_shape_alt = get_post_meta( $settings['background_shape']['id'], '_wp_attachment_image_alt', true );

		?> 
<div class="section-indent">
  <div class="container container-lg-fluid">
	<div class="layout01 layout01__revers layout01__single-img">
	  <div class="layout01__bg-marker">
		<?php
		if ( wp_http_validate_url( $background_shape ) ) {
			?>
					<img src="<?php echo esc_url( $background_shape ); ?>" alt="<?php echo esc_attr( $background_shape_alt ); ?>">
						<?php
		} else {
			echo $background_shape;
		}
		?>
	</div>
	  <div class="layout01__img">
		<div class="tt-img-main">
		<?php
		if ( wp_http_validate_url( $image ) ) {
			?>
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						<?php
		} else {
			echo $image;
		}
		?>
		</div>
	  </div>
	  <div class="layout01__content">
		<div class="layout01__content-wrapper">
		  <div class="section-title text-left">
			<div class="section-title__01"><?php echo $tagline; ?></div>
			<div class="section-title__02"><?php echo $title; ?></div>
		  </div>
		  <ul class="tt-list01">
			<?php echo $content_list; ?>
		  </ul>
		</div>
	  </div>
	</div>
  </div>
</div> 
		<?php
	}

	protected function content_template() {
	}
}
