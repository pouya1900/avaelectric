<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Services_Slider extends Widget_Base {

	public function get_name() {
		return 'electrician_services_slider';
	}

	public function get_title() {
		return esc_html__( 'Electrician Services Slider', 'electrician' );
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
			'sub_heading',
			array(
				'label'   => esc_html__( 'Sub Heading', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '24/7 Electrician Services – Safe and Efficient', 'electrician' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'We are a Full Service Electrical Contractor', 'electrician' ),
			)
		);
		$this->add_control(
			'background_shape',
			array(
				'label'   => esc_html__( 'Banckground Shape', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$this->add_control(
			'bimage',
			array(
				'label' => __( 'Bulb Image', 'plugin-domain' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'item', 'electrician' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Electrical Service', 'electrician' ),
			)
		);

		$repeater->add_control(
			'item_content',
			array(
				'label'       => esc_html__( 'Content', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'We provide complete electrical design and installation services.', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$repeater->add_control(
			'item_button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'More info', 'electrician' ),
			)
		);

		$repeater->add_control(
			'item_button_url',
			array(
				'label'         => esc_html__( 'Button URL', 'electrician' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'electrician' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),

			)
		);

		$repeater->add_control(
			'item_icon',
			array(
				'label' => esc_html__( 'Icon', 'electrician' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

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
					array(
						'list_title'   => esc_html__( 'Title #2', 'electrician' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'electrician' ),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_settings',
			array(
				'label' => esc_html__( 'Carousel Settings', 'electrician' ),
			)
		);
		$this->add_control(
			'slides_to_show',
			array(
				'label'   => esc_html__( 'How Many Slides To Show', 'driving_school' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
			)
		);

		$this->add_control(
			'slides_to_scroll',
			array(
				'label'   => esc_html__( 'How Many Slides To Scroll', 'driving_school' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'   => esc_html__( 'Autoplay Speed', 'driving_school' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '4500', 'driving_school' ),
			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings         = $this->get_settings_for_display();
		$sub_heading      = $settings['sub_heading'];
		$heading          = $settings['heading'];
		$background_shape = ( $settings['background_shape']['id'] != '' ) ? wp_get_attachment_image( $settings['background_shape']['id'], 'full' ) : $settings['background_shape']['url'];

		$slides_to_show   = $settings['slides_to_show'];
		$slides_to_scroll = $settings['slides_to_scroll'];
		$autoplay_speed   = $settings['autoplay_speed'];

		?> 
	<div class="section-indent">
		<div class="container container-lg-fluid container__p-r">
			<div class="section-marker section-marker_b-l">
		<?php
		if ( wp_http_validate_url( $background_shape ) ) {
			?>
				<img src="<?php echo esc_url( $background_shape ); ?>" alt="<?php esc_html__( 'Alt', 'electrician-core' ); ?>">
			<?php
		} else {
			echo $background_shape;
		}
		?>
			</div>
			<div class="section-title max-width-01 section-title_indent-02">
				<div class="section-title__01"><?php echo $sub_heading; ?></div>
				<div class="section-title__02"><?php echo $heading; ?></div>
			</div>
			<div class="tt-box02_wrapper row slick-type01 slick-slider slick-dotted" data-slick='{
					"slidesToShow": <?php echo $slides_to_show; ?>,
					"autoplaySpeed": <?php echo $autoplay_speed; ?>,
					"slidesToScroll": <?php echo $slides_to_scroll; ?>,
					"responsive": [
						{
							"breakpoint": 750,
							"settings": {
								"slidesToShow": 2
							}
						},
						{
							"breakpoint": 546,
							"settings": {
								"slidesToShow": 1,
								"slidesToScroll": 1
							}
						}
					]
				}' >
			  
		<?php
		$i = 1;
		foreach ( $settings['items'] as $item ) {
			$item_title       = $item['item_title'];
			$item_content     = $item['item_content'];
			$item_button_text = $item['item_button_text'];
			$item_button_url  = $item['item_button_url']['url'];
			if ( ! empty( $item_button_url ) ) {
				$this->add_render_attribute( 'item_button_url' . $i, 'href', $item_button_url );
				if ( ! empty( $item['item_button_url']['is_external'] ) ) {
					$this->add_render_attribute( 'item_button_url' . $i, 'target', '_blank' );
				}

				if ( ! empty( $item['item_button_url']['nofollow'] ) ) {
					$this->add_render_attribute( 'item_button_url' . $i, 'rel', 'nofollow' );
				}
			}
			$item_icon  = $item['item_icon'];
			$item_image = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full', '', array( 'class' => 'tt-img-main' ) ) : $item['item_image']['url'];
			?>
		<div class="col-md-4">
			<div class="tt-box02">
				<a href="<?php echo esc_url( $item_button_url ); ?>" class="tt-box02__img <?php echo esc_attr( $item_icon['value'] ); ?>">
				<div class="tt-bg-dark">
			<?php
			if ( wp_http_validate_url( $item_image ) ) {
				?>
								<img src="<?php echo esc_url( $item_image ); ?>" class="tt-img-main" alt="<?php esc_html__( 'Alt', 'electrician-core' ); ?>">
				<?php
			} else {
				echo $item_image;
			}
			?>
				</div>
				<?php
				if ( ! empty( $settings['bimage']['url'] ) ) {
					echo '<img src="' . $settings['bimage']['url'] . '" class="tt-img-mask" loading="lazy" alt="">';
				} else {
					?>
				<img src="<?php echo plugins_url(); ?>/electricity-core/assets/images/mask-img01.png" class="tt-img-mask" loading="lazy" alt="">
				<?php } ?>
				</a>
				<?php if ( ! empty( $item_button_url ) ) { ?>
				<h6 class="tt-box02__title"><a href="<?php echo esc_url( $item_button_url ); ?>"><?php echo $item_title; ?></a></h6>
				<?php } else { ?>
					<h6 class="tt-box02__title"><?php echo $item_title; ?></h6>
				<?php } ?>
				<p><?php echo $item_content; ?></p>
				<?php
				if ( ! empty( $item_button_text ) && ! empty( $item_button_url ) ) {
					?>
				<div class="tt-row-btn">
				<a href="<?php echo esc_url( $item_button_url ); ?>" class="tt-link"><?php echo $item_button_text; ?><span class="icon-arrowhead-pointing-to-the-right-1"></span></a>
				</div>
				<?php } ?>
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
