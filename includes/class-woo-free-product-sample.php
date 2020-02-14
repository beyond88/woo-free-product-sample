<?php

/**
 * The file that defines the core plugin class
 *
 *
 * @link       https://profiles.wordpress.org/hossain88
 * @since      1.0.0
 *
 * @package    Woo_Free_Product_Sample
 * @subpackage Woo_Free_Product_Sample/includes
 * @author     hossain88 <muhin.cse.diu@gmail.com> 
 */

class Woo_Free_Product_Sample {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woo_Free_Product_Sample_Loader $loader
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version
	 */
	protected $version;

	/**
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WFPS_VERSION' ) ) {
			$this->version = WFPS_VERSION;
		} else {
			$this->version = '1.1.5';
		}
		$this->plugin_name = 'woo-free-product-sample';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-free-product-sample-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-free-product-sample-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woo-free-product-sample-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woo-free-product-sample-public.php';

		$this->loader = new Woo_Free_Product_Sample_Loader();

	}

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woo_Free_Product_Sample_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Woo_Free_Product_Sample_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'woocommerce_init', $plugin_admin, 'init' );

	}

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Woo_Free_Product_Sample_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );		
		$this->loader->add_action( 'woocommerce_single_product_summary', $plugin_public, 'wcfps_add_to_cart_btn', 35 );
		$this->loader->add_filter( 'woocommerce_add_cart_item_data', $plugin_public, 'wcfps_store_id', 10, 2 );
		$this->loader->add_filter( 'woocommerce_get_cart_item_from_session', $plugin_public, 'wcfps_get_cart_items_from_session', 10, 2 );
		$this->loader->add_filter( 'woocommerce_cart_item_name', $plugin_public,'wcfps_alter_cart_item_name', 10, 3 );
		// $this->loader->add_filter( 'woocommerce_add_to_cart_validation', $plugin_public, 'wcfps_set_limit_per_order', 10, 2 );						
		$this->loader->add_action( 'woocommerce_add_order_item_meta', $plugin_public, 'wcfps_save_posted_data_into_order', 10, 2 );
		$this->loader->add_action( 'woocommerce_checkout_order_processed', $plugin_public, 'wcfps_update_stock_on_checkout' );			
		$this->loader->add_action( 'woocommerce_after_add_to_cart_button', $plugin_public,'wcfps_variable_btn', 72 );
		$this->loader->add_filter( 'woocommerce_locate_template', $plugin_public, 'wcfps_set_woocommerce_locate_template', 10, 3 );
		$this->loader->add_filter( 'woocommerce_before_calculate_totals', $plugin_public, 'wcfps_apply_custom_price_to_cart_item', 99 );

	}

	/**
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 *
	 * @since     1.0.0
	 * @return    Woo_Free_Product_Sample_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
