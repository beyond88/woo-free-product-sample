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
<div id="wfp-sample-tab" class="panel wc-metaboxes-wrapper woocommerce_options_panel">
    <div class="options_group">
        <p class="form-field comment_status_field">
            <label for="enable_freesample"><?php esc_html_e( 'Enable Free Sample', 'woo-free-product-sample' ); ?></label>
            <input type="checkbox" class="checkbox enable_freesample" name="enable_freesample" id="enable_freesample" value="<?php echo esc_attr( $wcfps_enable_freesample ); ?>" <?php checked( "open", $wcfps_enable_freesample, true ); ?>> 
        </p>
    </div>
    <div class="enabled-area">
    <div class="options_group">
            <p class="form-field menu_order_field ">
                <label for="wfp-sample-timezone"><?php esc_html_e( 'Time Zone', 'woo-free-product-sample' ); ?></label>
                <select name="wfp_sample_timezone" id="wfp_sample_timezone" class="short">
                    <option value=""><?php esc_html_e("Select Timzone", "wfp-sample"); ?></option>
                    <option value="Etc/GMT+12" <?php selected( $wfp_sample_timezone, "Etc/GMT+12" ); ?>>(GMT-12:00) International Date Line West</option>
                    <option value="Pacific/Midway" <?php selected( $wfp_sample_timezone, "Pacific/Midway" ); ?>>(GMT-11:00) Midway Island, Samoa</option>
                    <option value="Pacific/Honolulu" <?php selected( $wfp_sample_timezone, "Pacific/Honolulu" ); ?>>(GMT-10:00) Hawaii</option>
                    <option value="US/Alaska" <?php selected( $wfp_sample_timezone, "US/Alaska" ); ?>>(GMT-09:00) Alaska</option>
                    <option value="America/Los_Angeles" <?php selected( $wfp_sample_timezone, "America/Los_Angeles" ); ?>>(GMT-08:00) Pacific Time (US & Canada)</option>
                    <option value="America/Tijuana" <?php selected( $wfp_sample_timezone, "America/Tijuana" ); ?>>(GMT-08:00) Tijuana, Baja California</option>
                    <option value="US/Arizona" <?php selected( $wfp_sample_timezone, "US/Arizona" ); ?>>(GMT-07:00) Arizona</option>
                    <option value="America/Chihuahua" <?php selected( $wfp_sample_timezone, "America/Chihuahua" ); ?>>(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                    <option value="US/Mountain" <?php selected( $wfp_sample_timezone, "US/Mountain" ); ?>>(GMT-07:00) Mountain Time (US & Canada)</option>
                    <option value="America/Managua" <?php selected( $wfp_sample_timezone, "America/Managua" ); ?>>(GMT-06:00) Central America</option>
                    <option value="US/Central" <?php selected( $wfp_sample_timezone, "US/Central" ); ?>>(GMT-06:00) Central Time (US & Canada)</option>
                    <option value="America/Mexico_City" <?php selected( $wfp_sample_timezone, "America/Mexico_City" ); ?>>(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                    <option value="Canada/Saskatchewan" <?php selected( $wfp_sample_timezone, "Canada/Saskatchewan" ); ?>>(GMT-06:00) Saskatchewan</option>
                    <option value="America/Bogota" <?php selected( $wfp_sample_timezone, "America/Bogota" ); ?>>(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                    <option value="US/Eastern" <?php selected( $wfp_sample_timezone, "US/Eastern" ); ?>>(GMT-05:00) Eastern Time (US & Canada)</option>
                    <option value="US/East-Indiana" <?php selected( $wfp_sample_timezone, "US/East-Indiana" ); ?>>(GMT-05:00) Indiana (East)</option>
                    <option value="Canada/Atlantic" <?php selected( $wfp_sample_timezone, "Canada/Atlantic" ); ?>>(GMT-04:00) Atlantic Time (Canada)</option>
                    <option value="America/Caracas" <?php selected( $wfp_sample_timezone, "America/Caracas" ); ?>>(GMT-04:00) Caracas, La Paz</option>
                    <option value="America/Manaus" <?php selected( $wfp_sample_timezone, "America/Manaus" ); ?>>(GMT-04:00) Manaus</option>
                    <option value="America/Santiago" <?php selected( $wfp_sample_timezone, "America/Santiago" ); ?>>(GMT-04:00) Santiago</option>
                    <option value="Canada/Newfoundland" <?php selected( $wfp_sample_timezone, "Canada/Newfoundland" ); ?>>(GMT-03:30) Newfoundland</option>
                    <option value="America/Sao_Paulo" <?php selected( $wfp_sample_timezone, "America/Sao_Paulo" ); ?>>(GMT-03:00) Brasilia</option>
                    <option value="America/Argentina/Buenos_Aires" <?php selected( $wfp_sample_timezone, "America/Argentina/Buenos_Aires" ); ?>>(GMT-03:00) Buenos Aires, Georgetown</option>
                    <option value="America/Godthab" <?php selected( $wfp_sample_timezone, "America/Godthab" ); ?>>(GMT-03:00) Greenland</option>
                    <option value="America/Montevideo" <?php selected( $wfp_sample_timezone, "America/Montevideo" ); ?>>(GMT-03:00) Montevideo</option>
                    <option value="America/Noronha" <?php selected( $wfp_sample_timezone, "America/Noronha" ); ?>>(GMT-02:00) Mid-Atlantic</option>
                    <option value="Atlantic/Cape_Verde" <?php selected( $wfp_sample_timezone, "Atlantic/Cape_Verde" ); ?>>(GMT-01:00) Cape Verde Is.</option>
                    <option value="Atlantic/Azores" <?php selected( $wfp_sample_timezone, "Atlantic/Azores" ); ?>>(GMT-01:00) Azores</option>
                    <option value="Africa/Casablanca" <?php selected( $wfp_sample_timezone, "Africa/Casablanca" ); ?>>(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                    <option value="Etc/Greenwich" <?php selected( $wfp_sample_timezone, "Etc/Greenwich" ); ?>>(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                    <option value="Europe/Amsterdam" <?php selected( $wfp_sample_timezone, "Europe/Amsterdam" ); ?>>(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                    <option value="Europe/Belgrade" <?php selected( $wfp_sample_timezone, "Europe/Belgrade" ); ?>>(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                    <option value="Europe/Brussels" <?php selected( $wfp_sample_timezone, "Europe/Brussels" ); ?>>(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                    <option value="Europe/Sarajevo" <?php selected( $wfp_sample_timezone, "Europe/Sarajevo" ); ?>>(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                    <option value="Africa/Lagos" <?php selected( $wfp_sample_timezone, "Africa/Lagos" ); ?>>(GMT+01:00) West Central Africa</option>
                    <option value="Asia/Amman" <?php selected( $wfp_sample_timezone, "Asia/Amman" ); ?>>(GMT+02:00) Amman</option>
                    <option value="Europe/Athens" <?php selected( $wfp_sample_timezone, "Europe/Athens" ); ?>>(GMT+02:00) Athens, Bucharest, Istanbul</option>
                    <option value="Asia/Beirut" <?php selected( $wfp_sample_timezone, "Asia/Beirut" ); ?>>(GMT+02:00) Beirut</option>
                    <option value="Africa/Cairo" <?php selected( $wfp_sample_timezone, "Africa/Cairo" ); ?>>(GMT+02:00) Cairo</option>
                    <option value="Africa/Harare" <?php selected( $wfp_sample_timezone, "Africa/Harare" ); ?>>(GMT+02:00) Harare, Pretoria</option>
                    <option value="Europe/Helsinki" <?php selected( $wfp_sample_timezone, "Europe/Helsinki" ); ?>>(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                    <option value="Asia/Jerusalem" <?php selected( $wfp_sample_timezone, "Asia/Jerusalem" ); ?>>(GMT+02:00) Jerusalem</option>
                    <option value="Europe/Minsk" <?php selected( $wfp_sample_timezone, "Europe/Minsk" ); ?>>(GMT+02:00) Minsk</option>
                    <option value="Africa/Windhoek" <?php selected( $wfp_sample_timezone, "Africa/Windhoek" ); ?>>(GMT+02:00) Windhoek</option>
                    <option value="Asia/Kuwait" <?php selected( $wfp_sample_timezone, "Asia/Kuwait" ); ?>>(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                    <option value="Europe/Moscow" <?php selected( $wfp_sample_timezone, "Europe/Moscow" ); ?>>(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                    <option value="Africa/Nairobi" <?php selected( $wfp_sample_timezone, "Africa/Nairobi" ); ?>>(GMT+03:00) Nairobi</option>
                    <option value="Asia/Tbilisi" <?php selected( $wfp_sample_timezone, "Asia/Tbilisi" ); ?>>(GMT+03:00) Tbilisi</option>
                    <option value="Asia/Tehran" <?php selected( $wfp_sample_timezone, "Asia/Tehran" ); ?>>(GMT+03:30) Tehran</option>
                    <option value="Asia/Muscat" <?php selected( $wfp_sample_timezone, "Asia/Muscat" ); ?>>(GMT+04:00) Abu Dhabi, Muscat</option>
                    <option value="Asia/Baku" <?php selected( $wfp_sample_timezone, "Asia/Baku" ); ?>>(GMT+04:00) Baku</option>
                    <option value="Asia/Yerevan" <?php selected( $wfp_sample_timezone, "Asia/Yerevan" ); ?>>(GMT+04:00) Yerevan</option>
                    <option value="Asia/Kabul" <?php selected( $wfp_sample_timezone, "Asia/Kabul" ); ?>>(GMT+04:30) Kabul</option>
                    <option value="Asia/Yekaterinburg" <?php selected( $wfp_sample_timezone, "Asia/Yekaterinburg" ); ?>>(GMT+05:00) Yekaterinburg</option>
                    <option value="Asia/Karachi" <?php selected( $wfp_sample_timezone, "Asia/Karachi" ); ?>>(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                    <option value="Asia/Calcutta" <?php selected( $wfp_sample_timezone, "Asia/Calcutta" ); ?>>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                    <option value="Asia/Calcutta" <?php selected( $wfp_sample_timezone, "Asia/Calcutta" ); ?>>(GMT+05:30) Sri Jayawardenapura</option>
                    <option value="Asia/Katmandu" <?php selected( $wfp_sample_timezone, "Asia/Katmandu" ); ?>>(GMT+05:45) Kathmandu</option>
                    <option value="Asia/Almaty" <?php selected( $wfp_sample_timezone, "Asia/Almaty" ); ?>>(GMT+06:00) Almaty, Novosibirsk</option>
                    <option value="Asia/Dhaka" <?php selected( $wfp_sample_timezone, "Asia/Dhaka" ); ?>>(GMT+06:00) Astana, Dhaka</option>
                    <option value="Asia/Rangoon" <?php selected( $wfp_sample_timezone, "Asia/Rangoon" ); ?>>(GMT+06:30) Yangon (Rangoon)</option>
                    <option value="Asia/Bangkok" <?php selected( $wfp_sample_timezone, "Asia/Bangkok" ); ?>>(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                    <option value="Asia/Krasnoyarsk" <?php selected( $wfp_sample_timezone, "Asia/Krasnoyarsk" ); ?>>(GMT+07:00) Krasnoyarsk</option>
                    <option value="Asia/Hong_Kong" <?php selected( $wfp_sample_timezone, "Asia/Hong_Kong" ); ?>>(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                    <option value="Asia/Kuala_Lumpur" <?php selected( $wfp_sample_timezone, "Asia/Kuala_Lumpur" ); ?>>(GMT+08:00) Kuala Lumpur, Singapore</option>
                    <option value="Asia/Irkutsk" <?php selected( $wfp_sample_timezone, "Asia/Irkutsk" ); ?>>(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                    <option value="Australia/Perth"<?php selected( $wfp_sample_timezone, "Australia/Perth" ); ?>>(GMT+08:00) Perth</option>
                    <option value="Asia/Taipei" <?php selected( $wfp_sample_timezone, "Asia/Taipei" ); ?>>(GMT+08:00) Taipei</option>
                    <option value="Asia/Tokyo" <?php selected( $wfp_sample_timezone, "Asia/Tokyo" ); ?>>(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                    <option value="Asia/Seoul" <?php selected( $wfp_sample_timezone, "Asia/Seoul" ); ?>>(GMT+09:00) Seoul</option>
                    <option value="Asia/Yakutsk" <?php selected( $wfp_sample_timezone, "Asia/Yakutsk" ); ?>>(GMT+09:00) Yakutsk</option>
                    <option value="Australia/Adelaide" <?php selected( $wfp_sample_timezone, "Australia/Adelaide" ); ?>>(GMT+09:30) Adelaide</option>
                    <option value="Australia/Darwin" <?php selected( $wfp_sample_timezone, "Australia/Darwin" ); ?>>(GMT+09:30) Darwin</option>
                    <option value="Australia/Brisbane" <?php selected( $wfp_sample_timezone, "Australia/Brisbane" ); ?>>(GMT+10:00) Brisbane</option>
                    <option value="Australia/Canberra" <?php selected( $wfp_sample_timezone, "Australia/Canberra" ); ?>>(GMT+10:00) Canberra, Melbourne, Sydney</option>
                    <option value="Australia/Hobart" <?php selected( $wfp_sample_timezone, "Australia/Hobart" ); ?>>(GMT+10:00) Hobart</option>
                    <option value="Pacific/Guam" <?php selected( $wfp_sample_timezone, "Pacific/Guam" ); ?>>(GMT+10:00) Guam, Port Moresby</option>
                    <option value="Asia/Vladivostok" <?php selected( $wfp_sample_timezone, "Asia/Vladivostok" ); ?>>(GMT+10:00) Vladivostok</option>
                    <option value="Asia/Magadan" <?php selected( $wfp_sample_timezone, "Asia/Magadan" ); ?>>(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                    <option value="Pacific/Auckland" <?php selected( $wfp_sample_timezone, "Pacific/Auckland" ); ?>>(GMT+12:00) Auckland, Wellington</option>
                    <option value="Pacific/Fiji" <?php selected( $wfp_sample_timezone, "Pacific/Fiji" ); ?>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                    <option value="Pacific/Tongatapu" <?php selected( $wfp_sample_timezone, "Pacific/Tongatapu" ); ?>>(GMT+13:00) Nuku'alofa</option>
                </select>
                <?php esc_html_e( 'Ex.: If don\'t select than server timezone will be set as default', 'woo-free-product-sample' ); ?> </span> 
            </p>	
        </div>           
        <div class="options_group">
            <p class="form-field menu_order_field ">
                <label for="sample_limits"><?php esc_html_e( 'Stock Quantity', 'woo-free-product-sample' ); ?></label>
                <input type="number" class="short" name="sample_limits" id="sample_limits" value="<?php echo esc_attr( $wcfps_limits );  ?>" step="1"> 
            </p>	
        </div>       
        <div class="options_group">
            <p class="form-field menu_order_field ">
                <label for="max_qty_per_order"><?php esc_html_e( 'Max. quantity for per order', 'woo-free-product-sample' ); ?></label>
                <input type="number" class="short" name="max_qty_per_order" id="max_qty_per_order" value="<?php echo esc_attr( $wcfps_mt_per_order );  ?>" step="1"> 
            </p>	
        </div>         
        <div class="options_group">
            <p class="form-field menu_order_field">
                <label for="wfp_from_date"><?php esc_html_e( 'Promotion Start Date', 'woo-free-product-sample' ); ?></label>
                <input type="text" class="short" autocomplete="off" name="wfp_from_date" id="wfp_from_date" value="<?php echo esc_attr( $wcfps_from_date ); ?>" placeholder="<?php esc_attr_e( 'YYYY-MM-DD', 'woo-free-product-sample' ); ?>" maxlength="10">
            </p>	
        </div>   
        <div class="options_group">
            <p class="form-field menu_order_field">
                <label for="wfp_to_date"><?php esc_html_e( 'Promotion End Date', 'woo-free-product-sample' ); ?></label>
                <input type="text" class="short" autocomplete="off"  name="wfp_to_date" id="wfp_to_date" value="<?php echo esc_attr( $wcfps_to_date ); ?>" placeholder="<?php esc_attr_e( 'YYYY-MM-DD', 'woo-free-product-sample' ); ?>" maxlength="10">
            </p>	
        </div>  
        <div class="options_group">
            <p class="form-field menu_order_field">
                <label for="button_text"><?php esc_html_e( 'Button Text', 'woo-free-product-sample' ); ?></label>
                <input type="text" class="short" name="button_text" id="button_text" value="<?php echo esc_attr( $wcfps_button_text ); ?>" placeholder="<?php esc_attr_e( 'Order a Free Sample', 'woo-free-product-sample' ); ?>" maxlength="50">
                <span class="wfp-help-text"> <?php esc_html_e( 'Ex.: Order a Free Sample', 'woo-free-product-sample' ); ?> </span>
            </p>	
        </div>             
    </div>         
</div>    