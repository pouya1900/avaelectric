<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_About_Two extends Widget_Base {







	public function get_name() {
		return 'electrician_about_two';
	}

	public function get_title() {
		return esc_html__( 'Electrician About Two', 'electrician' );
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
			'backdround_shape',
			array(
				'label'   => esc_html__( 'Backdround Shape', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$this->add_control(
			'image_01',
			array(
				'label'   => esc_html__( 'Image 01', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'image_02',
			array(
				'label'   => esc_html__( 'Image 02', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => esc_html__( 'Subtitle', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'About Us', 'electrician' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Outstanding Residential & Commercial Services', 'electrician' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'All of our services are backed by our 100% satisfaction guarantee. Our electricians can install anything from new security lighting for your outdoors to a whole home generator that will keep your appliances working during a power outage.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$this->add_control(
			'content_list',
			array(
				'label'       => esc_html__( 'Content List', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __(
					'<li>Full-service electrical layout, design</li>
<li>Wiring and installation/upgrades</li>
<li>Emergency power solutions (generators)</li>
<li>Virtually any electrical needs you have – just ask!</li>',
					'electrician'
				),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$this->add_control(
			'author_image',
			array(
				'label'   => esc_html__( 'Author Image', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$this->add_control(
			'author_name',
			array(
				'label'   => esc_html__( 'Author Name', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Mark Smith', 'electrician' ),
			)
		);

		$this->add_control(
			'author_designation',
			array(
				'label'   => esc_html__( 'Author Designation', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Your own electrician', 'electrician' ),
			)
		);

		$this->add_control(
			'author_signature',
			array(
				'label'   => esc_html__( 'Author Signature', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label' => __( 'Icon', 'electricity-core' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
			)
		);
		$repeater->add_control(
			'number',
			array(
				'label'   => __( 'Number', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '24',
			)
		);
		$repeater->add_control(
			'text',
			array(
				'label'   => __( 'Text', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Skilled & Certified Electricians',
			)
		);

		$this->add_control(
			'items',
			array(
				'label'  => __( 'Items', 'electricity-core' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			)
		);
		$this->end_controls_section();

	}
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$layout_select = $settings['layout_select'];

		$image_01 = ( $settings['image_01']['id'] != '' ) ? wp_get_attachment_image( $settings['image_01']['id'], 'full' ) : $settings['image_01']['url'];

		$image_02 = ( $settings['image_02']['id'] != '' ) ? wp_get_attachment_image( $settings['image_02']['id'], 'full' ) : $settings['image_02']['url'];

		$subtitle     = $settings['subtitle'];
		$title        = $settings['title'];
		$content      = $settings['content'];
		$content_list = $settings['content_list'];
		$author_image = ( $settings['author_image']['id'] != '' ) ? wp_get_attachment_image( $settings['author_image']['id'], 'full' ) : $settings['author_image']['url'];

		$author_name        = $settings['author_name'];
		$author_designation = $settings['author_designation'];
		$author_signature   = ( $settings['author_signature']['id'] != '' ) ? wp_get_attachment_image( $settings['author_signature']['id'], 'full' ) : $settings['author_signature']['url'];

		?> 
		<?php if ( $layout_select == 'style_1' ) { ?>
<div class="section-indent">
	<div class="container container-lg-fluid">
		<div class="layout01 layout01__img-more">
			<div class="layout01__img">
				<div class="tt-img-main">
			<?php echo $image_01; ?>
				</div>
				<div class="tt-img-more left-bottom">
			<?php echo $image_02; ?>
				</div>
			</div>
			<div class="layout01__content">
				<div class="layout01__content-wrapper">
					<div class="section-title text-left">
						<div class="section-title__01"><?php echo $subtitle; ?></div>
						<div class="section-title__02"><?php echo $title; ?></div>
					</div>
					<p>
			<?php echo $content; ?>
					</p>
					<ul class="tt-list01 tt-list-top">
			<?php echo $content_list; ?>
					</ul>
					<div class="tt-data-info">
						<div class="tt-item">
							<div class="personal-box">
								<div class="personal-box__img">
			<?php echo $author_image; ?>
								</div>
								<div class="personal-box__content">
									<div class="personal-box__title">
			<?php echo $author_name; ?>
									</div>
			<?php echo $author_designation; ?>
								</div>
							</div>
						</div>
						<div class="tt-item">
			<?php echo $author_signature; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
			<?php
		} elseif ( $layout_select == 'style_2' ) {
			$backdround_shape = ( $settings['backdround_shape']['id'] != '' ) ? wp_get_attachment_image( $settings['backdround_shape']['id'], 'full' ) : $settings['backdround_shape']['url'];
			?>
		<div class="section-indent">
		<div class="container container-lg-fluid">
			<div class="layout01 layout01__revers layout01__small-layout layout01__img-more">
				<div class="layout01__bg-marker"><?php echo $backdround_shape; ?></div>
				<div class="layout01__img">
					<div class="tt-img-main">
			<?php echo $image_01; ?>
					</div>
					<div class="tt-img-more left-bottom">
			<?php echo $image_02; ?>
					</div>
				</div>
				<div class="layout01__content">
					<div class="layout01__content-wrapper">
						<div class="section-title text-left">
							<div class="section-title__01"><?php echo $subtitle; ?></div>
							<div class="section-title__02"><?php echo $title; ?></div>
						</div>
						<p>
			<?php echo $content; ?>
						</p>
						<p>
			<?php echo $content_list; ?>
						</p>
						<div class="tt-box04-wrapper row">
			<?php
			foreach ( $settings['items'] as $item ) {
				?>
							<div class="col-6">
								<div class="tt-box04">
									<div class="tt-box04__figure"><i class="<?php echo $item['icon']['value']; ?>"></i></div>
									<div class="tt-box04__content">
										<div class="tt-title"><?php echo $item['number']; ?></div>
										<p>
				<?php echo $item['text']; ?>
										</p>
									</div>
								</div>
							</div>
			<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php } ?>
		<?php
	}

	protected function content_template() {

	}
}




