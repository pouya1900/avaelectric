<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Service_Banner extends Widget_Base {

	public function get_name() {
		return 'electrician_service_banner';
	}

	public function get_title() {
		return esc_html__( 'Electrician Service Banner', 'electrician' );
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
			'image',
			array(
				'label'   => esc_html__( 'Image', 'electrician' ),
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
				'default' => __( 'Our Services', 'electrician' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Responsive & Professional', 'electrician' ),
			)
		);
		$this->add_control(
			'title_tag',
			array(
				'label'   => esc_html__( 'Title Tag', 'electrician' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'default' => 'div',
			)
		);
		$this->add_control(
			'content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'We go the extra mile on every project. The value we provide clients comes from our level of skill and performance, as well as our knowledge and professionalism. Rest assured, we put the same level of energy into every project we take on.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$this->add_control(
			'contact_title',
			array(
				'label'   => esc_html__( 'Contact Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Call us today', 'electrician' ),
			)
		);

		$this->add_control(
			'contact_number',
			array(
				'label'   => esc_html__( 'Contact Number', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '1 (800) 765-43-21', 'electrician' ),
			)
		);

		$this->add_control(
			'contact_time',
			array(
				'label'   => esc_html__( 'Contact Time', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'We’re available 24/7, 365 days a year.', 'electrician' ),
			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings               = $this->get_settings_for_display();
		$background_shape       = ( $settings['background_shape']['id'] != '' ) ? wp_get_attachment_image( $settings['background_shape']['id'], 'full' ) : $settings['background_shape']['url'];
		$background_shape_alt   = get_post_meta( $settings['background_shape']['id'], '_wp_attachment_image_alt', true );
		$image                  = ( $settings['image']['id'] != '' ) ? wp_get_attachment_image( $settings['image']['id'], 'full' ) : $settings['image']['url'];
		$image_alt              = get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true );
				$tagline        = $settings['tagline'];
				$title          = $settings['title'];
				$title_tag      = $settings['title_tag'];
				$content        = $settings['content'];
				$contact_title  = $settings['contact_title'];
				$contact_number = $settings['contact_number'];
				$contact_time   = $settings['contact_time'];
		?>
<div class="section-indent">
  <div class="container container-lg-fluid">
	<div class="layout01 layout01__single-img">
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
			<?php echo sprintf( '<%1$s class="section-title__02">%2$s</%1$s>', $title_tag, $title ); ?>
		  </div>
		  <p>
			<?php echo $content; ?>
		  </p>
		  <div class="tt-info tt-info__top">
			<div class="tt-info__title"><?php echo $contact_title; ?></div>
			<address>
			  <a href="tel:<?php echo $contact_number; ?>"><i class="tt-icon icon-telephone"></i>	<?php echo $contact_number; ?></a>
			</address>
			<?php echo $contact_time; ?>
		  </div>
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
