<div class="wrap">
    <h1><?php esc_html_e('WooCommerce Free Product Sample','woo-free-product-sample')?></h1>
	<form method="post" action="options.php" novalidate="novalidate">
        <?php
            settings_fields( $this->_optionGroup );
			$settings_options = wp_parse_args( get_option($this->_optionName), $this->_defaultOptions );
        ?>
		<table class="form-table">
			<tbody>

				<?php 
					foreach( $settings as  $key => $value ) :
				?>
				
				<tr>
					<th scope="row">
                        <label for="<?php echo $value['name']; ?>">
							<?php echo $value['label']; ?>	
                        </label>
                    </th>
					<td>	
						<?php 
							$file_name = isset( $value['type'] ) ? $value['type'] : 'text';							
							
							if( $file_name ) {
								include WFPS_ADMIN_DIR_PATH . 'includes/fields/'. $file_name .'.php';
							}
							if( isset( $value['description'] ) ) {
						?>
							<div class="woo-free-product-sample-form-desc"><?php echo $value['description']; ?></div>
						<?php } ?>
					</td>
                </tr>
                                              
				<?php endforeach; ?>							
															  
                <?php do_settings_fields( $this->_optionGroup, 'default' ); ?>
			</tbody>
		</table>    
		<?php do_settings_sections($this->_optionGroup, 'default'); ?>
		<?php submit_button(); ?>
	</form>	
</div>