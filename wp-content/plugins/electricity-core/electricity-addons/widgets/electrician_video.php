<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater; 

class Electrician_Video extends Widget_Base {

	public function get_name() {
		return 'electrician_video';
	}

	public function get_title() {
		return esc_html__( 'Electrician Video', 'electrician' );
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
			'background',
			array(
				'label'   => esc_html__( 'Background', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'Your <span class="tt-base-color">Best Option</span><br>in Electrical<br>Contractors 24/7', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$this->add_control(
			'content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'Our experienced electricians are highly trained in all aspects of electrical service, from office lighting and security systems to emergency repair.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Explore services', 'electrician' ),
			)
		);
		$this->add_control(
			'button_link',
			array(
				'label'         => esc_html__( 'Button Link', 'electrician' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'electrician-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);
		$this->add_control(
			'video_link',
			array(
				'label' => esc_html__( 'Video Link', 'electrician' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$background = ( $settings['background']['id'] != '' ) ? wp_get_attachment_image_url( $settings['background']['id'], 'full' ) : $settings['background']['url'];

		$title       = $settings['title'];
		$content     = $settings['content'];
		$button_text = $settings['button_text'];
		// $button_link = $settings['button_link']['url'];
		$video_link  = $settings['video_link'];
		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'button_link', $settings['button_link'] );
		}
		?> 
<div class="section-indent">
	<div class="tt-box01 lazyload" data-bg="<?php echo $background; ?>">
		<div class="container">
			<div class="tt-box01__holder">
				<div class="tt-box01__video">
					<?php if ( $video_link ) { ?>
					<a href="<?php echo $video_link; ?>" class="tt-video js-video-popup"><i
							class="icon-arrowhead-pointing-to-the-right-1"></i></a>
						<?php } ?>
				</div>
				<div class="tt-box01__description">
					<h4 class="tt-box01__title">
		<?php echo $title; ?>
					</h4>
					<p>
		<?php echo $content; ?>
					</p>
					<div class="tt-row-btn">
						<?php if ( ! empty( $settings['button_link']['url'] ) ) { ?>
						<a class="tt-btn btn__color01" <?php echo $this->get_render_attribute_string( 'button_link' ); ?>>
						<?php } else { ?>
						<a class="tt-btn btn__color01" data-toggle="modal" data-target="#modalMakeAppointment" href="#">
						<?php } ?>
							<?php
							$electrician_options = electrician_options();
							if ( ! empty( $electrician_options['electrician-site-wide-icon'] ) ) {
								?>
							<span class="icon-sitewide"><?php echo $electrician_options['electrician-site-wide-icon']; ?></span>
							<?php } else { ?>
							<span class="icon-lightning"></span>
								<?php } ?>
							<?php echo $button_text; ?>
						</a>
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
