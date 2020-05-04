
<select class="<?php echo esc_attr( $value['class'] ); ?>" id="<?php echo $value['name']; ?>" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>[]" placeholder="<?php echo $value['placeholder']; ?>" multiple="multiple">
    <option value=""><?php esc_html_e( 'Select products', 'woo-free-product-sample' ); ?></option>
    <?php 

        foreach( $value['default'] as $val ) :
            $selected = '';
            if( isset( $setting_options[ $value['name'] ] ) ) :
                if( in_array( $val->ID, $setting_options[ $value['name'] ] ) ) :
                    $selected ='selected';
                endif;
            endif;    
    ?>
    <option value="<?php echo $val->ID; ?>" <?php echo $selected; ?>><?php echo $val->post_title; ?></option>
    <?php 
        endforeach;
    ?>
</select>