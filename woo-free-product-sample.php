<?php
/**
 * @link              https://profiles.wordpress.org/hossain88
 * @since             1.0.0
 * @package           Woo_Free_Product_Sample
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
 * Text Domain:       woo-free-product-sample
 * Domain Path:       /languages
 * Requires PHP:      5.6
 * Requires at least: 4.4
 * Tested up to:      5.3
 *
 * WC requires at least: 3.1
 * WC tested up to:   3.8* 
 * Copyright: © 2017-2020.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
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
 * This action is documented in includes/class-woo-free-product-sample-activator.php
 */
function activate_woo_free_product_sample() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-free-product-sample-activator.php';
	Woo_Free_Product_Sample_Activator::activate();	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-free-product-sample-deactivator.php
 */
function deactivate_woo_free_product_sample() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-free-product-sample-deactivator.php';
	Woo_Free_Product_Sample_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_free_product_sample' );
register_deactivation_hook( __FILE__, 'deactivate_woo_free_product_sample' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-free-product-sample.php';


/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
if ( ! function_exists( 'run_woo_free_product_sample' ) ) { 
	function run_woo_free_product_sample() {

		$plugin = new Woo_Free_Product_Sample();
		$plugin->run();

	}
	run_woo_free_product_sample();
}