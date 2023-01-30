<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elec_Work_Category extends Widget_Base {

	public function get_name() {
		return 'elec_work_category';
	}

	public function get_title() {
		return __( 'Work Category', 'electricity-core' );
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
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'electricity-core' ),
					'style_2' => __( 'Style 2', 'electricity-core' ),
				),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'electricity-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'title_1',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$repeater->add_control(
			'timage',
			array(
				'label' => __( 'Title background Image', 'electricity-core' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'       => __( 'Content', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
			)
		);
		$repeater->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => '+',
			)
		);

		$repeater->add_control(
			'action_link',
			array(
				'label'         => __( 'Action Button Link', 'electricity-core' ),
				'type'          => Controls_Manager::URL,
				'default'       => array(
					'url'         => '',
					'is_external' => '',
				),
				'description'   => __( 'Keep this field empty to toggle show the content on button click.', 'electricity-core' ),
				'show_external' => true,
			)
		);

		$this->add_control(
			'item_list',
			array(
				'label'   => __( 'Item List', 'electricity-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title_1' => __( 'Commercial', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Industrial', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Residential', 'electricity-core' ),
					),
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

		electrician_slider_controls( $this, 1 );
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$layout_select = $settings['layout_select'];
		$extra_class   = $settings['extra_class'];

		$changed_atts = electrician_slider_controls_settings_work_category( $settings );
		// wp_localize_script('electrician-custom', 'ajax_cat_car', $changed_atts);
		?>
		<?php if ( $layout_select == 'style_1' ) { ?>
		<div class="block <?php echo esc_attr( $extra_class ); ?>">
			<div class="skew-wrapper category-carousel light-arrow" data-slick='<?php echo wp_json_encode( $changed_atts ); ?>'>
				<div class="container">
					<?php
					if ( ! empty( $settings['item_list'] ) ) {
						foreach ( $settings['item_list'] as $item ) {
							$image  = ( $item['image']['id'] != '' ) ? wp_get_attachment_url( $item['image']['id'], 'full' ) : $item['image']['url'];
							$url    = '#';
							$target = '';
							if ( ! empty( $item['action_link'] ) ) {
								$link   = $item['action_link'];
								$url    = $link['url'];
								$target = $link['is_external'] ? 'target="_blank"' : '';
							}
							?>
							<div class="skew"><span class="straight-image" style="background-image: url(<?php echo esc_url( $image ); ?>);"></span>
								<span class="straight"><span class="title"><?php echo wp_kses_post( $item['title_1'] ); ?></span>
									<a class="btn btn-sm" href="<?php echo esc_url( $url ); ?>" <?php echo $target; ?>>
										<span><?php echo esc_html( $item['button_text'] ); ?></span>
									</a>
								</span>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	<?php } elseif ( $layout_select == 'style_2' ) { ?>
		<div class="section-indent <?php echo esc_attr( $extra_class ); ?>">
		<div class="tt-slideinfo-wrapper slick-type01">
			<?php
			if ( ! empty( $settings['item_list'] ) ) {
				foreach ( $settings['item_list'] as $item ) {
					$content = $item['content'];
					$image   = ( $item['image']['id'] != '' ) ? wp_get_attachment_url( $item['image']['id'], 'full' ) : $item['image']['url'];
					$url     = '#';
					$target  = '';
					if ( ! empty( $item['action_link'] ) ) {
						$link   = $item['action_link'];
						$url    = $link['url'];
						$target = $link['is_external'] ? 'target="_blank"' : '';
					}
					$timage = ( $item['timage']['id'] != '' ) ? wp_get_attachment_url( $item['timage']['id'], 'full' ) : $item['timage']['url'];
					?>
					 
			<div class="tt-slideinfo">
				<div class="tt-item__bg"><div data-bg="<?php echo esc_url( $image ); ?>" class="lazyload tt-item__bg-img"></div><div class="tt-item__bg-top"></div></div>
				<div class="tt-item__content">
					<div class="tt-item__title"><span class="tt-icon">
					<?php if ( ! empty( $timage ) ) { ?>
					<img src="<?php echo esc_url( $timage ); ?>" class="lazyload" data-src="<?php echo esc_url( $timage ); ?>" alt="">
					<?php } else { ?> 
					<img src="<?php echo plugins_url(); ?>/electricity-core/assets/images/slideinfo-marker.png" class="lazyload" data-src="<?php echo plugins_url(); ?>/electricity-core/assets/images/slideinfo-marker.png" alt="">
					<?php } ?>
					</span><span class="tt-text"><?php echo wp_kses_post( $item['title_1'] ); ?></span></div>
					<div class="tt-item__description">
						<?php echo $content; ?>
					</div>
					<?php if ( $url ) { ?>
						<div class="tt-item__btn_link">
							<a href="<?php echo esc_url( $url ); ?>"<?php echo $target; ?>><?php echo esc_html( $item['button_text'] ); ?></a>
					<?php } else { ?>
						<div class="tt-item__btn">
						<a href="#"><?php echo esc_html( $item['button_text'] ); ?></a>
						<?php
					}
					?>
					</div>
				</div>
			</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<?php } ?>
<!-- //Skew Category Block -->
		<?php
	}

}
