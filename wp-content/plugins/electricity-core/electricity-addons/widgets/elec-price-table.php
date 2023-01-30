<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;

class Elec_Price_table extends Widget_Base {

	public function get_name() {
		return 'elec_price_table';
	}

	public function get_title() {
		return __( 'Price Table', 'electricity-core' );
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
			'layout_style',
			array(
				'label'   => __( 'Layout Style', 'plugin-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'plugin-core' ),
					'style_2' => __( 'Style 2', 'plugin-core' ),
				),
			)
		);
		$this->add_control(
			'tagline',
			array(
				'label'   => esc_html__( 'Tagline', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Our Rates', 'electrician' ),
			)
		);

		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Our <b>Prices</b>', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'All of our prices include labour and materials but exclude VAT.', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);
		$this->add_control(
			'c1',
			[
				'label' => __( 'Column 1', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'c1h',
			array(
				'label'   => esc_html__( 'Column 1 Heading', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Common Job', 'electrician' ),
			)
		);
		$this->add_control(
			'c2',
			[
				'label' => __( 'Column 2', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'c2h',
			array(
				'label'   => esc_html__( 'Column 2 Heading', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Cost*', 'electrician' ),
			)
		);
		$this->add_control(
			'c3',
			[
				'label' => __( 'Column 3', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'c3h',
			array(
				'label'   => esc_html__( 'Column 3 Heading', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Description', 'electrician' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title_1',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$repeater->add_control(
			'price',
			array(
				'label'       => __( 'Price', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label' => __( 'Include', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'item_list',
			array(
				'label'   => __( 'Item List', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title_1' => __( 'Install ceiling fan', 'electricity-core' ),
						'price'   => __( '$100', 'electricity-core' ),
						'content' => __( 'You supply ceiling fan to suit your home.', 'electricity-core' ),

					),
					array(
						'title_1' => __( 'Supply ceiling fan', 'electricity-core' ),
						'price'   => __( '$75', 'electricity-core' ),
						'content' => __( 'You supply house to bolt it to.', 'electricity-core' ),

					),
					array(
						'title_1' => __( 'Install new double power', 'electricity-core' ),
						'price'   => __( '$90', 'electricity-core' ),
						'content' => __( 'Includes labour, cable, gpo, everything', 'electricity-core' ),

					),
				),
			)
		);

		$this->add_control(
			'note',
			array(
				'label'       => __( 'Note', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( '* Cost* may vary for difficult house. Usually cost is exactly as outlined above.', 'electricity-core' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$layout_style = $settings['layout_style'];
		?>
		<?php if ( $layout_style == 'style_1' ) { ?>
			<div class="container">
				<h2 class="text-center"><?php echo wp_kses_post( $settings['title_1'] ); ?></h2>
				<p class="font24 text-center"><?php echo wp_kses_post( $settings['title_2'] ); ?></p>
				<div class="table-wrapper">
					<table class="table price-table">
						<tbody>
							<tr class="table-header">
							<?php if ( 'yes' === $settings['c1']  ) { ?>
								<th><?php echo esc_html__( 'Common', 'electricity-core' ); ?></th>
							<?php } if ( 'yes' === $settings['c2'] ) { ?>
								<th><?php echo esc_html__( 'Job Cost*', 'electricity-core' ); ?></th>
							<?php } if ( 'yes' === $settings['c3'] ) { ?>
								<th><?php echo esc_html__( 'Description', 'electricity-core' ); ?></th>
							<?php } ?>
							</tr>
							<?php
							if ( ! empty( $settings['item_list'] ) ) {
								foreach ( $settings['item_list'] as $item ) {
									?>
								<tr>
								<?php if ( 'yes' === $settings['c1']  ) { ?>
									<td><?php echo esc_html( $item['title_1'] ); ?></td>
									<?php } if ( 'yes' === $settings['c2'] ) { ?>
									<td><?php echo wp_kses_post( $item['price'] ); ?></td>
									<?php } if ( 'yes' === $settings['c3'] ) { ?>
									<td><?php echo wp_kses_post( $item['content'] ); ?></td>
									<?php } ?>
								</tr>
									<?php
								}
							}
							?>
					</tbody>
				</table>
			</div>
					<?php
					 echo wp_kses_post( $settings['note'] );
					?>
			</div>
		</div>
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
	<div class="section-indent">
		<div class="container container-md-fluid">
			<div class="section-title max-width-01">
				<div class="section-title__01"><?php echo wp_kses_post( $settings['tagline'] ); ?></div>
				<div class="section-title__02"><?php echo wp_kses_post( $settings['title_1'] ); ?></div>
				<div class="section-title__03">
				<?php echo wp_kses_post( $settings['title_2'] ); ?>
				</div>
			</div>
			<div class="tt-table01 tt-table-responsive-md">
				<table>
					<thead>
						<tr>
						<?php if ( 'yes' === $settings['c1']  ) { ?>
							<th><?php echo esc_html__( $settings['c1h'] ); ?></th>
							<?php } if ( 'yes' === $settings['c2'] ) { ?>
							<th><?php echo esc_html__( $settings['c2h'] ); ?></th>
							<?php } if ( 'yes' === $settings['c3'] ) { ?>
							<th><?php echo esc_html__( $settings['c3h'] ); ?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
					<?php
					if ( ! empty( $settings['item_list'] ) ) {
						foreach ( $settings['item_list'] as $item ) {
							?>
						<tr>
						<?php  if ( 'yes' === $settings['c1'] ) { ?>
							<td><?php echo esc_html( $item['title_1'] ); ?> </td>
							<?php } if ( 'yes' === $settings['c2'] ) { ?>
							<td><?php echo wp_kses_post( $item['price'] ); ?></td>
							<?php } if ( 'yes' === $settings['c3'] ) { ?>
							<td><?php echo wp_kses_post( $item['content'] ); ?></td>
							<?php } ?>
						</tr>
							<?php
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
			<?php
		}
	}
}
