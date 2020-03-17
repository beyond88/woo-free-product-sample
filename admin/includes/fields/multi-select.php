<select class="<?php echo esc_attr( $value['class'] ); ?>" id="<?php echo $value['name']; ?>" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>[]" placeholder="<?php echo $value['placeholder']; ?>" multiple="multiple">
    <?php 
        foreach( $value['default'] as $val ) :
    ?>
    <option value="<?php echo $val->ID; ?>" <?php if( in_array( $val->ID, $setting_options[ $value['name'] ] ) ) { echo "selected=selected"; } ?>><?php echo $val->post_title; ?></option>
    <?php 
        endforeach;
    ?>
</select>