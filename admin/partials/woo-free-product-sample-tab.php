<?php 

    $wcfps_enable_freesample        = get_post_meta( $post->ID, 'enable_freesample', true );    
    $wfp_sample_timezone            = get_post_meta( $post->ID, 'wfp_sample_timezone', true );
    $wcfps_limits                   = get_post_meta( $post->ID, 'sample_limits', true );

    if( empty( $wcfps_limits ) ){
        $wcfps_limits = 0;
    }
    
    $wcfps_mt_per_order             = get_post_meta( $post->ID, 'max_qty_per_order', true );  
    if( empty( $wcfps_mt_per_order ) ){
        $wcfps_mt_per_order = 1;
    }

    $wcfps_from_date                = get_post_meta( $post->ID, 'wfp_from_date', true );
    $wcfps_to_date                  = get_post_meta( $post->ID, 'wfp_to_date', true );
    $wcfps_button_text              = get_post_meta( $post->ID, 'button_text', true );
?>
<div id="woo-free-product-sample-tab" class="panel wc-metaboxes-wrapper woocommerce_options_panel">
    <div class="options_group">
        <p class="form-field comment_status_field">
            <label for="enable_freesample"><?php esc_html_e( 'Enable Free Sample', 'woo-free-product-sample' ); ?></label>
            <input type="checkbox" class="checkbox enable_freesample" name="enable_freesample" id="enable_freesample" value="<?php echo esc_attr( $wcfps_enable_freesample ); ?>" <?php checked( "open", $wcfps_enable_freesample, true ); ?>> 
        </p>
    </div>
    <div class="enabled-area">  
        <div class="options_group">
            <p class="form-field menu_order_field">
                <label for="button_text"><?php esc_html_e( 'Button Text', 'woo-free-product-sample' ); ?></label>
                <input type="text" class="short" name="button_text" id="button_text" value="<?php echo esc_attr( $wcfps_button_text ); ?>" placeholder="<?php esc_attr_e( 'Order a Free Sample', 'woo-free-product-sample' ); ?>" maxlength="50">
                <span class="wfp-help-text"> <?php esc_html_e( 'Ex.: Order a Free Sample', 'woo-free-product-sample' ); ?> </span>
            </p>	
        </div>             
    </div>         
</div>    