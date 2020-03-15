<?php

/**
 * Register all settings actions and filters for the plugin
 *
 * @link       https://profiles.wordpress.org/hossain88
 * @since      2.0.0
 *
 * @package    Woo_Free_Product_Sample
 * @subpackage Woo_Free_Product_Sample/includes
 * @author     Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com> 
 */

class Woo_Free_Product_Sample_Settings {

    /**
	 * Initialize the class and set its settings options.
	 *
	 * @since    2.0.0
	 * @param    none 
	 */
    public function __construct() {

    }

    /**
	 * Define settings options as array
	 *
	 * @since    2.0.0
	 * @param    none
     * @return   array 
	 */
    public static function setting_fields() {

        $setting_fields = array(                         
            array(
                'name'          => 'button_label',
                'label'         => __( 'Button Label', 'woo-free-product-sample' ),
                'type'          => 'text',
                'class'         => 'widefat',
                'description'   => __( 'Set button label', 'woo-free-product-sample' ),
                'placeholder'   => __( 'Set button label', 'woo-free-product-sample' ),
            ),
			array(
                'name'          => 'max_qty_per_order',
                'label'         => __( 'Maximum quantity per order', 'woo-free-product-sample' ),
                'type'          => 'number',
                'class'         => 'widefat',
                'description'   => __( 'Maximum quantity per order', 'woo-free-product-sample' ),
                'placeholder'   => 5,
            ),            
		);

		return apply_filters( 'woo_free_product_sample_setting_fields', $setting_fields );
    }
}
