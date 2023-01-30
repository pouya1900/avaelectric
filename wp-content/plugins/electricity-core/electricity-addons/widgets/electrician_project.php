<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Project extends Widget_Base {




	public function get_name() {
		return 'electrician_project';
	}

	public function get_title() {
		return esc_html__( 'Electrician Project', '' );
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
				'label' => esc_html__( 'general', '' ),
			)
		);
		$this->add_control(
			'layout_select',
			array(
				'label'   => __( 'Layout Select', 'plugin-core' ),
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
				'label'   => esc_html__( 'Tagline', '' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '@electricians', '' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', '' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Our Projects', '' ),
			)
		);
		$this->add_control(
			'subheading',
			array(
				'label'   => esc_html__( 'Sub Heading', '' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'You will really enjoy doing business with us! Fast, electrical estimates at a competitive price. We save you time and money. Interested? Check out our photos.', '' ),
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
			'btn_name',
			array(
				'label'   => esc_html__( 'Button Name', '' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'View More', '' ),
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'   => esc_html__( 'Button Link', '' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url'         => '',
					'is_external' => '',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'item', '' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_category',
			array(
				'label'   => esc_html__( 'Category', '' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Residences', '' ),
			)
		);

		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', '' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$this->add_control(
			'items',
			array(
				'label'   => esc_html__( 'Repeater List', '' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'list_title'   => esc_html__( 'Title #1', '' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', '' ),
					),
					array(
						'list_title'   => esc_html__( 'Title #2', '' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', '' ),
					),
				),
			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$tagline       = $settings['tagline'];
		$heading       = $settings['heading'];
		$subheading    = $settings['subheading'];
		$layout_select = $settings['layout_select'];
		$tab1          = $settings['tab1'];
		$btn_name      = $settings['btn_name'];
		$button_link   = $settings['button_link'];
		$url           = $button_link['url'];
		$target        = $button_link['is_external'] ? 'target="_blank"' : '';

		?>
		<?php if ( $layout_select == 'style_1' ) { ?>
<div class="section-indent">
	<div class="container container-md-fluid">
		<div class="section-title max-width-01">
			<div class="section-title__01"><?php echo $tagline; ?></div>
			<div class="section-title__02"><?php echo $heading; ?></div>
			<?php if ( $subheading ) { ?>
			<div class="section-title__03"><?php echo $subheading; ?></div>
			<?php } ?>
		</div>
			<?php
			$category_arr       = array();
			$category_arr_class = array();
			foreach ( $settings['items'] as $key => $item ) {
				$cat = $item['item_category'];
				// $child_categories_ex        = explode( ',', $cat );
				$child_categories           = str_replace( ' ', '_', $cat );
				$category_arr_class[ $key ] = strtolower( $child_categories );
				// foreach ( $cat as $child_category ) {
					$category_arr[] = strtolower( $cat );
				// }
			}
			?>

			<div id="filter-nav">
				<ul>

					<li class="active"><a class="gallery-navitem" href="all"> <?php echo $tab1; ?></a></li>
			<?php
			$category_arr = array_unique( $category_arr );
			foreach ( $category_arr as $category ) {
				$category_slug = str_replace( ' ', '_', $category );
				echo '<li> <a class="gallery-navitem" href="' . $category_slug . '">' . $category . '</a></li>';
			}
			?>
				</ul>
			</div>
			<div id="filter-layout" class="row justify-content-center gallery-innerlayout-wrapper js-wrapper-gallery">
			<?php
			$i = 0;
			foreach ( $settings['items'] as $key => $item ) {
				$item_image_url = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];

				$item_image = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
				$image_alt  = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
				$i++;
				if ( $i > 10 ) {
					$class = 'item-hide';
				} else {
					$class = '';
				}
				?>
				<div class="col-4 col-md-3 col-custom-item5 <?php echo esc_attr( $category_arr_class[ $key ] ); ?> show all <?php echo $class; ?>">
					<a href="<?php echo $item_image_url; ?>" class="tt-gallery"><div class="gallery__icon"></div>
					<?php
					if ( wp_http_validate_url( $item_image ) ) {
						?>
						<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
							<?php
					} else {
						echo $item_image;
					}
					?>
				</a>
				</div>
			<?php } ?>
			<?php if ( ! empty( $btn_name ) ) { ?>
				<?php if ( $url ) { ?>
					<div class="col-12 text-center tt-top-more show">
					
					<?php
					if ( $url ) {
						?>
							<a href="<?php echo $url; ?>"
								<?php
								if ( ! ( empty( $target ) ) ) :
									?>
					target="<?php echo $target; ?>" 
									<?php
								endif;
								?>
								 class="tt-link tt-link__lg"><?php echo esc_html( $btn_name ); ?><span class="icon-arrowhead-pointing-to-the-right-1"></span></a>
					</div>
						<?php
					}
				} else {
					?>
				<div class="col-12 text-center tt-top-more" id="js-more-include">
					<a href="#" class="tt-link tt-link__lg"><?php echo esc_html( $btn_name ); ?><span class="icon-arrowhead-pointing-to-the-right-1"></span></a>
				</div>
					<?php
				}
			}
			?>
			</div>
	</div>
</div>
		<?php } elseif ( $layout_select == 'style_2' ) { ?>
		<div class="section-indent">
		<div class="container container-md-fluid">
			<div class="section-title max-width-01">
				<div class="section-title__01"><?php echo $tagline; ?></div>
				<div class="section-title__02"><?php echo $heading; ?></div>
				<div class="section-title__03">
			<?php echo $subheading; ?>
				</div>
			</div>
			<?php
			$category_arr       = array();
			$category_arr_class = array();
			foreach ( $settings['items'] as $key => $item ) {
				$cat = $item['item_category'];
				// $child_categories_ex        = explode( ',', $cat );
				$child_categories           = str_replace( ' ', '_', $cat );
				$category_arr_class[ $key ] = strtolower( $child_categories );
				// foreach ( $cat as $child_category ) {
					$category_arr[] = strtolower( $cat );
				// }
			}
			?>
			<div id="filter-nav">
				<ul>
					<li class="active"><a class="gallery-navitem" href="filter-all"><?php echo $tab1; ?></a></li>
			<?php
			$category_arr = array_unique( $category_arr );
			foreach ( $category_arr as $category ) {
				$category_slug = str_replace( ' ', '_', $category );
				echo '<li> <a class="gallery-navitem" href="' . $category_slug . '">' . $category . '</a></li>';
			}
			?>
				</ul>
			</div>
			<div id="filter-layout" class="row justify-content-center tt-gallery-wrapper js-wrapper-gallery">
			<?php
			$i = 0;
			foreach ( $settings['items'] as $key => $item ) {
				$item_image_url = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
				$item_image     = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
				$image_alt      = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
				$i++;
				if ( $i > 12 ) {
					$class = 'item-hide';
				} else {
					$class = '';
				}
				$cat              = $item['item_category'];
				$child_categories = str_replace( ' ', '_', $cat );
				$category_slug    = strtolower( $child_categories );
				?>
				<div class="col-6 col-md-4 show filter-all <?php echo esc_attr( $category_slug ); ?> <?php echo $class; ?>">
					<a href="<?php echo $item_image_url; ?>" class="tt-gallery"><div class="gallery__icon"></div>
					<?php
					if ( wp_http_validate_url( $item_image ) ) {
						?>
					<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						<?php
					} else {
						echo $item_image;
					}
					?>
				</a>
				</div>
			<?php } ?>
			<?php if ( $url ) { ?>
			<div class="col-12 text-center tt-top-more show">
				<?php if ( $url ) { ?>
					<?php
					if ( $url ) {
						?>
							<a href="<?php echo $url; ?>"
								<?php
								if ( ! ( empty( $target ) ) ) :
									?>
					target="<?php echo $target; ?>" 
									<?php
								endif;
								?>
								 class="tt-link"><?php echo $btn_name; ?><span class="icon-arrowhead-pointing-to-the-right-1"></span></a>
					</div>
						<?php
					}
				} else {
					?>
				<div class="col-12 text-center tt-top-more" id="js-more-include">
					<a href="#" class="tt-link"><?php echo $btn_name; ?><span class="icon-arrowhead-pointing-to-the-right-1"></span></a>
				</div>
					<?php
				}
			}
			?>
			</div>
		</div>
	</div>
		<?php } ?>
		<?php
	}

	protected function content_template() {

	}
}
