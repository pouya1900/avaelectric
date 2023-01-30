<?php
namespace ElectricianAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Elec_Faqs extends Widget_Base {

	public function get_name() {
		return 'elec_faqs';
	}

	public function get_title() {
		return __( 'Faqs', 'electricity-core' );
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
				'label' => __( 'FAQ List', 'electricity-core' ),
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
			'tagline',
			array(
				'label'   => esc_html__( 'Tagline', 'electrician' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Your Questions. Our Answers', 'electrician' ),
			)
		);
		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Frequently Asked <b>Questions</b>', 'electricity-core' ),
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'       => __( 'Title', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'You will find answers to all of your most common Electrical Services related questions located here.', 'electricity-core' ),
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title_1',
			array(
				'label'       => __( 'Question', 'electricity-core' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
			)
		);
		$repeater->add_control(
			'title_2',
			array(
				'label'       => __( 'Answere', 'electricity-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your title here', 'electricity-core' ),
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
						'title_1' => __( 'Does conduit need to go inside the transformer box?', 'electricity-core' ),
						'title_2' => __( 'No. Conduit should be stopped just short of the box.', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'How close to the pole do I bring my conduit to?', 'electricity-core' ),
						'title_2' => __( 'The top of the elbow must be 6" from the pole..', 'electricity-core' ),
					),
					array(
						'title_1' => __( 'Is additional conduit required beyond what is installed in the ditch?', 'electricity-core' ),
						'title_2' => __(
							'If the service is being supplied from a utility pole, the member is required to supply 1-10 section of SCH 80 PVC and 2-10 sections of SCH 40 PVC to be left near the base of the pole for installation by the power company up the pole.
                                    ',
							'electricity-core'
						),
					),
					array(
						'title_1' => __( 'Does someone need to inspect the ditch before covering the conduit?', 'electricity-core' ),
						'title_2' => __( 'Yes, contact the power company and a representative will come and inspect the ditch and conduit. The representative will place a white sticker on the meter panel with a pass or fail notice.', 'electricity-core' ),
					),
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$layout_select = $settings['layout_select'];
		?>
		<?php if ( $layout_select == 'style_1' ) { ?>
			<div class="container">
				<h1 class="text-center"><?php echo $settings['title_1']; ?></h1>
				<p class="font24 text-center"><?php echo $settings['title_2']; ?></p>
				<div class="panel-group">
					<?php
					if ( ! empty( $settings['item_list'] ) ) {
						$i = 0;
						foreach ( $settings['item_list'] as $key => $item ) {
							$isActive   = '';
							$isActive_1 = '';
							$collapsed  = 'collapsed';
							if ( $key == 0 ) {
								$isActive   = 'activate';
								$isActive_1 = 'in';
								$collapsed  = '';
							}
							?>
							<div class="faq-item">
								<div class="panel">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" href="#faq<?php echo $key + 1; ?>" class="<?php echo esc_attr( $collapsed ); ?>">
												<?php echo wp_kses_post( $item['title_1'] ); ?>
												<span class="caret-toggle closed">–</span>
												<span class="caret-toggle opened">+</span>
											</a>
										</h4>
									</div>
									<div id="faq<?php echo $key + 1; ?>" class="panel-collapse collapse <?php echo $isActive_1; ?>">
										<div class="panel-body">
											<p><?php echo wp_kses_post( $item['title_2'] ); ?></p>
										</div>
									</div>
								</div>
							</div>
							<?php
							$i++;
						}
					}
					?>
				</div>
			</div>
			<?php } elseif ( $layout_select == 'style_2' ) { ?>
				<div class="section-indent">
					<div class="container container-md-fluid">
						<div class="section-title max-width-01">
							<div class="section-title__01"><?php echo $settings['tagline']; ?></div>
							<div class="section-title__02"><?php echo $settings['title_1']; ?></div>
							<div class="section-title__03">
							<?php echo $settings['title_2']; ?>
							</div>
						</div>
						<div class="row tt-faq">
							<div class="col-md-6">
								<div class="js-accordeon">
								<?php
								$total      = count( $settings['item_list'] );
								$total_half = ceil( $total / 2 );
								$i          = 0;
								foreach ( $settings['item_list'] as $key => $item ) {
									$i++;
									?>
									<div class="tt-item">
										<div class="tt-item__marker"></div>
										<div class="tt-item__title"><?php echo wp_kses_post( $item['title_1'] ); ?></div>
										<div class="tt-item__content">
										<?php echo wp_kses_post( $item['title_2'] ); ?>
										</div>
									</div>
									<?php
									if ( $i == $total_half ) {
										break;
									}
								}
								?>
								</div> 
							</div>
							<div class="col-md-6">
								<div class="js-accordeon">
								<?php
									$i = 0;
								foreach ( $settings['item_list'] as $key => $item ) {
									$i++;
									if ( $i > $total_half ) {
										?>
									<div class="tt-item">
										<div class="tt-item__marker"></div>
										<div class="tt-item__title"><?php echo wp_kses_post( $item['title_1'] ); ?></div>
										<div class="tt-item__content">
										<?php echo wp_kses_post( $item['title_2'] ); ?>
										</div>
									</div>
										<?php
									}
								}
								?>
								</div> 
							</div>

						</div>
					</div>
				</div>
		<?php } ?>
		<?php
	}
}
