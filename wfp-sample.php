<?php
/**
 * @link              https://profiles.wordpress.org/hossain88
 * @since             1.0.0
 * @package           Wfp_Sample
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Free Product Sample
 * Plugin URI:        https://wordpress.org/plugins/woo-free-product-sample
 * Description:       WooCommerce Free Product Sample is a WordPress plugin. Display an add to cart button in product detail page to order product as free sample. Shop owner can be offered to customer to order product as free sample to promote his product or business.  
 * Version:           1.1.5
 * Author:            Mohiuddin Abdul Kader
 * Author URI:        https://profiles.wordpress.org/hossain88
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wfp-sample
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WFPS_VERSION', '1.1.5' );
define( 'WFPS_URL', plugins_url( '/', __FILE__ ) );
define( 'WFPS_ADMIN_URL', WFPS_URL . 'admin/' );
define( 'WFPS_PUBLIC_URL', WFPS_URL . 'public/' );

define( 'WFPS_FILE', __FILE__ );
define( 'WFPS_ROOT_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WFPS_ADMIN_DIR_PATH', WFPS_ROOT_DIR_PATH . 'admin/' );
define( 'WFPS_PUBLIC_PATH', WFPS_ROOT_DIR_PATH . 'public/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wfp-sample-activator.php
 */
function activate_wfp_sample() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wfp-sample-activator.php';
	Wfp_Sample_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wfp-sample-deactivator.php
 */
function deactivate_wfp_sample() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wfp-sample-deactivator.php';
	Wfp_Sample_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wfp_sample' );
register_deactivation_hook( __FILE__, 'deactivate_wfp_sample' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wfp-sample.php';


/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
if ( ! function_exists( 'run_wfp_sample' ) ) { 
	function run_wfp_sample() {

		$plugin = new Wfp_Sample();
		$plugin->run();

	}
	run_wfp_sample();
}