<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.thewpnext.com/
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
	 * The default option of this plugin.
	 *
	 * @since    2.0.0
	 * @param    array 
	 */	
	public $_defaultOptions = array(
		'button_label'      	=> '',
		'max_qty_per_order'		=> 5,
	);

	/**
	 * The option of this plugin.
	 *
	 * @since    2.0.0
	 * @param    string 
	 */
	public $_activation  = 'the_wp_next_licence_activation';	

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
	public function wfps_enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-free-product-sample-admin.css', array(), $this->version, 'all' );		
	}

	/**
	 * Register the admin menu for the settings
	 * 
	 * @since    2.0.0
	 * @param    array 
	 */
    public function wfps_settings_menu() {
		
        add_menu_page(
			__('Product Sample','woo-free-product-sample'),
			__('Product Sample','woo-free-product-sample'),
			'manage_options',
			'woo-free-product-sample',            
            array(
                $this,
                'wfps_settings_page'
			),
			WFPS_ADMIN_URL . 'img/woo-free-product-sample.png',
			60
		);
	}
	
	/**
	 * Display the settings page
	 * 
	 * @since    2.0.0
	 * @param    array
	 */	
	public function wfps_settings_page() {

		$current_user = wp_get_current_user();
		if( ! in_array('administrator', $current_user->roles) ) {
			return;
		}

		$settings = Woo_Free_Product_Sample_Settings::wfps_setting_fields();

		return include  WFPS_ADMIN_DIR_PATH . 'partials/woo-free-product-sample-settings.php';
	}	
	
	/**
	 * Save the setting options		
	 * 
	 * @since    2.0.0
	 * @param    array
	 */
	public function wfps_menu_register_settings() {
		register_setting( $this->_optionGroup, $this->_optionName );
	}

	/**
	 * Apply filter with default options
	 * 
	 * @since    2.0.0
	 * @param    none
	 */
	public function wfps_set_default_options() {
		return apply_filters( 'woo_free_product_sample_default_options', $this->_defaultOptions );
	}
	
	/**
	 * Load submit ticket button
	 * 
	 * @since    2.0.0
	 * @param    array
	 * @return   void
	 */	
	public function wfps_request_support_ticket( $data ) {

		$html = '';
		if( ! isset( $data['wfps_license_key'] ) || ! class_exists( 'Woo_Free_Product_Sample_Pro' ) ) {
			$html .='<p><a href="https://wordpress.org/support/plugin/woo-free-product-sample/" target="_blank">'.esc_html__( "Submit a topic", "woo-free-product-sample" ).'</a></p>';		
		} else {

			$expiry_date  = isset( $data['wfps_license_expire'] ) ? $data['wfps_license_expire'] : ''; 
			$current_date = date("Y-m-d");                                        
			$current_date = strtotime( $current_date );                                        
			$expiry_date  = strtotime( $expiry_date );
			if( isset( $data['wfps_license_key'] ) && $current_date > $expiry_date ) {
				$html .='<p><a href="https://wordpress.org/support/plugin/woo-free-product-sample/" target="_blank">'.esc_html__( "Submit a topic", "woo-free-product-sample" ).'</a></p>';
			} else {
				$html .='<p><a href="https://thewpnext.com/ask-question" target="_blank">'.esc_html__( "Submit a ticket", "woo-free-product-sample" ).'</a></p>';
			}

		}
		echo $html;

	}
}