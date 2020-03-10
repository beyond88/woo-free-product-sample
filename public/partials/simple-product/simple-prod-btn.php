<?php

	$settings_options 	   = wp_parse_args( get_option($this->_optionName), $this->_defaultOptions );	
	if( empty( $settings_options['button_label'] ) ) {
		$wcfps_button_label = esc_html__( 'Order a Free Sample', 'wfp-sample' );			
	} else { 
		$wcfps_button_label = esc_html__( $settings_options['button_label'], 'wfp-sample' );
	}
?>

	<button type="submit" name="simple-add-to-cart" value="<?php the_ID(); ?>" class="single_add_to_cart_button button simple-add-to-cart alt">
		<?php echo esc_attr( $wcfps_button_label ); ?>	
	</button>
	<input type="hidden" name="free_sample" value="<?php the_ID(); ?>">
	<input type="hidden" name="custom_price" value="<?php echo $settings_options['sample_price']; ?>" />

