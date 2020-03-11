<?php

	$settings_options 	    = wp_parse_args( get_option('woo_free_product_sample_settings'), array() );	
	if( ! empty( $settings_options['button_label'] ) ) {
		$wcfps_button_label = esc_html__( $settings_options['button_label'], 'woo-free-product-sample' );					
	} else { 
		$wcfps_button_label = esc_html__( 'Order a Free Sample', 'woo-free-product-sample' );
	}

	$sample_price = isset( $settings_options['sample_price'] ) ? $settings_options['sample_price'] : 0.00;
?>
	<button type="submit" name="simple-add-to-cart" value="<?php the_ID(); ?>" class="single_add_to_cart_button button simple-add-to-cart alt">
		<?php echo esc_attr( $wcfps_button_label ); ?>	
	</button>
	<input type="hidden" name="free_sample" value="<?php the_ID(); ?>">
	<input type="hidden" name="sample_price" value="<?php echo $sample_price; ?>" />

