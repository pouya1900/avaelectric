<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Blog extends Widget_Base {
























	public function get_name() {
		return 'electrician_blog';
	}

	public function get_title() {
		return esc_html__( 'Electrician Blog', 'electrcian-core' );
	}

	public function get_icon() {
		return 'eicon-post';
	}

	public function get_categories() {
		return array( 'Electrician' );
	}

	private function get_blog_categories() {
		$options  = array();
		$taxonomy = 'category';
		if ( ! empty( $taxonomy ) ) {
			$terms = get_terms(
				array(
					'parent'     => 0,
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						 $options[''] = 'Select';
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							$options[ $term->slug ] = $term->name;
						}
					}
				}
			}
		}
		return $options;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_blogs',
			array(
				'label' => esc_html__( 'Blog', 'electrcian-core' ),
			)
		);
		$this->add_control(
			'background',
			array(
				'label'   => esc_html__( 'Background', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'Subtitle', 'electrcian-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Latest News', 'electrcian-core' ),
			)
		);
		$this->add_control(
			'title_1',
			array(
				'label'       => esc_html__( 'Title', 'electrcian-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'News & Update', 'electrcian-core' ),
			)
		);
		$this->add_control(
			'category_id',
			array(
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Category', 'electrcian-core' ),
				'options' => $this->get_blog_categories(),
			)
		);

		$this->add_control(
			'number',
			array(
				'label'   => esc_html__( 'Number of Post', 'electrcian-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
			)
		);

		$this->add_control(
			'order_by',
			array(
				'label'   => esc_html__( 'Order By', 'electrcian-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => esc_html__( 'Date', 'electrcian-core' ),
					'ID'            => esc_html__( 'ID', 'electrcian-core' ),
					'author'        => esc_html__( 'Author', 'electrcian-core' ),
					'title'         => esc_html__( 'Title', 'electrcian-core' ),
					'modified'      => esc_html__( 'Modified', 'electrcian-core' ),
					'rand'          => esc_html__( 'Random', 'electrcian-core' ),
					'comment_count' => esc_html__( 'Comment count', 'electrcian-core' ),
					'menu_order'    => esc_html__( 'Menu order', 'electrcian-core' ),
				),
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Order', 'electrcian-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => array(
					'desc' => esc_html__( 'DESC', 'electrcian-core' ),
					'asc'  => esc_html__( 'ASC', 'electrcian-core' ),
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings();
		$background     = ( $settings['background']['id'] != '' ) ? wp_get_attachment_image( $settings['background']['id'], 'full', false, array( 'class' => 'bg-marker01' ) ) : $settings['background']['url'];
		$background_alt = get_post_meta( $settings['background']['id'], '_wp_attachment_image_alt', true );
		$posts_per_page = $settings['number'];

		$title_1  = $settings['title_1'];
		$subtitle = $settings['subtitle'];

		$order_by = $settings['order_by'];
		$order    = $settings['order'];
		$pg_num   = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$args     = array(
			'post_type'      => array( 'post' ),
			'post_status'    => array( 'publish' ),
			'nopaging'       => false,
			'paged'          => $pg_num,
			'posts_per_page' => $posts_per_page,
			'category_name'  => $settings['category_id'],
			'orderby'        => $order_by,
			'order'          => $order,
		);

		$query = new \WP_Query( $args );

		?>

<!-- Nes -->
<div class="section-indent">
	<div class="container container-md-fluid">
		<div class="row">
			<div class="col-sm-6 col-lg-4">
				<div class="section-title text-left section-title_indent-01">
					<div class="section-title__01"><?php echo $subtitle; ?></div>
					<h4 class="section-title__02"><?php echo $title_1; ?></h4>
						<?php
						if ( wp_http_validate_url( $background ) ) {
							?>
								<img src="<?php echo esc_url( $background ); ?>" alt="<?php echo esc_attr( $background_alt ); ?>">
								<?php
						} else {
							echo $background;
						}
						?>
				</div>
				<div class="tt-news-list">
		<?php
		if ( $query->have_posts() ) {
			$i = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				global $post;
				if ( $i < 2 ) {
					?>
					<div class="tt-item">
						<div class="tt-item_data"><?php echo get_the_date( 'd M, Y' ); ?></div>
						<h4 class="tt-item__title"><a
								href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
						<p>
					<?php
					$content = substr( get_the_excerpt(), 0, 70 );
					echo $content . '...';
					?>
				</p>
					</div>
					<?php
				}
				$i++;
			}
			wp_reset_postdata();
		}
		?>
				</div>
			</div>
			<div class="divider d-block d-sm-none"></div>
			<div class="col-sm-6 col-lg-8">
				<div class="tt-news-col row js-init-carusel-04 slick-type01">
		<?php
		if ( $query->have_posts() ) {
			$i = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				global $post;
				if ( $i > 1 ) {
					$image = wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'electrician-post-grid' );
					?>
					<div class="col-md-12 col-lg-6">
						<div class="tt-news-obj">
							<div class="tt-news-obj__img"><?php echo $image; ?></div>
							<div class="tt-news-obj__wrapper">
								<div class="tt-news-obj__data"><?php echo get_the_date( 'd M, Y' ); ?></div>
								<div class="tt-news-obj__title"><a
										href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></div>
										<p>
					<?php
					$content = substr( get_the_excerpt(), 0, 90 );
					echo $content . '...';
					?>
										</p>
								<div class="row-btn">
									<a href="<?php echo esc_url( get_permalink() ); ?>"
										class="tt-link"><?php esc_html_e( 'Read More', 'electricity-core' ); ?><span
											class="icon-arrowhead"></span></a>
								</div>
							</div>
						</div>
					</div>
					<?php

				}
				$i++;
			}
			wp_reset_postdata();
		}
		?>
				</div>
			</div>
		</div>
	</div>
</div>

		<?php
	}

}
