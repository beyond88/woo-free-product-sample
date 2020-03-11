<?php
/**
 *
 * @link       https://profiles.wordpress.org/hossain88
 * @since      1.0.0
 *
 * @package    Woo_Free_Product_Sample
 * @subpackage Woo_Free_Product_Sample/public
 */

class Woo_Free_Product_Sample_Public {

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
	 * The option of this plugin.
	 *
	 * @since    1.6.0
	 * @param    string 
	 */
	public $_optionName  = 'woo_free_product_sample_settings';
	
	/**
	 * The option group of this plugin.
	 *
	 * @since    1.6.0
	 * @param    string 
	 */	
	public $_optionGroup = 'woo-free-product-sample-options-group';
	
	/**
	 * The option group of this plugin.
	 *
	 * @since    1.6.0
	 * @param    array 
	 */	
	public $_defaultOptions = array(
		'button_label'          => '',
		'max_qty_per_order'		=> 5 
	);	

	/**
	 * @since    1.0.0
	 * @param    string    $plugin_name
	 * @param    string    $version
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;		
	}


	/**
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-free-product-sample-public.css', array(), $this->version, 'all' );

	}


	/**
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {}

	/**
	 *
	 * @since  1.6.0  
	 */
	public function woo_free_product_sample_add_to_cart_btn() {

		global $product;
		if( $product->is_type( array('simple') ) ) { 
			wc_get_template(
				'/partials/simple-product/simple-prod-btn.php',
			array(),
			'',			
			untrailingslashit( plugin_dir_path( __FILE__ ) ) 
			);	
		} else if( $product->is_type( array('variable') ) ) {
			wc_get_template(
				'/partials/variable-product/variable-prod-btn.php',
			array(),
			'',			
			untrailingslashit( plugin_dir_path( __FILE__ ) ) 
			);
		} 

	}	

	/**
	 *
	 * @since 1.6.0
	 */
	public static function woo_free_product_sample_add_to_cart_action( $url = false ) {

		if ( 
			! isset( $_REQUEST['simple-add-to-cart'] ) || 
			! is_numeric( wp_unslash( $_REQUEST['simple-add-to-cart'] ) ) ||
			! isset( $_REQUEST['variable-add-to-cart'] ) || 
			! is_numeric( wp_unslash( $_REQUEST['variable-add-to-cart'] ) ) )			 
		{ // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			return;
		}

		wc_nocache_headers();

		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( wp_unslash( $_REQUEST['simple-add-to-cart'] ) ) ); // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
		$was_added_to_cart = false;
		$adding_to_cart    = wc_get_product( $product_id );

		if ( ! $adding_to_cart ) {
			return;
		}

		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart );

		if ( 'variable' === $add_to_cart_handler || 'variation' === $add_to_cart_handler ) {
			$was_added_to_cart = self::add_to_cart_handler_variable( $product_id );
		} else {
			$was_added_to_cart = self::add_to_cart_handler_simple( $product_id );
		}

		// If we added the product to the cart we can now optionally do a redirect.
		if ( $was_added_to_cart && 0 === wc_notice_count( 'error' ) ) {
			$url = apply_filters( 'woocommerce_add_to_cart_redirect', $url, $adding_to_cart );

			if ( $url ) {
				wp_safe_redirect( $url );
				exit;
			} elseif ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
				wp_safe_redirect( wc_get_cart_url() );
				exit;
			}
		}
	}

	/**
	 * Handle adding simple products to the cart.
	 *
	 * @since 2.4.6 Split from add_to_cart_action.
	 * @param int $product_id Product ID to add to the cart.
	 * @return bool success or not
	 */
	private static function add_to_cart_handler_simple( $product_id ) {
		$quantity          = 1; // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

		if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			return true;
		}
		return false;
	}
	
	/**
	 * Handle adding variable products to the cart.
	 *
	 * @since 2.4.6 Split from add_to_cart_action.
	 * @throws Exception If add to cart fails.
	 * @param int $product_id Product ID to add to the cart.
	 * @return bool success or not
	 */
	private static function add_to_cart_handler_variable( $product_id ) {
		try {
			$variation_id       = empty( $_REQUEST['variation_id'] ) ? '' : absint( wp_unslash( $_REQUEST['variation_id'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
			$quantity           = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( wp_unslash( $_REQUEST['quantity'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
			$missing_attributes = array();
			$variations         = array();
			$adding_to_cart     = wc_get_product( $product_id );

			if ( ! $adding_to_cart ) {
				return false;
			}

			// If the $product_id was in fact a variation ID, update the variables.
			if ( $adding_to_cart->is_type( 'variation' ) ) {
				$variation_id   = $product_id;
				$product_id     = $adding_to_cart->get_parent_id();
				$adding_to_cart = wc_get_product( $product_id );

				if ( ! $adding_to_cart ) {
					return false;
				}
			}

			// Gather posted attributes.
			$posted_attributes = array();

			foreach ( $adding_to_cart->get_attributes() as $attribute ) {
				if ( ! $attribute['is_variation'] ) {
					continue;
				}
				$attribute_key = 'attribute_' . sanitize_title( $attribute['name'] );

				if ( isset( $_REQUEST[ $attribute_key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
					if ( $attribute['is_taxonomy'] ) {
						// Don't use wc_clean as it destroys sanitized characters.
						$value = sanitize_title( wp_unslash( $_REQUEST[ $attribute_key ] ) ); // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
					} else {
						$value = html_entity_decode( wc_clean( wp_unslash( $_REQUEST[ $attribute_key ] ) ), ENT_QUOTES, get_bloginfo( 'charset' ) ); // phpcs:ignore WordPress.Security.NonceVerification.NoNonceVerification
					}

					$posted_attributes[ $attribute_key ] = $value;
				}
			}

			// If no variation ID is set, attempt to get a variation ID from posted attributes.
			if ( empty( $variation_id ) ) {
				$data_store   = WC_Data_Store::load( 'product' );
				$variation_id = $data_store->find_matching_product_variation( $adding_to_cart, $posted_attributes );
			}

			// Do we have a variation ID?
			if ( empty( $variation_id ) ) {
				throw new Exception( __( 'Please choose product options&hellip;', 'woocommerce' ) );
			}

			// Check the data we have is valid.
			$variation_data = wc_get_product_variation_attributes( $variation_id );

			foreach ( $adding_to_cart->get_attributes() as $attribute ) {
				if ( ! $attribute['is_variation'] ) {
					continue;
				}

				// Get valid value from variation data.
				$attribute_key = 'attribute_' . sanitize_title( $attribute['name'] );
				$valid_value   = isset( $variation_data[ $attribute_key ] ) ? $variation_data[ $attribute_key ] : '';

				/**
				 * If the attribute value was posted, check if it's valid.
				 *
				 * If no attribute was posted, only error if the variation has an 'any' attribute which requires a value.
				 */
				if ( isset( $posted_attributes[ $attribute_key ] ) ) {
					$value = $posted_attributes[ $attribute_key ];

					// Allow if valid or show error.
					if ( $valid_value === $value ) {
						$variations[ $attribute_key ] = $value;
					} elseif ( '' === $valid_value && in_array( $value, $attribute->get_slugs(), true ) ) {
						// If valid values are empty, this is an 'any' variation so get all possible values.
						$variations[ $attribute_key ] = $value;
					} else {
						/* translators: %s: Attribute name. */
						throw new Exception( sprintf( __( 'Invalid value posted for %s', 'woocommerce' ), wc_attribute_label( $attribute['name'] ) ) );
					}
				} elseif ( '' === $valid_value ) {
					$missing_attributes[] = wc_attribute_label( $attribute['name'] );
				}
			}
			if ( ! empty( $missing_attributes ) ) {
				/* translators: %s: Attribute name. */
				throw new Exception( sprintf( _n( '%s is a required field', '%s are required fields', count( $missing_attributes ), 'woocommerce' ), wc_format_list_of_items( $missing_attributes ) ) );
			}
		} catch ( Exception $e ) {
			wc_add_notice( $e->getMessage(), 'error' );
			return false;
		}

		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );

		if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			return true;
		}

		return false;
	}	
	 
	/**
	 *
	 * @since      1.6.0     
	 * @param      string, string    	 
	 */
	public function woo_free_product_sample_store_id( $cart_item, $product_id ) {

		if( isset( $_REQUEST['simple-add-to-cart'] ) || isset( $_REQUEST['variable-add-to-cart'] ) ) {
			$cart_item['free_sample']  = $_REQUEST['free_sample'];
			$cart_item['sample_price'] = $_REQUEST['sample_price'];			
		}
			
		return $cart_item; 
	}	

	/**
	 *
	 * @since      1.6.0
	 * @param      array, array    
	 */
	public function woo_free_product_sample_get_cart_items_from_session( $cart_item, $values ) {

		$settings_options   = wp_parse_args(get_option($this->_optionName),$this->_defaultOptions);	
		if ( isset( $values['simple-add-to-cart'] ) || isset( $values['variable-add-to-cart'] ) ) {
			$cart_item['free_sample'] = $values['free_sample'];
			$cart_item['price'] 	  = $settings_options['sample_price'];
		}    

		return $cart_item;
	}
	 
	/**
	 *
	 * @since      1.6.0
	 * @param      int, array    	 
	 */
	public function woo_free_product_sample_save_posted_data_into_order( $itemID, $values ) {

		if ( isset( $_REQUEST['simple-add-to-cart'] ) && !empty( $values['free_sample'] ) ) {
			$product 			 = wc_get_product( $values['free_sample'] );
			$product_name 		.=  " (" . $product->get_name() . ")";
			wc_add_order_item_meta( $itemID, 'Free sample', $product_name );
			wc_add_order_item_meta( $itemID, 'prod_type', 'free_sample' );
		}
		
	}

	/**
	 *
	 * @since      1.6.0
	 * @param      none
	 */
	public static function woo_free_product_sample_get_plugin_path(){		
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 *
	 * @since      1.6.0
	 * @param      none
	 */
	public function woo_free_product_sample_set_locate_template( $template, $template_name, $template_path ) {

		global $woocommerce;
		$_template = $template;
		if ( ! $template_path ) {
			$template_path = $woocommerce->template_url;
		}		

	  	$plugin_path  = self::woo_free_product_sample_get_plugin_path() . '/partials/woocommerce/';
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
	 * @since      1.6.0
	 * @param      object, array     	 
	 */
    public function woo_free_product_sample_apply_sample_price_to_cart_item( $cart ) {

		if ( is_admin() && ! defined( 'DOING_AJAX' ) )
		return;

		// Avoiding hook repetition (when using price calculations for example)
		if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
		return;	
	
		foreach ( $cart->get_cart() as $key => $value ) {
			if( isset( $value["sample_price"] ) ) {
				//$value['data']->set_price($value["sample_price"]);
				$value['data']->price = $value["sample_price"];
			}				

		}   
	}

	/**
	 *
	 * @since      1.6.0
	 * @param      int, array 
	 */		
	function woo_free_product_sample_set_limit_per_order( $valid, $product_id ) {
	
		global $woocommerce;
		$settings_options = wp_parse_args(get_option('woo_free_product_sample_settings'),array());
		if( $woocommerce->cart->cart_contents_count > 0 ) {
			foreach( $woocommerce->cart->get_cart() as $key => $val ) {
				if( isset( $_REQUEST['simple-add-to-cart'] ) || isset( $_REQUEST['variable-add-to-cart'] ) ) {

					if( ( $product_id == $val['free_sample'] ) && ( $settings_options['max_qty'] <= $val['quantity'] ) ) {
						wc_add_notice( esc_html__( 'You can order this product '.$settings_options['max_qty'].' time per order.', 'woo-free-product-sample' ), 'error' );
						return false;
					}

				}

			}
		}
		return $valid;

	}

	/**
	 *
	 * @since      1.6.0
	 * @param      int, array 
	 */	
	public function woo_free_product_sample_add_to_cart_message ( $message, $products ) {

		$titles = '';
		if( isset( $_REQUEST['simple-add-to-cart'] ) || isset( $_REQUEST['variable-add-to-cart'] ) ) {
			
			foreach ( $products as $product_id => $qty ) {
				$titles = get_the_title( $product_id );
			}	
			$message = sprintf( esc_html__('Sample - "%s" have been added to your cart.','woo-free-product-sample'), $titles ); 
			return $message; 

		} else {

			return $message;

		}

	}

	/**
	 *
	 * @since      1.6.0
	 * @param      int, array 
	 */	
	public function set_free_sample_item_name ( $product_name, $cart_item, $cart_item_key ) {

		$settings_options   = wp_parse_args( get_option($this->_optionName), $this->_defaultOptions );	
		$product 			= $cart_item['data']; // Get the WC_Product Object
		$sample_price 		= str_replace( ",",".", $settings_options['sample_price'] );
		$prod_price 		= str_replace( ",",".", $product->get_price() );	
		if( $sample_price == $prod_price ) {
			$product_name   = esc_html__( 'Sample ', 'woo-free-product-sample' ).' - "'.$product_name.'"';		
		}

		return $product_name;
	}

   	/**
	 *
	 * @since      1.6.0
	 * @param      int, array, array 
	 */
    public function woo_free_product_sample_cart_item_price_filter( $price, $cart_item, $cart_item_key ) {
	
		$settings_options   = wp_parse_args( get_option($this->_optionName), $this->_defaultOptions );
		$set_price 			= str_replace( ",",".",$settings_options['sample_price'] );
		if( isset( $cart_item['sample_price'] ) ) {
			$sample_price 		= str_replace( ",",".",$cart_item['sample_price'] );	
			if( $sample_price == $set_price ) {
				$price   = wc_price( $sample_price );		
			}
		}
		
		return $price;
	} 


}