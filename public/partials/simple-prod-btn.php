<?php
 
	global $post; 
	$wcfps_enable_freesample  				= get_post_meta( $post->ID, 'enable_freesample', true );
	$wfp_sample_timezone  				    = get_post_meta( $post->ID, 'wfp_sample_timezone', true );
	$wcfps_limits      						= get_post_meta( $post->ID, 'sample_limits', true );
	$wcfps_from_date      					= get_post_meta( $post->ID, 'wfp_from_date', true );
	$wcfps_to_date        					= get_post_meta( $post->ID, 'wfp_to_date', true );
	$wcfps_button_text        				= get_post_meta( $post->ID, 'button_text', true );

	if( !empty($wfp_sample_timezone) ){
		date_default_timezone_set($wfp_sample_timezone);
		$wcfps_current_date 					= date( "Y/m/d H:s" );
		$wcfps_from_date 						= strtotime($wcfps_current_date);
		$wcfps_from_date 						= strtotime($wcfps_from_date); 
		$wcfps_to_date 							= strtotime($wcfps_to_date);			
	} else {
		$wcfps_current_date 					= date( "Y/m/d H:s" );
	}	

	if( empty( $wcfps_button_text ) ){
		$wcfps_button_text = esc_html__( 'Order a Free Sample', 'wfp-sample' );			
	} else { 
		$wcfps_button_text = esc_html__( $wcfps_button_text, 'wfp-sample' );
	}
	
	if( $wcfps_enable_freesample == "open" && $wcfps_limits > 0 && ( $wcfps_from_date <= $wcfps_current_date && $wcfps_to_date >= $wcfps_current_date ) ){	
?>
	<p class="stock in-stock">
		<?php echo esc_attr( $wcfps_limits ); ?> 
		<?php esc_html_e( 'free sample in stock', 'wfp-sample' ); ?>
	</p>

	<form class="cart" method="post" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" enctype='multipart/form-data' id="wfp_form">
		<button type="submit" name="add-to-cart" value="<?php the_ID(); ?>" class="single_add_to_cart_button button alt">
			<?php echo esc_attr( $wcfps_button_text ); ?>	
		</button>
		<input type="hidden" name="free_sample" value="<?php the_ID(); ?>">
		<input type="hidden" name="custom_price" value="0.00" />
	</form>	

	<?php 
	}
?>