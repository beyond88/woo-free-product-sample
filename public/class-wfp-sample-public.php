<?php
/**
 *
 * @link       https://profiles.wordpress.org/hossain88
 * @since      1.0.0
 *
 * @package    Wfp_Sample
 * @subpackage Wfp_Sample/public
 */

class Wfp_Sample_Public {

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string 
	 */
	private $plugin_name;

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version 
	 */
	private $version;

	/**
	 * @since    1.0.0
	 * @param    string    $plugin_name
	 * @param    string    $version
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_filter( 'woocommerce_add_to_cart_validation', array( $this, 'wcfps_set_limit_per_order' ), 10, 2 );						
		
	}


	/**
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wfp-sample-public.css', array(), $this->version, 'all' );

	}


	/**
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {}


	/**
	 *
	 * @since    1.0.0
	 */
	public function wcfps_add_to_cart_btn() {

		global $product;
		$wc_product_type = $product->get_type();
		if( 'simple' == $wc_product_type ){ 
			include_once 'partials/simple-prod-btn.php';
		} 

	}

	 
	/**
	 *
	 * @since      1.0.0
	 * @param      string, string    	 
	 */
	public function wcfps_store_id( $cart_item, $product_id ) {

		if( isset( $_POST['free_sample'] ) ) {
	        $cart_item['free_sample']  = $_POST['free_sample'];
			$cart_item['custom_price'] = $_POST['custom_price'];			
		}

		if( isset( $_POST['free-variable-btn'] ) ) {
	        $cart_item['free_sample']  = $product_id;
			$cart_item['custom_price'] = 0.00;				
		}		

		return $cart_item; 
	}	

	 
	/**
	 *
	 * @since      1.0.0
	 * @param      array, array    
	 */
	public function wcfps_get_cart_items_from_session( $cart_item, $values ) {

		if ( isset( $values['free_sample'] ) ){
			$cart_item['free_sample'] = $values['free_sample'];
			$cart_item['price'] 	  = 0.00;
		}

		return $cart_item;

	}

	 
	/**
	 *
	 * @since      1.0.0
	 * @param      string, array, array     	 
	 */
	public function wcfps_alter_cart_item_name( $product_name, $cart_item, $cart_item_key ) {

		if ( $product_name == "Free Sample" ) {
		$product 			= wc_get_product( $cart_item["free_sample"] );
		$product_name 		.=  " (" . $product->get_name() . ")";
		}

		return $product_name;

	}

	 
	/**
	 *
	 * @since      1.0.0
	 * @param      int, array    	 
	 */
	public function wcfps_save_posted_data_into_order( $itemID, $values ) {

	    if ( !empty( $values['free_sample'] )) {
	        $product 			= wc_get_product( $values['free_sample'] );
	        $product_name 		.=  " (" . $product->get_name() . ")";
			wc_add_order_item_meta( $itemID, 'Free sample', $product_name );
			wc_add_order_item_meta( $itemID, 'prod_type', 'free_sample' );
		}
		
	}


	/**
	 *
	 * @since      1.0.0
	 * @param      none
	 */
	public static function wcfps_get_plugin_path(){		

		return untrailingslashit( plugin_dir_path( __FILE__ ) );

	}


	/**
	 *
	 * @since      1.0.0
	 * @param      none
	 */
	public function wcfps_set_woocommerce_locate_template( $template, $template_name, $template_path ) {

		global $woocommerce;
		$_template = $template;
		if ( ! $template_path ) {
			$template_path = $woocommerce->template_url;
		}		

	  	$plugin_path  = self::wcfps_get_plugin_path() . '/partials/woocommerce/';
	  	$template = locate_template(
	    	array(
	      		$template_path . $template_name,
	      		$template_name
	    	)
	  	);

	  	if ( ! $template && file_exists( $plugin_path . $template_name ) )
	    	$template = $plugin_path . $template_name;

	  	if ( ! $template )
	    	$template = $_template;

		return $template;
		  
	}

	
	/**
	 *
	 * @since      1.0.0
	 * @param      object, array     	 
	 */
    public function wcfps_apply_custom_price_to_cart_item( $cart_object ) {

        if( !WC()->session->__isset( "reload_checkout" ) ) {
            
            foreach ( $cart_object->cart_contents as $key => $value ) {
                if( isset( $value["custom_price"] ) ) {
                    $value['data']->set_price($value["custom_price"]);
                }
            }   
        } 

	}
	    

	/**
	 *
	 * @since      1.0.0
	 * @param      none 
	 */
	public function wcfps_variable_btn() {

	    global $product;
		$wc_product_type = $product->get_type();
		if( 'variable' == $wc_product_type ){
			include 'partials/variable-prod-btn.php';
		} 
		
	}


	/**
	 *
	 * @since      1.0.0
	 * @param      int 
	 */
	public function wcfps_update_stock_on_checkout( $order_id ) {

		$order 			= new WC_Order( $order_id );
		$items 			= $order->get_items();

		foreach ( $items as $key => $value ) {

			$prod_id 	= $value['product_id'];
			$prod_qty	= $value['qty'];
			$prod_status= $value['prod_type'];			
 
			if( $prod_status ){

				$get_old_qty = get_post_meta( $prod_id, 'sample_limits', true );
				update_post_meta( $prod_id, 'sample_limits', ( $get_old_qty-$prod_qty ) );
				wc_delete_order_item_meta( $prod_id, 'prod_type' );
				delete_post_meta( $prod_id, 'prod_type' ); 
				
			}

		}
		
	}


	/**
	 *
	 * @since      1.0.0
	 * @param      int, array 
	 */		
	function wcfps_set_limit_per_order( $valid, $product_id ) {

		global $woocommerce;
		if( $woocommerce->cart->cart_contents_count > 0){
			foreach( $woocommerce->cart->get_cart() as $key => $val ) {
				$_product = $val['data'];
				if( ($product_id == $val['free_sample']) && 
					( isset($_POST['free_sample'])  || isset($_POST['free-variable-btn']) ) && 
					( get_post_meta($product_id, 'max_qty_per_order', true) <= $val['quantity'] )
				) {
					$max = get_post_meta( $product_id, 'max_qty_per_order', true );
					wc_add_notice( esc_html__('You can order this product '.$max.' time per order.', 'wfp-sample'), 'error' );
					return false;
				}
			}
		}
		return $valid;

	}


}