<?php
	$setting_options 	    = wp_parse_args( get_option('woo_free_product_sample_settings'), array() );	
	$button_label 			= isset( $setting_options['button_label'] ) ? esc_html__( $setting_options['button_label'], 'woo-free-product-sample' ) : esc_html__( 'Order a Sample', 'woo-free-product-sample' );
?>
	<button type="submit" name="variable-add-to-cart" value="<?php the_ID(); ?>" class="single_add_to_cart_button button variable-add-to-cart alt">
		<?php echo esc_attr( $button_label ); ?>	
	</button>

