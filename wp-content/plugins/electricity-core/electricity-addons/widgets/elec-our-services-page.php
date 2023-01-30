<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elec_Our_Services_Page extends Widget_Base {

	public function get_name() {
		return 'elec_our_services_page';
	}

	public function get_title() {
		return __( 'Our Services Page', 'electricity-core' );
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
		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Our <b>Services</b>', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title 2', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'We offer a variety of electrical services for both residential and commercial properties, including upgrades, repairs, replacements, and installations', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$this->add_control(
			'tab1',
			array(
				'label'   => esc_html__( '1st Tab Item', '' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'All', '' ),
			)
		);
		$this->add_control(
			'btn_text',
			array(
				'label'     => __( 'Button Text', 'electricity-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Schedule for Service', 'electricity-core' ),
				'condition' => array( 'layout_select' => 'style_2' ),
			)
		);
		$this->add_control(
			'btn_link',
			array(
				'label'     => __( 'Button Link', 'electricity-core' ),
				'type'      => Controls_Manager::URL,
				'condition' => array( 'layout_select' => 'style_2' ),
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
			'title_2',
			array(
				'label'       => __( 'Content', 'electricity-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);
		$repeater->add_control(
			'category',
			array(
				'label'   => __( 'Category', 'electricity-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Commercial Services', 'electricity-core' ),
			)
		);
		$repeater->add_control(
			'item_btn_text',
			array(
				'label'   => __( 'Button Text', 'electricity-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Read more', 'electricity-core' ),
			)
		);
		$repeater->add_control(
			'action_link',
			array(
				'label'         => __( 'Action Button', 'electricity-core' ),
				'type'          => Controls_Manager::URL,
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
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
						'title_1' => __( 'Electrical', 'electricity-core' ),
						'title_2' => __( 'Wiring, Remodels and Additions, Heat detectors', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Heating', 'electricity-core' ),
						'title_2' => __( 'Trust our professionals to listen to your needs and problems', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Air Conditioning', 'electricity-core' ),
						'title_2' => __( 'Then present you with options that fit your budget and designs', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Security Systems', 'electricity-core' ),
						'title_2' => __( 'You can view events over a monitor in our home', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Panels Changes', 'electricity-core' ),
						'title_2' => __( 'IPrices that meet your needs and budget', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Trouble Shooting', 'electricity-core' ),
						'title_2' => __( 'We think before we start working to save you money', 'electricity-core' ),
					),
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$layout_select = $settings['layout_select'];
		$tab1          = $settings['tab1'];

		?>

		<?php if ( $layout_select == 'style_1' ) { ?>
			<h1 class="text-center"><?php echo wp_kses_post( $settings['title_1'] ); ?></h1>
			<p class="font24 text-center"><?php echo wp_kses_post( $settings['title_2'] ); ?></p>
			<div class="row">
			<?php
			if ( ! empty( $settings['item_list'] ) ) {
				foreach ( $settings['item_list'] as $item ) {
					$image_alt = get_post_meta( $item['image']['id'], '_wp_attachment_image_alt', true );
					$image     = ( $item['image']['id'] != '' ) ? wp_get_attachment_image( $item['image']['id'], 'full', false, array( 'class' => 'img-responsive' ) ) : $item['image']['url'];
					$url       = '#';
					$target    = '';
					if ( ! empty( $item['action_link'] ) ) {
						$link   = $item['action_link'];
						$url    = $link['url'];
						$target = $link['is_external'] ? 'target="_blank"' : '';
					}
					?>
					<div class="col-sm-6 col-md-4">
						<a href="<?php echo esc_url( $url ); ?>" <?php echo $target; ?> class="category-item">
							<div class="category-image">
							<?php
							if ( wp_http_validate_url( $image ) ) {
								?>
							<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
								<?php
							} else {
								echo $image;
							}
							?>
							</div>
							<h5 class="category-title"><?php echo wp_kses_post( $item['title_1'] ); ?></h5>
							<div class="category-text"><?php echo wp_kses_post( $item['title_2'] ); ?></div>
						</a>
					</div>
					<?php
				}
			}
			?>
			</div>
			<?php
		} elseif ( $layout_select == 'style_2' ) {

			$btn_text = $settings['btn_text'];
			$btn_link = $settings['btn_link']['url'];
			?>
		<div class="section-indent">
		<div class="container container-md-fluid">
			<div class="section-title max-width-01">
				<div class="section-title__02"><?php echo wp_kses_post( $settings['title_1'] ); ?> </div>
				<p class="font24 text-center"> <?php echo wp_kses_post( $settings['title_2'] ); ?> </p>
			</div>
			<div id="filter-nav">
			<?php
			$category_arr       = array();
			$category_arr_class = array();
			foreach ( $settings['item_list'] as $key => $item ) {
				$cat                        = $item['category'];
				$child_categories_ex        = explode( ',', $cat );
				$child_categories           = str_replace( ' ', '', $cat );
				$category_arr_class[ $key ] = strtolower( $child_categories );
				foreach ( $child_categories_ex as $child_category ) {
					$category_arr[] = strtolower( $child_category );
				}
			}
			?>
				<ul>
					<li class="active"><a class="gallery-navitem" href="filter-all"><?php echo $tab1; ?></a></li>
					<?php
					$category_arr = array_unique( $category_arr );
					foreach ( $category_arr as $category ) {
						$category_slug = str_replace( ' ', '', $category );
						echo '<li><a class="gallery-navitem" href="' . $category_slug . '">' . $category . '</a></li>';

					}
					?>
				</ul>
			</div>
			<div id="filter-layout" class="row justify-content-center tt-obj-wrapper">
			<?php
			if ( ! empty( $settings['item_list'] ) ) {
				foreach ( $settings['item_list'] as $item ) {
					$image_alt = get_post_meta( $item['image']['id'], '_wp_attachment_image_alt', true );
					$image     = ( $item['image']['id'] != '' ) ? wp_get_attachment_image( $item['image']['id'], 'full' ) : $item['image']['url'];
					$url       = '#';
					$target    = '';
					if ( ! empty( $item['action_link'] ) ) {
						$link   = $item['action_link'];
						$url    = $link['url'];
						$target = $link['is_external'] ? 'target="_blank"' : '';
					}
					$cat = $item['category'];

					$child_categories = str_replace( ' ', '', $cat );
					$category_slug    = strtolower( $child_categories );
					$item_btn_text    = $item['item_btn_text'];
					?>
				<div class="col-sm-6 col-md-4 show filter-all <?php echo esc_attr( $category_slug ); ?>">
					<div class="tt-obj">
						<div class="tt-obj__img">
						<?php
						if ( wp_http_validate_url( $image ) ) {
							?>
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
							<?php
						} else {
							echo $image;
						}
						?>
						</div>
						<div class="tt-obj__wrapper">
							<div class="tt-obj__title"><a href="<?php echo $url; ?>"><?php echo wp_kses_post( $item['title_1'] ); ?></a></div>
							<p><?php echo wp_kses_post( $item['title_2'] ); ?></p>
							<?php if ( $item_btn_text ) { ?>
							<div class="row-btn">
								<a href="<?php echo $url; ?>" class="tt-link"><?php echo $item_btn_text; ?><span class="icon-arrowhead-pointing-to-the-right-1"></span></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
					<?php
				}
			}
			?>
			</div>
			<div class="text-center tt-top-more02">
			<?php if ( $btn_link ) { ?>
				<a href="<?php echo $btn_link; ?>" class="tt-btn btn__color01">
			<?php } else { ?>
				<a href="#" data-toggle="modal" data-target="#modalMakeAppointment" class="tt-btn btn__color01">
			<?php } ?>
				<?php
				$electrician_options = electrician_options();
				if ( ! empty( $electrician_options['electrician-site-wide-icon'] ) ) {
					?>
				<span class="icon-sitewide"><?php echo $electrician_options['electrician-site-wide-icon']; ?></span>
				<?php } else { ?>
				<span class="icon-lightning"></span>
					<?php } ?>
				<?php echo $btn_text; ?>
				</a>
			</div>
		</div>
	</div>
		<?php } ?>
		<?php
	}
}
