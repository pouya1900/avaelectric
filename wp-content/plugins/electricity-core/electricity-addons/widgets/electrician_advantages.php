<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Advantages extends Widget_Base {

	public function get_name() {
		return 'electrician_advantages';
	}

	public function get_title() {
		return esc_html__( 'Electrician Advantages', 'electrician' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'electrician' );
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
				'default' => __( 'Our Advantages', 'electrician' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Reasons You Should Call Us', 'electrician' ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'Subtitle', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'Electrician is your single source for a complete range of high-quality electrical services, including design/build, engineering and maintenance.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '24/7 Emergency Services', 'electrician' ),
			)
		);

		$repeater->add_control(
			'item_content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( '24/7 emergency electrician you can trust.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$repeater->add_control(
			'item_icon',
			array(
				'label' => esc_html__( 'Icon', 'electrician' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$this->add_control(
			'items',
			array(
				'label'   => esc_html__( 'Repeater List', 'electrician' ),
				'type'    => Controls_Manager::REPEATER,
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
		$settings         = $this->get_settings_for_display();
		$tagline          = $settings['tagline'];
				$title    = $settings['title'];
				$subtitle = $settings['subtitle'];
		?>
<div class="section-indent">
	<div class="container container-lg-fluid">
		<div class="section-title max-width-01">
			<div class="section-title__01"><?php echo $tagline; ?></div>
			<div class="section-title__02"><?php echo $title; ?></div>
			<div class="section-title__03">
				<?php echo $subtitle; ?>
			</div>
		</div>
		<div class="row tt-services-promo__list justify-content-center">
			<?php
			$i = 0;
			foreach ( $settings['items'] as $item ) {
				$item_title   = $item['item_title'];
				$item_content = $item['item_content'];
				$item_icon    = $item['item_icon'];
				$i++;
				?>
			<div class="col-sm-6 col-lg-4  tt-item">
				<div class="tt-services-promo">
					<div class="tt-value tt-value__indent"><?php echo $i; ?></div>
					<div class="tt-wrapper">
						<div class="tt-col-icon <?php echo $item_icon['value']; ?>"></div>
						<div class="tt-col-layout">
							<div class="tt-title">
								<?php echo $item_title; ?>
							</div>
							<p>
								<?php echo $item_content; ?>
							</p>
						</div>
					</div>
					<div class="tt-bg-marker"></div>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>
</div>
		<?php
	}

	protected function content_template() {
	}
}
