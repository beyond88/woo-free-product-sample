<?php
/*
 *
 */

$settings_fields = array(
    'dokan_general' => array_merge(
        $general_site_options,
        $general_vendor_store_options
    ),
    'dokan_selling' => array(
        'new_seller_enable_selling' => array(
            'name'    => 'new_seller_enable_selling',
            'label'   => __( 'New Vendor Product Upload', 'dokan-lite' ),
            'desc'    => __( 'Allow newly registered vendors to add products', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'on'
        ),
        'order_status_change' => array(
            'name'    => 'order_status_change',
            'label'   => __( 'Order Status Change', 'dokan-lite' ),
            'desc'    => __( 'Vendor can update order status', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'on'
        ),
        'disable_product_popup' => array(
            'name'    => 'disable_product_popup',
            'label'   => __( 'Disable Product Popup', 'dokan-lite' ),
            'desc'    => __( 'Disable add new product in popup view', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'off'
        ),
        'disable_welcome_wizard' => array(
            'name'    => 'disable_welcome_wizard',
            'label'   => __( 'Disable Welcome Wizard', 'dokan-lite' ),
            'desc'    => __( 'Disable welcome wizard for newly registered vendors', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'off'
        ),
    ),
    'dokan_selling' => array_merge(
        $selling_option_commission,
        $selling_option_vendor_capability
    ),
    'dokan_withdraw' => array(
        'withdraw_methods' => array(
            'name'    => 'withdraw_methods',
            'label'   => __( 'Withdraw Methods', 'dokan-lite' ),
            'desc'    => __( 'Select suitable Withdraw methods for Vendors', 'dokan-lite' ),
            'type'    => 'multicheck',
            'default' => array( 'paypal' => 'paypal' ),
            'options' => dokan_withdraw_get_methods()
        ),
        'withdraw_limit' => array(
            'name'    => 'withdraw_limit',
            'label'   => __( 'Minimum Withdraw Limit', 'dokan-lite' ),
            'desc'    => __( 'Minimum balance required to make a withdraw request. Leave blank to set no minimum limits.', 'dokan-lite' ),
            'default' => '50',
            'type'    => 'text',
        )
    ),
    'dokan_pages' => array(
        'dashboard' => array(
            'name'        => 'dashboard',
            'label'       => __( 'Dashboard', 'dokan-lite' ),
            'desc'        => __( 'Select a page to show Vendor Dashboard', 'dokan-lite' ),
            'type'        => 'select',
            'placeholder' => __( 'Select page', 'dokan-lite' ),
            'options'     => $pages_array,
        ),
        'my_orders' => array(
            'name'    => 'my_orders',
            'label'   => __( 'My Orders', 'dokan-lite' ),
            'desc'        => __( 'Select a page to show My Orders', 'dokan-lite' ),
            'type'    => 'select',
            'placeholder' => __( 'Select page', 'dokan-lite' ),
            'options' => $pages_array,
        ),
        'store_listing' => array(
            'name'        => 'store_listing',
            'label'       => __( 'Store Listing', 'dokan-lite' ),
            'desc'        => __( 'Select a page to show all Stores', 'dokan-lite' ),
            'type'        => 'select',
            'placeholder' => __( 'Select page', 'dokan-lite' ),
            'options'     => $pages_array,
        ),
        'reg_tc_page' => array(
            'name'        => 'reg_tc_page',
            'label'       => __( 'Terms and Conditions Page', 'dokan-lite' ),
            'desc'        => __( 'Select a page to show Terms and Conditions', 'dokan-lite' ),
            'type'        => 'select',
            'placeholder' => __( 'Select page', 'dokan-lite' ),
            'options'     => $pages_array,
            'desc'        => sprintf( __( 'Select where you want to add Dokan pages <a target="_blank" href="%s"> Learn More </a>', 'dokan-lite' ), 'https://wedevs.com/docs/dokan/settings/page-settings-2/' ),
        )
    ),
    'dokan_appearance' => array(
        'store_map' => array(
            'name'    => 'store_map',
            'label'   => __( 'Show Map on Store Page', 'dokan-lite' ),
            'desc'    => __( 'Enable Map of the Store Location in the store sidebar', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'on'
        ),
        'map_api_source' => array(
            'name'               => 'map_api_source',
            'label'              => __( 'Map API Source', 'dokan-lite' ),
            'desc'               => __( 'Which Map API source you want to use in your site?', 'dokan-lite' ),
            'refresh_after_save' => true,
            'type'               => 'radio',
            'default'            => 'google_maps',
            'options'            => array(
                'google_maps' => __( 'Google Maps', 'dokan-lite' ),
                'mapbox'      => __( 'Mapbox', 'dokan-lite' ),
            ),
        ),
        'gmap_api_key' => array(
            'name'    => 'gmap_api_key',
            'show_if' => array(
                'map_api_source' => array(
                    'equal' => 'google_maps',
                )
            ),
            'label'   => __( 'Google Map API Key', 'dokan-lite' ),
            'desc'    => __( '<a href="https://developers.google.com/maps/documentation/javascript/" target="_blank" rel="noopener noreferrer">API Key</a> is needed to display map on store page', 'dokan-lite' ),
            'type'    => 'text',
        ),
        'mapbox_access_token' => array(
            'name'    => 'mapbox_access_token',
            'show_if' => array(
                'map_api_source' => array(
                    'equal' => 'mapbox',
                )
            ),
            'label'   => __( 'Mapbox Access Token', 'dokan-lite' ),
            'desc'    => __( '<a href="https://docs.mapbox.com/help/how-mapbox-works/access-tokens/" target="_blank" rel="noopener noreferrer">Access Token</a> is needed to display map on store page', 'dokan-lite' ),
            'type'    => 'text',
        ),
        'contact_seller' => array(
            'name'    => 'contact_seller',
            'label'   => __( 'Show Contact Form on Store Page', 'dokan-lite' ),
            'desc'    => __( 'Display a vendor contact form in the store sidebar', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'on'
        ),
        'store_header_template' => array(
            'name'    => 'store_header_template',
            'label'   => __( 'Store Header Template', 'dokan-lite' ),
            'type'    => 'radio_image',
            'options' => array(
                'default' => DOKAN_PLUGIN_ASSEST . '/images/store-header-templates/default.png',
                'layout1' => DOKAN_PLUGIN_ASSEST . '/images/store-header-templates/layout1.png',
                'layout2' => DOKAN_PLUGIN_ASSEST . '/images/store-header-templates/layout2.png',
                'layout3' => DOKAN_PLUGIN_ASSEST . '/images/store-header-templates/layout3.png'
            ),
            'default' => 'default',
        ),
        'store_open_close'  => array(
            'name'    => 'store_open_close',
            'label'   => __( 'Store Opening Closing Time Widget', 'dokan-lite' ),
            'desc'    => __( 'Enable store opening & closing time widget in the store sidebar', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'on'
        ),
        'enable_theme_store_sidebar' => array(
            'name'    => 'enable_theme_store_sidebar',
            'label'   => __( 'Enable Store Sidebar From Theme', 'dokan-lite' ),
            'desc'    => __( 'Enable showing Store Sidebar From Your Theme.', 'dokan-lite' ),
            'type'    => 'checkbox',
            'default' => 'off'
        ),
    ),
    'dokan_privacy' => array(
        'enable_privacy' => array(
            'name'    => 'enable_privacy',
            'label'   => __( 'Enable Privacy Policy', 'dokan-lite' ),
            'type'    => 'checkbox',
            'desc'    => __( 'Enable privacy policy for Vendor store contact form', 'dokan-lite' ),
            'default' => 'on'
        ),
        'privacy_page' => array(
            'name'        => 'privacy_page',
            'label'       => __( 'Privacy Page', 'dokan-lite' ),
            'type'        => 'select',
            'desc'        => __( 'Select a page to show your privacy policy', 'dokan-lite' ),
            'placeholder' => __( 'Select page', 'dokan-lite' ),
            'options'     => $pages_array
        ),
        'privacy_policy' => array(
            'name'    => 'privacy_policy',
            'label'   => __( 'Privacy Policy', 'dokan-lite' ),
            'type'    => 'textarea',
            'rows'    => 5,
            'default' => __( 'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our [dokan_privacy_policy]', 'dokan-lite' ),
        )
    )
);

return apply_filters( 'woo_free_product_sample_settings_options', $settings_fields, $this );