<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Elec_Action_Button extends Widget_Base {

	public function get_name() {
		return 'elec_action_button';
	}

	public function get_title() {
		return __( 'Elec Action Button', 'electricity-core' );
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
			'button_style_select',
			array(
				'label'   => __( 'Button Style', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 01', 'electricity-core' ),
					'style_2' => __( 'Style 02', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Order Service Now', 'electricity-core' ),
			)
		);

		$this->add_control(
			'button_style',
			array(
				'label'   => __( 'Button Action', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'popup',
				'options' => array(
					'popup' => __( 'Popup', 'electricity-core' ),
					'link'  => __( 'Link', 'electricity-core' ),
					'modal' => __( 'Modal', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'action_link',
			array(
				'label'         => __( 'Link', 'plugin-domain' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'condition'     => array( 'button_style' => 'link' ),
				'placeholder'   => __( 'https://your-link.com', 'electricity-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
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
					'button_style' => 'popup',
					'button_style' => 'modal',
				),
			)
		);

		$this->add_control(
			'popup_position',
			array(
				'label'     => __( 'Pop Up Location To Open', 'electricity-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'buttom',
				'options'   => array(
					'top'    => __( 'Top', 'electricity-core' ),
					'buttom' => __( 'Buttom', 'electricity-core' ),
				),
				'condition' => array( 'button_style' => 'popup' ),
			)
		);
		$this->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value' => 'icon-lightning',
				),
			)
		);

		$this->add_control(
			'extra_class',
			array(
				'label'       => __( 'Extra Class', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings            = $this->get_settings_for_display();
		$button_style_select = $settings['button_style_select'];
		$button_style        = $settings['button_style'];
		$extra_class         = $settings['extra_class'];
		$icon                = $settings['icon'];
		$popup_position      = $settings['popup_position'];

		$popup_position_class = '';
		switch ( $popup_position ) {
			case 'top':
				$popup_position_class = 'form-popup--top';
				break;
			case 'bottom':
				$popup_position_class = '';
				break;

			default:
				$popup_position_class = '';
		}
		if ( $button_style_select == 'style_1' ) {
			if ( $button_style == 'link' ) {
				$action_link = $settings['action_link']['url'];
				$target      = $settings['action_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow    = $settings['action_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
			<a class="btn" <?php echo $target . $nofollow; ?> href="<?php echo esc_url( $action_link ); ?>">
				<i class="<?php echo $icon['value']; ?>"></i>
				<span><?php echo esc_html( $settings['button_text'] ); ?></span>
			</a>
				<?php
			} elseif ( $button_style == 'modal' ) {
				$modal_id = $settings['modal_id'];
				?>
				<a href="#" data-toggle="modal" data-target="#<?php echo esc_attr( $modal_id ); ?>" class="btn"><span class="<?php echo $icon['value']; ?>"></span><?php echo esc_html( $settings['button_text'] ); ?></a>
				<?php
			} else {
				?>
		<div class="divider divider-md"></div>
			<div class="form-popup-wrap form-popup-wrap-full text-center">
			<a href="#" class="btn btn-lg btn-border form-popup-link">
				<i class="icon <?php echo $icon['value']; ?>"></i>
				<span>
						<?php echo esc_html( $settings['button_text'] ); ?></span>
			</a>
			<div class="form-popup <?php echo esc_attr( $popup_position_class ); ?> <?php echo esc_attr( $extra_class ); ?>">
				<div class="request-form-popup">
						<?php
						if ( ! empty( $settings['form_shortcode'] ) ) {
							echo do_shortcode( '[contact-form-7 id="' . $settings['form_shortcode'] . '"]' );
						}
						?>
				</div>
			</div>
		</div>
				<?php
			}
		} elseif ( $button_style_select == 'style_2' ) {
			if ( $button_style == 'link' ) {
				$action_link = $settings['action_link']['url'];
				$target      = $settings['action_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow    = $settings['action_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
			<a class="tt-btn btn__color01 tt-btn-top" <?php echo $target . $nofollow; ?> href="<?php echo esc_url( $action_link ); ?>">
				<span class="<?php echo $icon['value']; ?>"></span>
				<?php echo esc_html( $settings['button_text'] ); ?>
			</a>
				<?php
			} elseif ( $button_style == 'modal' ) {
				?>
			<a href="#" data-toggle="modal" data-target="#elementor_modalMakeAppointment" class="tt-btn btn__color01 tt-btn-top"><span class="<?php echo $icon['value']; ?>"></span><?php echo esc_html( $settings['button_text'] ); ?></a>
			<?php	if ( isset( $settings['form_shortcode'] ) && ! empty( $settings['form_shortcode'] ) ) { ?>
			<div class="modal fade" id="elementor_modalMakeAppointment" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md">
					<div class="modal-content ">
						<div class="modal-body form-default modal-layout-dafault">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon-860796"></span></button>
							<?php
								// echo do_shortcode( $electrician_options['electrician_modal_form'] );
								echo  do_shortcode( '[contact-form-7 id="' . $settings['form_shortcode'] . '"]' );
							?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- modal - Make an Appointment -->
				<?php
			} else {
				?>
			<div class="form-popup-wrap form-popup-wrap-full">
			<a href="#" class="tt-btn btn__color01 tt-btn-top form-popup-link">
				<span class="<?php echo $icon['value']; ?>"></span>
				<?php echo esc_html( $settings['button_text'] ); ?>
			</a>
			<div class="form-popup <?php echo esc_attr( $popup_position_class ); ?> <?php echo esc_attr( $extra_class ); ?>">
				<div class="request-form-popup">
						<?php
						if ( ! empty( $settings['form_shortcode'] ) ) {
							echo do_shortcode( '[contact-form-7 id="' . $settings['form_shortcode'] . '"]' );
						}
						?>
				</div>
			</div>
		</div>
		
				 <?php
			}
		}

	}
}
