<?php

/**
 * Define the internationalization functionality
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/includes
 * @author     Greg Sweet <greg@ccdzine.com>
 */
class WP_Motivator_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-motivator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
