<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Elec_Count extends Widget_Base {

	public function get_name() {
		return 'elec_count';
	}

	public function get_title() {
		return esc_html__( 'Counter Box', 'electricity-core' );
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
				'label' => esc_html__( 'Content', 'electricity-core' ),
			)
		);

		$this->add_control(
			'layout_select',
			array(
				'label'   => __( 'Layout Style', 'electricity-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'electricity-core' ),
					'style_2' => __( 'Style 2', 'electricity-core' ),
				),
			)
		);
		$this->add_control(
			'subheading',
			array(
				'label'     => esc_html__( 'Sub Heading', 'electricity-core' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array( 'layout_select' => 'style_2' ),
			)
		);
		$this->add_control(
			'heading',
			array(
				'label'     => esc_html__( 'Heading', 'electricity-core' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array( 'layout_select' => 'style_2' ),
			)
		);
		$this->add_control(
			'background_shape',
			array(
				'label'     => __( 'Background Shape', 'electricity-core' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array( 'layout_select' => 'style_2' ),
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'count_text',
			array(
				'label'       => esc_html__( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'count_number',
			array(
				'label'       => esc_html__( 'Counter Value', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'count_speed',
			array(
				'label'       => esc_html__( 'Speed', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => '1500',
			)
		);

		$this->add_control(
			'item_list',
			array(
				'label'   => esc_html__( 'Item List', 'electricity-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'count_number' => '15',
						'count_text'   => __( 'Residential Projects Done', 'electricity-core' ),
					),
					array(
						'count_number' => '142',
						'count_text'   => __( 'Commercial Projects Done', 'electricity-core' ),
					),
					array(
						'count_number' => '24',
						'count_text'   => __( 'Industrial Projects Done', 'electricity-core' ),
					),
					array(
						'count_number' => '12',
						'count_text'   => __( 'Team Members', 'electricity-core' ),
					),
				),
			)
		);
		$this->end_controls_section();
		electrician_slider_controls( $this, 4, 1, 'no' );
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$layout_select = $settings['layout_select'];
		$changed_atts  = electrician_slider_controls_settings( $settings );

		// wp_enqueue_script('waypoint');
		// wp_enqueue_script('countTo');
		// wp_localize_script('electrician-custom', 'ajax_counterbox', $changed_atts);
		?>
<!-- Counters Block -->
		<?php if ( $layout_select == 'style_1' ) { ?>
<div class="block bg-2">
	<div class="container">
		<div class="row counter-carousel" data-slick='<?php echo wp_json_encode( $changed_atts ); ?>'>
			<?php
			if ( ! empty( $settings['item_list'] ) ) {
				foreach ( $settings['item_list'] as $item ) {
					?>
			<div class="col-md-3">
				<div class="counter-box">
					<div class="counter-box-number"><span class="count" data-to="<?php echo $item['count_number']; ?>"
							data-speed="<?php echo $item['count_speed']; ?>">0</span>+</div>
					<div class="decor"></div>
					<div class="counter-box-text"><?php echo wp_kses_post( $item['count_text'] ); ?></div>
				</div>
			</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
			<?php
		} elseif ( $layout_select == 'style_2' ) {
			$subheading           = $settings['subheading'];
			$heading              = $settings['heading'];
			$background_shape     = ( $settings['background_shape']['id'] != '' ) ? wp_get_attachment_image( $settings['background_shape']['id'], 'full', false, array( 'class' => 'bg-marker' ) ) : $settings['background_shape']['url'];
			$background_shape_alt = get_post_meta( $settings['background_shape']['id'], '_wp_attachment_image_alt', true );
			?>
<div class="section-indent">
	<div class="section__wrapper">
		<div class="container container-md-fluid">
			<div class="tt-info-value row">
				<div class="tt-col-title col-md-4">
					<div class="tt-title">
							<?php
							if ( wp_http_validate_url( $background_shape ) ) {
								?>
								<img src="<?php echo esc_url( $background_shape ); ?>" alt="<?php echo esc_attr( $background_shape_alt ); ?>">
									<?php
							} else {
								echo $background_shape;
							}
							?>
						<div class="tt-title__01"><?php echo $subheading; ?></div>
						<div class="tt-title__02">
							<?php echo $heading; ?>
						</div>
					</div>
				</div>
				<?php
				if ( ! empty( $settings['item_list'] ) ) {
					foreach ( $settings['item_list'] as $item ) {
						?>
				<div class="col-auto ml-auto">
					<div class="tt-item">
						<div class="tt-value"><?php echo $item['count_number']; ?>+</div>
						<?php echo wp_kses_post( $item['count_text'] ); ?>
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
<?php } ?>
		<?php
	}

}
