<?php
namespace ElectricianAddons;

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.2.0
 */
class Plugin {




















	/**
	 * Instance
	 *
	 * @since  1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since  1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since  1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		global $electrician_option;
		$theme = $electrician_option['electrician_demo_select'];

		if ( $theme == '2' ) {
			wp_enqueue_script( 'electrician-addons-script-2', plugins_url( '/assets/js/addons-script-2.js', __FILE__ ), array( 'jquery', 'waypoint' ), time(), true );
		} else {
			wp_enqueue_script( 'electrician-addons-script', plugins_url( '/assets/js/addons-script.js', __FILE__ ), array( 'jquery', 'jquery.nivo', 'waypoint', 'countTo' ), time(), true );
		}
	}

	public function widget_editor_scripts() {
		// wp_enqueue_script('electrician-addons-script-2', plugins_url('/assets/js/addons-script-2.js', __FILE__), array( 'jquery' ), time(), true);
		// wp_enqueue_script('electrician-editor-script', plugins_url('assets/js/editor-script.js', __FILE__), array('jquery'), true, true);
		// wp_add_inline_script( 'elementor-editor', goodsoul_elementor_codition_script() );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since  1.2.0
	 * @access private
	 */
	private function include_widgets_files() {

		include_once __DIR__ . '/widgets/elec-title.php';
		include_once __DIR__ . '/widgets/elec-service-page-footer.php';
		include_once __DIR__ . '/widgets/elec-action-button.php';
		include_once __DIR__ . '/widgets/elec-nivo-slider.php';
		include_once __DIR__ . '/widgets/elec-about-us.php';
		include_once __DIR__ . '/widgets/elec-work-category.php';
		include_once __DIR__ . '/widgets/elec-banner.php';
		include_once __DIR__ . '/widgets/elec-bulb.php';
		include_once __DIR__ . '/widgets/elec-testimonials-1.php';
		include_once __DIR__ . '/widgets/elec-price.php';
		include_once __DIR__ . '/widgets/elec-count.php';
		include_once __DIR__ . '/widgets/elec-latest-news.php';
		include_once __DIR__ . '/widgets/elec-brands.php';
		include_once __DIR__ . '/widgets/our-advantages.php';
		include_once __DIR__ . '/widgets/elec-coupon.php';
		include_once __DIR__ . '/widgets/elec-price-table.php';
		include_once __DIR__ . '/widgets/elec-gallery.php';
		include_once __DIR__ . '/widgets/elec-faqs.php';
		include_once __DIR__ . '/widgets/elec-request-block.php';
		include_once __DIR__ . '/widgets/elec-our-services.php';
		include_once __DIR__ . '/widgets/elec-services.php';
		include_once __DIR__ . '/widgets/elec-contacts.php';
		include_once __DIR__ . '/widgets/elec-our-services-page.php';
		include_once __DIR__ . '/widgets/elect-services-text.php';
		include_once __DIR__ . '/widgets/electrician_about_two.php';
		include_once __DIR__ . '/widgets/electrician_services_slider.php';
		include_once __DIR__ . '/widgets/electrician_project.php';
		include_once __DIR__ . '/widgets/electrician_testimonial_two.php';
		include_once __DIR__ . '/widgets/electrician_video.php';
		include_once __DIR__ . '/widgets/electrician-blog.php';
		include_once __DIR__ . '/widgets/electrician_certificates.php';
		include_once __DIR__ . '/widgets/electrician_advantages.php';
		include_once __DIR__ . '/widgets/electrician_service_banner.php';
		include_once __DIR__ . '/widgets/electrician_why_us.php';
		include_once __DIR__ . '/widgets/electrician_contact_info.php';
		include_once __DIR__ . '/widgets/electrician_contact_form.php';
		include_once __DIR__ . '/widgets/electrician_testimonial_grid.php';
	}

	/**
	 * Register Widgets
	 *
	 * Register widgets.
	 *
	 * @since  1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();
		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Action_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Services_Page_Footer() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Services() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Faqs() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Nivo_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_About_Us() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Work_Category() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Our_Services() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Bulb() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Testimonials_One() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Count() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Price() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Brands() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Our_Advantage() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Coupons() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Latest_News() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Price_table() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ele_ContactForm7() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Request_Block() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Our_Services_Page() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Elec_Serives_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_About_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Services_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Project() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Testimonial_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Video() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Blog() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Certificates() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Advantages() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Service_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Why_Us() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Contact_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Contact_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Electrician_Testimonials_Grid() );
	}

	public function register_custom_css() {
		wp_register_style( 'nivo-slider', ELECTRICITY_CSS_URL . '/nivo-slider.css' );
		wp_enqueue_style( 'nivo-slider' );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since  1.2.0
	 * @access public
	 */
	public function __construct() {
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ) );
		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
		// add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'widget_editor_scripts' ) );
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'register_custom_css' ) );
	}
}

// Instantiate Plugin Class
Plugin::instance();
