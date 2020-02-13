<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://profiles.wordpress.org/hossain88
 * @since      1.0.0
 *
 * @package    Wfp_Sample
 * @subpackage Wfp_Sample/includes
 */


class Wfp_Sample_i18n {


	/**
	 *
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wfp-sample',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


}
