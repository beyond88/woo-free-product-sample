<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       mohiuddinabdulkader.website
 * @since      1.0.0
 *
 * @package    Woo_Free_Product_Sample
 * @subpackage Woo_Free_Product_Sample/admin
 * @author     Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */

class Woo_Free_Product_Sample_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version
	 */
	private $version;

	/**
	 * The option of this plugin.
	 *
	 * @since    2.0.0
	 * @param    string 
	 */
	public $_optionName  = 'woo_free_product_sample_settings';
		
	/**
	 * The option group of this plugin.
	 *
	 * @since    2.0.0
	 * @param    string 
	 */	
	public $_optionGroup = 'woo-free-product-sample-options-group';
	
	/**
	 * The option group of this plugin.
	 *
	 * @since    2.0.0
	 * @param    array 
	 */	
	public $_defaultOptions = array(
		'button_label'      	=> '',
		'max_qty_per_order'		=> 5,
	);

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string, string 
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;
		add_option( $this->_optionName, $this->_defaultOptions );		
	}	

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-free-product-sample-admin.css', array(), $this->version, 'all' );		
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-free-product-sample-admin.js', array( 'jquery' ), $this->version, false ); 		

	}

	/**
	 *
	 * @since    2.0.0
	 * @param    array 
	 */
    public function woo_free_product_sample_settings_menu() {
		
        add_menu_page(
			__('Free Product Sample','woo-free-product-sample'),
			__('Free Product Sample','woo-free-product-sample'),
			'manage_woocommerce',
			'woo-free-product-sample',            
            array(
                $this,
                'woo_free_product_sample_settings_page'
			),
			'dashicons-admin-generic',
			10
		);
	}
	
	/**
	 *
	 * @since    2.0.0
	 * @param    array
	 */	
	public function woo_free_product_sample_settings_page() {

		$current_user = wp_get_current_user();
		if( ! in_array('administrator', $current_user->roles) ) {
			return;
		}

		$settings = Woo_Free_Product_Sample_Settings::setting_fields();

		return include  WFPS_ADMIN_DIR_PATH . 'partials/woo-free-product-sample-settings.php';
	}	
	
	/**
	 *
	 * @since    2.0.0
	 * @param    array
	 */
	public function woo_free_product_sample_menu_register_settings() {
		register_setting( $this->_optionGroup, $this->_optionName );
	}

	/**
	 *
	 * @since    2.0.0
	 * @param    none
	 */
	public function woo_free_product_sample_set_default_options() {

		return apply_filters( 'woo_free_product_sample_default_options', $this->_defaultOptions );

	}	
}