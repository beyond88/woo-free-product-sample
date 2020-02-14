<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/hossain88
 * @since      1.0.0
 *
 * @package    Woo_Free_Product_Sample
 * @subpackage Woo_Free_Product_Sample/admin
 * @author     max-themes <muhin.cse.diu@gmail.com>
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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string, string 
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-free-product-sample-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name."datetime-css", plugin_dir_url( __FILE__ ) . 'css/jquery.datetimepicker.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-free-product-sample-admin.js', array( 'jquery' ), $this->version, false );  
		wp_enqueue_script( $this->plugin_name."-datetime", plugin_dir_url( __FILE__ ) . 'js/jquery.datetimepicker.full.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 *
	 * @since    1.0.0
	 */
	public function init() {

		// Add our Free Product Sample panel to the WooCommerce panel container
		add_action( 'woocommerce_product_write_panel_tabs', array( $this, 'woo_free_product_sample_render_tabs' ) );
		add_action( 'woocommerce_product_data_panels', array( $this, 'woo_free_product_sample_tabs_panel' ) );

		// Save custom tab data
		add_action( 'woocommerce_process_product_meta', array( $this, 'woo_free_product_sample_save_tab_data' ), 10, 2 );
		
	}

	
	/**
	 *
	 * @since    1.0.0
	 */
	public function woo_free_product_sample_render_tabs() {

		echo "<li class=\"woo_free_product_sample_wc_product_tabs_tab\"><a href=\"#woo-free-product-sample-tab\"><span>" . __( 'Free Product Sample', 'woo-free-product-sample' ) . "</span></a></li>";
	
	}
	
	
	/**
	 *
	 * @since    1.0.0
	 */
	public function woo_free_product_sample_tabs_panel() {

		global $woocommerce, $post;
		return include 'partials/woo-free-product-sample-tab.php';

	}
	
	
	/**
	 *
	 * @since    1.0.0
	 */
	public function woo_free_product_sample_save_tab_data( $post_id ) {

		$woo_free_product_sample_enable 	= isset( $_POST['enable_freesample'] ) ? 'open' : '';		
		update_post_meta( $post_id, 'enable_freesample', $woo_free_product_sample_enable );
		
		$woo_free_product_sample_timezone = $_POST['wfp_sample_timezone'];
		if( !empty($woo_free_product_sample_timezone) ) {
			update_post_meta( $post_id, 'wfp_sample_timezone', sanitize_text_field( $woo_free_product_sample_timezone ) );		
		}
				
		$woo_free_product_sample_limits = $_POST['sample_limits'];
		update_post_meta( $post_id, 'sample_limits', sanitize_text_field( $woo_free_product_sample_limits ) );

		$woo_free_product_sample_mt_per_order = $_POST['max_qty_per_order'];
		update_post_meta( $post_id, 'max_qty_per_order', sanitize_text_field( $woo_free_product_sample_mt_per_order ) );		

		$woo_free_product_sample_from_date = $_POST['wfp_from_date'];
		update_post_meta( $post_id, 'wfp_from_date', sanitize_text_field( $woo_free_product_sample_from_date ) );

		$woo_free_product_sample_to_date = $_POST['wfp_to_date'];
		update_post_meta( $post_id, 'wfp_to_date', sanitize_text_field( $woo_free_product_sample_to_date ) );	

		$woo_free_product_sample_button_text = $_POST['button_text'];
		update_post_meta( $post_id, 'button_text', sanitize_text_field( $woo_free_product_sample_button_text ) );				
			
	}		

}