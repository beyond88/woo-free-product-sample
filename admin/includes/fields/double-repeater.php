<table class="form-table">
    <tbody id="append_body">
        <?php if( is_array($setting_options[$value['name']]) ) { ?>
        <?php 
            $i=0; 
            foreach( $setting_options[$value['name']]['qty'] as $val ){      
        ?>
        <tr valign="top">
            <td class="middle-align">
                <input type="text" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>[qty][]" maxlength="30" class="timezone_string wfps-meta-field playfield" placeholder="<?php esc_html_e( 'Quantity', 'woo-free-product-sample' ); ?>" value="<?php echo $val; ?>">               
                <input type="text" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>[price][]" maxlength="30" class="timezone_string wfps-meta-field playfield" placeholder="<?php esc_html_e( 'Price', 'woo-free-product-sample' ); ?>" value="<?php echo $setting_options[$value['name']]['price'][$i]; ?>">
            </td>
        </tr>             
        <?php $i++;} ?>         
        <?php } else { ?>
        <tr valign="top">
            <td class="middle-align">
                <input type="text" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>[qty][]" maxlength="30" value="" class="timezone_string wfps-meta-field playfield" placeholder="<?php esc_html_e( 'Quantity', 'woo-free-product-sample' ); ?>">               
                <input type="text" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>[price][]" maxlength="30" value="" class="timezone_string wfps-meta-field playfield" placeholder="<?php esc_html_e( 'Price', 'woo-free-product-sample' ); ?>">
            </td>
        </tr>    
        <?php } ?>
    </tbody>
</table>

<table class="form-table">
    <tr valign="top">
        <td class="middle-align">
            <div class="wfps-click-area-wrapper">
                <div class="wfps-click-overlay" id="wfps-click-overlay"></div>
                <label for="add-field" class="wfps-group-field-add" >
                    <span class="dashicons dashicons-plus-alt rx_add_field_icon"></span>
                    <span class="rx_add_field_label"><?php esc_html_e( 'Add Sample Price', 'woo-free-product-sample' );?></span>
                    <input type="button" name="add-field" id="add-field" class="timezone_string add-field" value="">
                </label>
            </div>            
        </td>
    </tr>
</table> 
