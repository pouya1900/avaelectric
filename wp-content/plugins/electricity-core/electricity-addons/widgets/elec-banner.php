<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;


class Elec_Banner extends Widget_Base {

	public function get_name() {
		return 'ele_banner_1';
	}

	public function get_title() {
		return __( 'Banner', 'electricity-core' );
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
			'background_shape',
			array(
				'label'     => esc_html__( 'Banckground Shape', 'electrician' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array( 'layout_select' => 'style_2' ),
			)
		);
		$this->add_control(
			'title_1',
			array(
				'label'   => __( 'Title 1', 'electricity-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( '<span class="light">Do you need help with</span>', 'electricity-core' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'electricity-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Contact us – our technicians are ready to help you solve that issue.', 'electricity-core' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Give Us A Call', 'electricity-core' ),
			)
		);

		$this->add_control(
			'action_link',
			array(
				'label'         => __( 'Button 1 Link', 'electricity-core' ),
				'type'          => Controls_Manager::URL,
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'show_external' => true,
			)
		);

		$this->add_control(
			'button_text_1',
			array(
				'label'       => __( 'Button 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Request A Free Estimate', 'electricity-core' ),
			)
		);

		$this->add_control(
			'button_style',
			array(
				'label'     => __( 'Button Action', 'electricity-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'popup',
				'options'   => array(
					'popup' => __( 'Popup', 'electricity-core' ),
					'link'  => __( 'Link', 'electricity-core' ),
				),
				'condition' => array(
					'layout_select' => 'style_1',
				),
			)
		);

		$this->add_control(
			'action_link_1',
			array(
				'label'         => __( 'Link', 'electricity-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'condition'     => array( 'button_style' => 'link' ),
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'show_external' => true,
				'condition'     => array(
					'layout_select' => 'style_1',
				),
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
				'condition'   => array(
					'button_style'  => 'popup',
					'layout_select' => 'style_1',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$layout_select = $settings['layout_select'];

		$url    = '// ';
		$target = '';
		if ( ! empty( $settings['action_link'] ) ) {
			$link   = $settings['action_link'];
			$url    = $link['url'];
			$target = $link['is_external'] ? 'target="_blank"' : '';
		}

		$url_1    = '#';
		$target_1 = '';
		if ( ! empty( $settings['action_link_1'] ) ) {
			$link_1   = $settings['action_link_1'];
			$url_1    = $link_1['url'];
			$target_1 = $link_1['is_external'] ? 'target="_blank"' : '';
		}

		?>
		<?php if ( $layout_select == 'style_1' ) { ?>
		<div class="block bg-dark pad-sm">
			<div class="container">
				<div class="text-center">
					<h3><span class="light"> 
					<?php
							echo wp_kses_post( $settings['title_1'] );
					?>
							</h3>
					<p class="font24"> 
					<?php
						echo wp_kses_post( $settings['content'] );
					?>
						</p>
					<div class="btn-inline">
						<?php if ( $settings['action_link']['url'] ) { ?>
							<a class="btn" href="<?php echo esc_url( $settings['action_link']['url'] ); ?>" <?php echo $target; ?>><i class="icon icon-telephone"></i><span><?php echo esc_html( $settings['button_text'] ); ?></span></a>
						<?php } ?>
						<?php
						if ( $settings['button_text_1'] ) {
							if ( $settings['button_style'] == 'link' ) {
								?>
								<a class="btn" href="<?php echo esc_url( $settings['action_link_1']['url'] ); ?>" <?php echo $target_1; ?>><i class="icon icon-telephone"></i><span><?php echo esc_html( $settings['button_text_1'] ); ?></span></a>
								<?php
							} else {
								?>
								<div class="form-popup-wrap">
									<a class="btn btn-invert form-popup-link" href="#"><i class="icon icon-lightning"></i><span><?php echo esc_html( $settings['button_text_1'] ); ?></span></a>
									<div class="form-popup">
										<?php
										if ( ! empty( $settings['form_shortcode'] ) ) {
											echo do_shortcode( '[contact-form-7 id="' . $settings['form_shortcode'] . '"]' );
										}
										?>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
			<?php
		} elseif ( $layout_select == 'style_2' ) {
			$background_shape = ( $settings['background_shape']['id'] != '' ) ? wp_get_attachment_image_url( $settings['background_shape']['id'], 'full' ) : $settings['background_shape']['url'];
			?>
		<div class="section-indent">
			<div class="tt-box01 js-init-bg lazyload" data-bg="<?php echo $background_shape; ?>">
				<div class="container">
					<div class="tt-box01__holder">
						<div class="tt-box01__description">
							<h4 class="tt-box01__title">
							<?php echo wp_kses_post( $settings['title_1'] ); ?> 
							</h4>
							<p>
							<?php echo wp_kses_post( $settings['content'] ); ?>
							</p>
							<div class="tt-row-btn">
							<?php if ( $settings['action_link']['url'] ) { ?>
								<a class="tt-btn btn__color01" href="<?php echo $settings['action_link']['url']; ?>"><span class="icon-telephone"></span><?php echo esc_html( $settings['button_text'] ); ?></a>
							<?php } ?>
								<a class="tt-btn btn__color02" data-toggle="modal" data-target="#modalMakeAppointment" href="#">
								<?php $electrician_options = electrician_options();
								if(!empty($electrician_options['electrician-site-wide-icon'])){ ?>
								<span class="icon-sitewide"><?php echo $electrician_options['electrician-site-wide-icon']; ?></span>
								<?php } else { ?>
								<span class="icon-lightning"></span>
								 <?php } ?>
								<?php echo esc_html( $settings['button_text_1'] ); ?></a>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php
	}

}
