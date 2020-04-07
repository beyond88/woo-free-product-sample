<?php
/**
 * @link              https://www.thewpnext.com
 * @since             1.0.0
 * @package           Woo_Free_Product_Sample
 *
 * @wordpress-plugin
 * Plugin Name:       Free Product Sample for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/woo-free-product-sample
 * Description:       Display an add to cart button in the product detail page to order product as free sample.  
 * Version:           2.0.3
 * Author:            TheWPNext
 * Author URI:        https://www.thewpnext.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-free-product-sample
 * Domain Path:       /languages
 * Requires PHP:      5.6
 * Requires at least: 4.4
 * Tested up to:      5.3
 *
 * WC requires at least: 3.1
 * WC tested up to:   3.9* 
 * Copyright: © 2020.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Required functions
require_once( plugin_dir_path( __FILE__ ) . 'woo-includes/woo-functions.php' );

// WC active check
if ( ! is_woocommerce_active() ) {
	return;
}

define( 'WFPS_VERSION', '2.0.3' );
define( 'MINIMUM_PHP_VERSION', '5.6.0' );
define( 'MINIMUM_WP_VERSION', '4.4' );
define( 'MINIMUM_WC_VERSION', '3.0.9' );
define( 'WFPS_URL', plugins_url( '/', __FILE__ ) );
define( 'WFPS_ADMIN_URL', WFPS_URL . 'admin/' );
define( 'WFPS_PUBLIC_URL', WFPS_URL . 'public/' );
define( 'WFPS_FILE', __FILE__ );
define( 'WFPS_ROOT_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WFPS_ADMIN_DIR_PATH', WFPS_ROOT_DIR_PATH . 'admin/' );
define( 'WFPS_PUBLIC_PATH', WFPS_ROOT_DIR_PATH . 'public/' );
define( 'WFPS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'WFPS_PLUGIN_NAME', 'Free Product Sample for WooCommerce' );

/**
 * Free Product Sample for WooCommerce Start.
 *
 * @since 2.0.0
 */
class Woo_Free_Product_Sample_Start {	

	/** @var \Woo_Free_Product_Sample_Start single instance of this class */
	private static $instance;

	/** @var array the admin notices to add */
	private $notices = array();

	/**
	 * Loads Free Product Sample for WooCommerce Start.
	 *
	 * @since 2.0.0
	 */
	protected function __construct() {

		register_activation_hook( __FILE__, array( $this, 'activation_check' ) );

		// handle notices and activation errors
		add_action( 'admin_init',    array( $this, 'check_environment' ) );
		add_action( 'admin_init',    array( $this, 'add_plugin_notices' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ), 15 );

		// if the environment check fails, initialize the plugin
		if ( $this->is_environment_compatible() ) {
			add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
		}
	}

	/**
	 *
	 * @since    2.0.0
	 */
    public function plugin_action_links( $links ) {

		$links[] = '<a href="http://plugins.mohiuddinabdulkader.website/woo-free-product-sample" style="color: #389e38;font-weight: bold;">' . __( 'Go PRO', 'woo-free-product-sample' ) . '</a>';
		$links[] = '<a href="' . admin_url( 'admin.php?page=woo-free-product-sample' ) . '">' . __( 'Configure', 'woo-free-product-sample' ) . '</a>';
		$links[] = '<a href="https://wordpress.org/support/plugin/woo-free-product-sample">' . __( 'Docs', 'woo-free-product-sample' ) . '</a>';
		$links[] = '<a href="https://wordpress.org/support/plugin/woo-free-product-sample">' . __( 'Support', 'woo-free-product-sample' ) . '</a>';
		$links[] = '<a href="https://wordpress.org/plugins/woo-free-product-sample/#reviews">' . __( 'Review', 'woo-free-product-sample' ) . '</a>';

        return $links;
    }	


	/**
	 * Cloning instances is forbidden due to singleton pattern.
	 *
	 * @since 2.0.0
	 */
	public function __clone() {

		_doing_it_wrong( __FUNCTION__, sprintf( 'You cannot clone instances of %s.', get_class( $this ) ), '2.0.0' );
	}


	/**
	 * Unserializing instances is forbidden due to singleton pattern.
	 *
	 * @since 2.0.0
	 */
	public function __wakeup() {

		_doing_it_wrong( __FUNCTION__, sprintf( 'You cannot unserialize instances of %s.', get_class( $this ) ), '2.0.0' );
	}


	/**
	 * Initializes the plugin.
	 *
	 * @internal
	 *
	 * @since 2.0.0
	 */
	public function init_plugin() {

		if ( ! $this->plugins_compatible() ) {
			return;
		}

		// load the main plugin class
		require_once( WFPS_ROOT_DIR_PATH . 'includes/class-woo-free-product-sample.php' );

		$plugin = new Woo_Free_Product_Sample();
		$plugin->run();
	}

	/**
	 * Checks the server environment and other factors and deactivates plugins as necessary.
	 *
	 * Based on http://wptavern.com/how-to-prevent-wordpress-plugins-from-activating-on-sites-with-incompatible-hosting-environments
	 *
	 * @internal
	 *
	 * @since 2.0.0
	 */
	public function activation_check() {

		if ( ! $this->is_environment_compatible() ) {

			$this->deactivate_plugin();

			wp_die( WFPS_PLUGIN_NAME . ' could not be activated. ' . $this->get_environment_message() );
		}
	}

	/**
	 * Checks the environment on loading WordPress, just in case the environment changes after activation.
	 *
	 * @internal
	 *
	 * @since 2.0.0
	 */
	public function check_environment() {

		if ( ! $this->is_environment_compatible() && is_plugin_active( plugin_basename( __FILE__ ) ) ) {

			$this->deactivate_plugin();

			$this->add_admin_notice( 'bad_environment', 'error', WFPS_PLUGIN_NAME . ' has been deactivated. ' . $this->get_environment_message() );
		}
	}


	/**
	 * Adds notices for out-of-date WordPress and/or WooCommerce versions.
	 *
	 * @internal
	 *
	 * @since 2.0.0
	 */
	public function add_plugin_notices() {

		if ( ! $this->is_wp_compatible() ) {

			$this->add_admin_notice( 'update_wordpress', 'error', sprintf(
				'%s requires WordPress version %s or higher. Please %supdate WordPress &raquo;%s',
				'<strong>' . WFPS_PLUGIN_NAME . '</strong>',
				MINIMUM_WP_VERSION,
				'<a href="' . esc_url( admin_url( 'update-core.php' ) ) . '">', '</a>'
			) );
		}

		if ( ! $this->is_wc_compatible() ) {

			$this->add_admin_notice( 'update_woocommerce', 'error', sprintf(
				'%1$s requires WooCommerce version %2$s or higher. Please %3$supdate WooCommerce%4$s to the latest version, or %5$sdownload the minimum required version &raquo;%6$s',
				'<strong>' . WFPS_PLUGIN_NAME . '</strong>',
				MINIMUM_WC_VERSION,
				'<a href="' . esc_url( admin_url( 'update-core.php' ) ) . '">', '</a>',
				'<a href="' . esc_url( 'https://downloads.wordpress.org/plugin/woocommerce.' . MINIMUM_WC_VERSION . '.zip' ) . '">', '</a>'
			) );
		}
	}


	/**
	 * Determines if the required plugins are compatible.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	private function plugins_compatible() {

		return $this->is_wp_compatible() && $this->is_wc_compatible();
	}


	/**
	 * Determines if the WordPress compatible.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	private function is_wp_compatible() {

		return version_compare( get_bloginfo( 'version' ), MINIMUM_WP_VERSION, '>=' );
	}


	/**
	 * Determines if the WooCommerce compatible.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	private function is_wc_compatible() {

		return defined( 'WC_VERSION' ) && version_compare( WC_VERSION, MINIMUM_WC_VERSION, '>=' );
	}


	/**
	 * Deactivates the plugin.
	 *
	 * @since 2.0.0
	 */
	private function deactivate_plugin() {

		deactivate_plugins( plugin_basename( __FILE__ ) );

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}


	/**
	 * Adds an admin notice to be displayed.
	 *
	 * @internal
	 *
	 * @since 2.0.0
	 *
	 * @param string $slug the slug for the notice
	 * @param string $class the css class for the notice
	 * @param string $message the notice message
	 */
	public function add_admin_notice( $slug, $class, $message ) {

		$this->notices[ $slug ] = array(
			'class'   => $class,
			'message' => $message
		);
	}


	/**
	 * Displays admin notices.
	 *
	 * @since 2.0.0
	 */
	public function admin_notices() {

		foreach ( $this->notices as $notice_key => $notice ) :

			?>
			<div class="<?php echo esc_attr( $notice['class'] ); ?>">
				<p><?php echo wp_kses( $notice['message'], array( 'a' => array( 'href' => array() ) ) ); ?></p>
			</div>
			<?php

		endforeach;
	}


	/**
	 * Determines if the server environment is compatible with this plugin.
	 *
	 * Override this method to add checks for more than just the PHP version.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	private function is_environment_compatible() {

		return version_compare( PHP_VERSION, MINIMUM_PHP_VERSION, '>=' );
	}


	/**
	 * Gets the message for display when the environment is incompatible with this plugin.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	protected function get_environment_message() {

		return sprintf( 'The minimum PHP version required for this plugin is %1$s. You are running %2$s.', MINIMUM_PHP_VERSION, PHP_VERSION );
	}


	/**
	 * Gets the main Measurement Price Calculator loader instance.
	 *
	 * Ensures only one instance can be loaded.
	 *
	 * @since 2.0.0
	 *
	 * @return \Woo_Free_Product_Sample_Start
	 */
	public static function instance() {

		if ( null === self::$instance ) {

			self::$instance = new self();
		}

		return self::$instance;
	}


}


// fire it up!
Woo_Free_Product_Sample_Start::instance();