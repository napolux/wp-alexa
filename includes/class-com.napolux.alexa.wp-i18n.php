<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://napolux.com
 * @since      1.0.0
 *
 * @package    Com.napolux.alexa.wp
 * @subpackage Com.napolux.alexa.wp/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Com.napolux.alexa.wp
 * @subpackage Com.napolux.alexa.wp/includes
 * @author     Francesco Napoletano <napolux@gmail.com>
 */
class Com.napolux.alexa.wp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'com.napolux.alexa.wp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
