<?php 
	
	global $post; 
	$woo_free_product_sample_enable  							= get_post_meta( $post->ID, 'enable_freesample', true );
	$wfp_sample_timezone  				    					= get_post_meta( $post->ID, 'wfp_sample_timezone', true );
	$woo_free_product_sample_limits      						= get_post_meta( $post->ID, 'sample_limits', true );
	$woo_free_product_sample_from_date      					= get_post_meta( $post->ID, 'wfp_from_date', true );
	$woo_free_product_sample_to_date        					= get_post_meta( $post->ID, 'wfp_to_date', true );
	$woo_free_product_sample_button_text        				= get_post_meta( $post->ID, 'button_text', true );
	
	if( !empty($wfp_sample_timezone) ){
		date_default_timezone_set($wfp_sample_timezone);
		$woo_free_product_sample_current_date 					= date( "Y/m/d H:s" );
		$woo_free_product_sample_from_date 						= strtotime( $woo_free_product_sample_current_date );
		$woo_free_product_sample_from_date 						= strtotime( $woo_free_product_sample_from_date ); 
		$woo_free_product_sample_to_date 						= strtotime( $woo_free_product_sample_to_date );			
	} else {
		$woo_free_product_sample_current_date 					= date( "Y/m/d H:s" );
	}

	if( empty($woo_free_product_sample_button_text) ){
		$woo_free_product_sample_button_text = esc_html__( 'Order a Free Sample', 'woo-free-product-sample' );			
	} else { 
		$woo_free_product_sample_button_text = esc_html__( $woo_free_product_sample_button_text, 'woo-free-product-sample' );
	}
	
	if( $woo_free_product_sample_enable == "open" && $woo_free_product_sample_limits > 0 && ( $woo_free_product_sample_from_date <= $woo_free_product_sample_current_date && $woo_free_product_sample_to_date >= $woo_free_product_sample_current_date ) ){		
?>

	<p class="stock in-stock">
		<?php echo esc_attr( $woo_free_product_sample_limits ); ?> 
		<?php esc_html_e( 'free sample in stock', 'woo-free-product-sample' ); ?>
	</p>

	<div class="variable-free-sample-btn">			
		<input type="submit" name="free-variable-btn" value="<?php echo esc_attr( $woo_free_product_sample_button_text ); ?>" class="single_add_to_cart_button button alt">
	</div>	

	<?php 
	}
?>









