<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if accessed directly

/**
 * Main Electricity Class
 *
 * The init class that runs the Electricity plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 *
 * @since 1.2.0
 */

final class Elementor_Electrician {


	/**
	 * Plugin Version
	 *
	 * @since 1.2.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.2.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Init Plugin
		add_action( 'admin_init', array( $this, 'electricity_core_notice_dismissed' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once 'plugin.php';
		require_once 'functions.php';
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		if ( ! class_exists( 'Vc_Manager' ) ) {
			$user_id = get_current_user_id();
			if ( ! get_user_meta( $user_id, 'electricity_core_notice_dismissed' ) ) {
				$message = sprintf(
					esc_html__( 'If you want to use Elementor Version of "%1$s" Theme, Its requires "%2$s" to be installed and activated.', 'electricity-core' ),
					'<strong>' . esc_html__( 'Electricity', 'electricity-core' ) . '</strong>',
					'<strong>' . esc_html__( 'Elementor', 'electricity-core' ) . '</strong>'
				);
				printf( '<div class="notice notice-warning  electricity_core is-dismissible"><p>%1$s</p><a href="?electricity-core-dismissed">Dismiss this notice</a></div>', $message );
			}
		}
	}

	public function electricity_core_notice_dismissed() {
		$user_id = get_current_user_id();
		if ( isset( $_GET['electricity-core-dismissed'] ) ) {
			add_user_meta( $user_id, 'electricity_core_notice_dismissed', 'true', true );
		}
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'electricity-core' ),
			'<strong>' . esc_html__( 'Elementor Electricity', 'electricity-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'electricity-core' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'Electricity-core' ),
			'<strong>' . esc_html__( 'Elementor Electricity', 'electricity-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'electricity-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate Elementor_Hello_World.
new Elementor_Electrician();
