<div class="wrap">
    <h1><?php esc_html_e('WooCommerce Free Product Sample Settings','woo-free-product-sample')?></h1>
	<form method="post" action="options.php" novalidate="novalidate">
        <?php
            settings_fields( $this->_optionGroup );
            $settings_options = wp_parse_args( get_option($this->_optionName),$this->_defaultOptions );
        ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
                        <label for="max_qty">
                        	<?php esc_html_e('Max quantity for per order','woo-free-product-sample')?>
                        </label>
                    </th>
					<td>
						<input type="number" class="widefat" maxlength="6" min="0" required name="<?php echo $this->_optionName; ?>[max_qty]" id="max_qty" value="<?php echo $settings_options['max_qty']; ?>" placeholder="<?php esc_html_e('Max quantity for per order','woo-free-product-sample')?>"/>
					</td>
                </tr>
                                              
                <?php do_settings_fields($this->_optionGroup, 'default'); ?>
			</tbody>
		</table>    
		<?php do_settings_sections($this->_optionGroup, 'default'); ?>
		<?php submit_button(); ?>
	</form>	
</div>