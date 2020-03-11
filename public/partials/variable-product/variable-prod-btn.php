<?php
 
	global $post; 
	$wcfps_enable_freesample  				= get_post_meta( $post->ID, 'enable_freesample', true );
	$wcfps_limits      						= get_post_meta( $post->ID, 'sample_limits', true );
	// $wcfps_button_text        				= get_post_meta( $post->ID, 'button_text', true );
	$settings_options 						= wp_parse_args(get_option('woo_free_product_sample_settings'),array());	

	if( empty( $settings_options['button_label'] ) ) {
		$wcfps_button_text = esc_html__( 'Order a Free Sample', 'wfp-sample' );			
	} else { 
		$wcfps_button_text = esc_html__( $settings_options['button_label'], 'wfp-sample' );
	}
		
	if( $wcfps_enable_freesample == "open" ) {	
?>

		<button type="submit" name="variable-add-to-cart" value="<?php the_ID(); ?>" class="single_add_to_cart_button button variable-add-to-cart alt">
			<?php echo esc_attr( $wcfps_button_text ); ?>	
		</button>
		<input type="hidden" name="free_sample" value="<?php the_ID(); ?>">
		<input type="hidden" name="sample_price" value="<?php echo $settings_options['sample_price']; ?>" />
	<?php 
	}
?>
