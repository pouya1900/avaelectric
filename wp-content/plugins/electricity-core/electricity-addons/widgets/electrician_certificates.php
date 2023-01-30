<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Certificates extends Widget_Base {

	public function get_name() {
		return 'electrician_certificates';
	}

	public function get_title() {
						return esc_html__( 'Electrician Certificates', 'electrician' );
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
			'backdround',
			array(
				'label'   => esc_html__( 'Backdround', 'electrician' ),
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
				'default' => __( 'Certificates', 'electrician' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'We are a Qualified & Certified Electrical Company', 'electrician' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'We currently employ a team of fully qualified electricians and a number of apprentices. We have been registered with he ECA and therefore all our electricians are JIB registered. Our aim is to keep our services high and our prices very competitive.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$repeater->add_control(
			'item_popup_image',
			array(
				'label'   => esc_html__( 'Popup Image', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$this->add_control(
			'items',
			array(
				'label'   => __( 'Items', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'list_title'   => esc_html__( 'Title #1', 'electrician' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'electrician' ),
					),
				),
			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings           = $this->get_settings_for_display();
		$tagline            = $settings['tagline'];
				$title      = $settings['title'];
				$content    = $settings['content'];
				$backdround = ( $settings['backdround']['id'] != '' ) ? wp_get_attachment_image_url( $settings['backdround']['id'], 'full' ) : $settings['backdround']['url'];
		?>
<div class="section-indent">
	<div class="layout01-fluid">
		<div class="layout01__img" style="background-image: url(<?php echo $backdround; ?>)"></div>
		<div class="container container-lg-fluid">
			<div class="layout01__content">
				<div class="layout01__content-wrapper">
					<div class="section-title text-left">
						<div class="section-title__01"><?php echo $tagline; ?></div>
						<div class="section-title__02"><?php echo $title; ?></div>
					</div>
					<p>
						<?php echo $content; ?>
					</p>
					<ul class="js-wrapper-gallery gallery01 gallery01-top">
						<?php
								$i = 1;
						foreach ( $settings['items'] as $item ) {
							$item_image       = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
							$image_alt        = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
							$item_popup_image = ( $item['item_popup_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_popup_image']['id'], 'full' ) : $item['item_popup_image']['url'];

							?>
						<li><a class="tt-gallery" href="<?php echo $item_popup_image; ?>">
								<?php
								if ( wp_http_validate_url( $item_image ) ) {
									?>
								<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
									<?php
								} else {
									echo $item_image;
								}
								?>
									
							</a></li>
						<?php } ?>

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
