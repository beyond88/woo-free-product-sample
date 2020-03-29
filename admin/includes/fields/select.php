
<select class="<?php echo esc_attr( $value['class'] ); ?>" id="<?php echo $value['name']; ?>" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>[]" placeholder="<?php echo $value['placeholder']; ?>">
    <?php 
        foreach( $value['default'] as $key => $val ) :
            $selected = '';
            if( isset( $setting_options[ $value['name'] ] ) ) :
                if( in_array( $key, $setting_options[ $value['name'] ] ) ) :
                    $selected ='selected';
                endif;
            endif;             
    ?>
    <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $val; ?></option>
    <?php 
        endforeach;
    ?>
</select>