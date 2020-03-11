
<input class="<?php echo esc_attr( $value['class'] ); ?>" id="<?php echo $value['name']; ?>" type="number" name="<?php echo $this->_optionName."[".$value['name']."]"; ?>" value="<?php echo $settings_options[$value['name']]; ?>" placeholder="<?php echo $value['placeholder']; ?>" <?php //echo $attrs; ?>>
