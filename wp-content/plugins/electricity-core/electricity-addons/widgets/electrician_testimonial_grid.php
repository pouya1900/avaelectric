<?php
namespace ElectricianAddons\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if accessed directly

/**
 *  Testimonials Slider
 *
 *  widget for Testimonials Slider.
 *
 * @since 1.0.0
 */

class Electrician_Testimonials_Grid extends Widget_Base {








	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'electrician-testimonials-grid';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonials Grid', 'electricity-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'electrician' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'electricity-core' ),
			)
		);

		$this->add_control(
			'col_num',
			array(
				'label'   => esc_html__( 'Number of Columns', 'plugin-name' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-md-4',
				'options' => array(
					'col-md-6' => esc_html__( '2', 'plugin-name' ),
					'col-md-4' => esc_html__( '3', 'plugin-name' ),
					'col-md-3' => esc_html__( '4', 'plugin-name' ),
					'col-md-2' => esc_html__( '6', 'plugin-name' ),
				),
			)
		);

		$this->add_control(
			'tagline',
			array(
				'label'       => __( 'Tagline', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'A Reputation You Can Count On', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Explore Some of Our Testimonials!', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( "Here are a few testimonials and reviews from our customers - we're sure you will feel the same when we work with you.", 'electricity-core' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'content',
			array(
				'label'       => __( 'Review Text', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			)
		);
		$repeater->add_control(
			'username',
			array(
				'label'       => __( 'Reviewer Name', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'designation',
			array(
				'label'       => __( 'Designation', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),

			)
		);
		$this->add_control(
			'slider_list',
			array(
				'label'   => __( 'Slider List', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'content'  => __( 'Great service. They really helped me out when my heater went out. They made the service and payment very convenient for me. I highly recommend this company.', 'electricity-core' ),
						'username' => __( 'Paul Grant', 'electricity-core' ),
					),
					array(
						'content'  => __( 'I love my new heaters. I should have done this years ago. The installation was done professionally and in the time frame allotted. It was a great experience.', 'electricity-core' ),
						'username' => __( 'Eldon C. Caron', 'electricity-core' ),
					),
					array(
						'content'  => __( 'Great service. They really helped me out when my heater went out. They made the service and payment very convenient for me. I highly recommend this company.', 'electricity-core' ),
						'username' => __( 'Paul Grant', 'electricity-core' ),
					),
					array(
						'content'  => __( 'I love my new heaters. I should have done this years ago. The installation was done professionally and in the time frame allotted. It was a great experience.', 'electricity-core' ),
						'username' => __( 'Eldon C. Caron', 'electricity-core' ),
					),
					array(
						'content'  => __( 'Great service. They really helped me out when my heater went out. They made the service and payment very convenient for me. I highly recommend this company.', 'electricity-core' ),
						'username' => __( 'Paul Grant', 'electricity-core' ),
					),
					array(
						'content'  => __( 'I love my new heaters. I should have done this years ago. The installation was done professionally and in the time frame allotted. It was a great experience.', 'electricity-core' ),
						'username' => __( 'Eldon C. Caron', 'electricity-core' ),
					),
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="section-indent">
		<div class="container container-md-fluid">
			<div class="section-title">
				<div class="section-title__01"><?php echo esc_html( $settings['tagline'] ); ?></div>
				<div class="section-title__02"><?php echo esc_html( $settings['title_1'] ); ?></div>
				<div class="section-title__03"><?php echo esc_html( $settings['title_2'] ); ?></div>
			</div>
			<div class="tt-testimonials-wrapper row">
		<?php
		if ( ! empty( $settings['slider_list'] ) ) {
			foreach ( $settings['slider_list'] as $item ) {
				$item_image = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
				?>
						<div class="col-sm-6 <?php echo $settings['col_num']; ?>">
							<div class="tt-testimonials">
								<div class="tt-testimonials__marker">“</div>
								<div class="tt-testimonials_top-layout">
									<h3 class="tt-testimonials__title"><?php echo esc_html( $item['title'] ); ?></h3>
									<p><?php echo wp_kses_post( $item['content'] ); ?></p>
								</div>
								<div class="tt-testimonials__data">
									<div class="tt-col">
										<div class="tt-img">
				<?php
				if ( wp_http_validate_url( $item_image ) ) {
					?>
													<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_html__( 'Alt', 'electrician-core' ); ?>">
					<?php
				} else {
					echo $item_image;
				}
				?>
										</div>
									</div>
									<div class="tt-col">
										<div class="tt-title__text01"><?php echo esc_html( $item['username'] ); ?></div>
										<div class="tt-title__text02"><?php echo esc_html( $item['designation'] ); ?></div>
									</div>
								</div>
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
	}

}
