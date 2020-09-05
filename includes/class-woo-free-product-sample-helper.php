<?php

/**
 * The file that defines the core plugin class
 *
 *
 * @link       https://www.thewpnext.com/
 * @since      1.0.0
 *
 * @package    Woo_Free_Product_Sample
 * @subpackage Woo_Free_Product_Sample/includes
 * @author     hossain88 <muhin.cse.diu@gmail.com> 
 */

class Woo_Free_Product_Sample_Helper {

/**
	 * The option of this plugin.
	 *
	 * @since    2.0.0
	 * @param    string 
	 */
	public static $_optionName  = 'woo_free_product_sample_settings';

	/**
	 * The option message of this plugin.
	 *
	 * @since    2.0.0
	 * @param    string 
	 */	
	public static $_optionNameMessage  = 'woo_free_product_sample_message';	
	
	/**
	 * The option group of this plugin.
	 *
	 * @since    2.0.0
	 * @param    string 
	 */	
	public static $_optionGroup = 'woo-free-product-sample-options-group';

	/**
	 * The option message group of this plugin.
	 *
	 * @since    2.0.0
	 * @param    string 
	 */	
	public static $_optionGroupMessage = 'woo-free-product-sample-options-message';	
	
	/**
	 * The default option of this plugin.
	 *
	 * @since    2.0.0
	 * @param    array 
	 */	
	public static $_defaultOptions = array(
		'button_label'          => 'Order a Sample',
		'max_qty_per_order'		=> 5 
	);

	/**
	 * The default option of this plugin.
	 *
	 * @since    2.0.0
	 * @param    array 
	 */	
	public static $_defaultMessageOptions = array(
		'qty_validation'      	   => ''	
	);    

	/**
	 * Check product is in stock
	 * 
	 * @since    2.0.0
	 * @param    none
	 */	
	public static function wfps_is_in_stock() {
        global $product;
        return $product->is_in_stock(); 
	}    

	/**
	 * Check product type in product details page
	 * 
	 * @since    2.0.0
	 * @param    none
	 */	
	public static function wfps_product_type() {
		global $product;
		if( $product->is_type( 'simple' ) ) {
			return 'simple';
		} else if( $product->is_type( 'variable' ) ) {
			return 'variable';
		} else {
			return NULL;
		}
    }
    
	/**
	 * Display sample button
	 * 
	 * @since    2.0.0
	 * @param    none
	 */    
    public static function wfps_request_button() {

        $button  = '';
        switch ( self::wfps_product_type() ) {
            case "simple":
                $button = '<button type="submit" name="simple-add-to-cart" value="'.get_the_ID().'" id="woo-free-sample-button" class="woo-free-sample-button">'.self::wfps_button_text().'</button>';
                break;
            case "variable":
                $button = '<button type="submit" name="variable-add-to-cart" value="'.get_the_ID().'" id="woo-free-sample-button" class="woo-free-sample-button">'.self::wfps_button_text().'</button>';
                break;			
            default:
                $button = '';
        }         
        return $button; 
    }
    
	/**
	 * Retrive button label	
	 * 
	 * @since    2.0.0
	 * @param    none
	 */	
	public static function wfps_button_text() {
		$setting_options   = wp_parse_args( get_option(self::$_optionName), self::$_defaultOptions );
		return isset( $setting_options['button_label'] ) ? esc_html__( $setting_options['button_label'], 'woo-free-product-sample' ) : esc_html__( 'Order a Free Sample', 'woo-free-product-sample' );
	}    


}