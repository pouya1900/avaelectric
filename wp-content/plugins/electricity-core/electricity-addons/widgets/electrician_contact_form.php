<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Contact_Form extends Widget_Base {





	public function get_name() {
		return 'electrician_contact_form';
	}

	public function get_title() {
		return esc_html__( 'Electrician Contact Form', 'electrician' );
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
			'tagline',
			array(
				'label'   => esc_html__( 'Tagline', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Contact Form', 'electrician' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Get In Touch with Us', 'electrician' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'Are you stumped by a home wiring project or problem? Fill out the form with the details of your situation and we can come to your aid.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);
		$this->add_control(
			'contact_form',
			array(
				'label'       => esc_html__( 'Select Contact Form', 'car-repair-service-core' ),
				'description' => esc_html__( 'Contact form 7 - plugin must be installed and there must be some contact forms made with the contact form 7', 'electrician-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => false,
				'label_block' => 1,
				'options'     => get_contact_form_7_posts(),
			)
		);
		$this->end_controls_section();

	}
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$tagline      = $settings['tagline'];
		$title        = $settings['title'];
		$content      = $settings['content'];
		$contact_form = $settings['contact_form'];
		?> <div class="section-indent">
	<div class="container container-md-fluid">
		<div class="section-title max-width-01">
			<div class="section-title__01"><?php echo $tagline; ?></div>
			<div class="section-title__02"><?php echo $title; ?></div>
		<?php if ( $content ) { ?>
			<div class="section-title__03">
			<?php echo $content; ?>
			</div>
		<?php } ?>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8">
		<?php
		if ( ! empty( $contact_form ) ) {
			echo do_shortcode( '[contact-form-7 id="' . $contact_form . '"]' );
		}
		?>
			</div>
		</div>
	</div>
</div> 
		<?php
	}

	protected function content_template() {
	}
}


