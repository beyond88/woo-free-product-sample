<div class="wrap wfps_settings">
    <div id="icon-options-general" class="icon32"></div>
    <h1><?php echo WFPS_PLUGIN_NAME; ?></h1>

    <div id="poststuff">
        <div class="metabox-holder columns-2">
            <!-- main content -->
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable" style="position:relative">
                    <div class="wfps_settings_outer_left">
                        <div class="postbox">
                            <div class="wfps_inside">
								<form method="post" action="options.php" novalidate="novalidate">
									<?php
										settings_fields( $this->_optionGroup );
										$setting_options = wp_parse_args( get_option($this->_optionName), $this->_defaultOptions );
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
                            <!-- .inside -->

                        </div>
                        <!-- .postbox -->

                        <div class="premium clearfix">
                            <div class="premium_left">
                                <h1>Upgrade to <br>Premium Now!</h1>
                               <div class="price">
                                   <span>For only <b>$29.00</b> per site</span>
                               </div>
                                <div class="tagline">
                                    Supercharge Your WooCommerce Stores <br> with our
                                    light, fast and feature-rich plugins.
                                </div>
                                <div>
                                    <a href="https://acowebs.com/woo-custom-product-addons/?ref=free-wfps" target="_blank">Upgrade Now</a>
                                </div>


                            </div>
                            <div class="premium_right">
                                <div class="outer">
                                    <h4>Premium Features</h4>
                                    <ul>
                                        <li>
                                            <b>22+ types of custom product fields.</b>
                                        </li>
                                        <li>
                                            <b>Conditional logic:</b> Show or hide some fields based on the value selected for other fields.
                                        </li>
                                        <li>
                                            <b>Fields based on variations:</b> Show or hide some fields based on the product variation selected.
                                        </li>
                                        <li>
                                            <b>Set price for fields:</b> Price can be set for all the fields available. The price can be a fixed value, percentage value of the product base price.
                                        </li>
                                        <li>
                                            <b>Custom price formula:</b> To calculate price using mathematical formula based on user input value, product quantity, product base price, and based on the prices of other fields as well.
                                        </li>
                                        <li>
                                            <b>WPML</b> and <b>Polylang</b> support.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar">
                        <div class="sidebar_top">
                            <h1>Upgrade to<br> Premium Now!</h1>
                            <div class="price_side">
                               For only<b> $29 </b>per site
                            </div>
                            <div class="tagline_side">Supercharge Your WooCommerce <br>Stores  with our
                                light, fast <br>and feature-rich plugins
                            </div>
                            <div>
                                <a href="https://acowebs.com/woo-custom-product-addons/?ref=free-wfps" target="_blank">Upgrade Now</a>
                            </div>

                        </div>

                        <div class="sidebar_bottom">
                            <ul>
                                <li>
                                    <b>22+ types of custom product fields.</b>
                                </li>
                                <li>
                                    <b>Conditional logic:</b> Show or hide some fields based on the value selected for other fields.
                                </li>
                                <li>
                                    <b>Fields based on variations:</b> Show or hide some fields based on the product variation selected.
                                </li>
                                <li>
                                    <b>Set price for fields:</b> Price can be set for all the fields available. The price can be a fixed value, percentage value of the product base price.
                                </li>
                                <li>
                                    <b>Custom price formula:</b> To calculate price using mathematical formula based on user input value, product quantity, product base price, and based on the prices of other fields as well.
                                </li>
                                <li>
                                    <b>WPML</b> and <b>Polylang</b> support.
                                </li>
                            </ul>
                        </div>
                        <div class="support">
                            <h3>Dedicated Support Team</h3>
                            <p>Our support is what makes us No.1. We are available round the clock for any support.</p>
                            <p><a href="https://wordpress.org/support/plugin/woo-free-product-sample/" target="_blank">Submit a ticket</a></p>
                        </div>

                    </div>

                </div>
                <!-- .meta-box-sortables .ui-sortable -->

            </div>
            <!-- post-body-content -->


            <!-- #postbox-container-1 .postbox-container -->

        </div>
        <!-- #post-body .metabox-holder .columns-2 -->
        <div id="post-body" class="metabox-holder columns-2">

        </div>

        <br class="clear">
    </div>
    <!-- #poststuff -->

</div> <!-- .wrap -->