<?php
namespace ElectricianAddons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use \Elementor\Repeater;

class Electrician_Testimonial_Two extends Widget_Base {










	public function get_name() {
		return 'electrician_testimonial_two';
	}

	public function get_title() {
		return esc_html__( 'Electrician Testimonial Two', 'electrician' );
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
			'background',
			array(
				'label'   => esc_html__( 'Right Image', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$this->add_control(
			'background_shape',
			array(
				'label'   => esc_html__( 'Background Shape', 'electrician' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$this->add_control(
			'contact_title',
			array(
				'label'   => esc_html__( 'Contact Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Emergency Service', 'electrician' ),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'       => esc_html__( 'Text', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( 'If this is an emergency outside of normal business hours, call us', 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$this->add_control(
			'phone_number',
			array(
				'label'   => esc_html__( 'Phone Number', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( ' 1 (800) 765-43-21', 'electrician' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_area',
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
				'default' => __( 'What Our Clients Say', 'electrician' ),
			)
		);

		$repeater->add_control(
			'item_review_title',
			array(
				'label'   => esc_html__( 'Review Title', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Professional, Reliable & Cost Effective', 'electrician' ),
			)
		);

		$repeater->add_control(
			'item_review_text',
			array(
				'label'       => esc_html__( 'Review Text', 'electrician' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 0,
				'default'     => __( "We've been using your company and from the very beginning found him and his team to be extremely professional and knowledgeable . We wouldn't have any hesitation in recommending their services. ", 'electrician' ),
				'placeholder' => esc_html__( 'Type your description here', 'electrician' ),

			)
		);

		$repeater->add_control(
			'item_reviewer_name',
			array(
				'label'   => esc_html__( 'Reviewer Name', 'electrician' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Teresa and Kevin K.', 'electrician' ),
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

	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$layout_select        = $settings['layout_select'];
		$background           = ( $settings['background']['id'] != '' ) ? wp_get_attachment_image_url( $settings['background']['id'], 'full' ) : $settings['background']['url'];
		$background_shape     = ( $settings['background_shape']['id'] != '' ) ? wp_get_attachment_image( $settings['background_shape']['id'], 'full' ) : $settings['background_shape']['url'];
		$background_shape_alt = get_post_meta( $settings['background_shape']['id'], '_wp_attachment_image_alt', true );

		$contact_title = $settings['contact_title'];
		$text          = $settings['text'];
		$phone_number  = $settings['phone_number'];
		?>
		<?php if ( $layout_select == 'style_1' ) { ?>
		<div class="tt-box03 tt-box03__extraindent">
			<div class="container container-md-fluid">
				<div class="row no-gutters">
					<div class="col-md-7">
						<div class="tt-box03__content ">
							<div class="slick-type01 slick-dots-left" data-slick='{
										"slidesToShow": 1,
										"slidesToScroll": 1,
										"autoplaySpeed": 4500
									}'>
			<?php
			$i = 1;
			foreach ( $settings['items'] as $item ) {
				$item_title         = $item['item_title'];
				$item_review_title  = $item['item_review_title'];
				$item_review_text   = $item['item_review_text'];
				$item_reviewer_name = $item['item_reviewer_name'];
				$item_image         = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
				$image_alt          = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
				?>
								<div class="item">
									<div class="item__row">
										<div class="tt-item__img">
				<?php
				if ( wp_http_validate_url( $item_image ) ) {
					?>
																	<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
					<?php
				} else {
					echo $item_image;
				}
				?>
										</div>
										<div class="tt-item__title">
											<div class="section-title text-left">
												<div class="section-title__01"><?php echo $item_title; ?></div>
												<div class="section-title__02"><?php echo $item_review_title; ?></div>
											</div>
										</div>
									</div>
									<div class="tt-item__content">
										<blockquote>
				<?php echo $item_review_text; ?>
											<cite>- <?php echo $item_reviewer_name; ?></cite>
										</blockquote>
									</div>
								</div>
			<?php } ?>

							</div>
						</div>
						<div class="tt-box03__img tt-visible-mobile lazyload" data-bg="<?php echo $background; ?>"></div>
						<div class="tt-box03__extra">
							<div class="tt-title">
			<?php echo $contact_title; ?>
							</div>
							<p>
			<?php echo $text; ?>
							</p>
							<address><a href="tel:<?php echo $phone_number; ?>"><i class="icon-telephone"></i>
			<?php echo $phone_number; ?></a></address>
						</div>
					</div>
					<div class="tt-box03__img tt-visible-desktop lazyload" data-bg="<?php echo $background; ?>"></div>
				</div>
			</div>
		</div>
		<?php } elseif ( $layout_select == 'style_2' ) { ?>
			<div class="section-indent">
			<div class="container container-md-fluid">
			<div class="tt-box03 tt-box03__mobile-revers">
				<div class="row no-gutters">
					<div class="col-md-7">
						<div class="tt-box03__content slick-type01 slick-dots-left">
						<div class="tt-box03__bg-marker">
			<?php
			if ( wp_http_validate_url( $background_shape ) ) {
				?>
									<img src="<?php echo esc_url( $background_shape ); ?>" alt="<?php echo esc_attr( $background_shape_alt ); ?>">
				<?php
			} else {
				echo $background_shape;
			}
			?>
						</div>
						<div class="slick-type01 slick-dots-left" data-slick='{
								"slidesToShow": 1,
								"slidesToScroll": 1,
								"autoplaySpeed": 4500
								}'>
			<?php
			$i = 1;
			foreach ( $settings['items'] as $item ) {
				$item_title         = $item['item_title'];
				$item_review_title  = $item['item_review_title'];
				$item_review_text   = $item['item_review_text'];
				$item_reviewer_name = $item['item_reviewer_name'];
				$item_image         = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
				$image_alt          = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
				?>
								<div class="item">
									<div class="item__row">
										<div class="tt-item__img">
				<?php
				if ( wp_http_validate_url( $item_image ) ) {
					?>
											<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
					<?php
				} else {
					echo $item_image;
				}
				?>
										</div>
										<div class="tt-item__title">
											<div class="section-title text-left">
												<div class="section-title__01"><?php echo $item_title; ?></div>
												<div class="section-title__02"><?php echo $item_review_title; ?></div>
											</div>
										</div>
									</div>
									<div class="tt-item__content">
										<blockquote>
				<?php echo $item_review_text; ?>
											<cite>- <?php echo $item_reviewer_name; ?></cite>
										</blockquote>
									</div>
								</div>
			<?php } ?>

							</div>
						</div>
						<div class="tt-box03__img tt-visible-mobile" style="background-image: url(<?php echo $background; ?>)"></div>
					</div>
					<div class="tt-box03__img tt-visible-desktop" style="background-image: url(<?php echo $background; ?>)"></div>
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
