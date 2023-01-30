<?php
if ( ! defined( 'ELECTRICITY_THEME_URI' ) ) {
	define( 'ELECTRICITY_THEME_URI', get_template_directory_uri() );
}

define( 'ELECTRICITY_THEME_DIR', get_template_directory() );
define( 'ELECTRICITY_CSS_URL', get_template_directory_uri() . '/css' );
define( 'ELECTRICITY_JS_URL', get_template_directory_uri() . '/js' );
define( 'ELECTRICITY_FONTS_URL', get_template_directory_uri() . '/fonts/font-awesome/css' );
define( 'ELECTRICITY_IMG_URL', ELECTRICITY_THEME_URI . '/images/' );
define( 'ELECTRICITY_FREAMWORK_DIRECTORY', ELECTRICITY_THEME_DIR . '/framework/' );
define( 'ELECTRICITY_VC_MAP', ELECTRICITY_THEME_DIR . '/vc_element/' );
define( 'REV_SLIDER_AS_THEME', true );

/*
 * plugin.php has to load to know which plugin is active
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'plugin-list.php';
/*
 * Enable support TGM features.
 */
require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'class-tgm-plugin-activation.php';
/*
 * Enable support TGM configuration.
 */
require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'config.tgm.php';

require_once ELECTRICITY_FREAMWORK_DIRECTORY . '/dashboard/class-dashboard.php';

/*
 * Enable support TGM features.
 */



function electircian_color_settings() {
	$electrician_option = electrician_options();
	$theme              = isset( $electrician_option['electrician_demo_select'] ) ? $electrician_option['electrician_demo_select'] : 1;
	if ( $theme == '2' ) {
		require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'framework_customize-2.php';
	} else {
		require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'framework_customize.php';

	}
}

add_action( 'init', 'electircian_color_settings' );

/*
 * Redux framework configuration
 */

require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'redux.fallback.php';
require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'redux.config.php';
require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'template-functions.php';


/*
 * Load VC element
 */
require_once ELECTRICITY_VC_MAP . 'vc_shortcodes_map.php';
require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'nav_menu_walker.php';

/**
 * electrician-theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package electrician-theme
 */
if ( ! function_exists( 'electrician_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function electrician_setup() {
		global $content_width;

		$content_width = apply_filters( 'electrician_content_width', 640 );
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on electrician-theme, use a find and replace
		* to change 'electrician' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'electrician', get_template_directory() . '/languages' );

		$defaults = array(
			'default-image'          => '',
			'width'                  => 0,
			'height'                 => 0,
			'flex-height'            => false,
			'flex-width'             => false,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '',
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);

		add_theme_support( 'custom-header', $defaults );

		$defaults = array(
			'default-color'          => '',
			'default-image'          => '',
			'default-repeat'         => '',
			'default-position-x'     => '',
			'default-attachment'     => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-background', $defaults );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'responsive-embeds' );

		// Add custom thumb size
		set_post_thumbnail_size( 847, 491, false );
		add_image_size( 'electrician-gallery-thumbnail', 476, 416, true );
		add_image_size( 'electrician_service_image', 870, 494, true );
		add_image_size( 'electrician_coupon', 257, 261, true );
		add_image_size( 'electrician-post-grid', 370, 280, true );
		add_image_size( 'electrician-post-list', 771, 443, true );
		add_image_size( 'electrician-sidebar-post', 333, 252, true );
	}

endif; // electrician_setup
add_action( 'after_setup_theme', 'electrician_setup' );

/*
 * Meta Box Configuration Post Meta Option
 */
require_once ELECTRICITY_FREAMWORK_DIRECTORY . 'config.meta.box.php';

add_action( 'widgets_init', 'electrician_widgets_init' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( ! function_exists( 'electrician_widgets_init' ) ) :
	function electrician_widgets_init() {

		$electrician_option = electrician_options();
		$theme              = isset( $electrician_option['electrician_demo_select'] ) ? $electrician_option['electrician_demo_select'] : 1;
		if ( $theme == '2' ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Blog Sidebar', 'electrician' ),
					'id'            => 'blogleftsidebar',
					'before_widget' => '<div class="%2$s tt-block-aside" id="%1$s"><div class="tt-aside-content">',
					'after_widget'  => '</div></div>',
					'before_title'  => '<h3 class="tt-aside-title">',
					'after_title'   => '</h3>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Services Sidebar', 'electrician' ),
					'id'            => 'servicesidebar',
					'description'   => esc_html__( 'Service sidebar area', 'electrician' ),
					'before_widget' => '<div id="%1$s" class="tt-block-aside widget %2$s"><div class="tt-aside-content">',
					'after_widget'  => '</div></div>',
					'before_title'  => '<h3 class="tt-aside-title">',
					'after_title'   => '</h3>',
				)
			);
		} else {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Blog Sidebar', 'electrician' ),
					'id'            => 'blogleftsidebar',
					'before_widget' => '<div class="%2$s side-block" id="%1$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="text-uppercase title-aside">',
					'after_title'   => '</h4>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Services Sidebar', 'electrician' ),
					'id'            => 'servicesidebar',
					'description'   => esc_html__( 'Service sidebar area', 'electrician' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4>',
					'after_title'   => '</h4>',
				)
			);
		}

		register_sidebar(
			array(
				'name'          => esc_html__( 'Page Sidebar', 'electrician' ),
				'id'            => 'pagesidebar',
				'before_widget' => '<div class="%2$s side-block" id="%1$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="text-uppercase title-aside">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Contact Sidebar', 'electrician' ),
				'id'            => 'contactsidebar',
				'before_widget' => '<div class="%2$s side-block" id="%1$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="text-uppercase title-aside">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 1', 'electrician' ),
				'id'            => 'footer_col_1',
				'description'   => esc_html__( 'Footer Column 1', 'electrician' ),
				'before_widget' => '<div id="%1$s" class="footer-widget  %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="text-uppercase title-aside">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 2', 'electrician' ),
				'id'            => 'footer_col_2',
				'description'   => esc_html__( 'Footer Column 2', 'electrician' ),
				'before_widget' => '<div id="%1$s" class="footer-widget2  %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="text-uppercase title-aside">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 3', 'electrician' ),
				'id'            => 'footer_col_3',
				'description'   => esc_html__( 'Footer Column 3', 'electrician' ),
				'before_widget' => '<div id="%1$s" class="footer-widget3  %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="text-uppercase title-aside">',
				'after_title'   => '</h4>',
			)
		);

		$secondary_footer = 1;
		if ( $secondary_footer == 1 ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Secondary Footer Column 1', 'electrician' ),
					'id'            => 'secondary_footer_col_1',
					'description'   => esc_html__( 'Footer Column 1', 'electrician' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="text-left">',
					'after_title'   => '</h4>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Secondary Footer Column 2', 'electrician' ),
					'id'            => 'secondary_footer_col_2',
					'description'   => esc_html__( 'Footer Column 2', 'electrician' ),
					'before_widget' => '<div id="%1$s" class="widget  %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="text-left">',
					'after_title'   => '</h4>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Secondary Footer Column 3', 'electrician' ),
					'id'            => 'secondary_footer_col_3',
					'description'   => esc_html__( 'Footer Column 3', 'electrician' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="text-left">',
					'after_title'   => '</h4>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Header Left', 'electrician' ),
					'id'            => 'sidebar_header_left',
					'description'   => esc_html__( 'Widget Area For Header Leftr', 'electrician' ),
					'before_widget' => '<div id="%1$s" class="widget  %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="text-left">',
					'after_title'   => '</h4>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Header Right', 'electrician' ),
					'id'            => 'sidebar_header_right',
					'description'   => esc_html__( 'Widget Area For Header Right', 'electrician' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="text-left">',
					'after_title'   => '</h4>',
				)
			);

			$theme = isset( $electrician_option['electrician_demo_select'] ) ? $electrician_option['electrician_demo_select'] : 1;
			if ( $theme == '2' ) {
				register_sidebar(
					array(
						'name'          => esc_html__( 'Woo Shop Sidebar', 'electrician' ),
						'id'            => 'woo_shop_sideber',
						'description'   => esc_html__( 'Shop sidebar area', 'electrician' ),
						'before_widget' => '<div class="%2$s tt-block-aside tt-block-aside__shadow widget" id="%1$s"><div class="tt-aside-content">',
						'after_widget'  => '</div></div>',
						'before_title'  => '<h3 class="tt-aside-title">',
						'after_title'   => '</h3>',
					)
				);
			} else {
				register_sidebar(
					array(
						'name'          => esc_html__( 'Woo Shop Sidebar', 'electrician' ),
						'id'            => 'woo_shop_sideber',
						'description'   => esc_html__( 'Shop sidebar area', 'electrician' ),
						'before_widget' => '<div class="%2$s side-block widget" id="%1$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h4 class="title-aside">',
						'after_title'   => '</h4>',
					)
				);
			}
			// end add by tanvir
		}
	}
endif; // end IF  For electrician_widgets_init

if ( ! function_exists( 'electrician_front_init_js_var' ) ) :
	function electrician_front_init_js_var() {
		global $yith_wcwl, $post, $product;

		wp_localize_script( 'electrician-custom', 'THEMEURL', array( 'url' => ELECTRICITY_THEME_URI ) );
		wp_localize_script( 'electrician-custom', 'IMAGEURL', array( 'url' => ELECTRICITY_THEME_URI . '/images' ) );
		wp_localize_script( 'electrician-custom', 'CSSURL', array( 'url' => ELECTRICITY_THEME_URI . '/css' ) );
	}
endif; // end IF  For electrician_front_init_js_var

add_action( 'wp_enqueue_scripts', 'electrician_front_init_js_var', 1001 );

/**
 * Enqueue scripts and styles.
 */

add_action( 'wp_enqueue_scripts', 'electrician_scripts_build', 1000 );
function electrician_scripts_build() {
	wp_enqueue_style( 'electrician-google-fonts', electrician_scripts_google(), array(), null );
}
function electrician_scripts_google() {
	 $electrician_option = electrician_options();

	$fonts_areas   = array(
		'electrician-body-typography',
		'electrician-heading-typography',
	);
	$font_families = array();
	foreach ( $fonts_areas as $option ) {
		if ( isset( $electrician_option[ $option ]['font-family'] ) && $electrician_option[ $option ]['font-family'] && ! in_array( $electrician_option[ $option ]['font-family'], $font_families )
		) {
			$font_families[] = $electrician_option[ $option ]['font-family'];
		}
	}

	if ( ! empty( $font_families ) ) {
		$protocol      = is_ssl() ? 'https:' : 'http:';
		$subsets       = 'latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese';
		$variants      = ':100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
		$font_families = implode( '|', $font_families );
		$query_args    = array(
			'family' => urlencode( $font_families . $variants ),
			'subset' => urlencode( $subsets ),
		);
		$font_url      = add_query_arg( $query_args, $protocol . '//fonts.googleapis.com/css' );
		return $font_url;
	} else {
		$protocol   = is_ssl() ? 'https:' : 'http:';
		$subsets    = 'latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese';
		$variants   = ':100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
		$query_args = array(
			'family' => urlencode( 'Roboto' . $variants ),
			'subset' => urlencode( $subsets ),
		);
		$font_url   = add_query_arg( $query_args, $protocol . '//fonts.googleapis.com/css' );
		return $font_url;
	}
}

add_action( 'wp_enqueue_scripts', 'electrician_scripts', 1000 );
if ( ! function_exists( 'electrician_scripts' ) ) :
	function electrician_scripts() {
		$electrician_option = electrician_options();
		$theme              = $electrician_option['electrician_demo_select'];
		// Load styles
		if ( $theme == '2' ) {
			wp_enqueue_style( 'bootstrap', ELECTRICITY_JS_URL . '/plugins/bootstrap4/bootstrap.css', false, time() );
		} else {
			wp_enqueue_style( 'bootstrap', ELECTRICITY_CSS_URL . '/bootstrap.min.css', false, time() );
		}
		wp_enqueue_style( 'bootstrap-submenu', ELECTRICITY_CSS_URL . '/bootstrap-submenu.css' );
		wp_enqueue_style( 'bootstrap-datetimepicker', ELECTRICITY_CSS_URL . '/bootstrap-datetimepicker.css' );
		wp_enqueue_style( 'animate', ELECTRICITY_CSS_URL . '/animate.min.css', array( 'e-animations' ) );

		// nivo will load only when it need, so need to register

		wp_register_style( 'nivo-slider', ELECTRICITY_CSS_URL . '/nivo-slider.css' );
		wp_enqueue_style( 'slick', ELECTRICITY_CSS_URL . '/slick.css' );
		wp_enqueue_style( 'shop', ELECTRICITY_CSS_URL . '/shop.css', false, time() );

		wp_enqueue_style( 'magnific-popup', ELECTRICITY_CSS_URL . '/magnific-popup.css' );

		// Icon Font
		if ( $theme == '2' ) {
			wp_enqueue_style( 'iconfont', ELECTRICITY_CSS_URL . '/iconfont/style-2.css', false, time() );
		} else {
			wp_enqueue_style( 'iconfont', ELECTRICITY_CSS_URL . '/iconfont/style.css', false, time() );
		}

		if ( $theme == '2' ) {
			wp_enqueue_style( 'style-2', ELECTRICITY_CSS_URL . '/style-2.css', false, time() );
			include_once ELECTRICITY_THEME_DIR . '/css/custom_style-2.php';
			$styles = electrician_get_custom_styles();
			wp_add_inline_style( 'style-2', $styles );
		} else {
			wp_enqueue_style( 'electrician-style', get_stylesheet_uri(), false, time() );
			include_once ELECTRICITY_THEME_DIR . '/css/custom_style.php';
			$styles = electrician_get_custom_styles();
			wp_add_inline_style( 'electrician-style', $styles );
		}

		// Load script
		wp_enqueue_script( 'electrician-html5shiv', ELECTRICITY_JS_URL . '/html5shiv.min.js' );
		wp_script_add_data( 'electrician-html5shiv', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'electrician-respond', ELECTRICITY_JS_URL . '/respond.min.js' );
		wp_script_add_data( 'electrician-respond', 'conditional', 'lt IE 9' );

		$apikey = '';
		if ( isset( $electrician_option['electrician-display-gmap'] ) && $electrician_option['electrician-display-gmap']
		) {
			$apikey = $electrician_option['electrician-gmap-api-key'];

			wp_register_script( 'contact-googlemap', 'https://maps.googleapis.com/maps/api/js?sensor=false&key=' . $apikey, array(), '', true );

			$gmap_vars = array(
				'GMAP_LAT'        => $electrician_option['electrician-gmap-latitude'],
				'GMAP_LNG'        => $electrician_option['electrician-gmap-longitude'],
				'GMAP_ZOOM'       => $electrician_option['electrician-gmap-zoom'],
				'GMAP_THEME_PATH' => ELECTRICITY_THEME_URI,
			);
			 wp_localize_script( 'contact-googlemap', 'electrician_gmap_vars', $gmap_vars );
		}

		if ( $theme == '2' ) {
			wp_enqueue_script( 'bootstrap', ELECTRICITY_JS_URL . '/plugins/bootstrap4/bootstrap.min.js', array( 'jquery' ), time(), true );
		} else {
			wp_enqueue_script( 'bootstrap', ELECTRICITY_JS_URL . '/plugins/bootstrap.min.js', array( 'jquery' ), time(), true );
			// it need to register when need it will load
			wp_register_script( 'jquery.nivo', ELECTRICITY_JS_URL . '/plugins/jquery.nivo.slider.js', array( 'jquery' ), '201202124', true );
			wp_enqueue_script( 'slick', ELECTRICITY_JS_URL . '/plugins/slick.min.js', array( 'jquery' ), time(), true );
		}

		wp_register_script( 'imagesloaded', ELECTRICITY_JS_URL . '/plugins/imagesloaded.pkgd.min.js', array( 'jquery' ), '201202124', true );
		wp_register_script( 'isotope', ELECTRICITY_JS_URL . '/plugins/isotope.pkgd.min.js', array( 'jquery' ), '201202124', true );
		wp_enqueue_script( 'magnific-popup', ELECTRICITY_JS_URL . '/plugins/jquery.magnific-popup.min.js', array( 'jquery' ), time(), true );
		wp_register_script( 'waypoint', ELECTRICITY_JS_URL . '/plugins/jquery.waypoints.min.js', array( 'jquery' ), '201202124', true );
		wp_register_script( 'countTo', ELECTRICITY_JS_URL . '/plugins/jquery.countTo.js', array( 'jquery' ), '201202124', true );
		wp_enqueue_script( 'electrician-custom', ELECTRICITY_JS_URL . '/custom.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'moment', ELECTRICITY_JS_URL . '/plugins/moment.min.js', array( 'jquery' ), '201202124', true );
		wp_enqueue_script( 'bootstrap-datetimepicker', ELECTRICITY_JS_URL . '/plugins/bootstrap-datetimepicker.min.js', array( 'jquery' ), '201202124', true );
		wp_enqueue_script( 'jquery-ui-spinner', false, array( 'jquery' ) );
		wp_localize_script(
			'electrician-custom',
			'my_ajax_object',
			array(
				'ajax_url'                => esc_url( admin_url( 'admin-ajax.php' ) ),
				'ajax_nonce_coupon_popup' => wp_create_nonce( 'coupon_popup_ajax' ),
				'loader_img'              => ELECTRICITY_IMG_URL . 'ajax-loader.gif',
			)
		);

		// wp_enqueue_script( 'electrician-map', 'https://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), time(), true );

		if ( $theme == '2' ) {

			wp_enqueue_script( 'electrician-bundle', ELECTRICITY_JS_URL . '/bundle.js', array( 'jquery' ), time(), true );
			$sticky = $electrician_option['electrician-site-sticky'];
			wp_localize_script(
				'electrician-bundle',
				'electrician_ajax_object',
				array(
					'ajax_url'    => esc_url( admin_url( 'admin-ajax.php' ) ),
					'ajax_sticky' => $sticky,
				)
			);
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// load google map script for contact us page

		if ( is_page_template( 'template-contact.php' ) ) {
			wp_enqueue_script( 'contact-googlemap' );
		}
	}
endif; // end IF  For electrician_scripts

function electrician_gutenberg_editor_palette_styles() {
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'strong yellow', 'electrician' ),
				'slug'  => 'strong-yellow',
				'color' => '#f7bd00',
			),
			array(
				'name'  => esc_html__( 'strong white', 'electrician' ),
				'slug'  => 'strong-white',
				'color' => '#fff',
			),
			array(
				'name'  => esc_html__( 'light black', 'electrician' ),
				'slug'  => 'light-black',
				'color' => '#242424',
			),
			array(
				'name'  => esc_html__( 'very light gray', 'electrician' ),
				'slug'  => 'very-light-gray',
				'color' => '#797979',
			),
			array(
				'name'  => esc_html__( 'very dark black', 'electrician' ),
				'slug'  => 'very-dark-black',
				'color' => '#000000',
			),
		)
	);

	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => esc_html__( 'Small', 'electrician' ),
				'size' => 10,
				'slug' => 'small',
			),
			array(
				'name' => esc_html__( 'Normal', 'electrician' ),
				'size' => 15,
				'slug' => 'normal',
			),
			array(
				'name' => esc_html__( 'Large', 'electrician' ),
				'size' => 24,
				'slug' => 'large',
			),
			array(
				'name' => esc_html__( 'Huge', 'electrician' ),
				'size' => 36,
				'slug' => 'huge',
			),
		)
	);
}
add_action( 'after_setup_theme', 'electrician_gutenberg_editor_palette_styles' );

function electrician_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'electrician_add_editor_styles' );

add_action( 'admin_enqueue_scripts', 'electrician_services_googlefont_build' );

function electrician_build_google_font() {
	$protocol   = is_ssl() ? 'https:' : 'http:';
	$query_args = array(
		'family' => urlencode( 'Roboto:400,500,700i' ),
	);
	$font_url   = add_query_arg( $query_args, $protocol . '//fonts.googleapis.com/css' );
	return $font_url;
}

function electrician_services_googlefont_build() {
	wp_enqueue_style( 'electrician-google-fonts-admin', electrician_build_google_font(), array(), null );
}

function electrician_block_editor_styles() {
	wp_enqueue_style( 'electrician-block-styles', get_theme_file_uri( 'css/all-block.css' ), false, '1.0', 'all' );
}

add_action( 'admin_enqueue_scripts', 'electrician_block_editor_styles' );

if ( ! function_exists( 'register_electrician_menu' ) ) :
	function register_electrician_menu() {
		register_nav_menu( 'primary-menu', esc_html__( 'Primary Menu', 'electrician' ) );
	}
endif; // end IF  For register_electrician_menu

add_action( 'init', 'register_electrician_menu' );

if ( ! function_exists( 'electrician_options' ) ) :
	function electrician_options() {
		global $electrician_option;
		return $electrician_option;
	}
endif; // end IF  For electrician_options

add_action( 'electrician_breadcrumb', 'electrician_breadcrumb' );

if ( ! function_exists( 'electrician_breadcrumb' ) ) :
	function electrician_breadcrumb() {

		global $post, $electrician_option;
		if ( ! isset( $post->ID ) ) {
			return false;
		}
		if ( ! is_front_page() || is_home() ) {
			if ( ( isset( $post->post_type ) && is_page() ) || is_search() || is_home() || is_single() || is_archive() || is_category() ) {
				$show_breadcrumb = get_post_meta( $post->ID, 'framework_show_breadcrumb', true );
				if ( isset( $electrician_option['electrician-blog-show-breadcrumb'] ) && $electrician_option['electrician-blog-show-breadcrumb'] && ( is_search() || is_home() || is_single() || is_archive() || is_category() )
				) {
					$show_breadcrumb = 'on';
				}
				if ( $show_breadcrumb == 'on' ) {
					$theme = $electrician_option['electrician_demo_select'];

					if ( isset( $electrician_option['electrician_breadcrumb_bg']['url'] ) && ! empty( $electrician_option['electrician_breadcrumb_bg']['url'] ) ) {
						$breadcrumb_bg = $electrician_option['electrician_breadcrumb_bg']['url'];
					}

					if ( $theme == '2' ) { ?>
						<div class="tt-breadcrumb" style="background-image: url(<?php echo esc_url( $breadcrumb_bg ); ?>)">
						<div class="container container-lg-fluid">
						<div class="breadcrumb-area">
						<?php
						if ( function_exists( 'yoast_breadcrumb' ) ) {
							yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
						}
						?>
						</div>
						</div>
						</div>
						<?php
					} else {
						?>
					<div class="container">
					<div class="breadcrumbs">
					<!-- Breadcrumb section -->
						<?php
						if ( function_exists( 'yoast_breadcrumb' ) ) {
							yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
						}
						?>
					</div>
					</div>
					<!--end .breadcrumbs -->
						<?php
					}
				}
			}
		}

	}
endif; // end IF  For electrician_breadcrumb

if ( ! function_exists( 'electrician_comment_nav' ) ) :

	function electrician_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
<nav class="navigation comment-navigation">
  <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'electrician' ); ?></h2>
  <div class="nav-links">
			<?php
			if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'electrician' ) ) ) :
				printf( '<div class="nav-previous">%s</div>', $prev_link );
			endif;

			if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'electrician' ) ) ) :
				printf( '<div class="nav-next">%s</div>', $next_link );
			endif;
			?>
  </div><!-- .nav-links -->
</nav><!-- .comment-navigation -->
			<?php
		endif;
	}

endif;
// body class filter
add_filter( 'body_class', 'electrician_body_classes' );

if ( ! function_exists( 'electrician_body_classes' ) ) :
	function electrician_body_classes( $classes ) {
		if ( is_front_page() ) {
			$classes[] = 'index';
		}
		return $classes;
	}
endif; // end IF  For electrician_body_classes
/*
 =============================================================================
 * Get Theme Font Icon
 * ============================================================================= */

if ( ! class_exists( 'ElectricianIconsForVc' ) ) {

	class ElectricianIconsForVc {







		private static $icons;

		public static function init() {
			add_filter( 'vc_iconpicker-type-electrician', array( __CLASS__, 'electrician_add_theme_icon' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'electrician_admin_enqueue' ) );
		}

		public static function electrician_get_theme_font() {

			self::$icons = apply_filters(
				'electrician_theme_icons',
				array(
					array( 'icon-arrow_right' => 'icon-arrow_right' ),
					array( 'icon-arrow_left' => 'icon-arrow_left' ),
					array( 'icon-speech' => 'icon-speech' ),
					array( 'icon-cancel' => 'icon-cancel' ),
					array( 'icon-arrow-left' => 'icon-arrow-left' ),
					array( 'icon-arrow-right' => 'icon-arrow-right' ),
					array( 'icon-light' => 'icon-light' ),
					array( 'icon-air-conditioner' => 'icon-air-conditioner' ),
					array( 'icon-security-camera' => 'icon-security-camera' ),
					array( 'icon-tool' => 'icon-tool' ),
					array( 'icon-screwdriver' => 'icon-screwdriver' ),
					array( 'icon-computer' => 'icon-computer' ),
					array( 'icon-check' => 'icon-check' ),
					array( 'icon-circle' => 'icon-circle' ),
					array( 'icon-facebook' => 'icon-facebook' ),
					array( 'icon-favorite' => 'icon-favorite' ),
					array( 'icon-google-plus' => 'icon-google-plus' ),
					array( 'icon-instagram' => 'icon-instagram' ),
					array( 'icon-interface' => 'icon-interface' ),
					array( 'icon-left-quote' => 'icon-left-quote' ),
					array( 'icon-lightning' => 'icon-lightning' ),
					array( 'icon-linkedin' => 'icon-linkedin' ),
					array( 'icon-map-marker' => 'icon-map-marker' ),
					array( 'icon-right-quote-sign' => 'icon-right-quote-sign' ),
					array( 'icon-technology' => 'icon-technology' ),
					array( 'icon-telephone' => 'icon-telephone' ),
					array( 'icon-tumblr' => 'icon-tumblr' ),
					array( 'icon-twitter' => 'icon-twitter' ),
					array( 'icon-calendar' => 'icon-calendar' ),
					array( 'icon-print' => 'icon-print' ),
					array( 'icon-shop-cart' => 'icon-shop-cart' ),
					array( 'icon-arrowhead' => 'icon-arrowhead' ),
					array( 'icon-star-black' => 'icon-star-black' ),
					array( 'icon-bin-delete' => 'icon-bin-delete' ),
					array( 'icon-calc' => 'icon-calc' ),
					array( 'icon-people' => 'icon-people' ),
					array( 'icon-price-tag' => 'icon-price-tag' ),
					array( 'icon-transport' => 'icon-transport' ),
					array( 'icon-24-hours' => 'icon-24-hours' ),
					array( 'icon-technology1' => 'icon-technology1' ),
					array( 'icon-clock' => 'icon-clock' ),
				)
			);

			return self::$icons;
		}

		public static function electrician_add_theme_icon( $icons ) {
			$icons['Electrician Icons'] = self::electrician_get_theme_font();
			return $icons;
		}

		public static function electrician_admin_enqueue() {

			wp_enqueue_style( 'electrician-admin-iconfont', get_template_directory_uri() . '/css/iconfont/style.css', '', time() );
		}
	}

	ElectricianIconsForVc::init();
}

add_filter( 'loop_shop_columns', 'loop_columns' );
if ( ! function_exists( 'loop_columns' ) ) {
	function loop_columns() {
		if ( is_product() ) {
			return 4;
		} else {
			return 3;
		}
	}
}
if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {
	function woocommerce_get_sidebar() {
		if ( is_product() ) {
		} else {
			dynamic_sidebar( 'woo_shop_sideber' );
		}
	}
}
if ( ! function_exists( 'woocommerce_pagination' ) ) {

	function woocommerce_pagination( $a = false ) {
		if ( ! $a ) {
			wc_get_template( 'loop/pagination.php' );
		} else {
			wc_get_template( 'loop/pagination-top.php' );
		}
	}
}

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) :
	function woocommerce_template_loop_product_title() {
		echo '<h3 class="woocommerce-loop-product__title">' . get_the_title() . '</h3>';
	}
endif; // end IF  For woocommerce_template_loop_product_title
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
	function woocommerce_output_upsells() {
		woocommerce_upsell_display( 4, 4 ); // Display 4 products in rows of 4
	}
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_output_cross_sell_display', 15 );

if ( ! function_exists( 'woocommerce_output_cross_sell_display' ) ) {
	function woocommerce_output_cross_sell_display() {
		woocommerce_cross_sell_display( 2, 2 ); // Display 4 products in rows of 4
	}
}

add_action( 'after_setup_theme', 'view_product_design' );
if ( ! function_exists( 'view_product_design' ) ) :
	function view_product_design() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif; // end IF  For view_product_design

if ( ! function_exists( 'woocommerce_template_loop_add_to_cart' ) ) :
	function woocommerce_template_loop_add_to_cart( $args = array() ) {
		global $product;

		if ( $product ) {
			$defaults = array(
				'quantity' => 1,
				'class'    => implode(
					' ',
					array_filter(
						array(
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
						)
					)
				),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			wc_get_template( 'loop/add-to-cart.php', $args );
		}
	}
endif; // end IF  For woocommerce_template_loop_add_to_cart

if ( ! function_exists( 'my_header_add_to_cart_fragment' ) ) :
	function my_header_add_to_cart_fragment( $fragments ) {

		ob_start();
		$count              = WC()->cart->cart_contents_count;
		$electrician_option = electrician_options();
		$theme              = $electrician_option['electrician_demo_select'];
		if ( $theme == '2' ) {
			?>
			<a href="<?php echo esc_js( 'javascript:void(0)' ); ?>" class="tt-obj__btn cart-contents">
				<i class="icon-808584"></i>
				<?php
				$count = WC()->cart->cart_contents_count;
				if ( $count > 0 ) {
					?>
				<div class="tt-obj__badge art-contents-count"><?php echo esc_html( $count ); ?></div>
				<?php } ?>
			</a>
		<?php } else { ?>
		<a class="cart-contents icon icon-shop-cart" href="<?php echo esc_js( 'javascript:void(0)' ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'electrician' ); ?>">
			<?php
			if ( $count > 0 ) {
				?>
					  <span class="badge cart-contents-count"><?php echo esc_html( $count ); ?></span>
			<?php } ?>
			</a>



			<?php
		}
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
endif; // end IF  For my_header_add_to_cart_fragment

add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment_details' );

if ( ! function_exists( 'my_header_add_to_cart_fragment_details' ) ) :
	function my_header_add_to_cart_fragment_details( $fragments ) {
		ob_start();
		?>
<div class="tt-obj__dropdown header-cart-dropdown">
		<?php get_template_part( 'woocommerce/cart/mini', 'cart' ); ?>
</div>
		<?php
		$fragments['div.header-cart-dropdown'] = ob_get_clean();
		return $fragments;
	}
endif; // end IF  For my_header_add_to_cart_fragment_details

if ( ! function_exists( 'woocommerce_widget_shopping_cart_button_view_cart' ) ) :
	function woocommerce_widget_shopping_cart_button_view_cart() {
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="btn wc-forward">' . esc_html__( 'View cart', 'electrician' ) . '</a>';
	}
endif; // end IF  For woocommerce_widget_shopping_cart_button_view_cart

if ( ! function_exists( 'woocommerce_widget_shopping_cart_proceed_to_checkout' ) ) :
	function woocommerce_widget_shopping_cart_proceed_to_checkout() {
		$electrician_option = electrician_options();
		$theme              = $electrician_option['electrician_demo_select'];

		if ( $theme == '2' ) {
			echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="tt-btn btn__color01 checkout wc-forward">' . esc_html__( 'Proceed to Checkout', 'electrician' ) . '</a>';
		} else {
			echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn btn-invert checkout wc-forward">' . esc_html__( 'Checkout', 'electrician' ) . '</a>';
		}

	}
endif; // end IF  For woocommerce_widget_shopping_cart_proceed_to_checkout

if ( ! function_exists( 'remove_item_from_cart' ) ) :
	function remove_item_from_cart() {
		$cart         = WC()->instance()->cart;
		$id           = sanitize_text_field( $_POST['product_id'] );
		$cart_id      = $cart->generate_cart_id( $id );
		$cart_item_id = $cart->find_product_in_cart( $cart_id );
		$array        = array();
		if ( $cart_item_id ) {
			$cart->set_quantity( $cart_item_id, 0 );
			// $array['success']=true;
			WC_AJAX::get_refreshed_fragments();
		} else {
			$array['error'] = true;
			echo json_encode( $array );
		}

		exit();
	}
endif; // end IF  For remove_item_from_cart

add_action( 'wp_ajax_remove_item_from_cart', 'remove_item_from_cart' );
add_action( 'wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart' );

// Display 24 products per page. Goes in functions.php
if ( ! function_exists( 'electrician_loop_shop_per_page' ) ) {
	function electrician_loop_shop_per_page( $cols ) {
		$cols = 9;
		return $cols;
	}
}
add_filter( 'loop_shop_per_page', 'electrician_loop_shop_per_page', 20 );

// Display Update car Added success massage.
add_filter( 'wc_add_to_cart_message_html', 'wc_add_to_cart_message_html_func', 10, 2 );
if ( ! function_exists( 'wc_add_to_cart_message_html_func' ) ) :
	function wc_add_to_cart_message_html_func( $message, $product_id ) {
		$message = preg_replace(
			'#<a.*?>([^>]*)</a>#i',
			'<a href="' . esc_url( wc_get_cart_url() ) . '"
  class="btn btn-invert wc-forward">' . esc_html__( 'View cart', 'electrician' ) . '</a>',
			$message
		);
		return $message;
	}
endif; // end IF For wc_add_to_cart_message_html_func

// Display Update car Added Error massage.
add_filter( 'woocommerce_add_error', 'my_woocommerce_add_error' );
if ( ! function_exists( 'my_woocommerce_add_error' ) ) :
	function my_woocommerce_add_error( $error ) {
		$error = preg_replace(
			'#<a.*?>([^>]*)</a>#i',
			'<a href="' . esc_url( wc_get_cart_url() ) . '"
    class="btn btn-invert wc-forward">' . esc_html__( 'View cart', 'electrician' ) . '</a>',
			$error
		);
		return $error;
	}
endif; // end IF For my_woocommerce_add_error

function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		if ( $post->post_type == 'electrician_services' ) {
			$classes[] = 'customwidget_' . $post->post_name;
		}
	}
	return $classes;
}
  add_filter( 'body_class', 'add_slug_body_class' );

add_filter(
	'electrician_services_postype_electrician_services_slug',
	'electrician_services_postype_electrician_services_slug',
	10
);

function electrician_services_postype_electrician_services_slug() {
	if ( function_exists( 'electrician_options' ) ) {
		$electrician_options = electrician_options();
		if ( isset( $electrician_options['electrician-slug_postype_electrician_services'] )
		   && ! empty( $electrician_options['electrician-slug_postype_electrician_services'] )
		) {
			return $electrician_options['electrician-slug_postype_electrician_services'];
		}
	}
}

  add_action( 'vc_before_init', 'electician_services_vcsetsstheme' );
function electician_services_vcsetsstheme() {
	vc_set_as_theme();
}

  /*
  add_action( 'wp_enqueue_scripts', 'electrician_disable_woocommerce_loading_css_js' );

  function electrician_disable_woocommerce_loading_css_js() {

  if( function_exists( 'is_woocommerce' ) ){

  if(! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
  wp_dequeue_style('woocommerce-layout');
  wp_dequeue_style('woocommerce-general');
  wp_dequeue_style('woocommerce-smallscreen');
  wp_dequeue_script('wc-cart-fragments');
  wp_dequeue_script('electrician');
  wp_dequeue_script('wc-add-to-cart');

  }
  }
  }*/

  add_action( 'electrician_preloader', 'electrician_preloader_function' );

if ( ! function_exists( 'electrician_preloader_function' ) ) {

	function electrician_preloader_function() {
		$electrician_options = electrician_options();
		if ( isset( $electrician_options['electrician-site-preloader'] ) && $electrician_options['electrician-site-preloader'] ) {
			if ( isset( $electrician_options['electrician_site_preloader_image'] )
				&& $electrician_options['electrician_site_preloader_image']['url'] != ''
			) {
				?>
  <div id="loader-wrapper" class="loader-on">
	<div class="custom-loader">
	  <img alt="<?php esc_html__( 'Loader Image', 'electrician' ); ?>"
		src="<?php echo esc_url( $electrician_options['electrician_site_preloader_image']['url'] ); ?>">
	</div>
  </div>
				<?php
			} else {
				?>
  <div id="loader-wrapper" class="loader-on">
	<div id="loader">
	  <div class="loader">
		<div class="bolt one">
		  <div class="other"></div>
		</div>
		<div class="bolt two">
		  <div class="other"></div>
		</div>
		<div class="bolt three">
		  <div class="other"></div>
		</div><?php esc_html_e( 'loading', 'electrician' ); ?>
	  </div>
	</div>
  </div>
				<?php
			}
		}
	}
}


if ( ! function_exists( 'electrician_comments' ) ) {

	function electrician_comments( $comment, $args, $depth ) {
		extract( $args, EXTR_SKIP );
		$args['reply_text'] = esc_html__( 'Reply', 'electrician' );
		$class              = '';
		if ( $depth > 1 ) {
			$class = '';
		}
		if ( $depth == 1 ) {
			$child_html_el     = '<ul><li>';
			$child_html_end_el = '</li></ul>';
		}

		if ( $depth >= 2 ) {
			$child_html_el     = '<li>';
			$child_html_end_el = '</li>';
		}
		?>
	
		<li>
		<?php if ( $comment->comment_type != 'trackback' && $comment->comment_type != 'pingback' ) { ?>
			<div class="comment tt-item" id="comment-<?php comment_ID(); ?>">
		<?php } else { ?>
				<div class="comment tt-item yes-ping">
		<?php } ?>
				<div class="tt-comments-level-1">
		<?php if ( $comment->comment_type != 'trackback' && $comment->comment_type != 'pingback' ) { ?>
					<div class="tt-avatar">
			<?php print get_avatar( $comment, 89, null, null, array( 'class' => array() ) ); ?>
					</div>
		<?php } ?>
					<div class="tt-content">
						<div class="tt-comments-title">
							<div class="username"><?php echo get_comment_author_link(); ?></div>
							<div class="time"><?php echo get_comment_date( 'd M, Y' ); ?></div>
						</div>
		<?php comment_text(); ?>
		<?php
		$replyBtn = 'tt-btn-default tt-btn-default__small';
		echo preg_replace(
			'/comment-reply-link/',
			'comment-reply-link ' . $replyBtn,
			get_comment_reply_link(
				array_merge(
					$args,
					array(
						'reply_text' => esc_html__( 'Reply', 'electrician' ),
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
					)
				)
			),
			1
		);
		?>
					</div>
				</div>
			</div>
		
		<?php
	}
}
/*
*    Comments Counter showing in post list and post details
*/
if ( ! function_exists( 'electrician_comments_count' ) ) :

	function electrician_comments_count( $suffix = null ) {
		if ( get_comments_number( get_the_ID() ) == 0 ) {
			$comments_count = '<a href="' . esc_url( get_permalink() ) . '" >' . $suffix . get_comments_number( get_the_ID() ) . esc_html__( ' Comments', 'electrician' ) . '</a>';
		} elseif ( get_comments_number( get_the_ID() ) > 1 ) {
			$comments_count = '<a href="' . esc_url( get_permalink() ) . '" >' . $suffix . get_comments_number( get_the_ID() ) . esc_html__( ' Comments', 'electrician' ) . '</a>';
		} else {
			$comments_count = '<a href="' . esc_url( get_permalink() ) . '#comments" >' . $suffix . get_comments_number( get_the_ID() ) . esc_html__( ' Comment', 'electrician' ) . '</a>';
		}
		echo sprintf( esc_html( '%s' ), $comments_count ); // WPCS: XSS OK.
	}
endif;


function electricin_google_font() {
	 $protocol  = is_ssl() ? 'https' : 'http';
	$subsets    = 'latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese';
	$variants   = ':600';
	$query_args = array(
		'family' => 'Poppins' . $variants,
		'subset' => $subsets,
	);
	$font_url   = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );
	wp_enqueue_style( 'electrician-google-fonts-two', $font_url, array(), null );
}
add_action( 'init', 'electricin_google_font' );

function electricin_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'electricin_comment_field_to_bottom' );


if ( ! function_exists( 'electrician_service_archive_to_custom_archive' ) ) {

	function electrician_service_archive_to_custom_archive() {
		$electrician_options = electrician_options();
		if ( isset( $electrician_options['electrician-slug_postype_electrician_services_archive'] ) && ! empty( $electrician_options['electrician-slug_postype_electrician_services_archive'] ) ) {

			if ( is_post_type_archive( 'electrician_services' ) ) {
				wp_redirect( home_url( '/' . $electrician_options['electrician-slug_postype_electrician_services_archive'] . '/' ), 301 );
				exit();
			}
		}
	}
}
add_action( 'template_redirect', 'electrician_service_archive_to_custom_archive' );


if ( ! function_exists( 'electrician_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */

	function electrician_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'electrician_theme_register_elementor_locations', array( true ), '2.0', 'electrician_register_elementor_locations' );
		if ( apply_filters( 'electrician_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}

add_action( 'elementor/theme/register_locations', 'electrician_register_elementor_locations' );




function electrician_appointment_form() {
	$electrician_options = electrician_options();
	if ( isset( $electrician_options['electrician_modal_form'] ) && ! empty( $electrician_options['electrician_modal_form'] ) ) {
		?>
		<div class="modal fade" id="modalMakeAppointment" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content ">
					<div class="modal-body form-default modal-layout-dafault">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon-860796"></span></button>
						<?php echo do_shortcode( $electrician_options['electrician_modal_form'] ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action( 'wp_footer', 'electrician_appointment_form', 100 );
