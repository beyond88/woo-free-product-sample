<?php

	$setting_options 	    = wp_parse_args( get_option('woo_free_product_sample_settings'), array() );	
	$button_label 			= isset( $setting_options['button_label'] ) ? esc_html__( $setting_options['button_label'], 'woo-free-product-sample' ) : esc_html__( 'Order a Free Sample', 'woo-free-product-sample' ); 
	$sample_price 			= isset( $setting_options['sample_price'] ) ? $setting_options['sample_price'] : 0.00;
?>
	<button type="submit" name="simple-add-to-cart" value="<?php the_ID(); ?>" class="single_add_to_cart_button button simple-add-to-cart alt">
		<?php echo esc_attr( $button_label ); ?>	
	</button>
	<input type="hidden" name="free_sample" value="<?php the_ID(); ?>">

