<?php
/**
 * Plugin Name: Electricity Core
 * Description: Electricity WordPress themes helper plugin
 * Version: 4.3
 * Author: Smartdatasoft
 * Author URI: http://www.smartdatasoft.com/
 * Requires at least: 4.0
 * Tested up to: 4.5
 * Text Domain: electricity-core
 * Domain Path: /i18n/languages/
 *
 * @package smart
 * @category Core
 * @author Smartdatasoft
 */
if ( ! defined( 'ELECTRICITY_THEME_URI' ) ) {
	define( 'ELECTRICITY_THEME_URI', get_template_directory_uri() );
}

$theme = wp_get_theme();
define( 'THEME_VERSION_CORE', $theme->Version );
if ( ! class_exists( 'electricityCore' ) ) {

	class electricityCore {


		public static $plugindir, $pluginurl;

		function __construct() {
			self::$plugindir = dirname( __FILE__ );
			self::$pluginurl = plugins_url( '', __FILE__ );
			// add_action('admin_enqueue_scripts', array($this, 'load_smart_shortcodes_admin_scripts'));
			add_filter( 'wp_kses_allowed_html', array( $this, 'add_some_valid_html_tags' ), 10, 1 );
		}

		public function add_some_valid_html_tags( $tags = array() ) {
			$tags['iframe'] = array(
				'src'                   => true,
				'id'                    => true,
				'class'                 => true,
				'width'                 => true,
				'height'                => true,
				'style'                 => true,
				'frameborder'           => true,
				'allowfullscreen'       => true,
				'mozallowfullscreen'    => true,
				'webkitallowfullscreen' => true,
			);
			$tags['i']      = array(
				'class' => true,
				'id'    => true,
			);
			$tags['script'] = array(
				'type' => true,
				'src'  => false,
			);
			return $tags;
		}

		function load_smart_shortcodes_admin_scripts() {

			wp_enqueue_script( 'jquery' );
		}
	}

	$electricityCore = new electricityCore();
	require_once electricityCore::$plugindir . '/electricity-addons/electricity-addons.php';
	require_once electricityCore::$plugindir . '/lib/sds_cpt_gallery.php';
	require_once electricityCore::$plugindir . '/lib/config.meta.box.php';
}

// Edit by shahin
define( 'PLUGIN_DIR', dirname( __FILE__ ) . '/' );
$classesDir = array(

	PLUGIN_DIR . 'widget/',
	PLUGIN_DIR . 'widgets/',
	PLUGIN_DIR . 'post_type/',
);
__autoloadCustomFolder( $classesDir );
function __autoloadCustomFolder( $classesDir ) {

	if ( is_array( $classesDir ) || is_object( $classesDir ) ) {
		foreach ( $classesDir as $directory ) {
			foreach ( glob( $directory . '*.php' ) as $filename ) {
				if ( file_exists( $filename ) ) {
					include_once $filename;
				}
			}
		}
	}
}

function loadCustomVcMapFile() {
	require_once electricityCore::$plugindir . '/lib/vc_shortcodes.php';
	$classesDir = array(
		PLUGIN_DIR . 'shortcode/',
		PLUGIN_DIR . 'vc_element/',
	);
	__autoloadCustomFolder( $classesDir );
}

add_action( 'vc_before_init', 'loadCustomVcMapFile' );
register_activation_hook( __FILE__, 'electrician_activation_func' );

function electrician_activation_func() {
	file_put_contents( __DIR__ . '/error_log.txt', ob_get_contents() );
}

add_action( 'plugins_loaded', 'electricity_core_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function electricity_core_load_textdomain() {
	load_plugin_textdomain( 'electricity-core', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'admin_init', 'electricity_core_check_active_plugins' );

function electricity_core_check_active_plugins() {
	if ( is_plugin_active( 'js_composer/js_composer.php' ) && is_plugin_active( 'elementor/elementor.php' ) ) {
		add_action( 'admin_notices', 'admin_notice_for_multi_plugin' );
	}
}

function admin_notice_for_multi_plugin() {
	$user_id = get_current_user_id();
	if ( ! get_user_meta( $user_id, 'admin_notice_for_multi_plugin_notice_dismissed' ) ) {

		$message = sprintf(
			esc_html__(
				'"%1$s" AND "%2$s" both are page builder plugins. Those plugins load their assets itself. You should not use two at once. It may create conflict in your site performance. We strongly suggest to you using one of them.
                ',
				'electricity-core'
			),
			'<strong>' . esc_html__( 'WPBakery Page Builder', 'electricity-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'electricity-core' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning  electricity_core is-dismissible"><p>%1$s</p><a href="?electricity-core-multi-plugin-notice-dismissed"><strong>%2$s</strong></a></div>', $message, esc_html__( 'Dismiss this notice', 'electricity-core' ) );
	}
}

add_action( 'admin_init', 'admin_notice_for_multi_plugin_notice_dismissed' );

function admin_notice_for_multi_plugin_notice_dismissed() {
	 $user_id = get_current_user_id();
	if ( isset( $_GET['electricity-core-multi-plugin-notice-dismissed'] ) ) {
		add_user_meta( $user_id, 'admin_notice_for_multi_plugin_notice_dismissed', 'true', true );
	}
}



function electrician_social_share_func() {
	global $post;
	?>
	<div class="tt-col">
		<ul class="tt-social">
			<li><a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>-<?php echo esc_url( get_permalink( $post ) ); ?>" class="icon-twitter-logo-button"></a></li>
			<li><a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink( $post ) ); ?>" class="icon-facebook-logo-button"></a></li>
			<li><a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.instagram.com/p/B8Jp8UbAHmd/?utm_source=<?php echo esc_url( get_permalink( $post ) ); ?>" class="icon-instagram-logo"></a></li>
		</ul>
	</div>
	<?php
}
add_action( 'electrician_social_share', 'electrician_social_share_func' );


// Hook called when the plugin is activated.
add_action( 'plugins_loaded', 'function_elem_cpt_support' );

/**
 * This function is called on plugin activation.
 *
 * @return void
 */

/**
 * Function_elem_cpt_support adds cpt support for elementor.
 *
 * @return void
 */


function function_elem_cpt_support() {

	$cpt_support = get_option( 'elementor_cpt_support' );

	if ( ! $cpt_support ) {

		// First check if the option is not available already in the database. It not then create the array with all default post types including yours and save the settings.

		$cpt_support = array( 'page', 'post', 'electrician_services' );
		update_option( 'elementor_cpt_support', $cpt_support );
	} elseif ( ! in_array( 'electrician_services', $cpt_support ) ) {

		// If the option is available then just append the array and update the settings.

		$cpt_support[] = 'electrician_services';
		update_option( 'elementor_cpt_support', $cpt_support );
	}
}
