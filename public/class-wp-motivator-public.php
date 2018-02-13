<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 * @package    WP_Motivator
 * @subpackage WP_Motivator/public
 * @author     Greg Sweet <greg@ccdzine.com>
 */
class WP_Motivator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp_motivator
	 */
	private $wp_motivator;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wp_motivator
	 * @param      string    $version
	 */
	public function __construct( $wp_motivator, $version ) {

		$this->wp_motivator = $wp_motivator;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function motivator_enqueue_styles() {

		/**
		 * Stylesheet not used.
		 * 
		 * This line and the file are preserved for future development.
		 */

		// wp_enqueue_style( $this->wp_motivator, plugin_dir_url( __FILE__ ) . 'assets/css/wp-motivator-public.css', [], $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function motivator_enqueue_scripts() {

		/**
		 * Script file not used.
		 * 
		 * This line and the file are preserved for future development.
		 */

		// wp_enqueue_script( $this->wp_motivator, plugin_dir_url( __FILE__ ) . 'assets/js/wp-motivator-public.js', [ 'jquery' ], $this->version, false );

	}

}
