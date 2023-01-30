<?php
namespace ElectricianAddons\Widgets;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

/**
 *  Main Slider
 *
 *  widget for Main Slider.
 *
 * @since 1.0.0
 */

class Nivo_Slider extends Widget_Base
{

	public $slick_default = array(
		'navigation' => true,
		'arrow'      => false,
	);

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'electrician-nivo-slider';
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
	public function get_title()
	{
		return __('Main Slider', 'electricity-core');
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
	public function get_icon()
	{
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
	public function get_categories()
	{
		return array('electrician');
	}

	/**
	 * Retrieve the list of style the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */

	public function get_style_depends()
	{
		return array('nivo-slider');
	}

	public function get_script_depends()
	{
		return array('jquery', 'jquery.nivo');
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
	protected function register_controls()
	{
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __('Content', 'electricity-core'),
			)
		);

		$this->add_control(
			'style_select',
			array(
				'label'   => __('Layout Style', 'electricity-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1' => __('Style 1', 'electricity-core'),
					'2' => __('Style 2', 'electricity-core'),
				),
			)
		);
		$this->add_control(
			'preloader_switch',
			array(
				'label'        => __('Preloader On/Off', 'electricity-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'slider_img',
			array(
				'label'       => __('Choose Slider preloader image', 'electricity-core'),
				'type'        => Controls_Manager::MEDIA,
				'description' => 'it will be visible if the main slider is deactivated.',
				'condition'   => array('preloader_switch' => 'yes'),
			)
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'slider_image',
			array(
				'label'   => __('Slider image', 'electricity-core'),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'title_1',
			array(
				'label'       => __('Title one', 'electricity-core'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
			)
		);
		$repeater->add_control(
			'title_2',
			array(
				'label'       => __('Title two', 'electricity-core'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'slider_list',
			array(
				'label'   => __('Slider List', 'electricity-core'),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'title_1' => __('We’re the Current<br>Specialist!', 'electricity-core'),
						'title_2' => __('keeping you wired', 'electricity-core'),
					),
					array(
						'title_1' => __('Best Services for<br>Your Family', 'electricity-core'),
						'title_2' => __('making our clients happier', 'electricity-core'),
					),
					array(
						'title_1' => __('Nothing is<br>Impossible for Us', 'electricity-core'),
						'title_2' => __('we can light everything', 'electricity-core'),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_options',
			array(
				'label' => __('Slider Settings', 'electricity-core'),
			)
		);

		$this->add_control(
			'animSpeed',
			array(
				'label'   => __('Anim Speed', 'electricity-core'),
				'type'    => Controls_Manager::NUMBER,
				'default' => '500',
			)
		);

		$this->add_control(
			'pauseTime',
			array(
				'label'   => __('Pause Time', 'electricity-core'),
				'type'    => Controls_Manager::NUMBER,
				'default' => '6000',
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'   => __('Infinite', 'electricity-core'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'   => __('Autoplay', 'electricity-core'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'direction_nav',
			array(
				'label'   => __('Direction Nav', 'electricity-core'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$style_select = $settings['style_select'];
		$animSpeed    = $settings['animSpeed'];
		$pauseTime    = $settings['pauseTime'];

		if ($settings['pause_on_hover'] == 'yes') {
			$pause_on_hover = 'true';
		} else {
			$pause_on_hover = 'false';
		}

		if ($settings['autoplay'] == 'yes') {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}

		if ($settings['direction_nav'] == 'yes') {
			$direction_nav = 'true';
		} else {
			$direction_nav = 'false';
		}

		$change_attr_vc = array(
			'anim_speed'     => '1000',
			'pause_time'     => '1000',
			'pause_on_hover' => 'true',
			'effect'         => 'sliceUpDown',
			'prev_text'      => '',
			'next_text'      => '',
			'control_nav'    => 'false',
			'autoplay'       => 'false',
			'direction_nav'  => 'true',
		);

		$changed_atts_elementor = array(
			'anim_speed'     => $animSpeed,
			'pause_time'     => $pauseTime,
			'pause_on_hover' => $pause_on_hover,
			'effect'         => 'sliceUpDown',
			'prev_text'      => '',
			'next_text'      => '',
			'autoplay'       => $autoplay,
			'direction_nav'  => $direction_nav,
			'control_nav'    => 'false',
		);

		// wp_enqueue_script('jquery.nivo');
		// wp_enqueue_style('nivo-slider');
		// wp_localize_script('electrician-custom', 'ajax_nivoslider', $changed_atts);

		$unique_id = $this->get_id();

?>
		<!-- Slider -->
		<?php if ($style_select == '1') { ?>
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider hide-arrows-mobile" data-slick='<?php echo wp_json_encode($changed_atts_elementor); ?>'>
					<?php
					if (!empty($settings['slider_list'])) {
						foreach ($settings['slider_list'] as $key => $item) {
							$image_alt    = get_post_meta($item['slider_image']['id'], '_wp_attachment_image_alt', true);
							$slider_image = ($item['slider_image']['id'] != '') ? wp_get_attachment_url($item['slider_image']['id'], 'full') : $item['slider_image']['url'];
					?>
							<img src="<?php echo esc_url($slider_image); ?>" title="#htmlcaption<?php echo $key + 1; ?>" data-thumb="<?php echo esc_url($slider_image); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
					<?php
						}
					}
					?>
				</div>
				<?php
				if (!empty($settings['slider_list'])) {
					foreach ($settings['slider_list'] as $key => $item) {
						$image_alt = get_post_meta($item['slider_image']['id'], '_wp_attachment_image_alt', true);
				?>
						<div id="htmlcaption<?php echo $key + 1; ?>" class="nivo-caption">
							<div class="vert-wrapper">
								<div class="vert">
									<div class="text text1"><?php echo wp_kses_post($item['title_1']); ?></div>
									<div class="text text2 margin-bottom"><?php echo wp_kses_post($item['title_2']); ?></div>
								</div>
							</div>
						</div>
				<?php
					}
				}
				?>
			</div>
			<!-- Slider -->
		<?php } elseif ($style_select == '2') { ?>
			<div class="container-indent no-margin mainSlider-wrapper">
				<?php if ($settings['preloader_switch']) { ?>
					<div class="loading-content">
						<div class="loading-dots">
							<?php
							if (!empty($settings['slider_img']['url'])) {
								echo '<img src="' . $settings['slider_img']['url'] . '">';
							} else {
							?>
								<img src="<?php echo ELECTRICITY_THEME_URI; ?>/images/bolt.gif">
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<div id="js-mainSlider" class="mainSlider">
					<?php
					if (!empty($settings['slider_list'])) {
						foreach ($settings['slider_list'] as $key => $item) {
							$slider_image = ($item['slider_image']['id'] != '') ? wp_get_attachment_url($item['slider_image']['id'], 'full') : $item['slider_image']['url'];
					?>
							<div class="slide">
								<div class="img--holder" data-bgslide="<?php echo esc_url($slider_image); ?>"></div>
								<div class="slide-content">
									<div class="container text-center js-rotation" data-animation="fadeInUpSm" data-animation-delay="0s">
										<div class="tt-title-01"><?php echo wp_kses_post($item['title_1']); ?></div>
										<div class="tt-title-02"><?php echo wp_kses_post($item['title_2']); ?></div>
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
<?php
	}
}
