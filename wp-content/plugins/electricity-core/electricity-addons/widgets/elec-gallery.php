<?php
namespace ElectricianAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if accessed directly

class Elec_Gallery extends Widget_Base {

	public function get_name() {
		return 'elec-gallery';
	}

	public function get_title() {
		return __( 'Gallery', 'electricity-core' );
	}

	public function get_icon() {
		return 'eicon-post';
	}

	public function get_categories() {
		return array( 'electrician' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_blogs',
			array(
				'label' => __( 'Gallery', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'electricity-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Our <b>Gallery</b>', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'   => __( 'Title 2', 'electricity-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'You will really enjoy doing business with us! Fast, electrical estimates at a competitive price. We save you time and money. Interested? Check out our photos.', 'electricity-core' ),
			)
		);

		$this->add_control(
			'number',
			array(
				'label'   => __( 'Number of Gallery', 'electricity-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 12,
			)
		);

		$this->add_control(
			'order_by',
			array(
				'label'   => __( 'Order By', 'electricity-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => __( 'Date', 'electricity-core' ),
					'ID'            => __( 'ID', 'electricity-core' ),
					'author'        => __( 'Author', 'electricity-core' ),
					'title'         => __( 'Title', 'electricity-core' ),
					'modified'      => __( 'Modified', 'electricity-core' ),
					'rand'          => __( 'Random', 'electricity-core' ),
					'comment_count' => __( 'Comment count', 'electricity-core' ),
					'menu_order'    => __( 'Menu order', 'electricity-core' ),
				),
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => __( 'Order', 'electricity-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => array(
					'desc' => __( 'DESC', 'electricity-core' ),
					'asc'  => __( 'ASC', 'electricity-core' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$posts_per_page = $settings['number'];
		$order_by       = $settings['order_by'];
		$order          = $settings['order'];
		$pg_num         = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$args           = array(
			'post_type'      => array( 'gallery' ),
			'post_status'    => array( 'publish' ),
			'nopaging'       => false,
			'paged'          => $pg_num,
			'posts_per_page' => $posts_per_page,
			'orderby'        => $order_by,
			'order'          => $order,
		);
		$test_query     = new \WP_Query( $args );
		// wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'isotope' );

		?>
<div class="container">
  <h1 class="text-center"> 
		<?php
		echo wp_kses_post( $settings['title_1'] );
		?>
		</h1>
  <p class="font24 text-center">
		<?php
		echo wp_kses_post( $settings['title_2'] );
		?>
  </p>
  <!-- Filters -->
  <div class="filters-by-category">
	<ul class="option-set" data-option-key="filter">
	  <li><a href="#filter" data-option-value="*" class="selected"><?php echo esc_html__( 'All', 'electricty-core' ); ?></a>
	  </li>
		<?php
		$taxonomy = 'gallery-cat';
		$terms    = get_terms(
			$taxonomy,
			array(
				'orderby'    => $order_by,
				'order'      => $order,
				'hide_empty' => false,
			)
		);
		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return false;
		}

		$filters = array( '' );
		foreach ( $terms as $term ) {
			$filters[] = $term->slug;
			echo '<li><a href="#filter" data-option-value=".' . $term->slug . '" class="">' . $term->name . '</a></li>';
		}
		?>
	</ul>
  </div>
</div>
<!-- //end Filters -->
		<?php
		if ( $test_query->have_posts() ) {
			$rand   = rand( 000000, 999999 );
			$prefix = 'framework';
			echo '<div class="gallery gallery-isotope" id="gallery"> ';
			while ( $test_query->have_posts() ) {
				$test_query->the_post();
				$post_id      = get_the_ID();
				$terms        = get_the_terms( $post_id, 'gallery-cat' );
				$filter_class = '';
				if ( $terms && ! is_wp_error( $terms ) ) {
					$filter = array();
					foreach ( $terms as $term ) {
						$filter[] = $term->slug;
					}
					$filter_class = join( ' ', $filter );
				}
				$gallary_url = get_post_meta( $post_id, "{$prefix}-gallery-url", true );
				?>
<div class="gallery__item <?php echo esc_attr( $filter_class ); ?>">
  <div class="gallery__item__image">
				<?php
				the_post_thumbnail( 'gallery-thumbnail' );
				$image_url = wp_get_attachment_url( get_post_thumbnail_id() );
				?>
	<a class="hover" href="<?php echo esc_url( $image_url ); ?>">
	  <div class="inside"><span class="icon icon-technology"></span>
				<?php echo esc_html__( 'View', 'electricity-core' ); ?></div>
	</a>
  </div>
</div>
				<?php
			}
			wp_reset_postdata();
			echo '</div>';
		}
	}
}
